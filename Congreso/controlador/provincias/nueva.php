<?php
	/*
	 * DEFINIR VARIABLES GENERALES 
	 */
	//define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("codigo", "nombre", "pais");
        $opcionalesPOST = array();
//	/*
//	 * SCRIPT REQUERIDOS 
//	 */
        require_once("../validacionUsuario.php");
	require_once("../validacionCampos.php");
        require_once('../../conexionBD.php');
        require_once('provinciaExistente.php');
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
        $pais = $_POST['pais'];
	
        $provinciaDisponible = validarProvinciaExistente($codigo, $nombre, $conexionbd);  
        if($provinciaDisponible == "disponible" ){            
            /*
             * ESTABLECER CONSULTA
             */
            comenzarTransaccion($conexionbd);
            $query = "
                    INSERT INTO provincia(
                            id, 
                            nombre,
                            pais_id
                    )VALUES($codigo, 
                            '$nombre',
                            $pais)";

            $respuesta = realizarOperacion($query, $conexionbd);
            $respuestaArray = explode("_", $respuesta);

            if($respuestaArray[0] == "exito"){
                finalizarTransaccion(true, $conexionbd);
            }else{
                finalizarTransaccion(false, $conexionbd);
            }
            exit($respuesta);
        }else{
            exit($provinciaDisponible);
        }
?>