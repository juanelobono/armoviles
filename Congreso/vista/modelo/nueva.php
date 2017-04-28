<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../resources/js/plugins/select2/select2_metro.css" />
        <link rel="stylesheet" type="text/css" href="../resources/js/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
        <link href="../resources/js/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
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
                            if ($subSeccion == 'nuevaModelo') {
                                echo "Registrar Nuevo Modelo de Vehículo <small> Agrega un nuevo Modelo </small>";
                            } else {
                                echo "Modificar Modelo de Vehículo <small> Modificar un Modelo existente </small>";
                            }
                            ?>							
                        </h3>
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="PnlAdmin.php?seccion=Inicio">Inicio</a>			
                                <i class="icon-angle-right"></i>					
                            </li>
                            <li>
                                <i class="icon-tasks"></i>
                                <a href="#">Modelos</a>			
                                <i class="icon-angle-right"></i>					
                            </li>
                            <li>
                                <?php
                                if ($subSeccion == 'nuevaModelo') {
                                    echo '<a href="#">Registrar Nuevo Modelo</a>';
                                } else {
                                    echo '<a href="#">Modificar Modelo</a>';
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
                                if ($subSeccion == 'nuevaModelo') {
                                    echo 'class="portlet box green">';
                                } else {
                                    echo 'class="portlet box blue">';
                                }
                                ?>
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php
                                    if ($subSeccion == 'nuevaModelo') {
                                        echo '<i class="icon-plus"></i>Registrar Nuevo Modelo de Vehículo';
                                    } else {
                                        echo '<i class="icon-pencil"></i>Modificar Modelo de Vehículo';
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
                                    <h3 class="form-section">Información del Modelo</h3>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="descripcion" class="control-label">Nombre<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="descripcion" id="descripcion" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                         <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="marca" class="control-label">Marca</label>
                                                <div class="controls">
                                                    <input name="marca" id="marca" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

                                   
                                    
                                    <div class="form-actions">
                                        <?php
                                        if ($subSeccion == 'nuevaModelo') {
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
    <script type="text/javascript" src="../resources/js/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../resources/js/plugins/jquery-validation/dist/additional-methods.min.js"></script>
    <script type="text/javascript" src="../resources/js/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="../resources/js/plugins/bootstrap-switch/static/js/bootstrap-switch.js"></script>

    <script type="text/javascript" src="../resources/js/scripts/formularios/nuevaModelo.js"></script>
    <script type="text/javascript" src="../resources/js/scripts/formularios/panelFormulario.js"></script>

    <script>
        var _idDB = '<?php if (!empty($_GET["id"])) {echo $_GET["id"];} else {echo '0';} ?>';

        jQuery(document).ready(function() {
            App.init();
            RegistrarNuevaModelo.init();
            PanelFormulario.init();
        });
    </script>	
</body>
</html>