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
	
	/*
	 * ASIGNAR VARIABLES RECIBIDAS
	 */								
	$nombre = $_POST['nombre'];
        $descripcion = $opcionalesValidados['descripcion'];   
        $idPadre = $opcionalesValidados['padre'];   
                
        $nombreUtilizado = validarNombreDisponible($nombre, $conexionbd);  
        
        if(sizeof($nombreUtilizado) == 0 ){
            /*
             * ESTABLECER CONSULTA
             */
            comenzarTransaccion($conexionbd);
            $query = "
                    INSERT INTO categoria(
                            nombre,
                            descripcion,
                            padre_id,
                            activo
                    )VALUES('$nombre',
                            '$descripcion',
                            $idPadre,
                            1)";
    
            $respuesta = realizarOperacion($query, $conexionbd);
            
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