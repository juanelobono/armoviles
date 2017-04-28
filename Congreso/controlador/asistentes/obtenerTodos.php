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
                c.id AS DT_RowId,
                CONCAT(c.apellido,' ',c.nombre) AS nombre,
                c.email,
                l.nombre AS localidad,
                p.nombre AS provincia,
                c.nombre_madre,
                c.nombre_padre
            FROM			
                cliente AS c LEFT JOIN localidad AS l ON
                c.localidad_id = l.id LEFT JOIN provincia as p ON
                l.provincia_id = p.id
            WHERE
                c.activo = 1
            ";

    exit(realizarConsulta($query, $conexionbd, "aaData"));
?>