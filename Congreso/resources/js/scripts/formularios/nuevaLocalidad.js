var RegistrarNuevaLocalidad = function() {
    
    var obtenerProvincias = function(){
        $('#provincia').select2({
            query: function (query){
                var data = {
                    results: [
                        { id: '', text: "" }
                    ]
                };
                query.callback(data);
            }
        });
        var idPais = $("#pais").val();
        var infoSelect = [                
            {
                id: "#provincia",
                url: "provincias/obtenerParaSelect.php",
                text: "nombre",
                cantSelecciones: 1,
                last: true
            }
        ];
        if(idPais === ""){
            $('#localidad').val("");
             var infoSelect = [
                {
                    id: "#localidad",
                    url: "localidades/obtenerParaSelect.php",
                    text: "nombre",
                    cantSelecciones: 1,
                    last: false
                }
            ];
            obtenerDatos(idPais,infoSelect);
        }else{
            $('#provincia').val("");
            $('#localidad').select2({
                query: function (query){
                    var data = {
                        results: [
                            { id: '', text: "" }
                        ]
                    };
                    query.callback(data);
                }
            });
            obtenerDatos(idPais,infoSelect);
        }        
    };
    
    var asignarSeleccionada = function(){
        var provinciaSeleccionada = $("#provincia").val();
        $("#provincia_seleccionada").val(provinciaSeleccionada + " (");
    };

    return {
        //main function to initiate the module
        init: function() {
            
            urlRegistrarNuevo = "localidades/nueva.php";
            urlModificar = "localidades/modificar.php";
            urlMostrarDatos = "localidades/obtenerPorId.php";

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
                codigo_postal: {
                    required: true
                },
                provincia_seleccionada: {
                    required: true
                },
                pais: {
                    required: false
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
                codigo_postal: {
                    required: mensajeRequerido
                },
                provincia: {
                    required: mensajeRequerido
                },
                pais: {
                    required: mensajeRequerido
                }
            };
            
            $('#activa').bootstrapSwitch('setState', true);

            mostrarDatosFormulario = function(data) {
                $("#codigo").val(data['aaData'][0]['DT_RowId']);
                $("#codigo").prop('readonly', true);
                $("#nombre").val(data['aaData'][0]['nombre']);
                $("#codigo_postal").val(data['aaData'][0]['codigo_postal']); 
                
                $("#provincia_seleccionada").val(data['aaData'][0]['provincia']);
                $(".sin-provincia").hide();
                $("#div-provincia_seleccionada").show();
            };

            formatSelects = function(item) {
                return item.id + ' - ' + item.nombre;
            };

            setFocoPrimerCampo = function() {
                $("#id").focus();
            };
            
            $("#cambiarProvincia").click(function(){
                $("#provincia_seleccionada").val("");
                $("#div-provincia-seleccionada").hide();
                $(".sin-provincia").show();
            });
        },
        buscarProvincias: function(){
            obtenerProvincias();
        },
        asignarSeleccionada: function(){
            asignarSeleccionada();
        }
    };
    
    function obtenerDatos(id,infoSelect){
        var select = infoSelect[0];
        $.ajax({
            type: 'post',
            url: select.url,
            data:{
                id: id
            },
            dataType: 'json',            
            success: function(data) {
                if(data){
                    $(select.id).select2({
                        data: {
                            results: data.datos,
                            text: select.text
                        },
                        formatSelection: formatSelects,
                        formatResult: formatSelects,
                        maximumSelectionSize: 1,
                        multiple: true,
                        formatNoMatches: function(term){
                            return "No existen resultados";
                        },
                        formatSelectionTooBig: function(max){
                            return "Solo puede seleccionar " + max + " opción";
                        }	
                    }); 
                }
            }
        });
    }
    
}();