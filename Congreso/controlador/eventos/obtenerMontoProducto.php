<?php
    $camposGET = array();
    $camposPOST = array('idDB');

    /*
     * SCRIPT REQUERIDOS 
     */	
    require_once("../validacionCampos.php");   
    require_once('../../conexionBD.php');
    
    	if(!empty($camposGET)) 
		validarGET($camposGET);
	if(!empty($camposPOST))
		validarPOST($camposPOST);
		
		$id = $_POST['idDB'];
	
    /*
     * ESTABLECER CONSULTA
     */
    $query = "
            SELECT 
            	precio_sin_iva + ( precio_sin_iva * alicuota * 0.01 ) AS monto
				FROM 
					producto 
				WHERE
					id='$id'";
             

    echo json_encode(array('aaData' => realizarConsultaRegistroArray($query, $conexionbd)));
    exit();
?>