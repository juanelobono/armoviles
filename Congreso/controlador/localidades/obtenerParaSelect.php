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
                l.id,
                CONCAT(l.nombre,' (',p.nombre,' - ',pa.nombre,')') AS nombre
            FROM			
                localidad AS l INNER JOIN provincia AS p ON
                l.provincia_id = p.id INNER JOIN pais AS pa ON
                p.pais_id = pa.id
            ORDER BY 
                l.nombre ASC";

    exit(realizarConsulta($query, $conexionbd, "datos"));
?>