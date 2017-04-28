var RegistrarNuevaVenta = function() {  
    return {
        //main function to initiate the module
        init: function() {
            $('#activo').bootstrapSwitch('setState', true);
            
            urlRegistrarNuevo = "ventas/nuevo.php";
            urlModificar = "ventas/modificar.php";
            urlMostrarDatos = "ventas/obtenerPorId.php";
            urlObtenerMontoVehiculo = "productos/obtenerMontoProducto.php";
            urlObtenerPlanPago = "planpago/obtenerPlanPago.php";
            

            selects = [
                {                    
                    id: "#vehiculo",
                    url: "productos/obtenerParaSelect.php",
                    text: "nombre",
                    cantSelecciones: 1,
                    last: true
                },
                {
						id:"#comprador",
						url:"clientes/obtenerParaSelect.php",
						text: "nombre",
						cantSelecciones: 1,
						last: true					
					},
					 {
						id:"#vendedor",
						url:"vendedores/obtenerParaSelect.php",
						text: "nombre",
						cantSelecciones: 1,
						last: true					
					},
					{
						id:"#plancuotas",
						url:"planpago/obtenerParaSelect.php",
						text: "nombre",
						cantSelecciones: 1,
						last: true
					}
            ];
            

            dateTimePickers = [];

            datePickers = [];

            dateRangePickers = [];

            datePickerChange = function(ev) {};

            esModal = false;

            reglasFormulario = {
                vehiculo: {
                    required: false
                },
                descripcion: {
                    required: false
                },
                vendedor: {
                    required: false
                },
                comprador: {
                    required: false
                }
                
               
            };

            mensajeRequerido = "Dato Requerido";
            mensajeDigitos = "Ingrese sólo números Por Favor";

            mensajesFormulario = {
                vehiculo: {
                    required: mensajeRequerido
                },
                vendedor: {
                    required: mensajeRequerido
                },
                comprador: {
                    required: mensajeRequerido
                },
                descripcion: {
                    required: mensajeRequerido
                }
            };

            mostrarDatosFormulario = function(data) {                
                $("#nombre").val(data['aaData'][0]['nombre']);
                $("#descripcion").val(data['aaData'][0]['descripcion']);
                $("#marca").val(data['aaData'][0]['marca']);
                $("#modelo").val(data['aaData'][0]['modelo']);
                $("#patente").val(data['aaData'][0]['patente']);
                $("#precio_sin_iva").val(data['aaData'][0]['precio_sin_iva']);
                $("#iva").val(data['aaData'][0]['alicuota']);
                $("#anio").val(data['aaData'][0]['anio']);
                if(data['aaData'][0]['activo']==="1"){
                    $('#activo').bootstrapSwitch('setState', true);
                }else{
                    $('#activo').bootstrapSwitch('setState', false);
                }
                $("#combustible").val(data['aaData'][0]['combustible']);
                $("#numero_chasis").val(data['aaData'][0]['numero_chasis']);
                $("#numero_motor").val(data['aaData'][0]['numero_motor']);
                $("#color").val(data['aaData'][0]['color_nombre']);
                var colorHtml = data['aaData'][0]['color_html'];
                $("#color_html").val(colorHtml);
                $("#color-seleccionado").attr("style","background-color:"+colorHtml);
                
                var clienteDuenioSeleccionado = [];
                
                if (data['aaData'][0]['cliente']) {                              
                clienteDuenioSeleccionado.push({
                		id:data['aaData'][0]['cliente_id'],
                		nombre: data['aaData'][0]['cliente']
                	});                     
                $("#comprador").select2("data", clienteDuenioSeleccionado);
             
               }
                

            };

            formatSelects = function(item) {
                return item.nombre;
            };

            setFocoPrimerCampo = function() {
                $("#nombre").focus();
            };
            
            $("#vehiculo").change(function () {
            	
            		var idVehiculo = $("#vehiculo").val();

            		$.ajax({
            			type: 'post',
            			url: urlObtenerMontoVehiculo, 
            			data: {
            				'idDB': idVehiculo 
            			},           
            			dataType: 'json',  
            			success: function(data) {
            			$("#monto").val(data['aaData'][0]['monto']);                
                	            			
            			},

        				});

            });
            
            $("#entrega").change(function () {
            	try {
            		$("#resumencuota").html("");
            		var saldo = $("#monto").val()-$("#entrega").val();
            		$("#saldo").html('Saldo Restante: $'+saldo);
            		}catch (error) {
            			
            		}
            });
            
            $("#plancuotas").change(function () {
            	var idPlanPago=$("#plancuotas").val();
            	
            	$.ajax({
            			type: 'post',
            			url: urlObtenerPlanPago, 
            			data: {
            				'idDB': idPlanPago 
            			},           
            			dataType: 'json',  
            			success: function(data) {
            				var cantCuotas = data['aaData'][0]['cuotas']; 
            				var interes = data['aaData'][0]['interes'];
            				
            				try {
            					var saldo = $("#monto").val()-$("#entrega").val();
            					var saldoConInteres = saldo*(1+((interes*(cantCuotas/12))/100));
            					var valorCuota = saldoConInteres/cantCuotas;
            				
            					$("#resumencuota").html('Valor de la cuota: $'+valorCuota.toFixed(2));
            				}catch (error) {
            			
            					}
            			               
                	            			
            				},

        				});
            
            });
        }
    }; 
}();