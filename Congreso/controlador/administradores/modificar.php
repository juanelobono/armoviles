<?php

	/*
	 * DEFINIR VARIABLES GENERALES 
	 */
	define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("nombre", "apellido", "usuario");
	$campoEmail = array("campo"=> "email", "valorEmpty" => " ");
        $campoActivo = array("campo" => "activo", "valorEmpty" => 0, "valorNotEmpty" => 1);
        $campoChkPermiso = array("campo" => "chkPermiso", "valorEmpty" => "");
	$opcionalesPOST = array($campoEmail,$campoChkPermiso,$campoActivo);
	
	/*
	 * SCRIPT REQUERIDOS 
	 */
	require_once("../validacionCampos.php");   
        require_once('../../conexionBD.php');
        require_once('usuarioExistente.php');
	
	/*
	 * VALIDAR VARIABLES RECIBIDAS
	 */
	if(!empty($camposGET)) 
		validarGET($camposGET);
	if(!empty($camposPOST))
		validarPOST($camposPOST);	
	if(!empty($opcionalesPOST))
		$opcionalesValidados = opcionalesPOST($opcionalesPOST);	
	$cambioContrasenia = false;
        
	$id = $_POST['idDB'];
        
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
        $usuario = $_POST['usuario'];
        $email = $opcionalesValidados['email'];
        $activo = $opcionalesValidados['activo'];
        $permisos = $opcionalesValidados['chkPermiso'];        
	
        $usuarioUtilizado = validarUsuarioAdministrador($usuario, $conexionbd);  
        
        if(sizeof($usuarioUtilizado) == 0 ||
                (sizeof($usuarioUtilizado) == 1 && $usuarioUtilizado[0]['id'] == $id)){
            
            comenzarTransaccion($conexionbd);
            
                $query = "
                    UPDATE 
                            usuario
                    SET
                            nombre = '$nombre',
                            apellido = '$apellido',
                            usuario = '$usuario',
                            email = '$email',
                            activo = '$activo'
                    WHERE 
                            id = $id";            
            
            $respuesta = realizarOperacion($query, $conexionbd, true);
            $respuesta = explode("_", $respuesta);	
            if($respuesta[0] == "exito"){
                /*
                 * ESTABLECER CONSULTA
                 */
                $query = "
                    DELETE FROM 
                        permiso
                    WHERE
                        usuario_id = $id";

                $respuesta = realizarOperacion($query, $conexionbd, true);
                $respuesta = explode("_", $respuesta);	
                if($respuesta[0] != "exito"){
                    die("Error al eliminar los permisos del usuario.");
                }
                if(!empty($permisos)){
                    foreach ($permisos as $permiso) {
                        $idSeccion = $permiso;
                        /*
                         * ESTABLECER CONSULTA
                         */
                        $query = "
                                INSERT INTO permiso(
                                        usuario_id,
                                        seccion_id
                                )VALUES(
                                        $id,
                                        $idSeccion)";

                        $respuesta = realizarOperacion($query, $conexionbd);
                        $respuesta = explode("_", $respuesta);	
                        if($respuesta[0] != "exito"){
                            finalizarTransaccion(false, $conexionbd);
                            die("Error al agregar permisos al usuario.");
                        }			
                    }	
                }
                finalizarTransaccion(true, $conexionbd);
                exit("exito_" .$id);
            }else{
                finalizarTransaccion(false, $conexionbd);
                die("Error al actualizar el nombre del usuario.");
            }            
        }else{
            exit("Ya existe un Administrador con ese Nombre de Usuario.");
        }        
?>