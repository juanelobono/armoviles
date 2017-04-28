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
                            if ($subSeccion == 'NuevaVenta') {
                                echo "Registrar Nueva Venta <small> Agrega una nueva Venta </small>";
                            } else {
                                echo "Modificar Venta <small> Modificar una Venta existente </small>";
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
                                <a href="#">Venta</a>			
                                <i class="icon-angle-right"></i>					
                            </li>
                            <li>
                                <?php
                                if ($subSeccion == 'NuevaVenta') {
                                    echo '<a href="#">Registrar Nueva Venta</a>';
                                } else {
                                    echo '<a href="#">Modificar Venta</a>';
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
                        if ($subSeccion == 'NuevaVenta') {
                            echo 'class="portlet box green">';
                        } else {
                            echo 'class="portlet box blue">';
                        }
                        ?>
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php
                                    if ($subSeccion == 'NuevaVenta') {
                                        echo '<i class="icon-plus"></i>Registrar Nueva Venta';
                                    } else {
                                        echo '<i class="icon-pencil"></i>Modificar Venta';
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
                                    <h3 class="form-section">Informaci&oacute;n de Venta</h3>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="vehiculo" class="control-label">Veh&iacute;culo<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="vehiculo" id="vehiculo" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="comprador" class="control-label">Comprador<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="comprador" id="comprador" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="descripcion" class="control-label">Descripci&oacute;n</label>
                                                <div class="controls">
                                                    <textarea class="span12 m-wrap" id="descripcion" name="descripcion" ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                      <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="vendedor" class="control-label">Vendedor</label>
                                                <div class="controls">
                                                    <input name="vendedor" id="vendedor" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div> 

                                    </div>
                                    <!--/row-->
                                    <div class="row-fluid">
													<div class="span6 ">
                                            <div class="control-group">
                                                <label for="monto" class="control-label">Valor del Vehículo</label>
                                                <div class="controls">
                                                <div class="input-prepend">
                                                	<span class="add-on">$</span>
                                                    <input name="monto" id="monto" type="text" class="span6 m-wrap" readOnly="readOnly"/>
                                                </div>
                                                </div>
                                            </div>
                                        </div> 
                                        
                                    </div>
                                    <h3 class="form-section">Condiciones de Pago</h3>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="entrega" class="control-label">Entrega</label>
                                                <div class="controls">
                                                <div class="input-prepend">
                                                	<span class="add-on">$</span>
                                                    <input name="entrega" id="entrega" type="text" class="span6 m-wrap" />
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                            		<p id="saldo" class="text-info"></p>
                                            </div>
                                        </div>  	
                                    </div>

                                    <!--/row-->
                                    <div class="row-fluid">
                                       <div class="span6 ">
                                       	 <div class="control-group">
                                                <label for="plancuotas" class="control-label">Plan de Cuotas</label>
                                                <div class="controls">          
                                                     <input name="plancuotas" id="plancuotas" type="text" class="span6 m-wrap" />                                                   
                                                </div>
                                              </div>
                                            
                                            </div>
                                        
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                            		<p id="resumencuota" class="text-info"></p>
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

<script type="text/javascript" src="../resources/js/scripts/formularios/nuevaVenta.js"></script>
<script type="text/javascript" src="../resources/js/scripts/formularios/panelFormulario.js"></script>

<script>
    var _idDB = '<?php if (!empty($_GET["id"])) {echo $_GET["id"];} else {echo '0';} ?>';
    
    jQuery(document).ready(function() {
        App.init();
        RegistrarNuevaVenta.init();
        PanelFormulario.init();
    });
</script>	
</body>
</html>