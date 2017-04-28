<?php
	session_start();

	if(empty($_SESSION['c_sesion_user']))	
            header("Location: ../vista/inicio.php");
		
	define('acceso','autorizado');
	
	$seccionesURL = array(
		'Inicio' => '../vista/inicio.php',
      'Administrador' => '../vista/administradores/inicio.php',
      'Vendedores'=> '../vista/admin/vendedores/inicio.php',
		'Clientes' => '../vista/admin/clientes/inicio.php',
		'Productos' => '../vista/admin/productos/inicio.php',
      'Localidades' => '../vista/admin/localidades/inicio.php',
      'Provincias' => '../vista/admin/provincias/inicio.php',
      'Paises' => '../vista/admin/paises/inicio.php',
      'Ventas' => '../vista/admin/paises/inicio.php',
      'PlanPago' => '../vista/admin/paises/inicio.php',
      'Cuotas' => '../vista/admin/cuotas/inicio');
		
	$subSeccionesSeccion = array(
		'NuevoAdministrador' => 'Administrador',
		'VerAdministradores' => 'Administrador',
                'VerAdministradoresInactivos' => 'Administrador',
		'ModificarAdministrador' => 'Administrador',
                'ModificarPassword' => 'Administrador',
                
      'NuevoVendedor' => 'Vendedores',
      'VerVendedores' => 'Vendedores',
      'VerVendedoresInactivos' => 'Vendedores',
      'ModificarVendedor' => 'Vendedores',
            
        'NuevoCliente' => 'Clientes',
		'VerClientes' => 'Clientes',
		'ModificarCliente' => 'Clientes',
            
        'NuevaCategoria' => 'Categorias',
		'VerCategorias' => 'Categorias',
		'ModificarCategoria' => 'Categorias',

		'NuevaModelo' => 'Categorias',
		'VerModelo' => 'Categorias',
		'ModificarModelo' => 'Categorias',

		'NuevaMarca' => 'Categorias',
		'VerMarca' => 'Categorias',
		'ModificarMarca' => 'Categorias',
            
        'NuevoProducto' => 'Productos',
		'VerProductos' => 'Productos',
		'ModificarProducto' => 'Productos',
                'ImagenProductos' => 'Productos',
            
        'NuevaLocalidad' => 'Localidades',
		'VerLocalidades' => 'Localidades',
		'ModificarLocalidad' => 'Localidades',
            
        'NuevaProvincia' => 'Provincias',
		'VerProvincias' => 'Provincias',
		'ModificarProvincia' => 'Provincias',
            
                'NuevoPais' => 'Paises',
		'VerPaises' => 'Paises',
		'ModificarPais' => 'Paises',
		'VerVentas' => 'Ventas',
		'NuevaVenta' => 'Ventas',
		'VerDetalle' => 'Ventas',
		'VerPlan' => 'PlanPago',
		'NuevoPlan' => 'PlanPago',
		'ModificarPlan' => 'PlanPago',
		'VerVencidas' => 'Cuotas',
		'VerPorVencer' => 'Cuotas');
		
	$subSeccionesURL = array(		
		'NuevoAdministrador' => '../vista/administradores/nuevo.php',
		'VerAdministradores' => '../vista/administradores/mostrarActivos.php',
                'VerAdministradoresInactivos' => '../vista/administradores/mostrarInactivos.php',
		'ModificarAdministrador' => '../vista/administradores/nuevo.php',
                'ModificarPassword' => '../vista/administradores/modificarContrasenia.php',
                
      'NuevoVendedor' => '../vista/vendedores/nuevo.php',
      'VerVendedores' => '../vista/vendedores/mostrarActivos.php',
      'VerVendedoresInactivos' => '../vista/vendedores/mostrarInactivos.php',
      'ModificarVendedor' => '../vista/vendedores/nuevo.php',
            
                'NuevoCliente' => '../vista/clientes/nuevo.php',
		'VerClientes' => '../vista/clientes/mostrarTodos.php',
		'ModificarCliente' => '../vista/clientes/nuevo.php',
            
        'NuevaCategoria' => '../vista/categorias/nueva.php',
		'VerCategorias' => '../vista/categorias/mostrarTodas.php',
		'ModificarCategoria' => '../vista/categorias/nueva.php',
		
		'NuevaMarca' => '../vista/marcas/nueva.php',
		'ModificarMarca' => '../vista/marcas/nueva.php',
		'verMarcas' => '../vista/marcas/mostrarTodas.php',

		'NuevaModelo' => '../vista/modelo/nueva.php',
		'ModificarModelo' => '../vista/modelo/nueva.php',
		'verModelos' => '../vista/modelo/mostrarTodas.php',
                
                'NuevoProducto' => '../vista/productos/nuevo.php',
		'VerProductos' => '../vista/productos/mostrarTodos.php',
		'ModificarProducto' => '../vista/productos/nuevo.php',
                'ImagenProductos' => '../vista/productos/imagenesProducto.php',
            
                'NuevaLocalidad' => '../vista/localidades/nueva.php',
		'VerLocalidades' => '../vista/localidades/mostrarTodas.php',
		'ModificarLocalidad' => '../vista/localidades/nueva.php',
            
                'NuevaProvincia' => '../vista/provincias/nueva.php',
		'VerProvincias' => '../vista/provincias/mostrarTodas.php',
		'ModificarProvincia' => '../vista/provincias/nueva.php',
            
                'NuevoPais' => '../vista/paises/nuevo.php',
		'VerPaises' => '../vista/paises/mostrarTodos.php',
		'ModificarPais' => '../vista/paises/nuevo.php',
		'VerVentas' => '../vista/ventas/mostrarTodas.php',
		'NuevaVenta' => '../vista/ventas/nueva.php',
		'VerDetalle' => '../vista/ventas/verDetalle.php',
		'VerPlan' => '../vista/planpago/mostrarTodos.php',
		'NuevoPlan' => '../vista/planpago/nuevo.php',
		'ModificarPlan' => '../vista/planpago/nuevo.php',
		'VerVencidas' => '../vista/cuotas/mostrarTodasImpagasVencidas.php',
		'VerPorVencer' => '../vista/cuotas/mostrarTodasImpagasPorVencer.php');
	
	if(!empty ($_GET['seccion'])){
		
		$seccion = $_GET['seccion'];
		$subSeccion = "";
		
		include_once("encabezado.php");
		include_once("menuLateral.php");

		if(array_key_exists($seccion, $seccionesURL)){
			
			if(in_array($seccion, $_SESSION['c_sesion_permisos'])){
				include_once $seccionesURL[$seccion];
			
			}else{				
				include_once("../vista/accesoNoAutorizado.php");
				die();
			}
			
		}else{			
			include_once("../vista/seccionNoEncontrada.php");
			die();
		}
			
	}elseif(!empty ($_GET['subSeccion'])){
			
		$subSeccion = $_GET['subSeccion'];
		
		if(array_key_exists($subSeccion, $subSeccionesSeccion)){
			$seccion = $subSeccionesSeccion[$subSeccion];
		}else{
			$seccion = NULL;
		}
		
		include_once("encabezado.php");
		include_once("menuLateral.php");

		if(array_key_exists($subSeccion, $subSeccionesURL)){
			
			if(in_array($subSeccion, $_SESSION['c_sesion_permisos'])){
				include_once $subSeccionesURL[$subSeccion];
			
			}else{				
				include_once("../vista/accesoNoAutorizado.php");
				die();
			}
			
		}else{			
			include_once("../vista/seccionNoEncontrada.php");
			die();
		}
		
	}else{
		$seccion = 'Inicio';
		$subSeccion = "";
		
		include_once("encabezado.php");
		include_once("menuLateral.php");	
		
		if(array_key_exists($seccion, $seccionesURL)){
			
			if(in_array($seccion, $_SESSION['c_sesion_permisos'])){
				include_once $seccionesURL[$seccion];
			
			}else{				
				include_once("../vista/accesoNoAutorizado.php");
				die();
			}
			
		}else{			
			include_once("../vista/seccionNoEncontrada.php");
			die();
		}
	}
?>