<?php	
    if(!defined('acceso')){
        exit();
    }
?>

<html>
    <body>
        <!-- BEGIN CONTAINER -->   
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->        
			<ul class="page-sidebar-menu">
				<li>
                                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                                    <div class="sidebar-toggler hidden-phone"></div>
                                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>			
				
				<?php 
                                    if(in_array('Inicio', $_SESSION['c_sesion_permisos'])){
				?>
				<li <?php if($seccion == 'Inicio'){
						echo "class='active start'";
					}else{
						echo "class='start'";} ?> >						
					<a href="pnlAdmin.php?seccion=Inicio">
                                            <i class="icon-home"></i> 
                                            <span class="title">Inicio</span>
                                            <?php if($seccion == 'Inicio') echo "<span class='selected'></span>";?>
					</a>
				</li>
				
				<?php
				}if(in_array('Administrador', $_SESSION['c_sesion_permisos']) ||
                                        in_array('Vendedores', $_SESSION['c_sesion_permisos']) ||
                                            in_array('Usuario', $_SESSION['c_sesion_permisos'])){
				?>
                                <li <?php if(($seccion == 'Administrador') || ($seccion == 'Vendedores') || ($seccion == 'Usuario')){ echo "class='active'";} ?> >						
                                    <a href="pnlAdmin.php?seccion=Inicio">
                                        <i class="icon-group"></i> 
                                        <span class="title">Usuarios</span>
                                        <?php if(($seccion == 'Administrador') || ($seccion == 'Vendedores') || ($seccion == 'Usuario')) echo "<span class='selected'></span>";?>
                                        <?php if(($seccion == 'Administrador') || ($seccion == 'Vendedores') || ($seccion == 'Usuario')){
                                                        echo "<span class='arrow open'></span>";
                                                }else{
                                                        echo "<span class='arrow '></span>";}?>
                                    </a>
                                    
                                    <ul class="sub-menu">
                                        <li  <?php if($seccion == 'Administrador') echo "class='active'";?> >
                                            <a href="javascript:;">
                                            <i class="icon-user"></i> 
                                            <span class="title">Administradores</span>
                                            <?php if($seccion == 'Administrador') echo "<span class='selected'></span>";?>
                                            <?php if($seccion == 'Administrador'){
                                                    echo "<span class='arrow open'></span>";
                                            }else{
                                                    echo "<span class='arrow '></span>";}?>
                                            </a>
                                            <ul class="sub-menu">

                                                    <?php						
                                                    if(in_array('NuevoAdministrador', $_SESSION['c_sesion_permisos'])){
                                                    ?>
                                                    <li <?php if($subSeccion == 'NuevoAdministrador') echo "class='active'";?>>
                                                            <a href="pnlAdmin.php?subSeccion=NuevoAdministrador">
                                                            <i class="icon-plus"></i> 
                                                            Nuevo Administrador</a>
                                                    </li>

                                                    <?php
                                                    }						
                                                    if(in_array('VerAdministradores', $_SESSION['c_sesion_permisos'])){
                                                    ?>
                                                    <li <?php if($subSeccion == 'VerAdministradores') echo "class='active'";?>>
                                                            <a href="pnlAdmin.php?subSeccion=VerAdministradores">
                                                            <i class="icon-th"></i>
                                                            Administradores Activos</a>
                                                    </li>					
                                                    <?php						
                                                    }if(in_array('VerAdministradoresInactivos', $_SESSION['c_sesion_permisos'])){
                                                    ?>
                                                    <li <?php if($subSeccion == 'VerAdministradoresInactivos') echo "class='active'";?>>
                                                            <a href="pnlAdmin.php?subSeccion=VerAdministradoresInactivos">
                                                            <i class="icon-th"></i>
                                                            Administradores Inactivos</a>
                                                    </li>					
                                                    <?php						
                                                    }
                                                    ?>					
                                            </ul>
                                        </li>
                                        <!--Fin Subseccion Administradores -->
                                        
                                        <li  <?php if($seccion == 'Vendedores') echo "class='active'";?> >
                                            <a href="javascript:;">
                                            <i class="icon-user"></i> 
                                            <span class="title">Vendedores</span>
                                            <?php if($seccion == 'Vendedores') echo "<span class='selected'></span>";?>
                                            <?php if($seccion == 'Vendedores'){
                                                    echo "<span class='arrow open'></span>";
                                            }else{
                                                    echo "<span class='arrow '></span>";}?>
                                            </a>
                                            <ul class="sub-menu">

                                                    <?php						
                                                    if(in_array('NuevoVendedor', $_SESSION['c_sesion_permisos'])){
                                                    ?>
                                                    <li <?php if($subSeccion == 'NuevoVendedor') echo "class='active'";?>>
                                                            <a href="pnlAdmin.php?subSeccion=NuevoVendedor">
                                                            <i class="icon-plus"></i> 
                                                            Nuevo Vendedor</a>
                                                    </li>

                                                    <?php
                                                    }						
                                                    if(in_array('VerVendedores', $_SESSION['c_sesion_permisos'])){
                                                    ?>
                                                    <li <?php if($subSeccion == 'VerVendedores') echo "class='active'";?>>
                                                            <a href="pnlAdmin.php?subSeccion=VerVendedores">
                                                            <i class="icon-th"></i>
                                                            Vendedores Activos</a>
                                                    </li>					
                                                    <?php						
                                                    }if(in_array('VerVendedoresInactivos', $_SESSION['c_sesion_permisos'])){
                                                    ?>
                                                    <li <?php if($subSeccion == 'VerVendedoresInactivos') echo "class='active'";?>>
                                                            <a href="pnlAdmin.php?subSeccion=VerVendedoresInactivos">
                                                            <i class="icon-th"></i>
                                                            Vendedores Inactivos</a>
                                                    </li>					
                                                    <?php						
                                                    }
                                                    ?>					
                                            </ul>
                                        </li>
                                        <!-- Fin de Subseccion Vendedores -->
                                    </ul>
                                    
                                   
                                </li>
                                <?php
                                }                                    
                                    if(in_array('Clientes', $_SESSION['c_sesion_permisos'])){
                                ?>
				<li  <?php if($seccion == 'Clientes') echo "class='active'";?> >
					<a href="javascript:;">
					<i class="icon-male"></i> 
					<span class="title">Clientes</span>
					<?php if($seccion == 'Clientes') echo "<span class='selected'></span>";?>
					<?php if($seccion == 'Clientes'){
						echo "<span class='arrow open'></span>";
					}else{
						echo "<span class='arrow '></span>";}?>
					</a>
					<ul class="sub-menu">
						
						<?php						
						if(in_array('NuevoCliente', $_SESSION['c_sesion_permisos'])){
						?>
						<li <?php if($subSeccion == 'NuevoCliente') echo "class='active'";?>>
							<a href="pnlAdmin.php?subSeccion=NuevoCliente">
							<i class="icon-plus"></i> 
							Nuevo Cliente</a>
						</li>
						
						<?php
						}						
						if(in_array('VerClientes', $_SESSION['c_sesion_permisos'])){
						?>
						<li <?php if(($subSeccion == 'VerClientes') || ($subSeccion == 'ModificarCliente')) echo "class='active'";?>>
							<a href="pnlAdmin.php?subSeccion=VerClientes">
							<i class="icon-th"></i>
							Ver Clientes</a>
						</li>					
						<?php						
						}
						?>					
					</ul>
				</li>

                                <?php
                } if(in_array('Productos', $_SESSION['c_sesion_permisos'])){
                                ?>
                <li  <?php if($seccion == 'Productos') echo "class='active'";?> >
                    <a href="javascript:;">
                    <i class="icon-truck"></i> 
                    <span class="title">Vehículos</span>
                    <?php if($seccion == 'Productos') echo "<span class='selected'></span>";?>
                    <?php if($seccion == 'Productos'){
                        echo "<span class='arrow open'></span>";
                    }else{
                        echo "<span class='arrow '></span>";}?>
                    </a>
                    <ul class="sub-menu">
                        
                        <?php                       
                        if(in_array('NuevoProducto', $_SESSION['c_sesion_permisos'])){
                        ?>
                        <li <?php if($subSeccion == 'NuevoProducto') echo "class='active'";?>>
                            <a href="pnlAdmin.php?subSeccion=NuevoProducto">
                            <i class="icon-plus"></i> 
                            Nuevo Vehículo</a>
                        </li>
                        
                        <?php
                        }                       
                        if(in_array('VerProductos', $_SESSION['c_sesion_permisos'])){
                        ?>
                        <li <?php if(($subSeccion == 'VerProductos') || ($subSeccion == 'ModificarProducto')) echo "class='active'";?>>
                            <a href="pnlAdmin.php?subSeccion=VerProductos">
                            <i class="icon-th"></i>
                            Ver Vehículos</a>
                        </li>                   
                        <?php                       
                        }
                        ?>                  
                    </ul>
                </li>   
                
				<?php
                 }                                    
                  if(in_array('Ventas', $_SESSION['c_sesion_permisos']) ||
                  	in_array('PlanPago', $_SESSION['c_sesion_permisos'])){
            ?>
				<li  <?php if($seccion == 'Ventas' || $seccion == 'PlanPago') echo "class='active'";?> >
					<a href="javascript:;">
					<i class="icon-usd"></i> 
					<span class="title">Boletos</span>
					<?php if($seccion == 'Ventas' || $seccion == 'PlanPago') echo "<span class='selected'></span>";?>
					<?php if($seccion == 'Ventas' || $seccion == 'PlanPago'){
						echo "<span class='arrow open'></span>";
					}else{
						echo "<span class='arrow '></span>";}?>
					</a>
					<ul class="sub-menu">
						<?php						
						if(in_array('NuevaVenta', $_SESSION['c_sesion_permisos'])){
						?>
						<li <?php if($subSeccion == 'NuevaVenta') echo "class='active'";?>>
							<a href="pnlAdmin.php?subSeccion=NuevaVenta">
							<i class="icon-plus"></i> 
							Nuevo Boleto</a>
						</li>					
						<?php						
						}			
										
						if(in_array('VerVentas', $_SESSION['c_sesion_permisos'])){
						?>
						<li <?php if($subSeccion == 'VerVentas') echo "class='active'";?>>
							<a href="pnlAdmin.php?subSeccion=VerVentas">
							<i class="icon-th"></i> 
							Ver Boletos</a>
						</li>
											
						<!--<?php						
						}
						if(in_array('PlanPago', $_SESSION['c_sesion_permisos'])) {
						?>		
						
						<li <?php if($seccion == 'PlanPago') echo "class='active'";?>>
                                                <a href="javascript:;">
                                                <i class="icon-calendar"></i> 
                                                <span class="title">Planes de Pago</span>					
                                                <?php if($seccion == 'PlanPago') echo "<span class='selected'></span>";?>
                                                <?php if($seccion == 'PlanPago'){
                                                        echo "<span class='arrow open'></span>";
                                                }else{
                                                        echo "<span class='arrow '></span>";}?>
                                                </a>
                                                <ul class="sub-menu">

                                                        <?php						
                                                        if(in_array('NuevoPlan', $_SESSION['c_sesion_permisos'])){
                                                        ?>
                                                        <li <?php if($subSeccion == 'NuevoPlan') echo "class='active'";?>>
                                                                <a href="pnlAdmin.php?subSeccion=NuevoPlan">
                                                                <i class="icon-plus"></i> 
                                                                Nuevo Plan</a>
                                                        </li>										
                                                        <?php
                                                        }						
                                                        if(in_array('VerPlan', $_SESSION['c_sesion_permisos'])){
                                                        ?>
                                                        <li <?php if(($subSeccion == 'VerPlan') || ($subSeccion == 'ModificarPlan')) echo "class='active'";?>>
                                                                <a href="pnlAdmin.php?subSeccion=VerPlan">
                                                                <i class="icon-th"></i>
                                                                Ver Planes</a>
                                                        </li>						
                                                        <?php
                                                        }						
                                                        ?>
                                                </ul>
                                        </li>	
                                        <?php
                                     }
                                     ?>		-->
									
					</ul>
				</li>
                               <?php
                } 
                                    if(in_array('Cuotas', $_SESSION['c_sesion_permisos'])){
                                ?>
                <li  <?php if($seccion == 'Cuotas') echo "class='active'";?> >
                    <a href="javascript:;">
                    <i class="icon-credit-card"></i> 
                    <span class="title">Cuotas</span>
                    <?php if($seccion == 'Cuotas') echo "<span class='selected'></span>";?>
                    <?php if($seccion == 'Cuotas'){
                        echo "<span class='arrow open'></span>";
                    }else{
                        echo "<span class='arrow '></span>";}?>
                    </a>
                    <ul class="sub-menu">
                        
                        <?php                       
                        if(in_array('VerVencidas', $_SESSION['c_sesion_permisos'])){
                        ?>
                        <li <?php if($subSeccion == 'VerVencidas') echo "class='active'";?>>
                            <a href="pnlAdmin.php?subSeccion=VerVencidas">
                            <i class="icon-th"></i> 
                            Ver Cuotas Vencidas</a>
                        </li>
                        
                        <?php
                        }                       
                        if(in_array('VerPorVencer', $_SESSION['c_sesion_permisos'])){
                        ?>
                        <li <?php if(($subSeccion == 'VerPorVencer') || ($subSeccion == 'ModificarCuotas')) echo "class='active'";?>>
                            <a href="pnlAdmin.php?subSeccion=VerporVencer">
                            <i class="icon-th"></i>
                            Ver Cuotas por Vencer</a>
                        </li>                   
                        <?php                       
                        }
                        ?>                  
                    </ul>
                </li>


				
                                <?php
				} 
                                    if(in_array('Categorias', $_SESSION['c_sesion_permisos'])){
                                ?>
				<li  <?php if($seccion == 'Categorias') echo "class='active'";?> >
					<a href="javascript:;">
					<i class="icon-sitemap"></i> 
					<span class="title">Tipos de Veh&iacute;culos</span>
					<?php if($seccion == 'Categorias') echo "<span class='selected'></span>";?>
					<?php if($seccion == 'Categorias'){
						echo "<span class='arrow open'></span>";
					}else{
						echo "<span class='arrow '></span>";}?>
					</a>
					<ul class="sub-menu">
						
						<?php						
						if(in_array('NuevaCategoria', $_SESSION['c_sesion_permisos'])){
						?>
						<li <?php if($subSeccion == 'NuevaCategoria') echo "class='active'";?>>
							<a href="pnlAdmin.php?subSeccion=NuevaCategoria">
							<i class="icon-plus"></i> 
							Nuevo Tipo</a>
						</li>
						
						<?php
						}						
						if(in_array('VerCategorias', $_SESSION['c_sesion_permisos'])){
						?>
						<li <?php if(($subSeccion == 'VerCategorias') || ($subSeccion == 'ModificarCategoria')) echo "class='active'";?>>
							<a href="pnlAdmin.php?subSeccion=VerCategorias">
							<i class="icon-th"></i>
							Ver Tipos</a>
						</li>					
						<?php						
						}
                        if(in_array('verMarcas', $_SESSION['c_sesion_permisos'])){
                        ?>
                        <li <?php if(($subSeccion == 'verMarcas') || ($subSeccion == 'ModificarMarcas')) echo "class='active'";?>>
                            <a href="pnlAdmin.php?subSeccion=verMarcas">
                            <i class="icon-th"></i>
                            Ver Marcas</a>
                        </li>                   
                        <?php                       
                        }
                        if(in_array('verModelos', $_SESSION['c_sesion_permisos'])){
                        ?>
                        <li <?php if(($subSeccion == 'verModelos') || ($subSeccion == 'ModificarModelos')) echo "class='active'";?>>
                            <a href="pnlAdmin.php?subSeccion=verModelos">
                            <i class="icon-th"></i>
                            Ver Modelos</a>
                        </li>                   
                        <?php                       
                        }
						?>					
					</ul>
				</li>
				
			
                                <?php
				}
                if(in_array('Localidades', $_SESSION['c_sesion_permisos']) ||
                                        in_array('Provincias', $_SESSION['c_sesion_permisos']) ||
                                            in_array('Paises', $_SESSION['c_sesion_permisos'])){
				?>
                                <li <?php if(($seccion == 'Localidades') || ($seccion == 'Provincias') || ($seccion == 'Paises')){ echo "class='active'";} ?> >						
                                    <a href="pnlAdmin.php?seccion=Inicio">
                                        <i class="icon-globe"></i> 
                                        <span class="title">Ubicaciones</span>
                                        <?php if(($seccion == 'Localidades') || ($seccion == 'Provincias') || ($seccion == 'Paises')) echo "<span class='selected'></span>";?>
                                        <?php if(($seccion == 'Localidades') || ($seccion == 'Provincias') || ($seccion == 'Paises')){
                                                        echo "<span class='arrow open'></span>";
                                                }else{
                                                        echo "<span class='arrow '></span>";}?>
                                    </a>
                                    
                                    <ul class="sub-menu">
                                        <li <?php if($seccion == 'Localidades') echo "class='active'";?>>
                                                <a href="javascript:;">
                                                <i class="icon-globe"></i> 
                                                <span class="title">Localidades</span>					
                                                <?php if($seccion == 'Localidades') echo "<span class='selected'></span>";?>
                                                <?php if($seccion == 'Localidades'){
                                                        echo "<span class='arrow open'></span>";
                                                }else{
                                                        echo "<span class='arrow '></span>";}?>
                                                </a>
                                                <ul class="sub-menu">

                                                        <?php						
                                                        if(in_array('NuevaLocalidad', $_SESSION['c_sesion_permisos'])){
                                                        ?>
                                                        <li <?php if($subSeccion == 'NuevaLocalidad') echo "class='active'";?>>
                                                                <a href="pnlAdmin.php?subSeccion=NuevaLocalidad">
                                                                <i class="icon-plus"></i> 
                                                                Nueva Localidad</a>
                                                        </li>										
                                                        <?php
                                                        }						
                                                        if(in_array('VerLocalidades', $_SESSION['c_sesion_permisos'])){
                                                        ?>
                                                        <li <?php if(($subSeccion == 'VerLocalidades') || ($subSeccion == 'ModificarLocalidad')) echo "class='active'";?>>
                                                                <a href="pnlAdmin.php?subSeccion=VerLocalidades">
                                                                <i class="icon-th"></i>
                                                                Ver Localidades</a>
                                                        </li>						
                                                        <?php
                                                        }						
                                                        ?>
                                                </ul>
                                        </li>
                                
                                        <?php
                                        }if (in_array('Provincias', $_SESSION['c_sesion_permisos'])) {
                                        ?>
                                        <li <?php if($seccion == 'Provincias') echo "class='active'";?>>
                                                <a href="javascript:;">
                                                <i class="icon-globe"></i> 
                                                <span class="title">Provincias</span>					
                                                <?php if($seccion == 'Provincias') echo "<span class='selected'></span>";?>
                                                <?php if($seccion == 'Provincias'){
                                                        echo "<span class='arrow open'></span>";
                                                }else{
                                                        echo "<span class='arrow '></span>";}?>
                                                </a>
                                                <ul class="sub-menu">

                                                        <?php						
                                                        if(in_array('NuevaProvincia', $_SESSION['c_sesion_permisos'])){
                                                        ?>
                                                        <li <?php if($subSeccion == 'NuevaProvincia') echo "class='active'";?>>
                                                                <a href="pnlAdmin.php?subSeccion=NuevaProvincia">
                                                                <i class="icon-plus"></i> 
                                                                Nueva Provincia</a>
                                                        </li>										
                                                        <?php
                                                        }						
                                                        if(in_array('VerProvincias', $_SESSION['c_sesion_permisos'])){
                                                        ?>
                                                        <li <?php if(($subSeccion == 'VerProvincias') || ($subSeccion == 'ModificarLocalidad')) echo "class='active'";?>>
                                                                <a href="pnlAdmin.php?subSeccion=VerProvincias">
                                                                <i class="icon-th"></i>
                                                                Ver Provincias</a>
                                                        </li>						
                                                        <?php
                                                        }						
                                                        ?>
                                                </ul>
                                        </li> 
                                        <?php
                                        }if (in_array('Paises', $_SESSION['c_sesion_permisos'])) {
                                        ?>
                                        <li <?php if($seccion == 'Paises') echo "class='active'";?>>
                                            <a href="javascript:;">
                                            <i class="icon-globe"></i> 
                                            <span class="title">Países</span>					
                                            <?php if($seccion == 'Paises') echo "<span class='selected'></span>";?>
                                            <?php if($seccion == 'Paises'){
                                                    echo "<span class='arrow open'></span>";
                                            }else{
                                                    echo "<span class='arrow '></span>";}?>
                                            </a>
                                            <ul class="sub-menu">

                                                    <?php						
                                                    if(in_array('NuevoPais', $_SESSION['c_sesion_permisos'])){
                                                    ?>
                                                    <li <?php if($subSeccion == 'NuevoPais') echo "class='active'";?>>
                                                            <a href="pnlAdmin.php?subSeccion=NuevoPais">
                                                            <i class="icon-plus"></i> 
                                                            Nuevo País</a>
                                                    </li>										
                                                    <?php
                                                    }						
                                                    if(in_array('VerPaises', $_SESSION['c_sesion_permisos'])){
                                                    ?>
                                                    <li <?php if(($subSeccion == 'VerPaises') || ($subSeccion == 'ModificarPais')) echo "class='active'";?>>
                                                            <a href="pnlAdmin.php?subSeccion=VerPaises">
                                                            <i class="icon-th"></i>
                                                            Ver Países</a>
                                                    </li>						
                                                    <?php
                                                    }						
                                                    ?>
                                            </ul>
                                        </li> 
                                    </ul> 
                                    
                                </li>
                                <?php
                                }
                                ?>
                </ul>
			<!-- END SIDEBAR MENU -->
			<h6>Version 1.0</h6>
		</div>
    </body>
</html>
