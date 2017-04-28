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
        require_once("../validacionUsuario.php");
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
                    p.id AS DT_RowId,
                    p.nombre,
                    pa.id AS pais_id,
                    pa.nombre AS pais_nombre
		FROM			
                    provincia AS p INNER JOIN pais AS pa ON
                    p.pais_id = pa.id
		WHERE			
                    p.id = $id";
	
	exit(realizarConsultaRegistro($query, $conexionbd, "aaData"));	
?>

