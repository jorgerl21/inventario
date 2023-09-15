<?php 
    require_once "main.php";

    /* Almacenando datos */
    $product_id = limpiar_cadena($_POST['img_up_id']);

    /* Verificando producto */
    $check_producto = conexion();
    $check_producto = $check_producto -> query("SELECT * FROM producto WHERE producto_id='$product_id'");

    if ($check_producto -> rowCount()==1) {
        $datos = $check_producto -> fetch();
    }else {
        echo '<div class="notification is-danger is-light">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        La imagen del PRODUCTO que inteta actualizar no existe
        </div>';
        exit();
    }
    $check_producto = null;

    /* Comprobando si se ha seleccionado una imagen */
    if ($_FILES['producto_foto']['name']=="" || $_FILES['producto_foto']['size']==0) {
        echo '<div class="notification is-danger is-light">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        No se ha seleccionado minguna foto o imagen
        </div>';
        exit();
    }

    /* Directorios de imagenes */
    $img_dir = '../img/producto/';

    /* Creando directorio de imagenes */
    if (!file_exists($img_dir)) {
        if (!mkdir($img_dir,0777)) {
            echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Error al crear el directorio de imagenes
            </div>';
            exit();
        }
    }

    /* Cambiando permisos al directorio */
    chmod($img_dir, 0777);

    /* Comprobando formato de las imagenes */
    if (mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/png") {
        echo '<div class="notification is-danger is-light">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        La imagen que ha seleccionado es de un formato que no esta permitido
        </div>';
        exit();
    }

    /* Comprobando que la imagen no supere el limite de peso permitido */
    if (($_FILES['producto_foto']['size']/1024)>3072) {
        echo '<div class="notification is-danger is-light">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        La imagen que intenta subir supera el limite de peso permitido, por favor elija otra
        </div>';
        exit();
    }

    /* Extencion de las imagenes */
    switch (mime_content_type($_FILES['producto_foto']['tmp_name'])) {
        case 'image/jpeg':
            $img_ext = ".jpg";
            break;
        case 'image/png':
            $img_ext = ".png";
            break;
    }

    /* Nombre de la imagen */
    $img_nombre = renombrar_fotos($datos['producto_nombre']);

    /* Nombre final de la imagen */
    $foto = $img_nombre.$img_ext;

    /* Movimienfo imagen al direcctorio */
    if (!move_uploaded_file($_FILES['producto_foto']['tmp_name'], $img_dir.$foto)) {
        echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No podemos subir la imagen al sistema en este momento, por favor intente nuevamente
            </div>';
            exit();
    }

    /* Eliminando la imagen anterior */
    if (is_file($img_dir.$datos['producto_foto']) && $datos['producto_foto']!=$foto) {
        chmod($img_dir.$datos['producto_foto'],0777);
        unlink($img_dir.$datos['producto_foto']);
    }
    
    
?>