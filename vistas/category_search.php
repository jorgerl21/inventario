<div class="container is-fluid mb-6">
    <h1 class="title">Categorias</h1>
    <h2 class="subtitle">Buscar categoria</h2>
</div>

<div class="container pb-6 pt-6">
    <?php 
        require_once "./php/main.php";

        if (isset($_POST['modulo_buscador'])) {
            require_once "./php/buscador.php";
        }

        if (!isset($_SESSION['busqueda_categoria']) && empty($_SESSION['busqueda_categoria'])) {
        
    ?>
    
    <div class="columns">
        <div class="column">
            <form action="" method="POST" autocomplete="off">
                <input type="hidden" name="modulo_buscador" value="categoria">
                <div class="filed is-grouped">
                    <p class="control is-expanded">
                        <input class="input is-rounded" type="text" name="txt_buscador"
                        placeholder="que estas buscando?" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,30}"
                        maxlength="30">
                    </p>
                    <p class="control">
                        <button class="button is-info" type="submit">Buscar</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <?php }else{ ?>
    <div class="columns">
        <div class="column">
            <form class="has-text-centered mt-6 mb-6" action="" method="POST" autocomplete="off">
                <input type="hidden" name="modulo_buscador" value="categoria">
                <input type="hidden" name="eliminar_buscador" value="categoria">
                <p>Estas buscando <strong>"<?php echo $_SESSION['busqueda_categoria']; ?>"</strong></p>
                <br />
                <button type="submit" class="button is-danger is-rounded">Eliminar busqueda</button>
            </form>
        </div>
    </div>
    <?php 
        /* eliminar categoria */
        if (isset) {
            # code...
        }
    ?>
    }
        
    
</div>