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
               CONCAT(p.id,'-',p.nombre,' (',p.patente,')') as nombre
            FROM			
                producto AS p
            WHERE 
            	 p.activo = 1
            ORDER BY 
                p.nombre ASC";
             

    exit(realizarConsulta($query, $conexionbd, "datos"));
?>