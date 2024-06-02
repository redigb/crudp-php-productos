<?php
// Ajax para color (Recive las petiiones por parte del frontend)
require_once "../../Config/app.php";
require_once "../../App/Views/inc/session_start.php";
require_once "../../autoload.php";

use App\Controllers\ColorController;

$color = new ColorController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    if (isset($_POST["modulo_color"]) && $_POST["modulo_color"] == "registrar") {
        echo $color->registrarColor();
    }elseif (isset($_POST["accion"]) && $_POST["accion"] == "eliminarColor" && isset($_POST["id"])) {
        echo $color->eliminarColor();
    }
}else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["accion"] == "cargarListaColor") {
        echo $color->cargarListaColor();
    }

}else {
    session_destroy();
    header("Location: " . APP_URL . "login/");
}