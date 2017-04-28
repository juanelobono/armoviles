<?php
	function validarNombreDisponible($nombre, $conexionbd){
		$query = "
                    SELECT 	
                        l.id
                    FROM			
                        localidad AS l
                    WHERE
                        l.nombre = '$nombre'";
				
		$result = mysql_query($query, $conexionbd);
		
		$datos = array();
			
		if(mysql_num_rows($result) == 1){
			
			while($arr = mysql_fetch_array($result, MYSQL_ASSOC)){			
				$datos[] = $arr;
			}
		}	
		
		return $datos;
	}		
?>