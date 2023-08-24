<?php 
    $inicio = ($pagina>0) ? (($pagina * $registros) - $registros) : 0;
    $tabla="";

    if (isset($busqueda) && $busqueda!="") {
        $consulta_datos="SELECT * FROM categoria WHERE categoria_nombre LIKE '%$busqueda%' OR categoria_ubicacion 
        LIKE '%$busqueda%' ORDER BY categoria_nombre ASC LIMIT $inicio,$registros";

        $consulta_total="SELECT COUNT(categoria_id) FROM categoria WHERE categoria_nombre LIKE '%$busqueda%' 
        OR categoria_ubicacion LIKE '%$busqueda%'";
    }else {
        
    }
?>