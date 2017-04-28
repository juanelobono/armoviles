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
                            if ($subSeccion == 'NuevoCliente') {
                                echo "Registrar Nuevo Cliente <small> Agrega un nuevo Cliente </small>";
                            } else {
                                echo "Modificar Cliente <small> Modificar un Cliente existente </small>";
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
                                <a href="#">Clientes</a>			
                                <i class="icon-angle-right"></i>					
                            </li>
                            <li>
                                <?php
                                if ($subSeccion == 'NuevoCliente') {
                                    echo '<a href="#">Registrar Nuevo Cliente</a>';
                                } else {
                                    echo '<a href="#">Modificar Cliente</a>';
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
                                if ($subSeccion == 'NuevoCliente') {
                                    echo 'class="portlet box green">';
                                } else {
                                    echo 'class="portlet box blue">';
                                }
                                ?>
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php
                                    if ($subSeccion == 'NuevoCliente') {
                                        echo '<i class="icon-plus"></i>Registrar Nuevo Cliente';
                                    } else {
                                        echo '<i class="icon-pencil"></i>Modificar Cliente';
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
                                    <h3 class="form-section">Datos Personales</h3>
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
                                                <label for="email" class="control-label">E-Mail</label>
                                                <div class="controls">
                                                    <input name="email" id="email" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="fecha_inicio" class="control-label">Fecha Nacimiento:</label>
                                                <div class="controls">
                                                    <div class="input-append date form_datetime">
                                                        <input size="26" name="fecha_nacimiento" id="fecha_nacimiento" type="text" value="" format="dd/mm/yyyy" readonly class="m-wrap span18">
                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="telefono" class="control-label">Tel&eacute;fono</label>
                                                <div class="controls">
                                                    <input name="telefono" id="telefono" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="dni" class="control-label">CUIT / CUIL / Dni<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="dni" id="dni" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                     <div class="row-fluid">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="nombre_padre" class="control-label">Nombre Padre</label>
                                                <div class="controls">
                                                    <input name="nombre_padre" id="nombre_padre" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="nombre_madre" class="control-label">Nombre Madre</label>
                                                <div class="controls">
                                                    <input name="nombre_madre" id="nombre_madre" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <h3>Datos de Ubicaci&oacute;n</h3>
                                    <div class="row-fluid sin-localidad">
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="pais" class="control-label">Pa&iacute;s</label>
                                                <div class="controls">
                                                    <input name="pais" id="pais" onchange="RegistrarNuevoCliente.buscarProvincias();" class="span11 select2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="provincia" class="control-label">Provincia</label>
                                                <div class="controls">
                                                    <input name="provincia" id="provincia" onchange="RegistrarNuevoCliente.buscarLocalidades();" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid" id="div-localidad-seleccionada">
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="localidad-seleccionada" class="control-label">Localidad Seleccionada</label>
                                                <div class="controls">
                                                    <input name="localidad-seleccionada" id="localidad-seleccionada" class="span11 m-wrap" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6 ">
                                            <label class="control-label"><a id="cambiarLocalidad">Cambiar Localidad</a></label>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group sin-localidad">
                                                <label for="localidad" class="control-label">Localidad</label>
                                                <div class="controls">
                                                    <input name="localidad" id="localidad" onchange="RegistrarNuevoCliente.asignarSeleccionada();" class="span11 select2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="domicilio" class="control-label">Direcci&oacute;n</label>
                                                <div class="controls">
                                                    <input name="domicilio" id="domicilio" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <!--/span-->
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="piso" class="control-label">Piso</label>
                                                <div class="controls">
                                                    <input name="piso" id="piso" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6 ">
                                            <div class="control-group">
                                                <label for="departamento" class="control-label">Depto</label>
                                                <div class="controls">
                                                    <input name="departamento" id="departamento" type="text" class="span11 m-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <!--/span-->
                                        <div class="span6 ">
                                             <div class="control-group sin-estadocivil">
                                                <label for="estadocivil" class="control-label">Estado Civil</label>
                                                <div class="controls">
                                                    <input name="estadocivil" id="estadocivil" onchange="RegistrarNuevoCliente.asignarSeleccionada();" class="span11 select2">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                   

                                     <h3 class="form-section">Situacion Laboral</h3>
                                    <!--/row-->
                                    <div class="row-fluid">
                                        
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
                                                        <th class="hidden-480">Empresa</th>
                                                        <th class="hidden-480">Puesto/cargo</th>
                                                        <th class="hidden-480">Antig/Años</th>
                                                        <th class="hidden-480">Ing.$</th>   
                                                        <th class="hidden-480">Domicilio</th> 
                                                        <th class="hidden-480">Telefono</th> 
                                                        <th class="hidden-480">Otros Ing.$</th>
                                                        <th class="hidden-480"></th>
                                                    </tr>
                                                </thead>
                                                    <tbody id="tbodySituacionLaboral">       
                                                        <tr>
                                                            <td>
                                                                
                                                                <input class="m-wrap span12 nombre_empresa" name="nombre_empresa[]"  id="nombre_empresa">
                                                            </td>
                                                            <td>
                                                                <input class="m-wrap span12 condicion" name="condicion[]"  id="condicion">
                                                            
                                                            </td>                                                       
                                                            <td>
                                                                <input class="m-wrap span4 antiguedad" name="antiguedad[]" id="antiguedad">
                                                            </td>
                                                            <td>  
                                                                <input class="m-wrap span10 ingresos_mensuales" name="ingresos_mensuales[]" id="ingresos_mensuales">                                                                                                                                  
                                                            </td>
                                                            <td>    
                                                                <input class="m-wrap span10 domicilio_laboral" name="domicilio_laboral[]" id="domicilio_laboral">                                                             
                                                            </td>
                                                            <td>    
                                                                <input class="m-wrap span10 telefono_laboral" name="telefono_laboral[]" id="telefono_laboral">                                                             
                                                            </td>
                                                            <td>    
                                                                <input class="m-wrap span10 otros_ingresos" name="otros_ingresos[]" id="otros_ingresos">                                                             
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
                                        if ($subSeccion == 'NuevoCliente') {
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

    <script type="text/javascript" src="../resources/js/scripts/formularios/nuevoCliente.js"></script>
    <script type="text/javascript" src="../resources/js/scripts/formularios/nuevaSituacionlaboralcliente.js"></script>
    <script type="text/javascript" src="../resources/js/scripts/formularios/panelFormulario.js"></script>

    <script>
        var _idDB = '<?php if (!empty($_GET["id"])) {echo $_GET["id"];} else {echo '0';} ?>';
        $("#div-localidad-seleccionada").hide();
        jQuery(document).ready(function() {
            App.init();
            RegistrarNuevoCliente.init();
            PanelFormulario.init();
            ComportamientoSituacionLaboralcliente.init();
        });
    </script>	
</body>
</html>