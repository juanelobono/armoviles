<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../resources/js/plugins/select2/select2_metro.css" />		
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
                            if ($subSeccion == 'VerDetalle') {
                                echo "Detalles de la Venta <small> Información sobre la venta seleccionada </small>";
                            } else {
                                echo "#";
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
                                <i class="icon-usd"></i>
                                <a href="pnlAdmin.php?subSeccion=VerVentas">Ventas</a>			
                                <i class="icon-angle-right"></i>					
                            </li>
                            <li>
                                <?php
                                if ($subSeccion == 'VerDetalle') {
                                    echo '<a href="#">Detalles Venta</a>';
                                } else {
                                    echo '#';
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
                        if ($subSeccion == 'VerDetalle') {
                            echo 'class="portlet box yellow">';
                        } else {
                            echo 'class="portlet box blue">';
                        }
                        ?>
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php
                                    if ($subSeccion == 'VerDetalle') {
                                        echo '<i class="icon-usd"></i>Detalles Venta';
                                    } else {
                                        echo '<i class="icon-usd"></i>Modificar Cliente';
                                    }
                                    ?>									
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="reload" id="btnActualizar"></a>
                                    <a href="javascript:;" class="collapse"></a>									
                                </div>                                
                            </div> 
                            <div class="portlet-body form">
                                <form action="#" id="form" class="form-horizontal">
                                    <!-- BEGIN FORM-->
                                    <div class="form-horizontal form-view">
                                        <h3 class="form-section">Información de la Venta</h3>
                                        <!--/row-->
                                        <div class="row-fluid">
                                            <div class="span6 ">
                                                <div class="control-group">
                                                    <label id="fecha"></label>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="span6 ">
                                                <div class="control-group">
                                                    <label id="vehiculo"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row-fluid">
                                            <div class="span6 ">
                                                <div class="control-group">
                                                    <label id="comprador"></label>
                                                </div>
                                            </div>										
                                            <!--/span-->
                                            <div class="span6 ">
                                                <div class="control-group">
                                                    <label id="vendedor"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row-fluid">
                                            <!--/span-->
                                            <div class="span6 ">
                                                <div class="control-group">
                                                    <label id="importe"></label>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="span6 ">
                                                <div class="control-group">
                                                    <label id="descripcion"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="form-section">Entregas</h3>
                                        <!--/span-->
                                        <div class="portlet box">
                                            <div id="sinProductos" style="display: none; text-align: center">
                                                <h3 style="color: red">Esta venta no tiene Entregas realizadas.</h3>
                                            </div>
                                            <div class="portlet-body" id="divTabla">
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="tabla">
                                                        <thead>
                                                            <tr>
                                                                <th>Tipo</th>
                                                                <th>Monto</th>
                                                                <th>Nro Cheque/Tajeta</th>
                                                                <th>Banco</th>
                                                                <th>Cuit-Cuil/Titular</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
					                   </div>
                                       <h3 class="form-section">Veh&iacute;culos Entregados</h3>
                                        <!--/span-->
                                        <div class="portlet box">
                                            <div id="sinVehiculos" style="display: none; text-align: center">
                                                <h3 style="color: red">Esta venta no tiene Vehículos Entregados.</h3>
                                            </div>
                                            <div class="portlet-body" id="divTablaVehiculos">
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="tablaVehiculos">
                                                        <thead>
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Patente</th>
                                                                <th>Monto</th>
                                                                <th>Marca</th>
                                                                <th>Modelo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                       </div>
                                        <h3 class="form-section">Cuotas</h3>
                                        <!--/span-->
                                        <div class="portlet box">
                                            <div id="sinCuotas" style="display: none; text-align: center">
                                                <h3 style="color: red">Esta venta no tiene Cuotas asociadas.</h3>
                                            </div>
                                            <div class="portlet-body" id="divTablaCuotas">
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="tablaCuotas">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Importe</th>
                                                                <th>Fecha Vencimiento</th>
                                                                <th>Estado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
					<!-- END SAMPLE TABLE PORTLET-->
                                    </div>
                                    <div class="form-actions">
                                        <?php
                                            if ($subSeccion == 'detallesVenta') {
                                                echo '<button type="submit" id="btnRegistrar" class="btn green"><i class="icon-ok"></i> Registrar</button>';
                                            } else {
                                                echo '<button type="submit" id="btnModificar" style="display: none" class="btn blue"><i class="icon-ok"></i> Modificar</button>';
                                            }
                                        ?>
                                    </div>
                                </form>
                            </div>
                            <!--FIN PORTLET-->
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

<script type="text/javascript" src="../resources/js/scripts/formularios/verDetalleVenta.js"></script>
<script type="text/javascript" src="../resources/js/scripts/formularios/panelFormulario.js"></script>

<script>
    var _idDB = '<?php if (!empty($_GET["id"])) {echo $_GET["id"];} else {echo '0';}?>';
    
    jQuery(document).ready(function() {
        App.init();
        
        DetallesVenta.init();
        
        PanelFormulario.init();
        
    });
</script>	
</body>
</html>