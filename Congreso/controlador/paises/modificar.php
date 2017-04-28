<?php

        /*
	 * DEFINIR VARIABLES GENERALES 
	 */
	//define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("nombre");
        $opcionalesPOST = array();
//	/*
//	 * SCRIPT REQUERIDOS 
//	 */
        require_once("../validacionUsuario.php");
	require_once("../validacionCampos.php");
        require_once('../../conexionBD.php');
        require_once('nombreRegistrado.php');
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
	$codigo = $_POST['idDB'];
	$nombre = $_POST['nombre'];
	
        $nombreUtilizado = validarNombreDisponible($nombre, $conexionbd);  
        
        if(sizeof($nombreUtilizado) == 0 ||
                (sizeof($nombreUtilizado) == 1 && $nombreUtilizado[0]['id'] == $codigo)){
            /*
             * ESTABLECER CONSULTA
             */
            comenzarTransaccion($conexionbd);
            $query = "
                    UPDATE 
                        pais
                    SET
                        nombre = '$nombre'
                    WHERE 
                        id = $codigo";

            $respuesta = realizarOperacion($query, $conexionbd, true);
            $respuestaArray = explode("_", $respuesta);

            if($respuestaArray[0] == "exito"){
                finalizarTransaccion(true, $conexionbd);
            }else{
                finalizarTransaccion(false, $conexionbd);
            }
            exit($respuesta);
        }else{
            exit("Ya existe un País con ese nombre.");
        }
?>