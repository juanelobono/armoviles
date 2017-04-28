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
               CONCAT(c.id,'-',c.nombre,' ',c.apellido,' (',c.cuit_cuil_dni,')') as nombre
            FROM			
                cliente AS c
            ORDER BY 
                c.apellido ASC";
             

    exit(realizarConsulta($query, $conexionbd, "datos"));
?>