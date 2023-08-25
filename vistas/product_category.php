<div class="container is-fluid mb-6">
    <h1 class="title">Productos</h1>
    <h2 class="subtitle">Lista de productos por categoria</h2>
</div>

<div class="container pb-6 pt-6">
    <?php require_once "./php/main.php"?>
    <div class="columns">
        <div class="column is-one-third">
            <h2 class="title has-text-centered">Categorias</h2>
            <?php 
                $categorias = conexion();
                $categorias = $categorias -> query("SELECT * FROM categoria");
                if ($categorias->rowCount()>0) {
                    $categorias=$categorias->fetchAll();
                    foreach ($categorias as $row) {
                        echo '<a href="index.php?vista=product_category&category_id=' .$row['categoria_id'].'" 
                        class="button is-link is-inverted is-fullwidth">
                        '.$row['categoria_nombre'].
                        '</a>';
                    }
                }else {
                    echo '<p class="has-text-centered">No hay categorias registradas</p>';
                }
                $categorias=null;
            ?>
        </div>
        
    </div>
</div>