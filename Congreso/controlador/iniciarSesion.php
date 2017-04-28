<?php

session_start();
define("SCRIPT_VALIDO", TRUE);

$bdUser;
$bdNombre;
$bdIdUsuario;
$bdPermisos;

    if ((!empty($_POST['usuario'])) && (!empty($_POST['contrasenia']))) {

        include "../conexionBD.php";

        $user = $_POST['usuario'];
        $pass = $_POST['contrasenia'];
/*        
        $pass_encriptada1 = md5 ($pass); //Encriptacion nivel 1
        $pass_encriptada2 = crc32($pass_encriptada1); //Encriptacion nivel 1
        $pass_encriptada3 = crypt($pass_encriptada2, "xtemp"); //Encriptacion nivel 2
        $pass_encriptada4 = sha1("xtemp".$pass_encriptada3); //Encriptacion nivel 3
*/
        /*
         * BUSCAR USUARIO
         */
        $query = "
                            SELECT 
                                    u.id, 
                                    u.nombre, 
                                    u.usuario,
                                    u.tipo
                            FROM 
                                    usuario AS u 
                            WHERE 
                                    u.usuario = '$user' AND
                                    u.contrasenia = '$pass'";

        $result = realizarConsultaRegistroArray($query, $conexionbd);

        /*
         * SI EXISTE
         */
        if (count($result) == 1) {

            $arr = $result[0];
            $bdUser = $arr['usuario'];
            $bdNombre = $arr['nombre'];
            $bdIdUsuario = $arr['id'];
            $bdTipoUsuario = $arr['tipo'];

            /*
             * BUSCAR PERMISOS
             */
            $query = "
                        SELECT
                            s.nombre
                        FROM
                            seccion AS s,
                            permiso AS p 
                        WHERE
                            p.usuario_id = $bdIdUsuario AND
                            p.seccion_id = s.id";

            $result = mysql_query($query, $conexionbd) or die("Error: " . mysql_error());

            /*
             * SI EXISTEN
             */
            if (mysql_num_rows($result) > 0) {
                while ($arr = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    $bdPermisos[] = $arr["nombre"];
                }

                $_SESSION['c_sesion_reg'] = true;
                $_SESSION['c_sesion_user'] = $bdUser;
                $_SESSION['c_sesion_nombre'] = $bdNombre;
                $_SESSION['c_sesion_idUsuario'] = $bdIdUsuario;
                $_SESSION['c_sesion_tipoUsuario'] = $bdTipoUsuario;
                $_SESSION['c_sesion_permisos'] = $bdPermisos;
                
            }
        }
    }

    if($_SESSION['c_sesion_idUsuario'] != ""){
        exit("exito");
    }else{
        exit("ERROR");
    }
    

	//header("Location: ../../index.php");
?>