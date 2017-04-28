<?php
	function validarNombreDisponible($nombre, $conexionbd){
		$query = "
                    SELECT 	
                        p.id
                    FROM			
                        provincia AS p
                    WHERE
                        p.nombre = '$nombre'";
				
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