<?php
    $camposGET = array();
    $camposPOST = array("id");

    /*
     * SCRIPT REQUERIDOS 
     */	
    require_once("../validacionCampos.php");   
    require_once('../../conexionBD.php');
    
    $idProvincia = $_POST['id'];
    
    /*
     * ESTABLECER CONSULTA
     */
    $query = "
            SELECT 	
                l.id,
                l.nombre
            FROM			
                localidad AS l
            WHERE
                l.provincia_id = $idProvincia
            ORDER BY 
                l.nombre ASC";

    exit(realizarConsulta($query, $conexionbd, "datos"));
?>