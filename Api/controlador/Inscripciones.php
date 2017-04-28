<?php
include("mysql.php");
class ControladorInscripciones {
    
    /**
     * Devuelve todos los inscripciones del sistema
     *
     * @url GET /inscripciones/todos
     */
    public function todos() {
        $db = new MySQL();
        $query = "
            SELECT  
                I.id, 
                u.nombre,
                u.apellido,
                u.dni,
                u.domicilio,
                u.telefono
            FROM            
                inscripciones as i join
                usuario as u on i.Asistentes_id = u.id";
        $clientes = $db->consultaArray($query);

        return array("inscripciones" => $clientes);
    }
    /**
     * Devuelve todos los inscripciones del sistema
     *
     * @url GET /inscripciones/$Usuarios_id
     */
    public function todosporUsuario($Usuarios_id) {
        $db = new MySQL();
        $query = "
           SELECT  
                i.Cursos_id
            FROM            
                inscripciones as i join
                usuario as u on i.Asistentes_id = u.id
            WHERE 
                i.Asistentes_id = $Usuarios_id";

        $inscripciones = $db->consultaArray($query);

        if (!empty($inscripciones)) {

            return array("error" => false, "mensaje" => "Exito.", "cursos" => $inscripciones);
        
        }else{
            return array("error" => true, "mensaje" => "No se pudo completar la operacion.");
        }
    }
    /**
     *incribe a un curso
     *
     * @url GET /inscripciones/$Usuarios_id/$Curso_id
     */
    public function inscripcionACurso($Usuarios_id,$Curso_id) {
        $db = new MySQL();
         $query = "
            SELECT  
                c.id,
                c.Eventos_idEvento as Eventos_id
            FROM            
                cursos as c 
            Where 
                c.id = $Curso_id";
        $cursos = $db->consultaArray($query);
        $Eventos_id = $cursos[0]['Eventos_id'];
       

        //verifico q haya usuario correcto
        $query = "
                SELECT 
                    *
                FROM 
                    usuario 
                WHERE 
                    id = '$Usuarios_id'";
            $respuesta = $db->consultaRegistroArray($query);
            if (empty($respuesta)) {
                return array("error" => true, "mensaje" => "Usuario Invalido: No se pudo completar la operacion.");
            };

         //verifico q haya curso correcto
        $query = "
                SELECT 
                    *
                FROM 
                    cursos
                WHERE 
                    id = '$Curso_id'";
            $respuesta = $db->consultaRegistroArray($query);
            if (empty($respuesta)) {
                return array("error" => true, "mensaje" => "Curso Invalido: No se pudo completar la operacion.");
            };

        $query = "
           INSERT INTO inscripciones(
                            Asistentes_id,
                            Cursos_id,
                            Eventos_idEvento,
                            fecha_alta
                    )VALUES(
                            $Usuarios_id,
                            $Curso_id,
                            $Eventos_id,
                            Now()
                           )";

        
       $respuesta = $db->realizarOperacion($query);
       $respuestaArray = explode("_", $respuesta);
        if ($respuestaArray[0] == "exito") {

            return array("error" => false, "mensaje" => "Exito.");
        
        }else{
            return array("error" => true, "mensaje" => "No se pudo completar la operacion.");
        }
    }
}
