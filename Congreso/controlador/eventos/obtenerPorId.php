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
                    p.id AS DT_RowId,
                    p.nombre,
                    p.descripcion,
                    p.marca_id,
                    p.modelo_id,
                    m.descripcion as marcadesc,
                    mo.descripcion as modelodesc,
                    p.patente,
                    p.precio_sin_iva,
                    p.alicuota,
                    p.activo,
                    p.combustible,
                    p.numero_motor,
                    p.numero_chasis,
                    p.color_nombre,
                    p.color_html,
                    p.anio,
                    p.cliente_id,
                    p.precio_costo,
                    CONCAT(c.id,'-',c.nombre,' ',c.apellido,' (',c.cuit_cuil_dni,')') as cliente
		FROM			
                    producto AS p LEFT JOIN cliente AS c
                    ON p.cliente_id = c.id JOIN marca as m
                    on m.id = p.marca_id JOIN modelo as mo
                    on mo.id=p.modelo_id
		WHERE			
                    p.id = $id";
        
        $respuestaConsulta1 = realizarConsultaRegistroArray($query, $conexionbd);
        
        /*
	 * ESTABLECER CONSULTA
	 */
	$query2 = "
            SELECT 	
                pc.categoria_id,
                c.nombre
            FROM			
                producto_categoria AS pc INNER JOIN
                categoria AS c ON c.id = pc.categoria_id
            WHERE			
                pc.producto_id = $id";
	
	$respuestaConsulta2 = realizarConsultaArray($query2, $conexionbd, "categorias");
        
	echo json_encode(array('aaData' => $respuestaConsulta1, 
            'categorias' => $respuestaConsulta2));        
	exit();
?>

