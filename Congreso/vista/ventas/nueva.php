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
                                                    <input name="vehiculo" id="vehiculo" type="text" class="span12 m-wrap"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="comprador" class="control-label">Comprador<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="comprador" id="comprador" type="text" class="span9 m-wrap"/>
                                                    <a href="javascript:;" id="btnNuevo" class="btn blue"><i class="icon-plus"></i>Nuevo</a>
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label for="vendedor" class="control-label">Vendedor</label>
                                                <div class="controls">
                                                    <input name="vendedor" id="vendedor" type="text" class="span12 m-wrap"/>
                                                </div>
                                            
                                            </div>
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
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="fecha" class="control-label">Fecha:</label>
                                                <div class="controls">
                                                    <div class="input-append date form_datetime">
                                                        <input size="26" name="fecha" id="fecha" type="text" value="" format="dd/mm/yyyy" readonly class="m-wrap span18">
                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="conyugue" class="control-label">Conyugue<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="conyugue" id="conyugue" type="text" class="span9 m-wrap"/>
                                                    <a href="javascript:;" id="btnNuevo" class="btn blue"><i class="icon-plus"></i>Nuevo</a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="descripcion" class="control-label">Descripci&oacute;n</label>
                                                <div class="controls">
                                                    <textarea class="span12 m-wrap" id="descripcion" name="descripcion" ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                     
                                    <h3 class="form-section">Plan de Cuotas</h3>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="cuotas" class="control-label">Cantidad Cuotas</label>
                                                <div class="controls">
                                                    <input name="cuotas" id="cuotas" type="text" class="span4 m-wrap" />
                                                </div>
                                                
                                            </div>
                                            <div class="control-group">
                                                <label for="valor_cuota" class="control-label">Valor Cuota</label>
                                                <div class="controls">
                                                    <input name="valor_cuota" id="valor_cuota" type="text" class="span4 m-wrap" />
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                            	<label for="importe" class="control-label">Importe</label>
                                                <div class="controls">
                                                    <div class="input-prepend">
                                                    <span class="add-on">$</span>
                                                    <input name="importe" id="importe" type="text" placeholder="000000.00" class="span6 m-wrap" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  	
                                    </div>

                                    <!--/row--> 

                                    <h3 class="form-section">Entrega</h3>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="entrega-vehiculos" class="control-label">Veh&iacute;culos recibidos</label>
                                                <div class="controls">
                                                    <input name="entrega-vehiculos" id="entrega-vehiculos" type="text" class="span9 m-wrap"/>
                                                    <a href="javascript:;" id="btnNuevoAuto" class="btn blue"><i class="icon-plus"></i>Nuevo</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6">
                                           <div class="control-group">
                                                <!--<button type="submit" id="btnAgregarVehiculo" class="btn blue"><i class="icon-plus"></i>Agregar</button>-->
                                            </div>
                                        </div>
                                    </div>   

                                    <div class="row-fluid">
                                        <div class="span13 ">
                                            <table class="table table-bordered table-advance" id="tabla">
                                                <thead>
                                                    <tr>
                                                        <th class="hidden-480">Tipo</th>
                                                        <th class="hidden-480">Importe</th>
                                                        <th class="hidden-480">Nro. Cheque/Tarjeta</th>
                                                        <th class="hidden-480">Banco / Cotiz U$S</th>   
                                                        <th class="hidden-480">Cuit-Cuil/Titular</th> 
                                                        <th class="hidden-480">Operaciones</th>
                                                    </tr>
                                                </thead>
                                                    <tbody id="tbodyPrecios">       
                                                        <tr>
                                                            <td>
                                                                <select class="m-wrap span12 tipo" name="tipo[]" id="tipo">
                                                                    <option value="Efectivo">Efectivo</option>
                                                                    <option value="Cheque">Credito</option>
                                                                    <option value="Tarjeta">Cheque</option>
                                                                    <option value="Tarjeta">Dolares</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <div class="input-prepend">
                                                                <span class="add-on">$</span>
                                                                <input class="m-wrap span4 importe_entrega" name="importe_entrega[]" placeholder="00.00" id="importe_entrega">
                                                            </div>
                                                            </td>                                                       
                                                            <td>
                                                                <input class="m-wrap span10 numero" name="numero[]" id="numero">
                                                            </td>
                                                            <td>  
                                                                <input class="m-wrap span10 banco" name="banco[]" id="banco">                                                                                                                                  
                                                            </td>
                                                            <td>    
                                                                <input class="m-wrap span10 nombre_persona" name="nombre_persona[]" id="nombre_persona">                                                             
                                                            </td>
                                                            <td class="">
                                                                <div class="operacionesFila">
                                                                    <a href="javascript:;" class="btn mini red eliminarFila"><i class="icon-trash"></i> Eliminar</a>
                                                                    <a href="javascript:;" id="agregarFila" class="btn mini "><i class="icon-plus"></i> Agregar</a>
                                                                </div>
                                                            </td>
                                                        </tr>                               
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>                                 
                                   
                                    
                                    <div class="form-actions">
                                        <?php
                                        if ($subSeccion == 'NuevaVenta') {
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
<script type="text/javascript" src="../resources/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../resources/js/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="../resources/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../resources/js/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="../resources/js/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="../resources/js/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../resources/js/plugins/bootstrap-switch/static/js/bootstrap-switch.js"></script>

<script type="text/javascript" src="../resources/js/scripts/formularios/nuevaVenta.js"></script>
<script type="text/javascript" src="../resources/js/scripts/formularios/nuevaVentaComportamientoTabla.js"></script>
<script type="text/javascript" src="../resources/js/scripts/formularios/panelFormulario.js"></script>

<script>
    var _idDB = '<?php if (!empty($_GET["id"])) {echo $_GET["id"];} else {echo '0';} ?>';
    
    jQuery(document).ready(function() {
        App.init();

         var fecha  = new Date();
        $("#fecha").val(fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear());

        RegistrarNuevaVenta.init();
        comportamientoTablaEntregas.init();
        PanelFormulario.init();
    });
</script>	
</body>
</html>