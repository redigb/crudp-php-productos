<nav class="navbar bg-gray-200">
    <div class="navbar-brand">
        <a class="navbar-item" href="<?=APP_URL?>dashboard/">
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
        </div>
        </a>
        <div class="navbar-burger" data-target="navbarExampleTransparentExample">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div id="navbarExampleTransparentExample" class="navbar-menu">

        <div class="navbar-start">
            <a class="navbar-item" href="<?=APP_URL?>dashboard/">
                Inicio
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" href="#">
                    Usuarios
                </a>
                <div class="navbar-dropdown is-boxed">

                    <a class="navbar-item" href="<?=APP_URL?>userNew/">
                        Nuevo
                    </a>
                    <a class="navbar-item" href="<?=APP_URL?>userList/">
                        Lista
                    </a>
                    <a class="navbar-item" href="<?=APP_URL?>userSearch/">
                        Buscar
                    </a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" href="#">
                    Productos
                </a>
                <div class="navbar-dropdown is-boxed">
                    <a class="navbar-item" href="<?=APP_URL?>producto/">
                        producto
                    </a>
                    <a class="navbar-item" href="<?=APP_URL?>categorias/">
                        categorias
                    </a>
                    <a class="navbar-item" href="<?=APP_URL?>tamaño/">
                        tamaño
                    </a>
                    <a class="navbar-item" href="<?=APP_URL?>color/">
                        color
                    </a>
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    Cuenta de usuario
                </a>
                <div class="navbar-dropdown is-boxed">
                    <a class="navbar-item" href="<?=APP_URL?>userUpdate/">
                        Mi cuenta
                    </a>
                    <a class="navbar-item" href="<?=APP_URL?>userPhoto/">
                        Mi foto
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item" href="<?=APP_URL?>logOut/" id="btn_exit" >
                        Salir
                    </a>
                </div>
            </div>
        </div>

    </div>
</nav>