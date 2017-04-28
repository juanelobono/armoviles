var RegistrarNuevoCliente = function() {      
    
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
    
    var obtenerLocalidades = function(){
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
        var idProvincia = $("#provincia").val();
        var infoSelect = [                
            {
                id: "#localidad",
                url: "localidades/obtenerParaSelectPorProvincia.php",
                text: "nombre",
                cantSelecciones: 1,
                last: true
            }
        ];        
        obtenerDatos(idProvincia,infoSelect);
    };
    
    var asignarSeleccionada = function(){
        var localidadSeleccionada = $("#localidad").val();
        $("#localidad-seleccionada").val(localidadSeleccionada + " -");
    };
    formatSelects = function(item) {
                return item.nombre;
            };
    return {
        //main function to initiate the module
        init: function() {
            
            urlRegistrarNuevo = "clientes/nuevo.php";
            urlModificar = "clientes/modificar.php";
            urlMostrarDatos = "clientes/obtenerPorId.php";
            $(".sidebar-toggler").click();
            selects = [
                {
                    id: "#localidad",
                    url: "localidades/obtenerParaSelect.php",
                    text: "nombre",
                    cantSelecciones: 1,
                    last: false
                },
                {
                    id: "#pais",
                    url: "paises/obtenerParaSelect.php",
                    text: "nombre",
                    cantSelecciones: 1,
                    last: false
                },
                {
                    id: "#estadocivil",
                    url: "clientes/obtenerParaSelectEstadoCivil.php",
                    text: "nombre",
                    cantSelecciones: 1,
                    last: true
                }
            ];

            dateTimePickers = [];

            datePickers = [
                {
                    id: '#fecha_nacimiento'
                }
            ];

            dateRangePickers = [];

            datePickerChange = function(ev) {};

            esModal = false;

            reglasFormulario = {
                nombre: {
                    required: true
                },
                apellido: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                dni: {
                    required: true
                }
            };

            mensajeRequerido = "Dato Requerido";
            mensajeEmail = "Por favor ingrese un email válido";

            mensajesFormulario = {
                nombre: {
                    required: mensajeRequerido
                },
                apellido: {
                    required: mensajeRequerido
                },
                email: {
                    required: mensajeRequerido,
                    email: mensajeEmail
                },
                dni: {
                    required: mensajeRequerido
                }
            };

            mostrarDatosFormulario = function(data) {                
                $("#nombre").val(data['aaData'][0]['nombre']);
                $("#apellido").val(data['aaData'][0]['apellido']);                
                $("#email").val(data['aaData'][0]['email']);
                $("#fecha_nacimiento").val(data['aaData'][0]['fecha_nacimiento']);
                $("#telefono").val(data['aaData'][0]['telefono']);
                $("#dni").val(data['aaData'][0]['cuit_cuil_dni']);
                $("#domicilio").val(data['aaData'][0]['domicilio']);
                $("#piso").val(data['aaData'][0]['piso']);
                $("#departamento").val(data['aaData'][0]['departamento']);
                $("#nombre_padre").val(data['aaData'][0]['nombre_padre']);
                $("#nombre_madre").val(data['aaData'][0]['nombre_madre']); 

                $("#nombre_empresa").val(data['aaData'][0]['nombre_empresa']); 
                $("#antiguedad").val(data['aaData'][0]['antiguedad']); 
                $("#condicion").val(data['aaData'][0]['condicion']); 
                $("#domicilio_laboral").val(data['aaData'][0]['domicilio_laboral']); 
                $("#ingresos_mensuales").val(data['aaData'][0]['ingresos_mensuales_netos']); 
                $("#otros_ingresos").val(data['aaData'][0]['otros_ingresos']); 
                $("#telefono_laboral").val(data['aaData'][0]['telefono_laboral']); 
                

                mostrarSituacionLaboral(data['situacionLaboral']);
                               
                if(data['aaData'][0]['localidad_nombre'] !== ""){
                    $("#localidad-seleccionada").val(data['aaData'][0]['localidad_nombre']);
                    $(".sin-localidad").hide();
                    $("#div-localidad-seleccionada").show();
                }
                var estadocivilseleccionado = [];
                
                if (data['aaData'][0]['idestadocivil']) {                              
                estadocivilseleccionado.push({
                        id:data['aaData'][0]['idestadocivil'],
                        nombre: data['aaData'][0]['estado_civil']
                    });                     
                $("#estadocivil").select2("data", estadocivilseleccionado);
             
               }
            };

            

            setFocoPrimerCampo = function() {
                $("#id").focus();
            };
            
            $("#cambiarLocalidad").click(function(){
                $("#localidad-seleccionada").val("");
                $("#div-localidad-seleccionada").hide();
                $(".sin-localidad").show();
            });
        },
        buscarProvincias: function(){
            obtenerProvincias();
        },
        buscarLocalidades: function(){
            obtenerLocalidades();
        },
       
        asignarSeleccionada: function(){
            asignarSeleccionada();
        }
    };
    
        function mostrarSituacionLaboral(situacioneslaborales){
               
               $.each(situacioneslaborales, function(i, situacionlaboral) {
                   if(i > 0){
                       ComportamientoSituacionLaboralcliente.nuevaFila();
                   }
                   
                   $(".nombre_empresa:last").val(situacionlaboral.nombre_empresa);
                   $(".condicion:last").val(situacionlaboral.condicion);
                   $(".antiguedad:last").val(situacionlaboral.antiguedad);
                   $(".ingresos_mensuales:last").val(situacionlaboral.ingresos_mensuales_netos);
                   $(".domicilio_laboral:last").val(situacionlaboral.domicilio_laboral);
                   $(".telefono_laboral:last").val(situacionlaboral.telefono_laboral);
                   $(".otros_ingresos:last").val(situacionlaboral.otros_ingresos);
                                            
               });
           }

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