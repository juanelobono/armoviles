<?php
     error_reporting(0);
        /*
	 * DEFINIR VARIABLES GENERALES 
	 */
	//define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("nombre", "apellido", "dni");

    $campoNombrePadre = array("campo" => "nombre_padre", "valorEmpty" => " ");
    $campoNombreMadre = array("campo" => "nombre_madre", "valorEmpty" => " ");
	$campoTelefono = array("campo"=> "telefono", "valorEmpty" => " ");
        $campoEmail = array("campo"=> "email", "valorEmpty" => " ");
        $campoFechaNacimiento = array("campo" => "fecha_nacimiento", "valorEmpty" => "NULL");
        $campoLocalidad = array("campo" => "localidad-seleccionada", "valorEmpty" => "NULL");
        $campoestadocivil = array("campo" => "estadocivil", "valorEmpty" => "NULL");
        $campoDomicilio = array("campo" => "domicilio", "valorEmpty" => " ");

    $condicion = array("campo" => "condicion", "valorEmpty" => " ");
    $nombre_empresa = array("campo" => "nombre_empresa", "valorEmpty" => " ");
    $antiguedad = array("campo" => "antiguedad", "valorEmpty" => " ");
    $ingresos_mensuales = array("campo" => "ingresos_mensuales", "valorEmpty" => " ");

    $domicilio_laboral = array("campo" => "domicilio_laboral", "valorEmpty" => " ");
    $telefono_laboral = array("campo" => "telefono_laboral", "valorEmpty" => " ");
    $otros_ingresos = array("campo" => "otros_ingresos", "valorEmpty" => " ");



    $campoPiso = array("campo"=> "piso", "valorEmpty" => " ");
    $campoDepartamento = array("campo"=> "departamento", "valorEmpty" => " ");
    $opcionalesPOST = array($campoTelefono, $campoEmail, $campoFechaNacimiento, 
            $campoLocalidad, $campoDomicilio, $campoPiso, $campoDepartamento,$campoestadocivil,
            $nombre_empresa,$condicion,$antiguedad,$ingresos_mensuales,$domicilio_laboral,$telefono_laboral,
            $otros_ingresos,$nombre_padre,$nombre_madre);
	/*
	 * SCRIPT REQUERIDOS 
	 */
	require_once("../validacionCampos.php");   
        require_once('../../conexionBD.php');
        require_once('dniRegistrado.php');
	
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
    $estadocivil = $_POST['estadocivil'];
    $nombre_padre = $opcionalesValidados['nombre_padre'];
    $nombre_madre = $opcionalesValidados['nombre_madre'];
	$apellido = $_POST['apellido'];
        $dni = $_POST['dni'];  
        $email = $opcionalesValidados['email'];
        $telefono = $opcionalesValidados['telefono'];        
        $fechaNacimiento = null;
        $fechaNacimientoStr =  $opcionalesValidados['fecha_nacimiento'];  
        if($fechaNacimientoStr != null){
            $fechaNacimientoStr =  $_POST['fecha_nacimiento'];  
            $fechaNacimientoVec = explode("/", $fechaNacimientoStr);
            $dateTimeNac = new DateTime($fechaNacimientoVec[0]."-".$fechaNacimientoVec[1]."-".$fechaNacimientoVec[2]);
            $fechaNacimiento = $dateTimeNac->format('Y-m-d H:i');
        }
        $fechaIngreso = date("Y-m-d H:i");
        $localidadVec = explode("-", $opcionalesValidados['localidad-seleccionada']);   
        $localidad = trim($localidadVec[0]);
        $domicilio = $opcionalesValidados['domicilio'];    
        $piso = $opcionalesValidados['piso'];        
        $departamento = $opcionalesValidados['departamento'];        
        

    //actividad laboral
    $nombre_empresa = $_POST['nombre_empresa'];
    $condicion = $_POST['condicion'];
    $antiguedad = $_POST['antiguedad'];
    $ingresos_mensuales = $_POST['ingresos_mensuales'];
    $domicilio_laboral = $_POST['domicilio_laboral'];
    $telefono_laboral = $_POST['telefono_laboral'];
    $otros_ingresos = $_POST['otros_ingresos'];

        $dniUtilizado = validarDniDisponible($dni, $conexionbd);
        
        if(sizeof($dniUtilizado) == 0 ||
                (sizeof($dniUtilizado) == 1 && $dniUtilizado[0]['id'] == $id)){
            /*
             * ESTABLECER CONSULTA
             */
            comenzarTransaccion($conexionbd);
            $query = "
                    UPDATE 
                        cliente
                    SET
                        nombre = '$nombre',
                        apellido = '$apellido',
                        domicilio = '$domicilio',
                        email = '$email',
                        telefono = '$telefono',
                        fecha_nacimiento = CAST('$fechaNacimiento' AS DATETIME),
                        fecha_ingreso = '$fechaIngreso',
                        cuit_cuil_dni = '$dni',
                        localidad_id = $localidad,
                        piso = '$piso',
                        departamento = '$departamento',
                        nombre_padre = '$nombre_padre',
                        nombre_madre = '$nombre_madre',
                        estado_civil = $estadocivil
                    WHERE 
                        id = $id";

            $respuesta = realizarOperacion($query, $conexionbd, true);
            $respuestaArray = explode("_", $respuesta);
            $id_cliente = $id;

            $respuesta_limpiar = limpiar_situacion_laboral($conexionbd,$id_cliente);
            
           
             if($respuestaArray[0] == "exito"){
               $id_cliente = $id;

                if(($_POST["nombre_empresa"][0] != "")) {

                    for($i=0; $i< sizeof($_POST["nombre_empresa"]);$i++){

                        !empty($_POST["nombre_empresa"][$i]) ? $nombre_empresa = $_POST["nombre_empresa"][$i] : $nombre_empresa = NULL;
                        !empty($_POST["condicion"][$i]) ? $condicion = $_POST["condicion"][$i] : $condicion = NULL;
                        !empty($_POST["antiguedad"][$i]) ? $antiguedad = $_POST["antiguedad"][$i] : $antiguedad = NULL;
                        !empty($_POST["ingresos_mensuales"][$i]) ? $ingresos_mensuales = $_POST["ingresos_mensuales"][$i] : $ingresos_mensuales = NULL;
                        !empty($_POST["domicilio_laboral"][$i]) ? $domicilio_laboral = $_POST["domicilio_laboral"][$i] : $domicilio_laboral = NULL;
                        !empty($_POST["telefono_laboral"][$i]) ? $telefono_laboral = $_POST["telefono_laboral"][$i] : $telefono_laboral = NULL;
                        !empty($_POST["otros_ingresos"][$i]) ? $otros_ingresos = $_POST["otros_ingresos"][$i] : $otros_ingresos = NULL;

                        if($nombre_empresa != NULL && $condicion != NULL && $ingresos_mensuales != NULL && $id_cliente != NULL){
                             $query = "
                                    INSERT INTO situacion_laboral(
                                            nombre_empresa,
                                            condicion,                            
                                            antiguedad,
                                            ingresos_mensuales_netos,
                                            domicilio_laboral,
                                            telefono_laboral,
                                            otros_ingresos
                                    )VALUES('$nombre_empresa',
                                            '$condicion',
                                            '$antiguedad',
                                            '$ingresos_mensuales',
                                            '$domicilio_laboral',                            
                                            '$telefono_laboral',
                                            '$otros_ingresos')";
                            
                            
                            $respuesta = realizarOperacion($query, $conexionbd);
                            $respuestaArray = explode("_", $respuesta);
                            

                            if($respuestaArray[0] != "exito"){                                
                                die("Error al intentar guardar una situacion laboral.");
                            }else{
                                  $id_situacionLaboral = $respuestaArray[1];
                                  $query = "
                                            INSERT INTO clientes_situacion_laboral(
                                                    fecha_alta,
                                                    cliente_id,                            
                                                    situacion_laboral_id
                                            )VALUES(now(),
                                                    '$id_cliente',
                                                    '$id_situacionLaboral')";
                                    
                                    
                                    $respuesta = realizarOperacion($query, $conexionbd);
                                    $respuestaArray = explode("_", $respuesta);
                                    $cliente_id_situacionLaboral = $respuestaArray[1];
                            }

                        }else{
                            die("Hay filas de Situaciones Laborales del Cliente que estan vacíos. Debe eliminarlo o completar todos los campos.");
                        }
                    }
                }
            }

            

            if($respuestaArray[0] == "exito"){
                finalizarTransaccion(true, $conexionbd);
            }else{
                finalizarTransaccion(false, $conexionbd);
            }
            exit($respuesta);
        }else{
            exit("Ya existe un Cliente con ese CUIT / CUIL / DNI.");
        }  
        function limpiar_situacion_laboral($conexionbd,$id_cliente){
            $query = "select situacion_laboral_id from clientes_situacion_laboral where cliente_id = $id_cliente";
            $respuesta = realizarConsultaArray($query, $conexionbd,"aadata");
            

            for($i=0; $i< sizeof($respuesta);$i++){
                $situacion_laboral_id = $respuesta[$i]['situacion_laboral_id'];
                $query="delete from situacion_laboral where id = $situacion_laboral_id";
                $result = mysql_query($query, $conexionbd) or die("Error: ".mysql_error());
            }
            return $result;
        }
?>