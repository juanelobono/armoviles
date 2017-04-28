<?php
	/*
	 * DEFINIR VARIABLES GENERALES 
	 */
	define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array();
	
	/*
	 * SCRIPT REQUERIDOS 
	 */
	require_once("../validacionCampos.php");
	require_once("../../conexionBD.php");	
	
	/*
	 * VALIDAR VARIABLES RECIBIDAS
	 */
	if(!empty($camposGET)) 
		validarGET($camposGET);
	if(!empty($camposPOST))
		validarPOST($camposPOST);
	
	/*
	 * ASIGNAR VARIABLES RECIBIDAS
	 */
	
	
	/*
	 * ESTABLECER CONSULTA
	 */
	$query = "
            SELECT
                s.id,
                s.nombre,
                IF(!ISNULL(s.seccion_padre_id), s.seccion_padre_id, 0) AS idPadre,
                IF(!ISNULL(s.seccion_padre_id), sp.nombre, 0) AS padre,
                IF(!ISNULL(s.seccion_padre_id), (s.seccion_padre_id * 100) + s.id, (s.id * 100)) AS orden
            FROM
                seccion AS s LEFT JOIN
                seccion AS sp ON s.seccion_padre_id = sp.id
            ORDER BY
                orden";
	
	exit(realizarConsulta($query, $conexionbd, "datos"));	
?>