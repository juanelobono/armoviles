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
               e.id,
               e.descripcion as nombre
            FROM			
                estado_civil AS e
            ";
             

    exit(realizarConsulta($query, $conexionbd, "datos"));
?>