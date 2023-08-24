<?php 
        require_once "../inc/session_start.php";
        require_once "main.php";

    /* Almacenamiento de ID */
    $id = limpiar_cadena($_POST['usuario_id']);

    /* Verificacion de usuario */
        $check_usuario = conexion();
        $check_usuario = $check_usuario -> query("SELECT * FROM usuario WHERE usuario_id = '$id'");

    if ($check_usuario -> rowCount()<=0) {
        echo '
		    <div class="notification is-danger is-light">
		        <strong>¡Ocurrio un error inesperado!</strong><br>
		        El usuario no existe en el sistema
		    </div>
		    ';
            exit();
    } else {
        $datos = $check_usuario -> fetch();
    }
    $check_usuario = null;

    /* Alamacenamiento de los datos del administrador */
    $admin_usuario = limpiar_cadena($_POST['administrador_usuario']);
    $admin_clave = limpiar_cadena($_POST['administrador_clave']);
    
    /* verificacion de los campos obligatorios del administrador */
    if ($admin_usuario == "" || $admin_clave == "") {
        echo '
		    <div class="notification is-danger is-light">
		        <strong>¡Ocurrio un error inesperado!</strong><br>
		        No se han llenado los campos que corresponden a su USUARIO O CLAVE
		    </div>
		    ';
            exit();
    }
    /* verificando la integridad de los datos (admin) */
    if (verificar_datos("[a-zA-Z0-9]{4,20}",$admin_usuario)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                su USUARIO no coincide con el formato solicitado
            </div>
            ';
            exit();
    }
    
    if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$admin_clave)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                su CLAVE no coincide con el formato solicitado
            </div>
            ';
            exit();
    }

    /* verifiacando el administrador en DB */

    $check_admin = conexion();
    $check_admin = $check_admin -> query("SELECT usuario_usuario, usuario_clave FROM usuario WHERE usuario_usuario = '$admin_usuario' AND usuario_id = '".$_SESSION['$id']."'");
    
    if ($check_admin->rowCount()==1) {
        $check_admin = $check_admin -> fetch();

            if ($check_admin['usuario_usuario']!=$admin_usuario || !password_verify($admin_clave, $check_admin['usuario_clave'])) {
                echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    USUARIO O CLAVE de administrador son incorrectos
                </div>
                ';
                exit();    
            }
    }else {
        echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    USUARIO O CLAVE de administrador son incorrectos
                </div>
                ';
                exit(); 
    }
    $check_admin = null;

    /* almacenando datos del usuario */
    $nombre = limpiar_cadena($_POST['usuario_nombre']);
    $apellido = limpiar_cadena($_POST['usuario_apellido']);

    $usuario = limpiar_cadena($_POST['usuario_usuario']);
    $email = limpiar_cadena($_POST['usuario_email']);

    $clave_1 = limpiar_cadena($_POST['usuario_clave_1']);
    $clave_2 = limpiar_cadena($_POST['usuario_clave_2']);

    /* Verificaion de campos obligatorios de usuario */
    if ($nombre=="" || $apellido=="" || $usuario=="") {
        echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    no has llenado todos los campos que son obligatorios
                </div>
                ';
                exit(); 
    }

    /* verificando integridad de los datos (usuario) */
    if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)) {
        echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El NOMBRE no coincide con el formato solicitado
                </div>
                ';
                exit();
    }

    if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)) {
        echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El APELLIDO no coincide con el formato solicitado
                </div>
                ';
                exit();
    }

    if (verificar_datos("[a-zA-Z-0-9]{4,20}",$usuario)) {
        echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El USUARIO no coincide con el formato solicitado
                </div>
                ';
                exit();
    }

    if ($email != "" && $email != $datos['usuario_email']) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $check_email = conexion();
            $check_email = $check_email -> query("SELECT usuario_email FROM usuario WHERE usuario_email = '$email'");
            if ($check_email -> rowCount()>0) {
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El CORREO ELECTRONICO ya se encuentra registrado por favor intente con otro
                    </div>
                    ';
                    exit();
            }
            $check_email = null;
        }else {
            echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        Ha ingresado un correo electronico
                    </div>
                    ';
                    exit();
        }
    }

    /* verificando usuario */
    if ($usuario != $datos['usuario_usuario']) {
        $check_usuario = conexion();
        $check_usuario = $check_usuario -> query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario = '$usuario'");
        if ($check_usuario -> rowCount()>0) {
            echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El NOMBRE DE USUARIO ya existe intenta con uno distinto
                    </div>
                    ';
                    exit();
        }
        $check_usuario = null;
    }
//like a stone > me gusta la piedra XD    
?>