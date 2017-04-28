var RegistrarNuevaVenta = function() {  
    return {
        //main function to initiate the module
        init: function() {
            
            urlRegistrarNuevo = "ventas/nuevo.php";
            urlModificar = "ventas/modificar.php";
            urlMostrarDatos = "ventas/obtenerPorId.php";
            urlObtenerMontoVehiculo = "productos/obtenerMontoProducto.php";
            

            selects = [
                {                    
                    id: "#vehiculo",
                    url: "productos/obtenerParaSelect.php",
                    text: "nombre",
                    cantSelecciones: 1,
                    last: false
                },
                {
					id:"#comprador",
					url:"clientes/obtenerParaSelect.php",
					text: "nombre",
					cantSelecciones: 1,
					last: false					
				},
				 {
					id:"#conyugue",
					url:"clientes/obtenerParaSelect.php",
					text: "nombre",
					cantSelecciones: 1,
					last: false					
				},
                {
                    id:"#vendedor",
                    url:"vendedores/obtenerParaSelect.php",
                    text: "nombre",
                    cantSelecciones: 1,
                    last: false                  
                },
				{
					id:"#plancuotas",
					url:"planpago/obtenerParaSelect.php",
					text: "nombre",
					cantSelecciones: 1,
					last: false
				},
                {
                    id:"#entrega-vehiculos",
                    url:"productos/obtenerParaSelect.php",
                    text: "nombre",
                    //cantSelecciones: 1,
                    last: true
                }
            ];
            

            dateTimePickers = [];

            datePickers = [
                {
                    id: '#fecha'
                }
            ];

            dateRangePickers = [];

            datePickerChange = function(ev) {};

            esModal = false;

            reglasFormulario = {
                vehiculo: {
                    required: true
                },
                descripcion: {
                    required: false
                },
                vendedor: {
                    required: false
                },
                comprador: {
                    required: true
                },
                cuotas: {
                    required: false,
                    number: true
                },
                importe: {
                    required: false,
                    number: true
                },
                importe_entrega: {
                    required: false,
                    number: true
                },
                numero: {
                    required: false
                },
                banco:{
                    required: false
                },
                nombre_persona: {
                    required: false
                },
                fecha: {
                    required:true
                   
                },
                cuotasPagas: {
                    required: false,
                    number: true
                }
               
            };

            mensajeRequerido = "Dato Requerido";
            mensajeDigitos = "Ingrese sólo números Por Favor";
            mensajeFecha = "Ingrese una fecha válida";

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
                },
                cuotas: {
                    required: mensajeRequerido,
                    number: mensajeDigitos
                },
                importe: {
                    required: mensajeRequerido,
                    number: mensajeDigitos
                },
                importe_entrega: {
                    required: mensajeRequerido,
                    number: mensajeDigitos
                },
                numero: {
                    required: mensajeRequerido
                },
                banco:{
                    required: mensajeRequerido
                },
                nombre_persona: {
                    required: mensajeRequerido
                },
                fecha: {
                    required: mensajeRequerido,
                    date: mensajeFecha
                },
                cuotasPagas: {
                    required: mensajeRequerido,
                    number: mensajeDigitos
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
            
            
        }
    }; 
}();