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
                            if ($subSeccion == 'NuevoPlan') {
                                echo "Registrar Nuevo Plan de Pago <small> Agrega un nuevo Plan </small>";
                            } else {
                                echo "Modificar Plan de Pago <small> Modificar un Plan existente </small>";
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
                                <a href="#">Plan de Pago</a>			
                                <i class="icon-angle-right"></i>					
                            </li>
                            <li>
                                <?php
                                if ($subSeccion == 'NuevoPlan') {
                                    echo '<a href="#">Registrar Nuevo Plan</a>';
                                } else {
                                    echo '<a href="#">Modificar Plan</a>';
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
                        if ($subSeccion == 'NuevoPlan') {
                            echo 'class="portlet box green">';
                        } else {
                            echo 'class="portlet box blue">';
                        }
                        ?>
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php
                                    if ($subSeccion == 'NuevoPlan') {
                                        echo '<i class="icon-plus"></i>Registrar Nuevo Plan';
                                    } else {
                                        echo '<i class="icon-pencil"></i>Modificar Plan';
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
                                    <h3 class="form-section">Informaci&oacute;n del Plan de Pago</h3>
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
                                                <label for="activo" class="control-label">Entrega</label>
                                                <div class="controls">                                             
                                                    <input name="entrega" id="entrega" type="text" class="span11 m-wrap" />                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="cuotas" class="control-label">Cantidad de Cuotas<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="cuotas" id="cuotas" type="text" class="span3 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="interes" class="control-label">Inter&eacute;s<span class="required">*</span></label>
                                                <div class="controls">
                                                    <div class="input-prepend">
                                                        <span class="add-on">%</span>
                                                        <input name="interes" id="interes" type="text" placeholder="00.00" class="span5 m-wrap " value="">                                                        
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
                                    </div>
												<!--/row-->                                                                      
                                    
                                    <div class="form-actions">
                                        <?php
                                        if ($subSeccion == 'NuevoPlan') {
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

<script type="text/javascript" src="../resources/js/scripts/formularios/nuevoPlan.js"></script>
<script type="text/javascript" src="../resources/js/scripts/formularios/panelFormulario.js"></script>

<script>
    var _idDB = '<?php if (!empty($_GET["id"])) {echo $_GET["id"];} else {echo '0';} ?>';
    
    jQuery(document).ready(function() {
        App.init();
        RegistrarNuevoPlan.init();
        PanelFormulario.init();
    });
</script>	
</body>
</html>