<?php
    $camposGET = array();
    $camposPOST = array("id");

    /*
     * SCRIPT REQUERIDOS 
     */	
    require_once("../validacionCampos.php");   
    require_once('../../conexionBD.php');
    
    $idPais = $_POST['id'];
    
    /*
     * ESTABLECER CONSULTA
     */
    $query = "
            SELECT 	
                p.id,
                p.nombre
            FROM			
                provincia AS p
            WHERE
                p.pais_id = $idPais
            ORDER BY 
                p.nombre ASC";

    exit(realizarConsulta($query, $conexionbd, "datos"));
?>