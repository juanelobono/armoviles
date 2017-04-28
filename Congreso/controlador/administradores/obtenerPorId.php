<?php
	/*
	 * DEFINIR VARIABLES GENERALES 
	 */
	define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array('idDB');
	/*
	 * SCRIPT REQUERIDOS 
	 */
        require_once("../validacionCampos.php");
        require_once('../../conexionBD.php');
	
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
	$id = $_POST['idDB'];
	
	/*
	 * ESTABLECER CONSULTA
	 */
	$query = "
		SELECT
                    u.id AS DT_RowId,
                    u.nombre,			
                    u.apellido,
                    u.usuario,
                    u.contrasenia,
                    u.activo,
                    u.tipo,
                    u.email,
                    IF(!ISNULL(p.seccion_id), p.seccion_id, 0) AS idSeccion
		FROM			
                    usuario AS u LEFT JOIN
                    permiso AS p ON u.id = p.usuario_id					
		WHERE			
                    u.id = $id";
	
	exit(realizarConsulta($query, $conexionbd, "aaData"));	
?>

