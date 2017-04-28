<?php
	/*
	 * DEFINIR VARIABLES GENERALES 
	 */
	//define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("nombre");
        $campoPrecioSinIva = array("campo" => "precio_sin_iva", "valorEmpty" => "NULL");
        $campoIva = array("campo" => "iva", "valorEmpty" => "NULL"); 
        $campoPatente = array("campo" => "patente", "valorEmpty" => "NULL"); 
        $campoCategorias = array("campo"=> "categoria", "valorEmpty" => " ");
        $campoAnio = array("campo"=> "anio", "valorEmpty" => "NULL");
		  $campoDescripcion = array("campo"=> "descripcion", "valorEmpty" => " ");
        $campoMarca = array("campo"=> "marca", "valorEmpty" => " ");
        $campoModelo = array("campo"=> "modelo", "valorEmpty" => " ");
        $campoCombustible = array("campo"=> "combustible", "valorEmpty" => " ");
        $campoColor = array("campo"=> "color", "valorEmpty" => " ");
        $campoColorHtml = array("campo"=> "color_html", "valorEmpty" => " ");
        $campoActivo = array("campo" => "activo", "valorEmpty" => 0, "valorNotEmpty" => 1);
        $campoNumeroChasis = array("campo" => "numero_chasis", "valorEmpty" => " ");
        $campoNumeroMotor = array("campo" => "numero_motor", "valorEmpty" => " ");
        $campoPrecioCosto = array("campo" => "precio_costo", "valorEmpty" => "NULL");
        $campoClienteDuenio = array("campo" => "cliente_duenio", "valorEmpty" => "NULL");
	$opcionalesPOST = array($campoCategorias, $campoAnio,$campoDescripcion,
            $campoMarca,$campoModelo,$campoCombustible,$campoColor,$campoColorHtml,
                $campoActivo,$campoNumeroChasis,$campoNumeroMotor,$campoClienteDuenio,$campoPrecioCosto,
                $campoPrecioSinIva,$campoIva,$campoPatente);
        
	/*
	 * SCRIPT REQUERIDOS 
	 */
	require_once("../validacionCampos.php");   
        require_once('../../conexionBD.php');
        require_once('productoExistente.php');
	
	/*
	 * VALIDAR VARIABLES RECIBIDAS
	 */
	if(!empty($camposGET)) 
		validarGET($camposGET);
	if(!empty($camposPOST))
		validarPOST($camposPOST);	
	if(!empty($opcionalesPOST))
		$opcionalesValidados = opcionalesPOST($opcionalesPOST);	
	
	/*
	 * ASIGNAR VARIABLES RECIBIDAS
	 */								
		$nombre = $_POST['nombre'];
        
        if (preg_match('/,/',$_POST['categoria'])){
            $categorias = explode(',', $_POST['categoria']);
        }else{
            $categorias = array($opcionalesValidados['categoria']);
        }
        
        if(!empty($_POST['cliente_duenio'])){
        		$arrayClienteDuenio = explode('-',$opcionalesValidados['cliente_duenio']);
        		$clienteId = $arrayClienteDuenio[0]; 
        		}else {
        			$clienteId = $opcionalesValidados['cliente_duenio'];
        			}     
        
        $precioSinIva = $opcionalesValidados['precio_sin_iva'];
        $iva = $opcionalesValidados['iva'];
        $patente = $opcionalesValidados['patente'];
        $anio = $opcionalesValidados['anio']; 
        $descripcion = $opcionalesValidados['descripcion'];       
        $marca = $opcionalesValidados['marca'];    
        $modelo = $opcionalesValidados['modelo'];    
        $color = $opcionalesValidados['color']; 
        $colorHtml = $opcionalesValidados['color_html'];      
        $numeroChasis = $opcionalesValidados['numero_chasis'];    
        $numeroMotor = $opcionalesValidados['numero_motor'];    
        $activo = $opcionalesValidados['activo'];    
        $combustible = $opcionalesValidados['combustible'];
        $precioCosto = $opcionalesValidados['precio_costo'];
        
	
        $nombreUtilizado = validarPatente($patente, $conexionbd);  
        
        if(sizeof($nombreUtilizado) == 0 ){
            /*
             * ESTABLECER CONSULTA
             */
            comenzarTransaccion($conexionbd);
            $query = "
                    INSERT INTO producto(
                            nombre,
                            descripcion,
                            marca_id,
                            modelo_id,
                            patente,
                            alicuota,
                            precio_sin_iva,
                            combustible,
                            anio,
                            activo,
                            numero_motor,
                            numero_chasis,
                            color_nombre,
                            color_html,
                            cliente_id,
                            precio_costo
                    )VALUES('$nombre',
                            '$descripcion',
                            '$marca',
                            '$modelo',
                            '$patente',
                            '$iva',
                            '$precioSinIva',
                            '$combustible',
                            '$anio',
                            '$activo',
                            '$numeroMotor',
                            '$numeroChasis',
                            '$color',
                            '$colorHtml',
                             $clienteId,
                             $precioCosto)";
           
            $respuesta = realizarOperacion($query, $conexionbd);

            $respuestaArrayProducto = explode("_", $respuesta);        
            if($respuestaArrayProducto[0] == "exito"){
                $idProducto = $respuestaArrayProducto[1];

                foreach ($categorias as $idCategoriaActual) {
                    if($idCategoriaActual != " "){     
                        $query = "
                            INSERT INTO producto_categoria(
                                    producto_id,
                                    categoria_id
                            )VALUES('$idProducto',
                                    '$idCategoriaActual')";

                        $respuesta = realizarOperacion($query, $conexionbd);
                    }
                }
            }
            
            $respuestaArray = explode("_", $respuesta);           

            if($respuestaArray[0] == "exito"){
                finalizarTransaccion(true, $conexionbd);
            }else{
                finalizarTransaccion(false, $conexionbd);
            }
            exit($respuesta);
        }else{
            exit("Ya existe un Producto con ese Nombre.");
        }
?>