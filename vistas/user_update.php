<?php 
    require_once "./php/main.php";

    $id = (isset($_GET['user_id_up'])) ? $_GET['user_id_up'] :0;
    $id = limpiar_cadena($id);
?>

<div class="container is-fluid mb-6">
    <?php if ($id == $_SESSION['id']) { ?>

        <h1 class="title"> Mi cuenta </h1>
        <h2 class="subtitle"> Actualizar datos </h2>

        <?php }else { ?>
            <h1 class="title"> Usuarios </h1>
            <h2 class="subtitle"> Actualizar usuario </h2>
        <?php } ?>

</div>
<div class="container pb-6 pt-6">
    <?php 
        include "./inc/btn.back.php";

        /* VERIFICANDO USUARIO */
        $check_usuario = conexion();
        $check_usuario = $check_usuario -> query("SELECT * FROM usuario WHERE usuario_id='$id'");

        if ($check_usuario -> rowCount()>0) {
            $datos = $check_usuario -> fetch();
            ?>
        
        <div class="form-rest mb-6 mt-6"></div>
        <form action="./php/usuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">
            <input type="hidden" name="usuario_id" value="<php echo $datos['usuario_id']; ?>" required>
            <div class="columns">
                <div class="column">
                    <div class="control">
                            <label> Nombres </label>
                            <input class="input" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚ]" id="">
                    </div>
                </div>
            </div>
        </form>
        }
    ?>

</div>