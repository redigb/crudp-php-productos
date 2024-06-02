<?php
// Ajax para producto (Recive las petiiones por parte del frontend)
require_once "../../Config/app.php";
require_once "../../App/Views/inc/session_start.php";
require_once "../../autoload.php";

use App\Controllers\ProductoController;

$producto = new ProductoController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    if (isset($_POST["modulo_producto"]) && $_POST["modulo_producto"] == "registrar") {
        echo $producto->registrarProducto();
    } elseif (isset($_POST["accion"]) && $_POST["accion"] == "eliminarProducto" && isset($_POST["id"])) {
        echo $producto->eliminarProducto();
    }elseif (isset($_POST["modulo_producto"]) && $_POST["modulo_producto"] == "actulizar"){
        echo $producto->editarProducto();
    }
}else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["accion"] == "cargarListaProducto") {
        echo $producto ->cargarListaProduto();
    }
}else {
    session_destroy();
    header("Location: " . APP_URL . "login/");
}