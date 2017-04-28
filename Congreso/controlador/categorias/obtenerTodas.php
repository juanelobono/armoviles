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
                c.nombre,
                c.descripcion,
                CONCAT(c.padre_id,' - ',c1.nombre) as padre
            FROM			
                categoria AS c LEFT JOIN categoria AS c1 ON
                c.padre_id = c1.id
            where 
                c.activo = 1";

    exit(realizarConsulta($query, $conexionbd, "aaData"));
?>