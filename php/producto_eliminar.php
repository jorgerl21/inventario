<?php 
    /* Almacenando datos */
    $product_id_del = limpiar_cadena($_GET['producto_id_del']);

    /* verificando producto */
    $check_producto = conexion();
    $check_producto = $check_producto ->query("SELECT * FROM prooducto WHERE producto_id='$product_id_del'");

    if
?>