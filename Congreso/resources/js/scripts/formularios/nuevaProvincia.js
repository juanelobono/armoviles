var RegistrarNuevaProvincia = function() {

    return {
        //main function to initiate the module
        init: function() {
            
            urlRegistrarNuevo = "provincias/nueva.php";
            urlModificar = "provincias/modificar.php";
            urlMostrarDatos = "provincias/obtenerPorId.php";

            selects = [
                {
                    id: "#pais",
                    url: "paises/obtenerParaSelect.php",
                    text: "nombre",
                    cantSelecciones: 1,
                    last: true
                }
            ];

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
                },
                pais:{
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
                },
                pais: {
                    required: mensajeRequerido
                }
            };

            mostrarDatosFormulario = function(data) {
                $("#codigo").val(data['aaData'][0]['DT_RowId']);
                $("#codigo").prop('readonly', true);
                $("#nombre").val(data['aaData'][0]['nombre']);
                
                var paisSeleccionado = {
                    id: data['aaData'][0]['pais_id'],
                    nombre: data['aaData'][0]['pais_nombre']
                };           
                $("#pais").select2("data", paisSeleccionado);
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