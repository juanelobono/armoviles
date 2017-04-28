<?php
	function validarUsuarioAdministrador($usuario, $conexionbd){
		$query = "
                    SELECT 	
                        u.id
                    FROM			
                        usuario AS u
                    WHERE
                        u.usuario = '$usuario' AND u.tipo = 'admin'";
				
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