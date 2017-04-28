<?php
	/*
	 * DEFINIR VARIABLES GENERALES 
	 */
	//define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("vehiculo","comprador","fecha");
	$campoDescripcion = array("campo"=> "descripcion", "valorEmpty" => " ");
    $campoVendedor = array("campo"=> "vendedor", "valorEmpty" => "NULL");
    $campoconyugue = array("campo"=> "conyugue", "valorEmpty" => "NULL");
    $campoMontoTotal = array("campo"=> "monto", "valorEmpty" => "NULL");
    $campoCuotas = array("campo"=> "cuotas", "valorEmpty" => "NULL");
    $campoImporte = array("campo"=> "importe", "valorEmpty" => "NULL");
    $campoVehiculosEntregado = array("campo"=> "entrega-vehiculos", "valorEmpty" => " ");
    $campoCuotasPagas = array("campo"=>"valor_cuota", "valorEmpty"=>"NULL");
    
	$opcionalesPOST = array($campoDescripcion,$campoVendedor,$campoMontoTotal,$campoCuotas,
                            $campoImporte,$campoVehiculosEntregado,$campoCuotasPagas,$campoconyugue);
        
	/*
	 * SCRIPT REQUERIDOS 
	 */
	require_once("../validacionCampos.php");   
    require_once('../../conexionBD.php');
    require_once('ventaExistente.php');
	
	/*
	 * VALIDAR VARIABLES RECIBIDAS
	 */
	if(!empty($camposGET)) 
		validarGET($camposGET);
	if(!empty($camposPOST))
		validarPOST($camposPOST);	
	if(!empty($opcionalesPOST))
		$opcionalesValidados = opcionalesPOST($opcionalesPOST);	
	
	/*
	 * ASIGNAR VARIABLES RECIBIDAS
	 */			

        
        if (preg_match('/,/',$_POST['entrega-vehiculos'])){
            $entregaVehiculos = explode(',', $_POST['entrega-vehiculos']);
          
        }else{
            $entregaVehiculos = array($opcionalesValidados['entrega-vehiculos']);

        }
             
        
        $idVehiculo = $_POST['vehiculo'];
        $idClienteComprador = $_POST['comprador'];
        $fecha = $_POST['fecha'];

        $descripcion = $opcionalesValidados['descripcion'];       
        $idVendedor = $opcionalesValidados['vendedor'];    
        $montoTotal = $opcionalesValidados['monto'];    
        $cantidadCuotas = $opcionalesValidados['cuotas']; 
        $importeCuota = $opcionalesValidados['importe'];   
        $conyugue = $opcionalesValidados['conyugue'];   
        $cantidadCuotasPagas = $opcionalesValidados['valor_cuota'];
        $arrayFecha = explode("/",$fecha);
        $fechaIngreso = $arrayFecha[2]."-".$arrayFecha[1]."-".$arrayFecha[0];    
       
           
        /*
         * ESTABLECER CONSULTA
         */
        comenzarTransaccion($conexionbd);
        $query = "
                INSERT INTO venta(
                        fecha_ingreso,
                        descripcion,
                        producto_id,
                        patente,
                        nombre_producto,
                        cliente_id,
                        conyugue_id,
                        nombre_cliente,
                        dni_cliente,
                        usuario_id,
                        nombre_usuario,
                        monto_total,
                        cantidad_cuotas,
                        valor_cuota
                )VALUES('$fechaIngreso',
                        '$descripcion',
                         $idVehiculo,
                         (SELECT patente FROM producto WHERE id=$idVehiculo),
                         (SELECT nombre FROM producto WHERE id=$idVehiculo),
                         $idClienteComprador,
                         $conyugue,
                         (SELECT CONCAT(c.nombre,' ',c.apellido) FROM cliente as c WHERE id=$idClienteComprador),
                         (SELECT cuit_cuil_dni FROM cliente WHERE id=$idClienteComprador),
                         $idVendedor,
                         (SELECT CONCAT(u.nombre,' ',u.apellido) as nombre FROM usuario as u WHERE id=$idVendedor),
                         $montoTotal,
                         $cantidadCuotas,
                         $cantidadCuotasPagas
                         )";
        
        $respuesta = realizarOperacion($query, $conexionbd);

        $respuestaArrayVenta = explode("_", $respuesta);        
        if($respuestaArrayVenta[0] == "exito"){
            
            $idVenta = $respuestaArrayVenta[1];
            if($cantidadCuotas != "NULL"){
                //generarCuotas($cantidadCuotas,$importeCuota,$fechaIngreso,$idVenta,$cantidadCuotasPagas);
            }
            if($entregaVehiculos[0] != " "){
                generarEntregasVehiculos($entregaVehiculos,$idVenta);
            }

            if(($_POST["tipo"][0] != "") && ($_POST["importe_entrega"][0] != "")){
                generarEntregas($_POST["tipo"],$_POST["importe_entrega"],
                                $_POST["numero"],$_POST["banco"],
                                $_POST["nombre_persona"],$idVenta,$fechaIngreso);         

            }

            finalizarTransaccion(true, $conexionbd);
            
            
        }else{
            finalizarTransaccion(false, $conexionbd);
            
        }

        
        exit($respuesta);




        function generarCuotas($cantCuotas,$importe,$fecha,$idVenta,$cuotasPagas){
            global $conexionbd;
            $operacionesCorrectas = 0;

            for ($i=1;$i <= $cantCuotas; $i++) { 
                
                $nuevaFecha = date("Y-m-d",strtotime('+'.$i.' month',strtotime($fecha)));

                if($i > $cuotasPagas){
                    $query2="
                        INSERT INTO cuota(
                                monto,
                                fecha_vencimiento,
                                venta_id
                            )
                        VALUES(
                                $importe,
                                '$nuevaFecha',
                                $idVenta
                            )";
                }else{
                    $queryPago = "
                        INSERT INTO
                                    pago(fecha)
                                VALUES('$nuevaFecha')
                                ";
                    $respuesta = realizarOperacion($queryPago, $conexionbd);
                    $respuestaArray = explode("_", $respuesta);
                    $idPago = $respuestaArray[1];

                    $query2="
                        INSERT INTO cuota(
                                monto,
                                fecha_vencimiento,
                                venta_id,
                                pago_id
                            )
                        VALUES(
                                $importe,
                                '$nuevaFecha',
                                $idVenta,
                                $idPago
                            )";
                    


                }
                
                
                realizarOperacion($query2, $conexionbd);          
            }


        }


    function generarEntregasVehiculos($vehiculos,$idVenta){
        global $conexionbd;

        foreach ($vehiculos as $idVehiculo) {
            $query = "
                INSERT INTO entrega(monto,producto_id,venta_id)
                    VALUES(
                        (SELECT precio_costo FROM producto WHERE id=$idVehiculo),
                        $idVehiculo,
                        $idVenta)";
        realizarOperacion($query, $conexionbd);
              
        }



    }

    function generarEntregas($arrayTipo,$importe,$numero,$banco,$cuiltilular,$idVenta,$fecha){

        $regitro = 0;
        foreach ($arrayTipo as $tipo) {
            

            switch ($tipo) {
                case 'Efectivo':
                    registrarEntregaEfectivo($idVenta,$importe[$regitro],$fecha);
                    break;
                case 'Cheque':
                    registrarEntregaCheque($idVenta,$importe[$regitro],$numero[$regitro],$banco[$regitro],$cuiltilular[$regitro],$fecha);
                    break;
                case 'Tarjeta':
                    registrarEntregaTarjeta($idVenta,$numero[$regitro],$cuiltilular[$regitro],$importe[$regitro],$banco[$regitro],$fecha);
                    break;
                
                default:
                    # code...
                    break;
            }

            $regitro++;
        }

    }

    function registrarEntregaEfectivo($idVenta,$monto,$fecha){
        global $conexionbd;

       
        $queryPago = "
                    INSERT INTO
                        pago(fecha)
                        VALUES('$fecha')
                            ";
        $respuesta = realizarOperacion($queryPago, $conexionbd);
        $respuestaArray = explode("_", $respuesta);
        $idPago = $respuestaArray[1];
        $queryEntrega = "
                        INSERT INTO
                            entrega(monto,venta_id,pago_id)
                            VALUES($monto,$idVenta,$idPago)";

        realizarOperacion($queryEntrega, $conexionbd);     

    }

    function registrarEntregaCheque($idVenta,$monto,$numero,$banco,$cuil_tilular,$fecha){
        global $conexionbd;

        $queryCheque = "
                    INSERT INTO
                        cheque(numero,banco,cuit_cuil_emitido,monto)
                        VALUES($numero,'$banco','$cuil_tilular',$monto)
                            ";
        $respuesta = realizarOperacion($queryCheque, $conexionbd);
        $respuestaArray = explode("_", $respuesta);
        $idCheque = $respuestaArray[1];

    
        $queryPago = "
                    INSERT INTO
                        pago(fecha,cheque_id)
                        VALUES('$fecha',$idCheque)
                            ";
        $respuesta = realizarOperacion($queryPago, $conexionbd);
        $respuestaArray = explode("_", $respuesta);
        $idPago = $respuestaArray[1];

        $queryEntrega = "
                        INSERT INTO
                            entrega(monto,venta_id,pago_id)
                            VALUES($monto,$idVenta,$idPago)";

        realizarOperacion($queryEntrega, $conexionbd);     

    }

    function registrarEntregaTarjeta($idVenta,$numero,$titular,$monto,$banco,$fecha){
        global $conexionbd;

        $queryTarjeta = "
                    INSERT INTO
                        tarjeta(titular,numero,banco)
                        VALUES('$titular','$numero','$banco')
                            ";
        $respuesta = realizarOperacion($queryTarjeta, $conexionbd);
        $respuestaArray = explode("_", $respuesta);
        $idTarjeta = $respuestaArray[1];

        
        $queryPago = "
                    INSERT INTO
                        pago(fecha,tarjeta_id)
                        VALUES('$fecha',$idTarjeta)
                            ";
        $respuesta = realizarOperacion($queryPago, $conexionbd);
        $respuestaArray = explode("_", $respuesta);
        $idPago = $respuestaArray[1];

        $queryEntrega = "
                        INSERT INTO
                            entrega(monto,venta_id,pago_id)
                            VALUES($monto,$idVenta,$idPago)";

        realizarOperacion($queryEntrega, $conexionbd);     

    }
        
?>