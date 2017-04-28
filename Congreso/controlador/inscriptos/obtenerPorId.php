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
                    v.id AS DT_RowId,   
                    v.descripcion,
                    DATE_FORMAT(v.fecha_ingreso, '%e/%m/%Y') as fecha,
                    CONCAT(v.nombre_producto,' - ',v.patente) as vehiculo,
                    CONCAT(v.nombre_cliente,' - ',v.dni_cliente) as comprador,           
                    if(isnull(v.nombre_usuario),' ',v.nombre_usuario) as vendedor,
                    v.monto_total as importe
		FROM			
                    venta as v
		WHERE			
                    v.id = $id";
        
        $respuestaConsulta1 = realizarConsultaRegistroArray($query, $conexionbd);
        
        /*
	 * ESTABLECER CONSULTA
	 */
	$queryEntregas = "
            select
				e.monto,
				if(isnull(p.tarjeta_id) and isnull(p.cheque_id),' ',if(isnull(p.tarjeta_id),(select banco from cheque where id=p.cheque_id),(select banco from tarjeta where id=p.tarjeta_id))) as banco,
				if(isnull(p.tarjeta_id) and isnull(p.cheque_id),' ',if(isnull(p.tarjeta_id),(select numero from cheque where id=p.cheque_id),(select numero from tarjeta where id=p.tarjeta_id))) as numero,
				if(isnull(p.tarjeta_id) and isnull(p.cheque_id),' ',if(isnull(p.tarjeta_id),(select cuit_cuil_emitido from cheque where id=p.cheque_id),(select titular from tarjeta where id=p.tarjeta_id))) as titular_cuil_cuit,
				if(isnull(p.tarjeta_id) and isnull(p.cheque_id),'Efectivo',if(isnull(p.tarjeta_id),'Cheque','Tarjeta')) as tipo
			from entrega as e inner join pago as p on e.pago_id = p.id
			where e.venta_id = $id";
	
	$respuestaConsulta2 = realizarConsultaArray($queryEntregas, $conexionbd, "entregas");

	$queryCuotas = "
				select
					monto,
					DATE_FORMAT(fecha_vencimiento, '%e/%m/%Y') as fecha,
					if(isnull(pago_id),'Impaga','Paga') as estado
				FROM cuota
				where 
					venta_id = $id
					order by fecha_vencimiento";

	$respuestaConsulta3 = realizarConsultaArray($queryCuotas, $conexionbd, "cuotas");

	$queryVehiculosEntregados = "
				select
					v.nombre,
					v.patente,
					v.marca,
					v.modelo,
					v.precio_costo as monto
				from
					entrega as e inner join producto as v on e.producto_id = v.id
				where 
					e.venta_id = $id";
	$respuestaConsulta4 = realizarConsultaArray($queryVehiculosEntregados, $conexionbd, "vehiculos");
        
	echo json_encode(array('aaData' => $respuestaConsulta1,
							'entregas' => $respuestaConsulta2,
							'cuotas' => $respuestaConsulta3,
							'vehiculos' => $respuestaConsulta4));        
	exit();
?>

