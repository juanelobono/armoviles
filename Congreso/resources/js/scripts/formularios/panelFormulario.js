var PanelFormulario = function () {
	
	var uiElement;
	var mensajeError = $('.alert-error', form);
	var esModificar = false;	

	var limpiarCampos = function(){
		mensajeError.hide();
		
		App.blockUI(uiElement);          	

		//LIMPIAR CHECKBOX
		$("form input:checkbox:checked").each(function () {		
			this.click(); 
		});		
		$("#form")[0].reset();	
		
		if(!selects.length){
			setFocoPrimerCampo();
			App.unblockUI(uiElement);
		}else{
			initSelects();
		}
		
		$(".control-group").each(function(){
    		$(this).removeClass("success");
            });
	}
	
	var exitoModificar = function(){
		if(!esModal){
			setTimeout(function(){
                            window.location.href = document.referrer;
//                            parent.history.back();
			},1500);	
		}else{
			if($("#modalRegistrarNuevo").length) $("#modalRegistrarNuevo").modal('hide');
		}	
	}
	
	var mostrarExito = function(insertID){        
            if(typeof isSiguienteAjax !== 'undefined' && isSiguienteAjax == true){
                    siguienteAjax(insertID);
                    return;        		
                    }	

                    $.gritter.add({
            title: 'Registro exitoso!',
            text: 'El registro ha sido exitoso.'
            });
			
            if(!esModificar && typeof urlSiguientePaso !== 'undefined' && urlSiguientePaso !== null){

                    url = urlSiguientePaso + insertID;
                    setTimeout(function(){
                        window.open(url, "_self");    	
                            },1500);

            }else{        	        
                    esModificar ? exitoModificar() : limpiarCampos();	
            }				
	}
	
	var mostrarError = function(error){
		mensajeError.text(error);
		mensajeError.show();	
		App.unblockUI(uiElement);	
	}
	
	var registrarNuevo = function(form){
		var formData = $(form).serialize();
		$.ajax({
            type: 'post',
            url: urlRegistrarNuevo, 
            data: formData,           
            dataType: 'html',
            beforeSend: function(){
            },   
            success: function(data) {            	
            	var respuesta = data.split("_");            	
                if($.trim(respuesta[0]) === "exito"){
                        mostrarExito(respuesta[1]);	
                }else{
                    console.log(data);
                    mostrarError(data);	
                }				
            },
            error: function(a,b,c){
            	console.log(a);
            	console.log(b);
            	console.log(c);
            	mostrarError(a);	
            }
        });
	}
	
	var confirmarModificar = function(form){
		var formData = $(form).serialize();
		
		if(typeof _elementoSeleccionado !== 'undefined' && _elementoSeleccionado != null){
			!esModal ? formData += "&idDB=" + _idDB : formData += "&idDB=" + _elementoSeleccionado.id;
		}else{
			formData += "&idDB=" + _idDB;
		}
			
		$.ajax({
            type: 'post',
            url: urlModificar, 
            data: formData,           
            dataType: 'html',
            beforeSend: function(){
            },   
            success: function(data) {
				var respuesta = data.split("_");            	
				if($.trim(respuesta[0]) === "exito"){
					mostrarExito(respuesta[1]);	
				}else{
					console.log(data);
					mostrarError(data);	
				}				
            },
            error: function(a,b,c){
            	console.log(a);
            	console.log(b);
            	console.log(c);
            	mostrarError(a);	
            }
        });
	}
	
	var mostrarDatos = function(form){		
		if(esModal){
                    mostrarDatosFormulario();

                    return;
		}

		$.ajax({
            type: 'post',
            url: urlMostrarDatos, 
            data: {
            	'idDB': _idDB 
            },           
            dataType: 'json',
            beforeSend: function(){
            	App.blockUI(uiElement);
            },   
            success: function(data) {
            	mostrarDatosFormulario(data);                
                App.unblockUI(uiElement);   
                  			
            },
            error: function(a,b,c){
            	console.log(a);
            	console.log(b);
            	console.log(c);
            	App.unblockUI(uiElement);
            	mostrarError(a);            		
            }
        });
	}
	
	var formValidateFunction = function(){
		return {
	        errorElement: 'span', //default input error message container
	        errorClass: 'help-inline', // default input error message class
	        focusInvalid: false, // do not focus the last invalid input
	        ignore: "",
	        rules: reglasFormulario,			
                messages: mensajesFormulario,
	
	        invalidHandler: function (event, validator) { //display error alert on form submit              
	            App.scrollTo(mensajeError, -200);
	        },
	
	        highlight: function (element) { // hightlight error inputs
	            $(element)
	                .closest('.help-inline').removeClass('ok'); // display OK icon
	            $(element)
	                .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
	        },
	
	        unhighlight: function (element) { // revert the change done by hightlight
	            $(element)
	                .closest('.control-group').removeClass('error'); // set error class to the control group
	        },
	
	        success: function (label) {            	
	            label
	                .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
	            .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
	        },
	
	        submitHandler: function (form) { 
	        	if(typeof directSubmit !== 'undefined' && directSubmit == true){
	        		form.submit();
	        		return true;	
	        	}
	        	
	        	if(typeof consultaSubmit !== 'undefined' && consultaSubmit == true){
	        		realizarConsultaSubmit(form);
	        		return false;	
	        	}
	       	   
	        	App.blockUI(uiElement);            	
	            esModificar ? confirmarModificar(form) : registrarNuevo(form);
	                            
	            return false;                                
	        }
	    }
    }
		
	var validateForm = function(){
		
		var form = $('#form');
        
            form.validate(formValidateFunction());
	}	
	

	var setSelect = function(select){
		$.ajax({
            type: 'post',
            url: select.url,                       
            dataType: 'json',            
            success: function(data) {
            	
                $(select.id).select2({
                        data: {
                                results: data.datos,
                                text: select.text
                        },
                        formatSelection: formatSelects,
                        formatResult: formatSelects,
                        maximumSelectionSize: select.cantSelecciones,
                        multiple: true,
                        formatNoMatches: function(term){
                                return "No existen resultados";
                        },
                        formatSelectionTooBig: function(max){
                                return "Solo puede seleccionar " + max + " opción";
                        }	
                });             	

                if(select.last){
                        esModificar ? mostrarDatos() : setFocoPrimerCampo();
                        App.unblockUI(uiElement);	
                }
            },
            error: function(a,b,c){
            	console.log(a);
            }
        });
	}
	
	var initSelects = function(){			
		for(var i = 0; i< selects.length; i++){
			setSelect(selects[i]);
		}
	}
	
	var initDateTimePickers = function(){
			
		for(var i = 0; i< dateTimePickers.length; i++){
			$(dateTimePickers[i].id).datetimepicker({            
	            format: "dd/mm/yyyy - hh:ii",
	            pickerPosition: ("bottom-left"),
	            autoclose: true,            
	            minuteStep: 15,
	            todayHighlight: true,
	            language: 'es',
	            keyboardNavigation: false   
	        });
	        
	        $(dateTimePickers[i].id).datetimepicker().on('changeDate', dateTimePickerChange);
		}
	}
	
	var initDatePickers = function(){
			
		for(var i = 0; i< datePickers.length; i++){
			if(datePickers[i].soloMes){
				$(datePickers[i].id).datepicker({
		           	autoclose: true,	 
		           	language: 'es',
		        	viewMode: 2,
		        	minViewMode: 1
	        	});
	        }else{
	        	$(datePickers[i].id).datepicker({            
		            format: "dd/mm/yyyy",	            
		            autoclose: true,	            
		            todayHighlight: true,
		            language: 'es',
		            keyboardNavigation: false	           	
		        });
	        }		
	        
	        $(datePickers[i].id).datepicker().on('changeDate', datePickerChange);
		}
	}
	
	var initDateRangePickers = function(start, end){
		
		var startDate = null;
		var endDate = null; 
		start != null ? startDate = start : startDate = Date.today().addDays(1);
		end != null ? endDate = end : endDate = Date.today().addDays(1);		
		
		for(var i = 0; i< dateRangePickers.length; i++){
			$(dateRangePickers[i].id).daterangepicker({				
				opens: "left",
				format: 'DD/MM/YYYY',
				locale: {
		            applyLabel: 'Aceptar',
		            fromLabel: 'Desde',
		            toLabel: 'Hasta',
		            weekLabel: 'S',
		            customRangeLabel: 'Rango Personalizado',
		            daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
		            monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", 
		            	"Junio", "Julio", "Agosto", "Septiembre", 
		            	"Octubre", "Noviembre", "Diciembre"],
		            firstDay: 0
		        },
		        startDate: startDate,
		        endDate: startDate 	               
	        });	        
		}
	}
	
	var initComponents = function(){
		if(!esModal){
			uiElement = $("#form").closest(".portlet").children(".portlet-body");			
			
			$("#btnActualizar").click(function(){
				esModificar ? mostrarDatos() : limpiarCampos();
				return false;
	    	});
	    	
	    	$("#btnCancelar").click(function(){
	    		parent.history.back();    		    		
	    	});
	    	
		}else{
			uiElement = $("#form").closest(".modal").children(".modal-body");
			
			$("#btnCancelar").click(function(){
	    		return true;    		    		
	    	});		    	
		}
				
		App.blockUI(uiElement);			
		if(dateTimePickers.length) initDateTimePickers();
		if(datePickers.length) initDatePickers();
		if(dateRangePickers.length) initDateRangePickers();
		if(selects.length){
			initSelects();
		}else{
			esModificar ? mostrarDatos() : setFocoPrimerCampo();
			App.unblockUI(uiElement);	
		}	    	    	
	}

    return {

        //main function to initiate the module
        init: function (modificar) {
        	
        	if(modificar != null){
        		esModificar = modificar;
        	}else{
        		$("#btnModificar").length ? esModificar = true : esModificar = false;	
        	}			
        	
        	if(esModal) limpiarCampos(); 
        	
        	if(typeof limpiarAlIniciar !== 'undefined' && limpiarAlIniciar != null && limpiarAlIniciar == true){
        		limpiarCampos();
        	}
        				
        	initComponents();
        	validateForm();
        },
        
        initDateRangePickersPublic: function(start, end){
        	return initDateRangePickers(start,end);
        },
        
        formValidateFunctionPublic: function(){
        	return formValidateFunction();
        },
        
        esModificarPublic: function(){
        	return esModificar;
        },
        
        exitoModificarPublic: function(){
        	exitoModificar();
        },
        
        limpiarCamposPublic: function(){
        	limpiarCampos();
        }
    };
}();