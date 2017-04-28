var RegistrarNuevaMarca = function() {  
    return {
        //main function to initiate the module
        init: function() {
            
            urlRegistrarNuevo = "marcas/nueva.php";
            urlModificar = "marcas/modificar.php";
            urlMostrarDatos = "marcas/obtenerPorId.php";
            
            selects = [
               
            ];

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
                }
                
            };

            mensajeRequerido = "Dato Requerido";

            mensajesFormulario = {
                nombre: {
                    required: mensajeRequerido
                },
                descripcion: {
                    required: mensajeRequerido
                },
                email: {
                    required: mensajeRequerido
                }
            };

            mostrarDatosFormulario = function(data) {                
                
                $("#descripcion").val(data['aaData'][0]['descripcion']);
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
                $("#id").focus();
            };
        }
    }; 
}();