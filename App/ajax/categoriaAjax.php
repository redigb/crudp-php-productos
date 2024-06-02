<?php
// Ajax para categorias (Recive las petiiones por parte del frontend)
require_once "../../Config/app.php";
require_once "../../App/Views/inc/session_start.php";
require_once "../../autoload.php";

use App\Controllers\CategoriaController;

$categoria = new CategoriaController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    if (isset($_POST["modulo_categoria"]) && $_POST["modulo_categoria"] == "registrar") {
        echo $categoria->registrarCategoria();
    } elseif (isset($_POST["accion"]) && $_POST["accion"] == "eliminarCategoria" && isset($_POST["id"])) {
        echo $categoria->eliminarCategoria();
    }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["accion"] == "cargarListaCategoria") {
        echo $categoria->cargarListaCategoria();
    }
} else {
    session_destroy();
    header("Location: " . APP_URL . "login/");
}
    // un apartado de consulta para añadir a la tabla