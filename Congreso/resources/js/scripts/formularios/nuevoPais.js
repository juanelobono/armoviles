var RegistrarNuevoPais = function() {

    return {
        //main function to initiate the module
        init: function() {
            
            urlRegistrarNuevo = "paises/nuevo.php";
            urlModificar = "paises/modificar.php";
            urlMostrarDatos = "paises/obtenerPorId.php";

            selects = [];

            dateTimePickers = [];

            datePickers = [];

            dateRangePickers = [];

            datePickerChange = function(ev) {
            }

            esModal = false;

            reglasFormulario = {
                codigo: {
                    required: true,
                    digits: true
                },
                nombre: {
                    required: true
                }
            };

            mensajeRequerido = "Dato Requerido";
            mensajeDigito = "Ingrese sólo números por favor";

            mensajesFormulario = {
                codigo: {
                    required: mensajeRequerido,
                    digits: mensajeDigito
                },
                nombre: {
                    required: mensajeRequerido
                }
            };

            mostrarDatosFormulario = function(data) {
                $("#codigo").val(data['aaData'][0]['DT_RowId']);
                $("#codigo").prop('readonly', true);
                $("#nombre").val(data['aaData'][0]['nombre']);
            };

            formatSelects = function(item) {
                return item.id + ' - ' +item.nombre;
            };

            setFocoPrimerCampo = function() {
                $("#id").focus();
            };
        }
    };
}();