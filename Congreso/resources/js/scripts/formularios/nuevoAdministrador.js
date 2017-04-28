var RegistrarNuevoAdministrador = function() {

    return {
        //main function to initiate the module
        init: function() {
            
            urlRegistrarNuevo = "administradores/nuevo.php";
            urlModificar = "administradores/modificar.php";
            urlMostrarDatos = "administradores/obtenerPorId.php";            
            urlSecciones = "secciones/obtenerTodas.php";
        	
            $('#activo').bootstrapSwitch('setState', true);
                
            setSeccionesPadreListener = function(){
                $(".control-label input:checkbox").click(function(e){
                    if($(this).is(':checked')){						
                        $(this).closest(".control-group").find(".controls").show();
                    }else{						
                        $(this).closest(".control-group").find(".controls").hide();
                        $(this).closest(".control-group").find(".controls input:checkbox").each(function(i,v){
                            if($(this).is(':checked')){
                                $(this).click();								
                            }
                        });					
                    }					
                });	
            };		
        	
            cargarSecciones = function(){								
                $.ajax({
                    type: 'post',
                    url: urlSecciones, 
                    data: {},           
                    dataType: 'json',
                    beforeSend: function(){
                        $("#permisosSecciones").text("");
                    },   
                    success: function(data) {
                        var grupo = "";
                        $(data.datos).each(function(index){
                            if(parseInt(data.datos[index].idPadre) === 0){
                                if(grupo !== ""){
                                        grupo += '</div>';
                                        grupo += '</div>';
                                        grupo += '</div>';
                                        grupo += '</div>';
                                }
                                grupo += '<div class="row-fluid">';
                                grupo += '<div class="span6">';
                                grupo += '<div class="control-group">';
                                grupo += '<label class="control-label checkbox">';
                                grupo += data.datos[index].nombre;
                                grupo += ' <input name="chkPermiso[]" type="checkbox" value="' + data.datos[index].id + '"/>';
                                grupo += '</label>';
                                grupo += '<div class="controls">';	
                            }else{
                                grupo += '<label class="checkbox line">';
                                grupo += '<input name="chkPermiso[]" type="checkbox" value="' + data.datos[index].id + '"/> ';
                                grupo += data.datos[index].nombre;
                                grupo += '</label>';	
                            }	            		            			
                        });

                        grupo += '</div>';
                        grupo += '</div>';
                        grupo += '</div>';
                        grupo += '</div>';

                        $("#permisosSecciones").append(grupo);	            	
                        App.initUniform();

                        $("#permisosSecciones .controls").each(function(i,v){							
                            $(this).hide();							
                        });		
                        setSeccionesPadreListener();		            	            			
                    },
                    error: function(a,b,c){
                        console.log(a);
                        console.log(b);
                        console.log(c);  		
                    }
                });
            }

            cargarSecciones();
            
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
                apellido: {
                    required: true
                },                
                usuario: {
                    required: true
                },
                contrasenia: {
                    required: true
                },
                contrasenia2: {
                    required: true,
                    equalTo: "#contrasenia"
                },
                email: {
                    required: true,
                    email: true
                }
            };

            mensajeRequerido = "Dato Requerido";
            mensajeEmail = "Por favor ingrese un email válido";
            mensajeRepetirPass = "El valor ingresado debe ser igual a 'Contraseña'";

            mensajesFormulario = {
                nombre: {
                    required: mensajeRequerido
                },
                apellido: {
                    required: mensajeRequerido
                },               
                usuario: {
                    required: mensajeRequerido
                },
                contrasenia: {
                    required: mensajeRequerido
                },
                contrasenia2: {
                    required: mensajeRequerido,
                    equalTo: mensajeRepetirPass
                },
                email: {
                    required: mensajeRequerido,
                    email: mensajeEmail
                }
            };

            mostrarDatosFormulario = function(data) {   
                
                if(_isPassword === "1"){
                    urlModificar = "administradores/modificarContrasenia.php";
                    
                    $("#nombre").val(data['aaData'][0]['nombre']);
                    $("#nombre").prop('disabled', true);
                    $("#usuario").val(data['aaData'][0]['usuario']);
                    $("#usuario").prop('disabled', true);
                    $("#contrasenia").val("");
                    $("#contrasenia2").val("");

                    $("#apellido").val("------");
                    $("#apellido").closest(".control-group").hide();
                    $("#email").val("------@g.com");
                    $("#email").closest(".control-group").hide();
                    $('#activo').closest(".control-group").hide();
                    $("#permisosSecciones").hide();
                    
                    $(".tituloPermisos").hide();	   
                    
                }else{
                    urlModificar = "administradores/modificar.php";
                    
                    $("#nombre").val(data['aaData'][0]['nombre']);
                    $("#apellido").val(data['aaData'][0]['apellido']);
                    $("#usuario").val(data['aaData'][0]['usuario']);
                    $("#contrasenia").val(data['aaData'][0]['contrasenia']);
                    $("#contrasenia2").val(data['aaData'][0]['contrasenia']);
                    $("#contrasenia").closest(".control-group").hide(); 
                    $("#contrasenia2").closest(".control-group").hide(); 
                    $("#email").val(data['aaData'][0]['email']);

                    if(data['aaData'][0]['activo']==="1"){
                        $('#activo').bootstrapSwitch('setState', true);
                    }else{
                        $('#activo').bootstrapSwitch('setState', false);
                    } 

                    var idSeccion = 0;
                    $(data.aaData).each(function(index, value){
                        idSeccion = parseInt(value.idSeccion);                	
                        if(idSeccion !== 0){
                            $("#permisosSecciones input:checkbox").each(function(i,v){							
                                if(parseInt($(this).val()) === idSeccion){
                                    $(this).click();
                                }					
                            });	
                        }
                    });
                    
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