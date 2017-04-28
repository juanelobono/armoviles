<?php

class ControladorUsuarios {

    /**
     * Login usuarios desde el móvil
     *
     * @url POST /usuarios/login
     */
    public function login() {

        $db = new MySQL();
        $email = $_POST['email'];
        $contrasenia = $_POST['contrasenia'];

        $query = "
            SELECT 
				u.id, 
				u.contrasenia
			FROM 
				usuario AS u 
			WHERE 
				u.email = '$email' AND
				u.contrasenia = '$contrasenia' AND
				u.activo = 1";

        $respuesta = $db->consultaRegistroArray($query);
        if (!empty($respuesta)) {
			$idUsuario = $respuesta[0]['id'];
            $query = "
                SELECT 
					*
                FROM 
					sesion 
                WHERE 
					usuario_id = '$idUsuario'";
            $respuesta = $db->consultaRegistroArray($query);
            if (!empty($respuesta)) {
            	$db->comenzarTransaccion();
                $inicio_sesion = date("Y-m-d H:i:s");
                $uuid = $respuesta[0]['uuid'];
                $uuidNuevo = $this->getGUID();

                $query = "
					UPDATE 
						sesion 
					SET
						inicio_sesion = '$inicio_sesion',
						uuid = '$uuidNuevo'
					WHERE 
						uuid = '$uuid'";
                $respuesta = $db->realizarOperacion($query);
                $respuestaArray = explode("_", $respuesta);
                if ($respuestaArray[0] == "exito") {
                    $db->finalizarTransaccion(true);
                    return array("error" => false, "mensaje" => "Exito", "token" => $uuidNuevo);
                } else {
                	$db->finalizarTransaccion(false);
                    return array("error" => true, "mensaje" => "No se puede iniciar sesion. Intentelo mas tarde o comuniquese con el administrador.", "token" => "");
                }
            } else {
                $db->comenzarTransaccion();
                $inicio_sesion = date("Y-m-d H:i:s");
                $uuid = $this->getGUID();
                $query = "
					INSERT INTO sesion(
							inicio_sesion,
							usuario_id,
							uuid
					)VALUES(
							'$inicio_sesion',
							'$idUsuario',
							'$uuid')";
                $respuesta = $db->realizarOperacion($query);
                $respuestaArray = explode("_", $respuesta);
                if ($respuestaArray[0] == "exito") {
                    $db->finalizarTransaccion(true);
                    return array("error" => false, "mensaje" => "Exito", "token" => $uuid);
                } else {
                	$db->finalizarTransaccion(false);
                    return array("error" => true, "mensaje" => "No se puede iniciar sesion. Intentelo mas tarde o comuniquese con el administrador.", "token" => "");
                }
            }
        } else {
            return array("error" => true, "mensaje" => "Usuario o contraseña incorrectos.", "token" => "");
        }
    }

    /**
     * Devuelve todos los usuarios del sistema
     *
     * @url GET /usuarios/todos
     */
    public function todos() {
        $db = new MySQL();
        $query = "
            SELECT 	
                u.id,
                u.nombre,
                u.apellido,
                u.dni,
                u.domicilio,
                u.telefono,
                u.localidad_id as idlocalidad,
                l.nombre as localidad
            FROM			
                usuario as u join
                localidad as l on u.localidad_id = l.id
            WHERE
                activo = 1";
        $mozos = $db->consultaArray($query);

        return array("usuarios" => $mozos);
    }


     /**
     *	Registra un nuevo usuario
     *
     * @url POST /usuarios/nuevo
     */
    public function NuevoUsuario() {
        $db = new MySQL();
        $apellido = $_POST['apellido'];
        $nombre = $_POST['nombre'];
        $contrasenia = $_POST['contrasenia'];
        //$dni = $_POST['dni'];
        $email= $_POST['email'];
        //$fecha_nacimiento = $_POST['fecha_nacimiento'];
        //$domicilio = $_POST['domicilio'];
        //$telefono = $_POST['telefono'];
        //$localidad = $_POST['localidad'];
        //$legajo = $_POST['legajo'];

        //verifico no este registrado
        $query = "
                SELECT 
                    nombre
                FROM 
                    usuario 
                WHERE 
                    email = '$email'";
            $respuesta = $db->consultaRegistroArray($query);
            if (!empty($respuesta)) {
                return array("error" => true, "mensaje" => "Ya existe un usuario registrado con el correo $email.");
            }

        $db->comenzarTransaccion();
        $query = "
           INSERT INTO usuario(
                            nombre,
                            apellido,
                            email,
                            contrasenia,
                            activo                            
                    )VALUES(
                            '$nombre',
                            '$apellido',
                            '$email',
                            '$contrasenia',
                            1                            
                           )";

        
       $respuesta = $db->realizarOperacion($query);
       $respuestaArray = explode("_", $respuesta);
        if ($respuestaArray[0] == "exito") {
            $db->finalizarTransaccion(true);
            return array("error" => false, "mensaje" => "Exito.");        
        }else{
            $db->finalizarTransaccion(false);
            return array("error" => true, "mensaje" => "No se pudo completar la operación. Intentelo mas tarde");
        }
    }

    /**
     * Cierre de sesión del usuario
     *
     * @url POST /usuarios/cerrarsesion
     */
    public function cerrarSesion() {
        $db = new MySQL();
        $token = $_POST['token'];

        //Validacion sesion activa
        $query = "
            SELECT 	
                usuario_id,
                inicio_sesion
            FROM			
                sesion 
            WHERE
                uuid = '$token'";

        $respuesta = $db->consultaArray($query);
        if (empty($respuesta)) {
            return array("error" => true, "mensaje" => "La sesión caducó.");
        }

        $idUsuario = $respuesta[0]['usuario_id'];

		$queryEliminarSesion = "
			DELETE FROM 
				sesion
			WHERE 
				usuario_id = $idUsuario";

		$rtaEliminarSesion = $db->realizarOperacion($queryEliminarSesion);
		$respuestaArray = explode("_", $rtaEliminarSesion);

		if ($respuestaArray[0] == "exito") {
			$db->finalizarTransaccion(true);
			return array("error" => false, "mensaje" => "Exito.");
		}
				
    }
	
	/**
	 * Metodos privados
	 */	
	
	
    private function getGUID() {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = chr(123)// "{"
                    . substr($charid, 0, 8) . $hyphen
                    . substr($charid, 8, 4) . $hyphen
                    . substr($charid, 12, 4) . $hyphen
                    . substr($charid, 16, 4) . $hyphen
                    . substr($charid, 20, 12)
                    . chr(125); // "}"
            return $uuid;
        }
    }

}
