<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../resources/js/plugins/select2/select2_metro.css" />
        <link rel="stylesheet" type="text/css" href="../resources/js/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
        <link href="../resources/js/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <!-- BEGIN PAGE -->
        <div class="page-content">
            <!-- BEGIN PAGE CONTAINER-->
            <div class="container-fluid">
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">						
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                        <h3 class="page-title">
                            <?php
                            if ($subSeccion == 'NuevoProducto') {
                                echo "Registrar Nuevo Vehículo <small> Agrega un nuevo Vehículo </small>";
                            } else {
                                echo "Modificar Vehículo <small> Modificar un Vehículo existente </small>";
                            }
                            ?>							
                        </h3>
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="pnlAdmin.php?seccion=Inicio">Inicio</a>			
                                <i class="icon-angle-right"></i>					
                            </li>
                            <li>
                                <i class="icon-tasks"></i>
                                <a href="#">Vehículo</a>			
                                <i class="icon-angle-right"></i>					
                            </li>
                            <li>
                                <?php
                                if ($subSeccion == 'NuevoProducto') {
                                    echo '<a href="#">Registrar Nuevo Vehículo</a>';
                                } else {
                                    echo '<a href="#">Modificar Vehículo</a>';
                                }
                                ?>																
                            </li>
                        </ul>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row-fluid">
                    <div class="span12">
                        <div <?php
                        if ($subSeccion == 'NuevoProducto') {
                            echo 'class="portlet box green">';
                        } else {
                            echo 'class="portlet box blue">';
                        }
                        ?>
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php
                                    if ($subSeccion == 'NuevoProducto') {
                                        echo '<i class="icon-plus"></i>Registrar Nuevo Vehículo';
                                    } else {
                                        echo '<i class="icon-pencil"></i>Modificar Vehículo';
                                    }
                                    ?>									
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="reload" id="btnActualizar"></a>
                                    <a href="javascript:;" class="collapse"></a>									
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="#" id="form" class="form-horizontal">
                                    <div class="alert alert-error hide">
                                        Existen errores. Por favor modifique los datos
                                    </div>				
                                    <h3 class="form-section">Informaci&oacute;n General</h3>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="nombre" class="control-label">Nombre<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="nombre" id="nombre" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="marca" class="control-label">Marca</label>
                                                <div class="controls">
                                                    <input name="marca" id="marca" type="text" onchange="RegistrarNuevoProducto.buscarmodelos();" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="marca" class="control-label">Patente</label>
                                                <div class="controls">
                                                    <input name="patente" id="patente" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="modelo" class="control-label">Modelo</label>
                                                <div class="controls">
                                                    <input name="modelo" id="modelo" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="categoria" class="control-label">Tipo</label>
                                                <div class="controls">
                                                    <input name="categoria" id="categoria" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="anio" class="control-label">Año</label>
                                                <div class="controls">
                                                    <input name="anio" id="anio" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                        	  <div class="control-group">
                                        	  		<label for="cliente_duenio" class="control-label">Cliente Dueño</label>
                                        	  		<div class="controls">
																	<input name="cliente_duenio" id="cliente_duenio" type="text" class="span11 m-wrap"/>                                        	  		
                                        	  		</div>
                                        	  </div>
                                              <div class="control-group">
                                                    <label for="precio_costo" class="control-label">Precio Costo</label>
                                                    <div class="controls">
                                                        <input name="precio_costo" id="precio_costo" placeholder="00.00" type="text" class="span11 m-wrap"/>                                                    
                                                    </div>
                                              </div>
                                        </div> 
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="descripcion" class="control-label">Descripci&oacute;n</label>
                                                <div class="controls">
                                                    <textarea class="span12 m-wrap" id="descripcion" name="descripcion" ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="form-section">Informaci&oacute;n Ventas</h3>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="precio_sin_iva" class="control-label">Precio Sin IVA</label>
                                                <div class="controls">
                                                    <input name="precio_sin_iva" id="precio_sin_iva" placeholder="00.00" type="text" class="span11 m-wrap" />
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="iva" class="control-label">Porcentaje IVA</label>
                                                <div class="controls">
                                                    <div class="input-prepend">
                                                        <span class="add-on">%</span>
                                                        <input name="iva" id="iva" type="text" placeholder="00.00" class="m-wrap " value="">                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  	
                                    </div>

                                    <!--/row-->
                                    <div class="row-fluid">
                                       <div class="span6 ">
                                       	 <div class="control-group">
                                                <label for="activo" class="control-label">Activo</label>
                                                <div class="controls">
                                                    <div id="activo" class="switch span3" data-on="info" data-off="danger" data-on-label="SI" data-off-label="NO">
                                                        <input name="activo" type="checkbox" class="toggle" class="span11 m-wrap" />
                                                    </div>
                                                </div>
                                              </div>
                                            
                                            </div>
                                        
                                        <!--/span-->
                                        <div class="span6 ">
                                            <!--<div class="control-group">
                                                <label for="estado" class="control-label">Estado</label>
                                                <div class="controls">
                                                    <select name="estado" id="estado">
                                                    	<option value="disponible">Disponible</option>
                                                    	<option value="vendido">Vendido</option>
                                                    	<option value="reservado">Reservado</option>
                                                    </select>
                                                </div>-->
                                        </div>
                                    </div>
                                    <h3 class="form-section">Datos Extras</h3>
                                    <div class="row-fluid">
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="combustible" class="control-label">Combustible</label>
                                                <div class="controls">
                                                    <select name="combustible" id="combustible">
                                                    	<option value="nafta">Nafta</option>
                                                    	<option value="gasoil">GasOil</option>
                                                    	<option value="nafta-gnc">Nafta-GNC</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>								
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="numero_chasis" class="control-label">N&uacute;mero Chasis</label>
                                                <div class="controls">
                                                    <input name="numero_chasis" id="numero_chasis" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row-fluid">
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label class="control-label">Color</label>
                                                <div class="controls">
                                                        <div class="input-append color colorpicker-default" data-color="#3865a8" data-color-format="rgba">
                                                                <input type="text" id="color_html" name="color_html" class="span11 m-wrap"/>
                                                                <span class="add-on"><i id="color-seleccionado" style="background-color: #3865a8;"></i></span>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="numero_motor" class="control-label">N&uacute;mero Motor</label>
                                                <div class="controls">
                                                    <input name="numero_motor" id="numero_motor" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="row-fluid">
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="color" class="control-label">Descripci&oacute;n Color</label>
                                                <div class="controls">
                                                    <input name="color" id="color" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>                                    
                                    
                                    <div class="form-actions">
                                        <?php
                                        if ($subSeccion == 'NuevoProducto') {
                                            echo '<button type="submit" id="btnRegistrar" class="btn green"><i class="icon-ok"></i> Registrar</button>';
                                        } else {
                                            echo '<button type="submit" id="btnModificar" class="btn blue"><i class="icon-ok"></i> Modificar</button>';
                                        }
                                        ?>										
                                        <button type="button" id="btnCancelar" class="btn ">Cancelar</button>
                                    </div>
                                </form>
                                <!-- END FORM-->               
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
        <!-- END PAGE CONTAINER--> 
    </div>
    <!-- END PAGE -->    
</div>
<!-- END CONTAINER -->	
<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="footer-inner">
        2013 &copy; Meridio.
    </div>
    <div class="footer-tools">
        <span class="go-top">
            <i class="icon-angle-up"></i>
        </span>
    </div>
</div>
<!-- END FOOTER -->	
<script type="text/javascript" src="../resources/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../resources/js/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="../resources/js/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="../resources/js/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../resources/js/plugins/bootstrap-switch/static/js/bootstrap-switch.js"></script>

<script type="text/javascript" src="../resources/js/scripts/formularios/nuevoProducto.js"></script>
<script type="text/javascript" src="../resources/js/scripts/formularios/panelFormulario.js"></script>

<script>
    var _idDB = '<?php if (!empty($_GET["id"])) {echo $_GET["id"];} else {echo '0';} ?>';
    
    jQuery(document).ready(function() {
        App.init();
        RegistrarNuevoProducto.init();
        PanelFormulario.init();
    });
</script>	
</body>
</html>