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
                            if ($subSeccion == 'NuevoVendedor') {
                                echo "Registrar Nuevo Vendedor <small> Agrega un nuevo Vendedor </small>";
                            } else {
                                echo "Modificar Administrador <small> Modificar un Vendedor existente </small>";
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
                                <a href="#">Vendedores</a>			
                                <i class="icon-angle-right"></i>					
                            </li>
                            <li>
                                <?php
                                if ($subSeccion == 'NuevoVendedor') {
                                    echo '<a href="#">Registrar Nuevo Vendedor</a>';
                                } else {
                                    echo '<a href="#">Modificar Vendedor</a>';
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
                                if ($subSeccion == 'NuevoVendedor') {
                                    echo 'class="portlet box green">';
                                } else {
                                    echo 'class="portlet box blue">';
                                }
                                ?>
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php
                                    if ($subSeccion == 'NuevoVendedor') {
                                        echo '<i class="icon-plus"></i>Registrar Nuevo Vendedor';
                                    } else {
                                        echo '<i class="icon-pencil"></i>Modificar Vendedor';
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
                                    <h3 class="form-section">Información del Vendedor</h3>
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
                                                <label for="apellido" class="control-label">Apellido<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="apellido" id="apellido" class="span11 m-wrap">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="usuario" class="control-label">Usuario<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="usuario" id="usuario" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="email" class="control-label">E-Mail<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="email" id="email" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="telefono" class="control-label">Tel&eacute;fono<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="telefono" id="telefono" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6">
                                        
                                        </div>
                                                                           
                                    </div>
                                    
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="contrasenia" class="control-label">Contraseña<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="contrasenia" id="contrasenia" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="contrasenia2" class="control-label">Repita su Contraseña<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="contrasenia2" id="contrasenia2" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row-fluid">                                        
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="activo" class="control-label">Usuario Activo</label>
                                                <div class="controls">
                                                    <div id="activo" class="switch" data-on="info" data-off="danger" data-on-label="SI" data-off-label="NO">
                                                        <input name="activo" type="checkbox" class="toggle" class="span11 m-wrap"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--/row-->
                                    <h3 class="form-section tituloPermisos">Permisos del Usuario</h3>
                                    <div id="permisosSecciones">
                                    </div>
                                    
                                    <div class="form-actions">
                                        <?php
                                        if ($subSeccion == 'NuevoVendedor') {
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

    <script type="text/javascript" src="../resources/js/scripts/formularios/nuevoVendedor.js"></script>
    <script type="text/javascript" src="../resources/js/scripts/formularios/panelFormulario.js"></script>

    <script>
        var _idDB = '<?php if (!empty($_GET["id"])) {echo $_GET["id"];} else {echo '0';} ?>';
        var _isPassword = '<?php if(!empty($_GET["isPassword"])) {echo '1';}else{echo '0';}   ?>';

        jQuery(document).ready(function() {
            App.init();
            RegistrarNuevoVendedor.init();
            PanelFormulario.init();
        });
    </script>	
</body>
</html>