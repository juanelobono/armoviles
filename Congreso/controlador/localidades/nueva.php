<?php
	/*
	 * DEFINIR VARIABLES GENERALES 
	 */
	//define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("codigo", "nombre", "codigo_postal", "provincia");
        $opcionalesPOST = array();
//	/*
//	 * SCRIPT REQUERIDOS 
//	 */
        require_once("../validacionUsuario.php");
	require_once("../validacionCampos.php");
        require_once('../../conexionBD.php');
        require_once('localidadExistente.php');
//	/*
//	 * VALIDAR VARIABLES RECIBIDAS
//	 */
	if(!empty($camposGET)) 
		validarGET($camposGET);
	if(!empty($camposPOST))
		validarPOST($camposPOST);	
	if(!empty($opcionalesPOST))
		$opcionalesValidados = opcionalesPOST($opcionalesPOST);	
	
	/*
	 * ASIGNAR VARIABLES RECIBIDAS
	 */								
	$codigo = (int)$_POST['codigo'];
	$nombre = $_POST['nombre'];
        $codigoPostal = $_POST['codigo_postal'];
        $provincia = $_POST['provincia'];
	
        $localidadDisponible = validarLocalidadExistente($codigo, $nombre, $conexionbd);  
        if($localidadDisponible == "disponible" ){
            
            /*
             * ESTABLECER CONSULTA
             */
            comenzarTransaccion($conexionbd);
            $query = "
                    INSERT INTO localidad(
                            id, 
                            nombre,
                            codigo_postal,
                            provincia_id
                    )VALUES($codigo, 
                            '$nombre',
                            $codigoPostal,
                            $provincia)";

            $respuesta = realizarOperacion($query, $conexionbd);
            $respuestaArray = explode("_", $respuesta);

            if($respuestaArray[0] == "exito"){
                finalizarTransaccion(true, $conexionbd);
            }else{
                finalizarTransaccion(false, $conexionbd);
            }
            exit($respuesta);
        }else{
            exit($localidadDisponible);
        }
?>