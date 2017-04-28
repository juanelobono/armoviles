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
                a.id AS DT_RowId,
                CONCAT(a.nombre,' ',a.apellido) AS nombre,
                a.usuario,
                a.email
            FROM			
                usuario AS a 
            WHERE
                a.tipo = 'admin' AND activo = 0";

    exit(realizarConsulta($query, $conexionbd, "aaData"));
?>