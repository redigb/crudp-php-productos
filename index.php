<?php
// Carga de dependecias
require_once './Config/app.php';
require_once './autoload.php';
require_once './App/Views/inc/session_start.php';
## Metodo para la url  -> tener valores separados
// isset para ver luna varrible definida
if (isset($_GET['views'])) {
    $url = explode("/", $_GET['views']);
} else {
    $url = ["login"];
}
?>
<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <?php require_once './App/Views/inc/head.php' ?>
    <script>
        const APP_URL = '<?= APP_URL ?>';
    </script>
</head>

<body>
    <?php
    // Obteniendo solo las rutas
    // use solo en php 
    use App\Controllers\ViewsController;
    use App\Controllers\LoginController;

    // Formato de login -> para manejar el inicio y cerrado de sesion
    $insLogin = new LoginController();

    $viewsController = new ViewsController();
    $vista = $viewsController->obtenerVistasControlador($url[0]);

    if ($vista == "login" || $vista == "404") {
        require_once "./App/Views/contenido/" . $vista . "-view.php";
    } else {
        // Cerrar la session -> si el usuario no esta logueado -!Login°
        /*if((!isset($_SESSION['id']) || $_SESSION['id']=="") || (!isset($_SESSION['usuario']) || $_SESSION['usuario'] == "")){
                $insLogin->cerrarSesionControlador();
                exit();
            }*/
        require_once "./App/Views/inc/navbar.php";
        require_once $vista;
    }

    require_once './App/Views/inc/script.php'
    ?>
    
</body>

</html>