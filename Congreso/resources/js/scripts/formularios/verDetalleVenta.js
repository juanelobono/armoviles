var DetallesVenta = function() {

    return {

        //main function to initiate the module
        init: function() {
            
            urlRegistrarNuevo = "#";
            urlModificar = "#";
            urlMostrarDatos = "ventas/obtenerPorId.php";

            
            selects = [];

            dateTimePickers = [];

            datePickers = [];

            dateRangePickers = [];

            datePickerChange = function(ev) {}

            esModal = false;

            reglasFormulario = {};

            mensajeRequerido = "Dato Requerido";

            mensajesFormulario = {};

            mostrarDatosFormulario = function(data) {
                
                
                limpiarCampos();
                $("#fecha").append("<strong>Fecha: </strong>"+data['aaData'][0]['fecha']);
                $("#vehiculo").append("<strong>Vehiculo: </strong>"+data['aaData'][0]['vehiculo']);
                $("#comprador").append("<strong>Cliente Comprador: </strong>"+data['aaData'][0]['comprador']);
                $("#vendedor").append("<strong>Vendedor: </strong>"+data['aaData'][0]['vendedor']);
                $("#importe").append("<strong>Importe: </strong>$"+data['aaData'][0]['importe']);
                $("#descripcion").append("<strong>Descripción: </strong>"+data['aaData'][0]['descripcion']);               
                
                mostrarEntregas(data);
                mostrarCuotas(data);
                mostrarVehiculosEntregados(data);
            };
            
            function mostrarEntregas(datos){
                var entregas = datos.entregas;
                if(entregas.length === 0){
                    $("#sinProductos").css("display","block");
                    $("#divTabla").css("display","none");
                }else{
                    $("#sinProductos").css("display","none");
                    $("#divTabla").css("display","block");
                    
                    $.each(entregas, function(i, entregaActual) {
                        
                        
                        var fila = "<tr><td>"+entregaActual.tipo+"</td><td>"+entregaActual.monto+"</td><td>"+entregaActual.numero+"</td><td>"+entregaActual.banco+"</td><td>"+entregaActual.titular_cuil_cuit+"</td></tr>";
                        $('#tabla tbody').append(fila);
                        
                                               
                    });
                    /*var descuento = datos['aaData'][0]['descuento'];
                    if(descuento === null){
                         descuento = 0;
                    }
                    var totalDescuento = total - descuento;
                    var filaTotal = "<tr><td></td><td>&nbsp;</td><td>&nbsp;</td><td><strong>TOTAL</strong></td><td>$"+total+"</td></tr>\n\
                                    <tr><td></td><td>&nbsp;</td><td>&nbsp;</td><td><strong>DESCUENTO</strong></td><td>$"+descuento+"</td></tr>\n\
                                    <tr><td></td><td>&nbsp;</td><td>&nbsp;</td><td style='background-color: #dff0d8'><strong>TOTAL CON DESCUENTO</strong></td><td style='background-color: #dff0d8'><strong>$"+totalDescuento+"</strong></td></tr>";
                    
                    $('#tabla tbody').append(filaTotal);*/
                }                
            }

            function mostrarCuotas(datos){
                var cuotas = datos.cuotas;
                if(cuotas.length === 0){
                    $("#sinCuotas").css("display","block");
                    $("#divTablaCuotas").css("display","none");
                }else{
                    $("#sinCuotas").css("display","none");
                    $("#divTablaCuotas").css("display","block");
                    
                    $.each(cuotas, function(i, cuotaActual) {
                        
                        
                        var fila = "<tr><td>"+(i+1)+"</td><td>"+cuotaActual.monto+"</td><td>"+cuotaActual.fecha+"</td><td>"+cuotaActual.estado+"</td></tr>";
                        $('#tablaCuotas tbody').append(fila);
                        
                                               
                    });
                    
                }                
            }

            function mostrarVehiculosEntregados(datos){
                var vehiculos = datos.vehiculos;
                if(vehiculos.length === 0){
                    $("#sinVehiculos").css("display","block");
                    $("#divTablaVehiculos").css("display","none");
                }else{
                    $("#sinVehiculos").css("display","none");
                    $("#divTablaVehiculos").css("display","block");
                    
                    $.each(vehiculos, function(i, vehiculoActual) {
                        
                        
                        var fila = "<tr><td>"+vehiculoActual.nombre+"</td><td>"+vehiculoActual.patente+"</td><td>"+vehiculoActual.monto+"</td><td>"+vehiculoActual.marca+"</td><td>"+vehiculoActual.modelo+"</td></tr>";
                        $('#tablaVehiculos tbody').append(fila);
                        
                                               
                    });
                    
                }                
            }

            function limpiarCampos(){
                $("#fecha").empty();
                $("#hora").empty();
                $("#duracion").empty();
                $("#mesa_id").empty();
                $("#mozo").empty();
                $("#cliente").empty();
                $('#tabla tbody').empty();
            }

            formatSelects = function(item) {
                return item.nombre;
            };

            setFocoPrimerCampo = function() {
                $("#id").focus();
            };
        }
    };
}();