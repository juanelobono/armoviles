<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../resources/js/plugins/select2/select2_metro.css" />
        <link rel="stylesheet" type="text/css" href="../resources/js/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
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
                            if ($subSeccion == 'NuevaLocalidad') {
                                echo "Registrar Nueva Localidad <small> Agrega una nueva Localidad </small>";
                            } else {
                                echo "Modificar Localidad <small> Modificar una Localidad existente </small>";
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
                                <i class="icon-globe"></i>
                                <a href="#">Localidad</a>			
                                <i class="icon-angle-right"></i>					
                            </li>
                            <li>
                                <?php
                                if ($subSeccion == 'NuevaLocalidad') {
                                    echo '<a href="#">Registrar Nueva Localidad</a>';
                                } else {
                                    echo '<a href="#">Modificar Localidad</a>';
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
                                if ($subSeccion == 'NuevaLocalidad') {
                                    echo 'class="portlet box green">';
                                } else {
                                    echo 'class="portlet box blue">';
                                }
                                ?>
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php
                                    if ($subSeccion == 'NuevaLocalidad') {
                                        echo '<i class="icon-plus"></i>Registrar Nueva Localidad';
                                    } else {
                                        echo '<i class="icon-pencil"></i>Modificar Localidad';
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
                                    <h3 class="form-section">Información de la Localidad</h3>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <div class="control-group">
                                                <label for="codigo" class="control-label">Código<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="codigo" id="codigo" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="nombre" class="control-label">Nombre<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="nombre" id="nombre" class="span11 m-wrap">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span3">
                                            <div class="control-group">
                                                <label for="codigo_postal" class="control-label">C.P.<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="codigo_postal" id="codigo_postal" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid sin-provincia">                                        
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="pais" class="control-label">Pa&iacute;s</label>
                                                <div class="controls">
                                                    <input name="pais" id="pais" onchange="RegistrarNuevaLocalidad.buscarProvincias();" class="span11 select2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="provincia" class="control-label">Provincia<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="provincia" id="provincia" onchange="RegistrarNuevaLocalidad.asignarSeleccionada();" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>                                   
                                    </div>
                                    <div class="row-fluid" id="div-provincia-seleccionada">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="provincia_seleccionada" class="control-label">Provincia Seleccionada</label>
                                                <div class="controls">
                                                    <input name="provincia_seleccionada" id="provincia_seleccionada" class="span11 m-wrap" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6 ">
                                            <label class="control-label"><a id="cambiarProvincia">Cambiar Provincia</a></label>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <?php
                                        if ($subSeccion == 'NuevaLocalidad') {
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

    <script type="text/javascript" src="../resources/js/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../resources/js/plugins/jquery-validation/dist/additional-methods.min.js"></script>
    <script type="text/javascript" src="../resources/js/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="../resources/js/plugins/bootstrap-switch/static/js/bootstrap-switch.js"></script>

    <script type="text/javascript" src="../resources/js/scripts/formularios/nuevaLocalidad.js"></script>
    <script type="text/javascript" src="../resources/js/scripts/formularios/panelFormulario.js"></script>

    <script>
        var _idDB = '<?php if (!empty($_GET["id"])) {echo $_GET["id"];} else {echo '0';} ?>';
        $("#div-localidad-seleccionada").hide();
        jQuery(document).ready(function() {
            App.init();
            RegistrarNuevaLocalidad.init();
            PanelFormulario.init();
        });
    </script>	
</body>
</html>