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
                l.id AS DT_RowId,
                l.nombre,
                l.codigo_postal,
                CONCAT(p.id,' - ',p.nombre) AS provincia,
                CONCAT(pa.id,' - ',pa.nombre) AS pais
            FROM			
                localidad AS l INNER JOIN provincia AS p ON
                l.provincia_id = p.id INNER JOIN pais AS pa ON
                p.pais_id = pa.id";

    exit(realizarConsulta($query, $conexionbd, "aaData"));
?>