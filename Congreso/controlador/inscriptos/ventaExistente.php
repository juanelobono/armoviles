<?php
	function validarVenta($descripcion, $conexionbd){
		$query = "
                    SELECT 	
                        v.id
                    FROM			
                        venta AS v
                    WHERE
                        v.descripcion = '$descripcion'";
				
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