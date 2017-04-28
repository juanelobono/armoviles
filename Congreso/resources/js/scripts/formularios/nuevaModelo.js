var RegistrarNuevaModelo = function() {  
    return {
        //main function to initiate the module
        init: function() {
            
            urlRegistrarNuevo = "modelos/nueva.php";
            urlModificar = "modelos/modificar.php";
            urlMostrarDatos = "modelos/obtenerPorId.php";
            
            selects = [
                {                    
                    id: "#marca",
                    url: "marcas/obtenerParaSelect.php",
                    text: "nombre",
//                    cantSelecciones: 1,
                    last: true
                }
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
                },
                marca: {
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
                marca: {
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
                
                var marcaSeleccionada = {
                    id: data['aaData'][0]['marca_id'],
                    nombre: data['aaData'][0]['descripcion_marca']
                };           
                $("#marca").select2("data", marcaSeleccionada);
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