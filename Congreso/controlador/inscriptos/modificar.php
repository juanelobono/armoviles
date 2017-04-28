<?php
        /*
	 * DEFINIR VARIABLES GENERALES 
	 */
	//define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("nombre","precio_sin_iva","iva","patente");
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
   $campoClienteDuenio = array("campo" => "cliente_duenio", "valorEmpty" => "NULL");
	$opcionalesPOST = array($campoCategorias, $campoAnio,$campoDescripcion,
            $campoMarca,$campoModelo,$campoCombustible,$campoColor,$campoColorHtml,
                $campoActivo,$campoNumeroChasis,$campoNumeroMotor,$campoClienteDuenio);
        
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
	
	$id = $_POST['idDB'];
        
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
        			
       $precioSinIva = $_POST['precio_sin_iva'];
        $iva = $_POST['iva'];
        $patente = $_POST['patente'];
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
	
        /*
         * ESTABLECER CONSULTA
         */
        comenzarTransaccion($conexionbd);
        $query = "
                UPDATE 
                    producto
                SET                
                    nombre = '$nombre',
                    descripcion = '$descripcion',
                    patente = '$patente',
                    alicuota = '$iva',
                    precio_sin_iva = '$precioSinIva',
                    activo = '$activo',
                    marca = '$marca',
                    modelo = '$modelo',
                    anio = '$anio',
                    color_nombre = '$color',
                    color_html = '$colorHtml',
                    numero_chasis = '$numeroChasis',
                    numero_motor = '$numeroMotor',
                    combustible = '$combustible',
                    cliente_id = $clienteId
                    
                WHERE 
                    id = $id";
        
        $respuestaQuery = realizarOperacion($query, $conexionbd);

        $respuestaArrayProducto = explode("_", $respuestaQuery);        
        if($respuestaArrayProducto[0] == "exito"){
            
            $query = "DELETE FROM producto_categoria WHERE producto_id = $id";
            $result = mysql_query($query, $conexionbd) or die("Error: ".mysql_error());
            
            foreach ($categorias as $idCategoriaActual) {
                if($idCategoriaActual != " "){     
                    $query = "
                        INSERT INTO producto_categoria(
                                producto_id,
                                categoria_id
                        )VALUES($id,
                                $idCategoriaActual)";

                    $respuesta = realizarOperacion($query, $conexionbd);
                }
            }
        }

        $respuestaArray = explode("_", $respuestaQuery);           

        if($respuestaArray[0] == "exito"){
            finalizarTransaccion(true, $conexionbd);
        }else{
            finalizarTransaccion(false, $conexionbd);
            $respuestaQuery = $respuestaArray;
        }
        exit($respuestaQuery);
?>