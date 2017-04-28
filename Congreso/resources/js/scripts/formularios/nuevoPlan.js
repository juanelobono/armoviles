var RegistrarNuevoPlan = function() {  
    return {
        //main function to initiate the module
        init: function() {
            $('#activo').bootstrapSwitch('setState', true);
            
            urlRegistrarNuevo = "planpago/nuevo.php";
            urlModificar = "planpago/modificar.php";
            urlMostrarDatos = "planpago/obtenerPorId.php";
           
            
				selects = [];
            dateTimePickers = [];

            datePickers = [];

            dateRangePickers = [];

            datePickerChange = function(ev) {};

            esModal = false;

            reglasFormulario = {
                nombre: {
                    required: true
                },
                descripcion: {
                    required: false
                },
                cuotas: {
                    required: true,
                    digits: true
                },
                interes: {
                    required: true,
                    number: true
                },
                
                activo: {
                    required: false
                }               
               
            };

            mensajeRequerido = "Dato Requerido";
            mensajeDigitos = "Ingrese sólo números Por Favor";

            mensajesFormulario = {
                nombre: {
                    required: mensajeRequerido
                },
                cuotas: {
                    required: mensajeRequerido
                },
                interes: {
                    required: mensajeRequerido
                },
                activo: {
                    required: mensajeRequerido
                }
                
            };

            mostrarDatosFormulario = function(data) {             
                $("#nombre").val(data['aaData'][0]['nombre']);
                $("#cuotas").val(data['aaData'][0]['cantidad_cuotas']);
                $("#interes").val(data['aaData'][0]['interes']);
                if(data['aaData'][0]['activo']==="1"){
                    $('#activo').bootstrapSwitch('setState', true);
                }else{
                    $('#activo').bootstrapSwitch('setState', false);
                }
                
				};
				
				formatSelects = function(item) {
                return item.nombre;
            };

            setFocoPrimerCampo = function() {
                $("#nombre").focus();
            };


        }
    }; 
}();