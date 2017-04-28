<?php
    $camposGET = array();
    $camposPOST = array();

    /*
     * SCRIPT REQUERIDOS 
     */	
    require_once("../validacionCampos.php");   
    require_once('../../conexionBD.php');
    /*
     * ESTABLECER CONSULTA
     */
    
    $categoriaId = $_POST["idCategoria"];
    
    $query = "
            SELECT 	
                p.id,
                p.nombre,
                CONCAT('$',ROUND(p.precio_sin_iva)) AS precio,
                p.marca
            FROM			
                producto AS p INNER JOIN producto_categoria AS pc
                ON p.id = pc.producto_id
            WHERE
                p.activo = 1 AND pc.categoria_id = $categoriaId AND p.precio_sin_iva is not null";

    $productos = realizarConsultaArray($query, $conexionbd, "aaData");

    if (empty($productos)) {
        exit();
    }
    
    for ($indice = 0; $indice < count($productos); $indice ++){
        $directorioImagen = "../../resources/js/scripts/custom/imagenes/".$productos[$indice]["id"]."/";
        if (!is_dir($directorioImagen)) {
            continue; 
        }
        $dirContents = scandir($directorioImagen);
        $arrayImagenes = array();
        foreach ($dirContents as $image) {
            if (isImageFile($image)) {
                array_push($arrayImagenes, $image);
            }
        }
        array_push($productos[$indice], $arrayImagenes);
    }
    
    

    // Define function to confirm each
    // filename is a valid image name/extension:
    function isImageFile($src) {
        return preg_match('/^.+\.(gif|png|jpe?g)$/i', $src);
    }

    // Loop through directory files and add to
    // $arrayContents on each iteration:
    exit(json_encode($productos));
?>