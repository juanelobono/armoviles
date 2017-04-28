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
                p.id AS DT_RowId,
                p.nombre
            FROM
                pais AS p";

    exit(realizarConsulta($query, $conexionbd, "aaData"));
?>