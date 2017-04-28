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
                    l.id AS DT_RowId,
                    l.nombre,
                    l.codigo_postal,
                    l.provincia_id,
                    CONCAT(p.id,' - ',p.nombre,' (',pa.nombre,') ') AS provincia
		FROM			
                    localidad AS l INNER JOIN provincia AS p ON
                    l.provincia_id = p.id INNER JOIN pais AS pa ON
                    p.pais_id = pa.id
		WHERE			
                    l.id = $id";
	
	exit(realizarConsultaRegistro($query, $conexionbd, "aaData"));	
?>

