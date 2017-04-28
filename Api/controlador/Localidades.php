<?php

class ControladorLocalidades {
    
    /**
     * Devuelve todos los clientes del sistema
     *
     * @url GET /localidades/todas
     */
    public function todos() {
        $db = new MySQL();
        try{
            $query = "SELECT nombre, codigo_postal AS codigo, 1 AS level, provincia_id as id_padre
                    FROM localidad
                    UNION ALL
                    SELECT nombre, id AS codigo, 2 AS level, pais_id as id_padre
                    FROM provincia
                    UNION ALL
                    SELECT nombre, '' AS codigo, 3 AS level, 0 as id_padre
                    FROM pais";
            $localidades = $db->consultaArray($query);

            return array("success"=>true, "localidades" => $localidades);
      }catch(Exception $e){

            return array('success' => false,"localidades" => "");
        }
    }
}