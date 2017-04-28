<?php

	/*
	 * DEFINIR VARIABLES GENERALES 
	 */
	define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("contrasenia");
	
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
        
	$pass = $_POST['contrasenia'];
        $pass_encriptada1 = md5 ($pass); //Encriptacion nivel 1
        $pass_encriptada2 = crc32($pass_encriptada1); //Encriptacion nivel 1
        $pass_encriptada3 = crypt($pass_encriptada2, "xtemp"); //Encriptacion nivel 2
        $pass_encriptada4 = sha1("xtemp".$pass_encriptada3); //Encriptacion nivel 3
        
        comenzarTransaccion($conexionbd);

            $query = "
                UPDATE 
                        usuario
                SET
                        contrasenia = '$pass_encriptada4'
                WHERE 
                        id = $id";            

        $respuesta = realizarOperacion($query, $conexionbd, true);
        $respuestaArray = explode("_", $respuesta);

        if($respuestaArray[0] == "exito"){
            finalizarTransaccion(true, $conexionbd);
        }else{
            finalizarTransaccion(false, $conexionbd);
        }
        exit($respuesta);
?>