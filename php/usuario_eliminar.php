<?php
$user_id_del = limpiar_cadena($_GET['user_id_del']);

//verificando el usuario
$check_usuario = conexion();
$check_usuario = $check_usuario->query("SELECT usuario_id FROM usuario WHERE usuario_id='user_id_del'");

if ($check_usuario->rowCount() == 1) {
    //verificando productos
    $check_productos = conexion();
    $check_productos = $check_productos->query("SELECT usuario_id FROM productos WHERE usuario_id='user_id_del' LIMIT 1");

    if ($check_productos -> rowCount()<=0) {
        $eliminar_usuario = conexion();
        $eliminar_usuario = $eliminar_usuario -> prepare("DELETE FROM usuario WHERE usuario_id=:id");

        $eliminar_usuario -> execute([":id" => $user_id_del]);

        if ($eliminar_usuario -> rowCount()==1) {
            echo '
            <div class="notification is-danger is-light"><strong>
            ¡Se completo la operacion con exito!</strong><br>
            Los datos del usuario se eliminaron con exito
            </div>
            '
        }
    }

} else {
    echo '
        <div class="notification is-danger is-light"><strong>
        ¡Ocurrio un error inesperado!</strong><br>
        Usuario o clave incorrectos
        </div>
        ';
}
$check_usuario = null;

/*
MI PARLAY
FC BAYERN MUNICH vs AUGSBURG - 27 domingo gana el bayern
SHEFFIELD UNITED vs MACHESTER CITY - 27 domingo
CELTA DE VIGO vs REAL MADRID - 25 viernes
*/