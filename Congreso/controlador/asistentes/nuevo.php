<?php
	/*
	 * DEFINIR VARIABLES GENERALES 
	 */
	//define("SCRIPT_VALIDO", TRUE);
	$camposGET = array();
	$camposPOST = array("nombre", "apellido", "dni");


    
	$campoTelefono = array("campo"=> "telefono", "valorEmpty" => " ");
    $campoEmail = array("campo"=> "email", "valorEmpty" => " ");
    $campoFechaNacimiento = array("campo" => "fecha_nacimiento", "valorEmpty" => "NULL");
    $campoLocalidad = array("campo" => "localidad", "valorEmpty" => "NULL");
    $telefono = array("campo" => "telefono", "valorEmpty" => "NULL");
    $campoDomicilio = array("campo" => "domicilio", "valorEmpty" => " ");

     
    $legajo = array("campo" => "legajo", "valorEmpty" => " ");
    $eventos = array("campo" => "eventos", "valorEmpty" => " ");



    $campoPiso = array("campo"=> "piso", "valorEmpty" => " ");
    $campoDepartamento = array("campo"=> "departamento", "valorEmpty" => " ");
	$opcionalesPOST = array($campoTelefono, $campoEmail, $campoFechaNacimiento, 
            $campoLocalidad, $campoDomicilio, $campoPiso, $campoDepartamento,$telefono,
            $piso,$legajo,
            $eventos);
        
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
	
	/*
	 * ASIGNAR VARIABLES RECIBIDAS
	 */								
	$nombre = $_POST['nombre'];
    
    
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
    $localidad = $opcionalesValidados['localidad'];    
    $domicilio = $opcionalesValidados['domicilio'];    
    $piso = $opcionalesValidados['piso'];        
    $departamento = $opcionalesValidados['departamento'];        
    


    //actividad laboral
    $legajo = $_POST['legajo'];
    $eventos = $_POST['eventos'];
    



    $dniUtilizado = validarDniDisponible($dni, $conexionbd);  
    
        if(sizeof($dniUtilizado) == 0 ){
            /*
             * ESTABLECER CONSULTA
             */
            comenzarTransaccion($conexionbd);
            
            $query = "
                    INSERT INTO cliente(
                            nombre,
                            apellido,                            
                            email,
                            telefono,
                            fecha_ingreso,
                            dni,
                            fecha_nacimiento,
                            domicilio,
                            piso,
                            departamento,
                            localidad_id,
                            legajo,
                            eventos,
                            
                            activo
                    )VALUES('$nombre',
                            '$apellido',
                            '$email',
                            '$telefono',
                            '$fechaIngreso',                            
                            '$dni',
                            CAST('$fechaNacimiento' AS DATETIME),
                            '$domicilio',
                            '$piso',
                            '$departamento',
                            $localidad,
                            $legajo,
                            $eventos,                            
                            1)";
           
            $respuesta = realizarOperacion($query, $conexionbd);
            $respuestaArray = explode("_", $respuesta);
            $id_cliente = $respuestaArray[1];


            


            if($respuestaArray[0] == "exito"){
                finalizarTransaccion(true, $conexionbd);
            }else{
                finalizarTransaccion(false, $conexionbd);
            }
            exit($respuestaArray[0]);
        }else{
            
            exit("Ya existe un Asistente con ese CUIT / CUIL / DNI. < /br> Por Favor Busquelo y Editelo");
        }
?>