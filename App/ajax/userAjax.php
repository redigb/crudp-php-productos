<?php
// Ajax para usuarios (Recive las petiiones por parte del frontend)
    require_once "../../Config/app.php";
    require_once "../../App/Views/inc/session_start.php";
    require_once "../../autoload.php";

    use App\Controllers\UserController;

    if (isset($_POST["modulo_usuario"])) {
        $usuario = new UserController();
        if ($_POST["modulo_usuario"] == "registrar") {
            echo $usuario->registrarUsuarioControlador();
        }
    }else{
        session_destroy();
        header("Location: ".APP_URL."login/");
    }