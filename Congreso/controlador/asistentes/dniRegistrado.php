<?php
	function validarDniDisponible($dni, $conexionbd){
		$query = "
                    SELECT 	
                        c.id
                    FROM			
                        cliente AS c
                    WHERE
                        c.cuit_cuil_dni = '$dni'";
				
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