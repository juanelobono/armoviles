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
                c.id,
                c.nombre
            FROM			
                categoria AS c
            where 
                c.activo = 1
            ORDER BY 
                c.nombre ASC";

    exit(realizarConsulta($query, $conexionbd, "datos"));
?>