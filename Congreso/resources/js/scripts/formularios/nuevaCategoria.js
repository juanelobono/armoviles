var RegistrarNuevaCategoria = function() {  
    return {
        //main function to initiate the module
        init: function() {
            
            urlRegistrarNuevo = "categorias/nueva.php";
            urlModificar = "categorias/modificar.php";
            urlMostrarDatos = "categorias/obtenerPorId.php";
            
            selects = [
                {                    
                    id: "#padre",
                    url: "categorias/obtenerParaSelect.php",
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
                padre: {
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
                $("#nombre").val(data['aaData'][0]['nombre']);
                $("#descripcion").val(data['aaData'][0]['descripcion']);
                var padreCategoriaSeleccionada = {
                    id: data['aaData'][0]['padre_id'],
                    nombre: data['aaData'][0]['padre_nombre']
                };           
                $("#padre").select2("data", padreCategoriaSeleccionada);
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