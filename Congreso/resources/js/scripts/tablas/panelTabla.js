var PanelTabla = function () {
		
	/*
	 * Script
	 */
	var tabla;
	var cantidadRegistros = 0;
	var portlet;
	
	var eliminarRegistros = function(datos){		
		$.ajax({
            type: 'post',
            url: urlEliminarRegistros, 
            data: datos,           
            dataType: 'html',
            beforeSend: function(){
    			        	
            },   
            success: function(data) {
            	var respuesta = data.split("_");            	
				if(respuesta[0] == "exito"){
            		$.gritter.add({
			            title: 'Registros eliminados!',
			            text: 'Los registros fueron eliminados con exito'
			        });		
			        
			        actualizarTabla();
			        
            	}else{
            		console.log(data);
            		$.gritter.add({
			            title: 'Error al eliminar!',
			            text: 'Ocurrió un error al eliminar los registros'
			        });		
            	}
                
            },
            error: function(a,b,c){
            	console.log(a);
            	$.gritter.add({
		            title: 'Error al eliminar!',
		            text: 'Ocurrió un error al eliminar los registros'
		        });		
            }
        });
	}
	
	var checkNewRecords = function(){
		if (cantidadRegistros == 0) return;
		 
		var registrosNuevos = tabla.fnSettings().fnRecordsTotal() - cantidadRegistros;
		
		if(registrosNuevos > 0){
			$.gritter.add({
	            title: 'Nuevos Registros!',
	            text: 'Existen ' + registrosNuevos + ' registros nuevos'
	        });		
	        
		}else if(registrosNuevos < 0){
			$.gritter.add({
	            title: 'Registros Eliminados!',
	            text: 'Existen ' + Math.abs(registrosNuevos) + ' registros eliminados'
	        });		
		}
	}
	
	var fnSelTodos = function (oTableLocal){		
		var aTrs = oTableLocal.$('tr', {"filter": "applied"});
		
		for ( var i=0 ; i<aTrs.length ; i++ ){
			$(aTrs[i]).addClass('row_selected');			
		}
	}
	
	var fnSelNinguno = function (oTableLocal){
		var aTrs = oTableLocal.$('tr', {"filter": "applied"});
		
		for ( var i=0 ; i<aTrs.length ; i++ ){
			$(aTrs[i]).removeClass('row_selected');			
		}
	}
	
	var fnDesSelFila = function (index){
				
		var aTrs = tabla.fnGetNodes(index);
		
		if ( $(aTrs).hasClass('row_selected')){
			$(aTrs).removeClass('row_selected');
		}			
	}
	
	/* Get the rows which are currently selected */
	var fnGetSelected = function( oTableLocal ){
		var aReturn = new Array();
		var aTrs = oTableLocal.fnGetNodes();
		
		for ( var i=0 ; i<aTrs.length ; i++ ){
                    if ( $(aTrs[i]).hasClass('row_selected') ){
                            aReturn.push( aTrs[i] );
                    }
		}
		return aReturn;
	}
	
	var fnGetIdSelected = function(oTableLocal){
		var id = 0;
		var filas = fnGetSelected(oTableLocal);
		
		if(filas.length == 1){
                    id = $(filas)[0].id;
		}
			
		return id;
	}
	
	var fnRowClick = function(){
		if ( $(this).hasClass('row_selected') ){
			$(this).removeClass('row_selected');
		}
		else{
			$(this).addClass('row_selected');
		}
	}
	
	var fnRegistrarRowClick = function(){
		/* Add a click handler to the rows - this could be used as a callback */
		$('#tabla tbody tr').unbind('click'); //prevenimos que no se registre varias veces la funcion
		$('#tabla tbody tr').click(fnRowClick);
	}
	
	var actualizarTabla = function(){
            $(tabla.fnSettings().aoData).each(function (){
                $(this.nTr).removeClass('row_selected');
            });
		
            cantidadRegistros = tabla.fnSettings().fnRecordsTotal();
            tabla.fnReloadAjax(); 
	}

    return {
        //main function to initiate the module
        init: function () {
        	panelTablaActualizarTabla = function(){
        		actualizarTabla();
        	}
        	
        	$(".btn-group.pull-right").hide();
        	
                portlet = jQuery("#tabla").closest(".portlet").children(".portlet-body");
            
            if (!jQuery().dataTable) {
                return;
            }                
            
            $('#chkSeleccion').on('switch-change', function (e, data) {
			    tabla.fnDraw();
			}); 
            
            /* Custom filtering function which will filter data in column four between two values */
			$.fn.dataTableExt.afnFiltering.push(
			    function( oSettings, aData, iDataIndex ) {		
					
			        if($('#chkSeleccion').bootstrapSwitch('status')){
			        	return true;
			        }
			        
					var row = tabla.fnGetNodes(iDataIndex);
					if ( $(row).hasClass('row_selected') ){
						return true;
					}else{
						return false;
					}
			    }
			);
			
			/**
			 *seleccion de cartelera en VerPeliculas 
			 */
//			if($("#chkCartelera").length){
//				$('#chkCartelera').on('switch-change', function (e, data) {
//				    tabla.fnDraw();
//				}); 
//	            
//	            /* Custom filtering function which will filter data in column four between two values */
//				$.fn.dataTableExt.afnFiltering.push(
//				    function( oSettings, aData, iDataIndex ) {		
//						
//				        if($('#chkCartelera').bootstrapSwitch('status')){
//				        	var enCartelera = oSettings.aoData[iDataIndex]._aData.cartelera;
//				        	if(enCartelera == 1){
//				        		return true;	
//				        	}else{
//				        		fnDesSelFila(iDataIndex);
//				        		return false;
//				        	}
//				        	
//				        }				        
//				        return true;
//				    }
//				);	
//			}

            // begin first table
            tabla = $('#tabla').dataTable({
                "bProcessing": true,
                "sAjaxSource": urlDatosTabla,
                "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {   
                	
					App.blockUI(portlet);
					             	
				    $.getJSON( sSource, aoData, function (json) {	                    
	                	fnCallback(json);
	                	App.unblockUI(portlet);
	                    checkNewRecords();	                    	                    					
	                });	                
				},
				"fnDrawCallback": function( oSettings ) {
					fnRegistrarRowClick();
				},
				"aoColumns": columnasTabla,		        
		        "aLengthMenu": [
                    [5, 10, 20, -1],
                    [5, 10, 20, "Todos"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 10,
                "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                "sPaginationType": "bootstrap",                
                "oLanguage": {
                    "sLengthMenu": "Mostrar _MENU_ registros por página",
                    "sSearch": "Buscar: ",                    
		            "sZeroRecords": "Sin registros",
		            "sInfo": "Mostrando _START_ - _END_ de _TOTAL_ registros",
		            "sInfoEmpty": "Mostrando 0 - 0 de 0 registros",
		            "sInfoFiltered": "(Filtrado de _MAX_ registros)",
                    "oPaginate": {
                        "sPrevious": "Ant",
                        "sNext": "Sig"
                    }
                },
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                	//var input = '<div class="checker"><span><input type="checkbox" class="checkboxes" value="1" /></span></div>';	            
		        },
		        "aoColumnDefs": columnasDef
			});
/*
            jQuery('#tabla .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                    	console.log(this);
                        $(this).attr("checked", true);
                    } else {
                    	console.log(this);
                        $(this).attr("checked", false);
                    }
                });
                jQuery.uniform.update(set);
            });   */
            
            $("#btnActualizar").click(function (e) {
                actualizarTabla();   			
                        return false;
                    });      

                $("#btnRegistrarNuevo").click(function (e) {
                        url = urlRegistrarNuevo;
                        window.open(url, '_self');
                        return false;
                });    
                
                $("#btnResponder").click(function (e) {
                        var filas = fnGetSelected(tabla); 
                        if(filas.length === 1){
                            var data = tabla.fnGetData(filas[0]);
                            window.open("mailto:"+data.email, '_self');
                            return true;
                        }else{
                                $.gritter.add({
                                    title: 'Error!',
                                    text: 'Debe seleccionar 1 solo registro para poder responder'
                                });		
                                return false;
                        }
                });

                $("#btnModificar").click(function (e) {
                        var filas = fnGetSelected(tabla); 
                        if(filas.length == 1){

                            var data = tabla.fnGetData(filas[0]);					
                            $("#modalModificar .modal-body-registro").text(infoModificar(data));					
                            return true;

                        }else{
                                $.gritter.add({
                            title: 'Error!',
                            text: 'Debe seleccionar 1 solo registro para poder modificar'
                        });		
                                return false;
                        }				
                });

                $("#btnModificarCosto").click(function (e) {
                        var filas = fnGetSelected(tabla); 
                        if(filas.length === 1){

                                var data = tabla.fnGetData(filas[0]);
                                $("#productoMod").empty();
                                $("#productoMod").empty();
                                $("#productoMod").empty();
                                $("#idProductoMod").val(data['id_producto']);
                                $("#idProovedorMod").val(_idDB);
                                $("#productoMod").append("<strong>- Producto: </strong>"+data['id_producto']+" - "+data['nombre']);
                                $("#precioMod").val(data['precio_costo']);
                                return true;

                        }else{
                                $.gritter.add({
                            title: 'Error!',
                            text: 'Debe seleccionar 1 solo registro para poder modificar'
                        });		
                                return false;
                        }				
                });
                
                $("#btnModificarPassword").click(function (e) {
                        var filas = fnGetSelected(tabla); 
                        if(filas.length == 1){

                                var data = tabla.fnGetData(filas[0]);
                                $("#modalModificar #modalModificarLabel").text("Modificar Password");					
                                $("#modalModificar .modal-body-registro").text(infoModificar(data));

                                console.log($("#modalModificar #modalModificarLabel").html());					
                                return true;

                        }else{
                                $.gritter.add({
                            title: 'Error!',
                            text: 'Debe seleccionar 1 solo registro para poder modificar'
                        });		
                                return false;
                        }				
                });

                $("#btnConfirmarModificar").click(function (e) {	

                        if($("#modalModificar #modalModificarLabel").html() == "Modificar Password"){
                                url = urlModificarRegistro + fnGetIdSelected(tabla) + "&isPassword=yes";	
                        }else{
                                url = urlModificarRegistro + fnGetIdSelected(tabla);	
                        }			

                    window.open(url, "_self");
                    return true;	
                });

                $("#btnImagenes").click(function (e) {
                        var filas = fnGetSelected(tabla); 
                        if(filas.length === 1){
                            url = urlImagenesRegistro + fnGetIdSelected(tabla);
                            window.open(url, "_self");					
                            return true;
                        }else{
                                $.gritter.add({
                            title: 'Error!',
                            text: 'Debe seleccionar 1 solo registro para poder modificar'
                        });		
                                return false;
                        }				
                });

                $("#btnVerDetalle").click(function (e) {
                        var filas = fnGetSelected(tabla); 
                        if(filas.length === 1){
                            url = urlVerDetalle + fnGetIdSelected(tabla);
                            window.open(url, "_self");                  
                            return true;
                        }else{
                                $.gritter.add({
                            title: 'Error!',
                            text: 'Debe seleccionar 1 solo registro para poder modificar'
                        });     
                                return false;
                        }               
                });
			
            $("#btnEliminar").click(function(e) {
                var filas = fnGetSelected(tabla);
                if (filas.length > 0) {

                    $("#modalEliminar .modal-body-registro").text("");
                    for (var i = 0; i < filas.length; i++) {
                        var data = tabla.fnGetData(filas[i]);
                        $("#modalEliminar .modal-body-registro").append(infoEliminar(data));
                    }

                    return true;

                } else {
                    $.gritter.add({
                        title: 'Error!',
                        text: 'Debe seleccionar por lo menos 1 registro para poder eliminar'
                    });
                    return false;
                }
            });
			
            $("#btnVerProductosProveedor").click(function (e) {
                    var filas = fnGetSelected(tabla);
                    if(filas.length == 1){

                            var data = tabla.fnGetData(filas[0]);					
                            $("#modalProductosProveedor .modal-body-registro").text(infoModificar(data));					
                            return true;

                    }else{
                            $.gritter.add({
                        title: 'Error!',
                        text: 'Debe seleccionar 1 solo registro para poder modificar'
                    });		
                            return false;
                    }		
            });

            $("#btnTodos").click(function (e) {
                    fnSelTodos(tabla);
                    return false;
            });

            $("#btnNinguno").click(function (e) {
                    fnSelNinguno(tabla);
                    return false;
            });

            $("#btnConfirmarEliminar").click(function (e) {				
                    var filas = fnGetSelected(tabla);				
                    var data = "";

                    $(filas).each(function (){
                            data += "idDB=" + $(this).attr("id") + "&";
                    });

                    data = data.substring(0, data.length-1);

                    eliminarRegistros(data);				
                    return true;
            });    
            
            $("#btnModificarConsulta").click(function (e) {
                var filas = fnGetSelected(tabla); 
                if(filas.length === 1){

                    var data = tabla.fnGetData(filas[0]);					
                    $("#modalModificarConsulta .modal-body-registro").text(infoModificar(data));					
                    return true;

                }else{
                    $.gritter.add({
                        title: 'Error!',
                        text: 'Debe seleccionar 1 solo registro para poder modificar'
                    });		
                    return false;
                }				
            });
            
            $("#btnConfirmarModificarConsulta").click(function (e) {
                url = urlModificarConsulta + fnGetIdSelected(tabla);
                window.open(url, "_self");
                return true;	
            });
        }
    };
}();