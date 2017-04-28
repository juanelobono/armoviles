<?php
        /*
	 * DEFINIR VARIABLES GENERALES 
	 */
	//define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("nombre");        
        $campoDescripcion = array("campo" => "descripcion", "valorEmpty" => " ");
        $campoPadre = array("campo"=> "padre", "valorEmpty" => "NULL");
	$opcionalesPOST = array($campoDescripcion,$campoPadre);
        
	/*
	 * SCRIPT REQUERIDOS 
	 */
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
	
	$id = $_POST['idDB'];
        
        
        /*
	 * ASIGNAR VARIABLES RECIBIDAS
	 */								
	$nombre = $_POST['nombre'];
        $descripcion = $opcionalesValidados['descripcion'];   
        $idPadre = $opcionalesValidados['padre'];   
                
        $nombreUtilizado = validarNombreDisponible($nombre, $conexionbd);
        
        if(sizeof($nombreUtilizado) == 0 ||
                (sizeof($nombreUtilizado) == 1 && $nombreUtilizado[0]['id'] == $id)){
            /*
             * ESTABLECER CONSULTA
             */
            comenzarTransaccion($conexionbd);
            $query = "
                    UPDATE 
                        categoria
                    SET
                        nombre = '$nombre',
                        descripcion = '$descripcion',
                        padre_id = $idPadre
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
        }else{
            exit("Ya existe una Categoría con ese Nombre.");
        }  
?>