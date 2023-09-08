<? 
    require_once "main.php";

    /* Alamacenando id */
    $id = limpiar_cadena($_POST['producto_id']);

    /* Verificando producto */
    $check_producto = conexion();
    $check_producto = $check_producto -> query("SELECT * FROM producto WHERE producto_id='$id' ");

    if ($check_producto -> rowCount()<=0) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El producto no existe en el sistema
            </div>
            ';
            exit();
    } else {
        $datos = $check_producto -> fetch();
    }
    $check_producto = null;

    /* Almacenando datos */
    $codigo = limpiar_cadena($_POST['producto_codigo']);
    $nombre = limpiar_cadena($_POST['producto_nombre']);

    $precio = limpiar_cadena($_POST['producto_precio']);
    $stock = limpiar_cadena($_POST['producto_stock']);
    $categoria = limpiar_cadena($_POST['producto_categoria']);

    /* Verificando campos obligatorios */
    if ($codigo=="" || $nombre=="" || $precio=="" || $stock=="" || $categoria=="") {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
            ';
    }

    /* Verificando integridad de los datos */
    //CODIGO
    if (verificar_datos("[a-zA-Z0-9- ]{1,70}", $codigo)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El codigo de barras del producto no cuenta con el formato solicitado
            </div>
            ';
            exit();
    }

    //NOMBRE
    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}", $nombre)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El nombre del producto no cuenta con el formato solicitado
            </div>
            ';
            exit();
    }
    
?>