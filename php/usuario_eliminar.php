<?php 

    /* Almacenando datos */
    $user_id_del = limpiar_cadena($_GET['user_id_del']);

    /* Verificando usuario */
    $check_usuario = conexion();
    $check_usuario = $check_usuario -> query("SELECT usuario_id FROM usuario WHERE usuario_id='$user_id_del'");

    if ($check_usuario -> rowCount()<=0) {
        $eliminar_usuario = conexion();
        $eliminar_usuario = $eliminar_usuario -> prepare("DELETE FROM usuario WHERE usuario_id=:id");

        $eliminar_usuario -> execute([":id"=>$user_id_del]);

        
    }