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
                p.id AS DT_RowId,
                p.nombre,
                p.descripcion,
                CONCAT('$',ROUND(p.precio_sin_iva,2)) AS precio_sin_iva,
                CONCAT(ROUND(p.alicuota,2),'%') AS iva,
                m.descripcion as marca,
                mo.descripcion as modelo
            FROM			
                producto AS p join
                marca as m on p.marca_id = m.id join
                modelo as mo on mo.id= p.modelo_id
            WHERE 
                p.activo = 1
            ";

    exit(realizarConsulta($query, $conexionbd, "aaData"));
?>