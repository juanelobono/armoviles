<?php
    $camposGET = array();
    $camposPOST = array();

    /*
     * SCRIPT REQUERIDOS 
     */	
    require_once("../validacionCampos.php");   
    require_once('../../conexionBD.php');
    /*
     * ESTABLECER CONSULTA
     */
    $query = "
            SELECT 	
                p.id,
                p.nombre
            FROM			
                pais AS p
            ORDER BY 
                p.nombre ASC";

    exit(realizarConsulta($query, $conexionbd, "datos"));
?>