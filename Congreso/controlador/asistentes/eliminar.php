<?php

    include '../../conexionBD.php';

    comenzarTransaccion($conexionbd);
    for($i=0; $i< sizeof($_POST["idDB"]);$i++){

            $id = $_POST["idDB"][$i];
            
            $query = "
                    UPDATE 
                        cliente
                    SET
                        activo = 0
                    WHERE 
                        id = $id";

            $respuesta = realizarOperacion($query, $conexionbd, true);
            $respuestaArray = explode("_", $respuesta);
    }
     if($respuestaArray[0] == "exito"){
        finalizarTransaccion(true, $conexionbd);
    }else{
        finalizarTransaccion(false, $conexionbd);
    }
    exit($respuesta);	
?>