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
                    c.id AS DT_RowId,
                    c.nombre,
                    c.descripcion,
                    c1.id AS padre_id,
                    c1.nombre AS padre_nombre
		FROM			
                    categoria AS c LEFT JOIN categoria AS c1 ON
                    c.padre_id = c1.id
		WHERE			
                    c.id = $id";
	
	exit(realizarConsultaRegistro($query, $conexionbd, "aaData"));	
?>

