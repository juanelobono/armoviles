<?php

class ControladorEventos {
    
    /**
     * Devuelve todos los eventos del sistema
     *
     * @url GET /eventos/todos
     */
    public function todos() {
        $db = new MySQL();
        $query = "
            SELECT  
                e.idEvento as id, 
                e.fecha_inicio,
                e.fecha_fin,
                e.descripcion,
                e.lugar,
                e.nombre
            FROM            
                eventos as e ";
        $eventos = $db->consultaArray($query);

        return array("eventos" => $eventos);
    }
    
}
