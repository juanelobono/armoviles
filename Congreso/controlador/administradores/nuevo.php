<?php
	/*
	 * DEFINIR VARIABLES GENERALES 
	 */
	//define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("nombre", "apellido","usuario","contrasenia");        
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
	
	/*
	 * ASIGNAR VARIABLES RECIBIDAS
	 */								
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];
        $pass_encriptada1 = md5 ($contrasenia); //Encriptacion nivel 1
	$pass_encriptada2 = crc32($pass_encriptada1); //Encriptacion nivel 1
	$pass_encriptada3 = crypt($pass_encriptada2, "xtemp"); //Encriptacion nivel 2
	$pass_encriptada4 = sha1("xtemp".$pass_encriptada3); //Encriptacion nivel 3
        
        $email = $opcionalesValidados['email'];    
        $activo = $opcionalesValidados['activo'];
        $permisos = $opcionalesValidados['chkPermiso'];
	
        $usuarioUtilizado = validarUsuarioAdministrador($usuario, $conexionbd);  
        
        if(sizeof($usuarioUtilizado) == 0 ){
            /*
             * ESTABLECER CONSULTA
             */
            comenzarTransaccion($conexionbd);
            $query = "
                    INSERT INTO usuario(
                            nombre,
                            apellido,
                            usuario,
                            contrasenia,
                            activo,
                            tipo,
                            email
                    )VALUES('$nombre',
                            '$apellido',
                            '$usuario',
                            '$pass_encriptada4',
                            '$activo',
                            'admin',
                            '$email')";
            
            $respuesta = realizarOperacion($query, $conexionbd);
            $respuesta = explode("_", $respuesta);

            if($respuesta[0] == "exito"){
                $idUsuario = $respuesta[1];
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
                                        $idUsuario,
                                        $idSeccion)";

                        $respuesta = realizarOperacion($query, $conexionbd);
                        $respuesta = explode("_", $respuesta);	
                        if($respuesta[0] != "exito"){
                            finalizarTransaccion(false, $conexionbd);
                            die("error");
                        }			
                    }	
                }
                finalizarTransaccion(true, $conexionbd);
                exit("exito_" .$idUsuario);
            }
            finalizarTransaccion(false, $conexionbd);
            die("error");
        }else{
            exit("Ya existe un Administrador con ese Nombre de Usuario.");
        }
?>