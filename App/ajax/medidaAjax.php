<?php
// Ajax para tamaño (Recive las petiiones por parte del frontend)
require_once "../../Config/app.php";
require_once "../../App/Views/inc/session_start.php";
require_once "../../autoload.php";

use App\Controllers\MedidaController;

$tamaño = new MedidaController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    if (isset($_POST["modulo_tamaño"]) && $_POST["modulo_tamaño"] == "registrar") {
        echo $tamaño->registrarMedida();
    }elseif (isset($_POST["accion"]) && $_POST["accion"] == "eliminarMedida" && isset($_POST["id"])) {
        echo $tamaño->eliminarMedida();
    }
// Consultar datos a tabla  
}else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["accion"] == "cargarListaMedida") {
        echo $tamaño->cargarListaMedida();
    }
}else {
    session_destroy();
    header("Location: " . APP_URL . "login/");
}