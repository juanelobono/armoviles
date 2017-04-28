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
                v.id AS DT_RowId,
                DATE_FORMAT(fecha_ingreso, '%e/%m/%Y') as fecha_ingreso,
                v.patente,
                v.nombre_producto,
                v.nombre_cliente,
                v.monto_total
            FROM			
                venta AS v";

    exit(realizarConsulta($query, $conexionbd, "aaData"));
?>