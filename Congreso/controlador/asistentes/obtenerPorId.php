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
                    c.apellido,
                    c.domicilio,
                    c.email,
                    DATE_FORMAT(c.fecha_nacimiento, '%e/%m/%Y') AS fecha_nacimiento,
                    c.telefono,
                    c.cuit_cuil_dni,
                    CONCAT(c.localidad_id,' - ',l.nombre,' (',p.nombre,' - ',pa.nombre,')') AS localidad_nombre,
                    c.piso,
                    c.departamento,
                    c.nombre_padre,
                    c.nombre_madre,
                    c.estado_civil as idestadocivil,
                    e.descripcion as estado_civil
					

		FROM			
                    cliente AS c LEFT JOIN localidad AS l ON
                    c.localidad_id = l.id LEFT JOIN provincia AS p ON
                    l.provincia_id = p.id LEFT JOIN pais AS pa ON
                    p.pais_id = pa.id JOIN estado_civil as e ON
                    e.id = c.estado_civil 
					

		WHERE			
                    c.id = $id AND
                    c.activo =1
        ";
	$respuestaConsulta1 = realizarConsultaArray($query, $conexionbd, "aaData");
	

	$querySituacionLaboral = "
				select
					sl.antiguedad,
					sl.condicion,
					sl.domicilio_laboral,
					sl.ingresos_mensuales_netos,
					sl.nombre_empresa,
					sl.otros_ingresos,
					sl.telefono_laboral,
					csl.fecha_alta
				from
					clientes_situacion_laboral as csl JOIN situacion_laboral as sl on
					sl.id = csl.situacion_laboral_id
				where 
					csl.cliente_id = $id";

	$respuestaConsulta4 = realizarConsultaArray($querySituacionLaboral, $conexionbd, "situacionLaboral");
        
	echo json_encode(array('aaData' => $respuestaConsulta1,
							'situacionLaboral' => $respuestaConsulta4));   
	exit();	
?>

