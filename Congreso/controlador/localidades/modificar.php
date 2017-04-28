<?php

        /*
	 * DEFINIR VARIABLES GENERALES 
	 */
	//define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("nombre", "codigo_postal", "provincia_seleccionada");
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
	$codigoPostal = $_POST['codigo_postal'];
        $provinciaVec = explode("-", $_POST['provincia_seleccionada']);   
        $provincia = trim($provinciaVec[0]);
	
        $nombreUtilizado = validarNombreDisponible($nombre, $conexionbd);  
        
        if(sizeof($nombreUtilizado) == 0 ||
                (sizeof($nombreUtilizado) == 1 && $nombreUtilizado[0]['id'] == $codigo)){
            /*
             * ESTABLECER CONSULTA
             */
            comenzarTransaccion($conexionbd);
            $query = "
                    UPDATE 
                        localidad
                    SET
                        nombre = '$nombre',
                        codigo_postal = $codigoPostal,
                        provincia_id = '$provincia'
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
            exit("Ya existe una Localidad con ese nombre.");
        }
?>