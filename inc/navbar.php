<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="index.php?vista=home">
            <img src="./img/logo.png" width="40" height="500">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    Usuarios
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=user_new">
                        Nuevo Usuario
                    </a>
                    <a class="navbar-item" href="index.php?vista=user_list">
                        Lista Usuarios
                    </a>
                    <a class="navbar-item" href="index.php?vista=user_search">
                        Buscar Usuario
                    </a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    Categorias
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item">
                        Nueva Categoria
                    </a>
                    <a class="navbar-item">
                        Lista Categoria
                    </a>
                    <a class="navbar-item">
                        Buscar Categoria
                    </a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    Productos
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item">
                        Nuevo Producto
                    </a>
                    <a class="navbar-item">
                        Lista Producto
                    </a>
                    <a class="navbar-item">
                        Prod. Categoria 
                    </a>
                    <a class="navbar-item">
                        Buscar Producto 
                    </a>
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-primary is-rounded">
                        Mi cuenta
                    </a>
                    <a class="button is-link is-rounded">
                        Salir
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>