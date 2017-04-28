<?php
	function validarPaisExistente($codigo, $nombre, $conexionbd){
            $query = "
                SELECT 	
                    p.id
                FROM			
                    pais AS p
                WHERE
                    p.nombre = '$nombre'";

            $result = mysql_query($query, $conexionbd);

            $datos = array();

            if(mysql_num_rows($result) > 0){

                    while($arr = mysql_fetch_array($result, MYSQL_ASSOC)){
                        array_push($datos,$arr['id']);
                    }
            }
            
            if(sizeof($datos) == 0 ){
                $query2 = "
                    SELECT 	
                        p.id
                    FROM			
                        pais AS p
                    WHERE
                        p.id = $codigo";
				
		$result2 = mysql_query($query2, $conexionbd);
		
		$datos2 = array();
			
		if(mysql_num_rows($result2) == 1){
			
                    while($arr2 = mysql_fetch_array($result2, MYSQL_ASSOC)){			
                            $datos2[] = $arr2;
                    }
		}	
		
		if(sizeof($datos2) == 0){
                    return "disponible";
                }else{
                    return "Ya existe un País con ese código";
                }
            }else{
                return "Ya existe un País con ese nombre";
            }
	}	
?>