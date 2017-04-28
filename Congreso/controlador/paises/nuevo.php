<?php
	/*
	 * DEFINIR VARIABLES GENERALES 
	 */
	//define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("codigo", "nombre");
        $opcionalesPOST = array();
//	/*
//	 * SCRIPT REQUERIDOS 
//	 */
        require_once("../validacionUsuario.php");
	require_once("../validacionCampos.php");
        require_once('../../conexionBD.php');
        require_once('paisExistente.php');
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
	
        $paisDisponible = validarPaisExistente($codigo, $nombre, $conexionbd);  
        if($paisDisponible == "disponible" ){            
            /*
             * ESTABLECER CONSULTA
             */
            comenzarTransaccion($conexionbd);
            $query = "
                    INSERT INTO pais(
                            id, 
                            nombre
                    )VALUES($codigo, 
                            '$nombre')";

            $respuesta = realizarOperacion($query, $conexionbd);
            $respuestaArray = explode("_", $respuesta);

            if($respuestaArray[0] == "exito"){
                finalizarTransaccion(true, $conexionbd);
            }else{
                finalizarTransaccion(false, $conexionbd);
            }
            exit($respuesta);
        }else{
            exit($paisDisponible);
        }
?>