<?php 
    require_once "../inc/session_start.php";

    require_once "main.php";

    /* Alamacenando datos */
    $codigo = limpiar_cadena($_POST['producto_codigo']);
    $nombre = limpiar_cadena($_POST['producto_nombre']);

    $precio = limpiar_cadena($_POST['producto_precio']);
    $stock = limpiar_cadena($_POST['producto_stock']);
    $categoria = limpiar_cadena($_POST['producto_categoria']);

    /* Verificando campos obligatorios */
    if ($codigo=="" || $nombre=="" || $precio=="" || $stock=="" || $categoria=="") {
        echo '<div class="notification is-danger is-light">
        <dtrong>Ocurrio un error!</strong><br>
        No has llenado todos los campos que son obligatorios
        </div>';
        exit();
    }

    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$nombre)) {
        echo '<div class="notification is-danger is-light">
        <dtrong>Ocurrio un error!</strong><br>
        El nombre no coincide con el formato solicitado
        </div>';
        exit();
    }

    if (verificar_datos("[0-9.]{1,25}",$precio)) {
        echo '<div class="notification is-danger is-light">
        <dtrong>Ocurrio un error!</strong><br>
        El precio no coincide con el formato solicitado
        </div>';
        exit();
    }

    if (verificar_datos("[0-9]{1,25}",$stock)) {
        echo '<div class="notification is-danger is-light">
        <dtrong>Ocurrio un error!</strong><br>
        El valor de stock ingresado nno coincide con el formato solicitado
        </div>';
        exit();
    }

    /* Verificando codigo */
    $check_codigo = conexion();
    $check_codigo = $check_codigo -> query("SELECT producto_codigo FROM producto WHERE producto_codigo='$codigo'");
    if ($check_codigo -> rowCount()>0) {
        echo '<div class="notification is-danger is-light">
        <dtrong>Ocurrio un error!</strong><br>
        EL COIGO DE BARRAS  ingresado ya se encuentra registrado por favor intente con uno nuevo
        </div>';
        exit();
    } 
    $check_codigo = null;
    
    /* Verificando nombre */
    $check_nombre = conexion();
    $check_nombre = $check_nombre -> query("SELECT producto_nombre FROM producto WHERE producto_nombre='$nombre'");
    if ($check_nombre -> rowCount()>0) {
        echo '<div class="notification is-danger is-light">
        <dtrong>Ocurrio un error!</strong><br>
        El nombre ingresado ya se encuentra registrado, por favor elija otro
        </div>';
        exit();
    }

    /* Verificando categoria */
    $check_categoria = conexion();
    $check_categoria = $check_categoria -> query("SELECT categoria_id FROM categoria WHERE ctegoria_id='$categoria'");
    if ($check_categoria -> rowCount()<=0) {
        echo '<div class="notification is-danger is-light">
        <dtrong>Ocurrio un error!</strong><br>
        La categoria seleccionada no existe
        </div>';
        exit();
    }

    /* Directorio de imagenes */
    $img_dir = '../img/producto/';

    /* Comprobando si se ha seleccionado una imagen */
    if ($_FILES['producto_foto']['name']!="" && $_FILES['producto_foto']['size']>0) {
        
        /* Creando directorio de imagenes */
        if (!file_exists($img_dir)) {
            if (!mkdir($img_dir,0777)) {
                echo '<div class="notification is-danger is-light">
                <dtrong>Ocurrio un error!</strong><br>
                Error al crear el directorio de imagenes
                </div>';
                exit();
            }
        }

        /* Comprobando formato de las imagenes */
        if (mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/png") {
            echo '<div class="notification is-danger is-light">
            <dtrong>Ocurrio un error!</strong><br>
            La imagen seleccionada es de un formato diferente al solicitado
            </div>';
            exit();
        }

        /* Comprobanda que la imagen no supere el peso permitido */
        if (($_FILES['producto_foto']['size']/1024)>3072) {
            echo '<div class="notification is-danger is-light">
            <dtrong>Ocurrio un error!</strong><br>
            La imagen supera el limite de peso permitido, porfavor elija otra
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

        /* Cambiando permisos al direcctorio */
        chmod($img_dir, 0777);

        /* Nombre de la imagen */
        $img_nombre = renombrar_fotos($nombre);

        /* Nombre final de la imagen */
        $foto = $img_nombre.$img_ext;

        /* Moviendo imagen al directorio */
        if (!move_uploaded_file($_FILES['producto_foto']['tmp_name'], $img_dir.$foto)) {
            echo '<div class="notification is-danger is-light">
            <dtrong>Ocurrio un error!</strong><br>
            No podemos subir la imagen al sistema en este momento, intente nuevamente
            </div>';
            exit();
        }
    }else {
        $foto = "";
    }

    /* Guardando datos */
    $guardar_producto = conexion();
    $guardar_producto = $guardar_producto -> prepare("INSERT INTO producto(producto_codigo,producto_nombre,producto_precio,producto_stock,producto_foto,categoria_id,usuario_id) VALUES(:codigo, :nombre, :precio, :stock, :foto, :categoria, :usuario)");

    $marcadores = [
        ":codigo" => $codigo,
        ":nombre" => $nombre,
        ":precio" => $precio,
        ":stock" => $stock,
        ":foto" => $foto,
        ":categoria" => $categoria,
        ":usuario" => $_SESSION['id']
    ];

    $guardar_producto -> execute($marcadores);

    if ($guardar_producto -> rowCount()==1) {
        echo '<div class="notification is-info is-light">
        <dtrong>PRODUCTO REGISTRADO!</strong><br>
        El producto se registro con exito
        </div>';
        exit();
    } else {
        if (is_file($img_dir.$foto)) {
            chmod($img_dir.$foto, 0777);
            unlink($img_dir.$foto);
        }
        echo '<div class="notification is-danger is-light">
        <dtrong>Ocurrio un error!</strong><br>
        El producto no se pudo registrar, por favor intenta nuevamente
        </div>';
    }

    $guardar_producto = null;
        
?>