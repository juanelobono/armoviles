var RegistrarNuevoProducto = function() {  
    

    var obtenermodelos = function(){
            $('#modelo').select2({
                query: function (query){
                    var data = {
                        results: [
                            { id: '', text: "" }
                        ]
                    };
                    query.callback(data);
                }
            });
            var idmarca = $("#marca").val();
            var infoSelect = [                
                {
                    id: "#modelo",
                    url: "modelos/obtenerParaSelectmarca.php",
                    text: "nombre",
                    cantSelecciones: 1,
                    last: true
                }
            ];
            if(idmarca === ""){
                $('#marca').val("");
                 var infoSelect = [
                    {
                        id: "#modelo",
                        url: "modelos/obtenerParaSelect.php",
                        text: "nombre",
                        cantSelecciones: 1,
                        last: false
                    }
                ];
                obtenerDatos(idmarca,infoSelect);
            }else{
                
                $('#modelo').select2({
                    query: function (query){
                        var data = {
                            results: [
                                { id: '', text: "" }
                            ]
                        };
                        query.callback(data);
                    }
                });
                obtenerDatos(idmarca,infoSelect);
            }        
        };
        
        var asignarSeleccionada = function(){
            var provinciaSeleccionada = $("#marca").val();
            $("#marca").val(provinciaSeleccionada + " (");
        };

    return {
        //main function to initiate the module
        init: function() {
            $('#activo').bootstrapSwitch('setState', true);
            
            urlRegistrarNuevo = "productos/nuevo.php";
            urlModificar = "productos/modificar.php";
            urlMostrarDatos = "productos/obtenerPorId.php";
            urlSiguientePaso = "pnlAdmin.php?subSeccion=ImagenProductos&idDB=";
            
            selects = [
                {                    
                    id: "#categoria",
                    url: "categorias/obtenerParaSelect.php",
                    text: "nombre",
//                    cantSelecciones: 1,
                    last: false
                },
                {
						id:"#cliente_duenio",
						url:"clientes/obtenerParaSelect.php",
						text: "nombre",
						cantSelecciones: 1,
						last: false					
				},
                {
                    id:"#marca",
                    url:"marcas/obtenerParaSelect.php",
                    text: "nombre",
                    cantSelecciones: 1,
                    last: false                  
                },
                {
                    id:"#modelo",
                    url:"modelos/obtenerParaSelect.php",
                    text: "nombre",
                    cantSelecciones: 1,
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
                    required: true
                },
                modelo: {
                    required: true
                },
                categoria: {
                    required: false
                },
                precio_sin_iva: {
                    required: false,
                    number: true
                },
                iva: {
                    required: false,
                    number: true
                },
                combustible: {
                    required: false
                },
                anio: {
                    required: false,
                    number: true
                },
                activo: {
                    required: false
                },
                color: {
                    required: false
                },
                colo_html: {
                    required: false
                },
                cliente_duenio: {
							required: false                
                },
                precio_costo: {
                    required: false,
                    number: true
                }
                
               
            };

            mensajeRequerido = "Dato Requerido";
            mensajeDigitos = "Ingrese sólo números Por Favor";

            mensajesFormulario = {
                nombre: {
                    required: mensajeRequerido
                },
                descripcion: {
                    required: mensajeRequerido
                },
                marca: {
                    required: mensajeRequerido
                },
                modelo: {
                    required: mensajeRequerido
                },
                categoria: {
                    required: mensajeRequerido
                },
                precio_sin_iva: {
                    required: mensajeRequerido,
                    number: mensajeDigitos
                },
                iva: {
                    required: mensajeRequerido,
                    number: mensajeDigitos
                },
                combustible: {
                    required: mensajeRequerido
                },
                anio: {
                    required: mensajeRequerido
                },
                activo: {
                    required: mensajeRequerido
                },
                color: {
                    required: mensajeRequerido
                },
                color_html: {
                    required: mensajeRequerido
                },

                precio_costo: {
                    required: mensajeDigitos,
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
                $("#precio_costo").val(data['aaData'][0]['precio_costo']);
                
                var clienteDuenioSeleccionado = [];
                
                if (data['aaData'][0]['cliente']) {                              
                clienteDuenioSeleccionado.push({
                		id:data['aaData'][0]['cliente_id'],
                		nombre: data['aaData'][0]['cliente']
                	});                     
                $("#cliente_duenio").select2("data", clienteDuenioSeleccionado);
             
               }
                
                var categoriasSeleccionadas = [];
                var categorias = data['categorias'];
                $(categorias).each(function(i) {
                    categoriasSeleccionadas.push({
                        id: data['categorias'][i]['categoria_id'],
                        nombre: data['categorias'][i]['nombre']
                    });
                });                
                $("#categoria").select2("data", categoriasSeleccionadas);

                var marcaselec = [];
                
                if (data['aaData'][0]['marcadesc']) {                              
                marcaselec.push({
                        id:data['aaData'][0]['marca_id'],
                        nombre: data['aaData'][0]['marcadesc']
                    });                     
                $("#marca").select2("data", marcaselec);
               }
               var modeloselec = [];
                
                if (data['aaData'][0]['modelodesc']) {                              
                modeloselec.push({
                        id:data['aaData'][0]['modelo_id'],
                        nombre: data['aaData'][0]['modelodesc']
                    });                     
                $("#modelo").select2("data", modeloselec);
               }
            };

            formatSelects = function(item) {
                return item.nombre;
            };

            setFocoPrimerCampo = function() {
                $("#id").focus();
            };
        },
         buscarmodelos: function(){
            obtenermodelos();
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