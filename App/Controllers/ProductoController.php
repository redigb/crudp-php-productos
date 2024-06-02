<?php

namespace App\Controllers;

use App\Models\MainModel;
use PDO;

class ProductoController extends MainModel
{

    public function registrarProducto(){
        #Datos  -> Producto
        $nombre_producto = $_POST['nombre_producto'];
        $otros_datos = $_POST['otros_datos'];
        $tamaño_id = $_POST['medida_id'];
        $color_id = $_POST['color_id'];
        $categoría_id = $_POST['categori_id'];

        // vericar campos obligatorios
        if ($nombre_producto == "" || $tamaño_id == "" || $color_id == "" || $categoría_id == "") {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "Por favor, revise los campos obligatorios",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        // Por añadir integridad de datos -> Filtro faltante
        // Verificar tamaño existente
        $check_producto = $this->ejecutarConsulta("SELECT nombre_producto FROM producto WHERE nombre_producto = '$nombre_producto'");
        if ($check_producto->rowCount() > 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El producto ya existe, elija otro",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        // Creacion de categoria
        $producto_datos_reg = [
            ["campo_nombre" => "nombre_producto", "campo_marcador" => ":Nombre", "campo_valor" => $nombre_producto],
            ["campo_nombre" => "otros_datos", "campo_marcador" => ":Otros", "campo_valor" => $otros_datos],
            ["campo_nombre" => "categoria_id", "campo_marcador" => ":Categoriaid", "campo_valor" => $categoría_id],
            ["campo_nombre" => "medida_id ", "campo_marcador" => ":Medida", "campo_valor" => $tamaño_id],
            ["campo_nombre" => "color_id", "campo_marcador" => ":Colorid", "campo_valor" => $color_id],
            ["campo_nombre" => "producto_creado", "campo_marcador" => ":Create", "campo_valor" => date("Y-m-d H:i:s")],
            ["campo_nombre" => "producto_actualizado", "campo_marcador" => ":Update", "campo_valor" => date("Y-m-d H:i:s")],
        ];
        // echo  json_encode($producto_datos_reg);
        $registrar_producto = $this->guardarDatos("producto", $producto_datos_reg);
        if ($registrar_producto->rowCount() == 1) {
            $alerta = [
                "tipo" => "regresar",
                "titulo" => "Producto creado",
                "texto" => "Producto '" . $nombre_producto . "' registrado correctamente",
                "icono" => "success",
                "url" => "" . APP_URL . "producto/"
            ];
            return json_encode($alerta);
            exit();
        } else {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El producto no se registro",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
    }

    public function cargarListaProduto(){
        $producto = $this->ejecutarConsulta("SELECT p.producto_id AS producto_id , p.nombre_producto AS nombre_producto,
        p.otros_datos AS otros_datos, c.categoria_nombre AS categoria_nombre, t.codigo_tamaño AS codigo_tamaño, 
        col.nombre_color AS nombre_color, p.producto_actualizado AS producto_actualizado, p.categoria_id AS categoria_id, 
        p.medida_id AS medida_id, p.color_id AS color_id FROM producto p
        INNER JOIN categoria c ON p.categoria_id = c.categoria_id
        INNER JOIN tamaño t ON p.medida_id = t.tamaño_id
        INNER JOIN color col ON p.color_id = col.color_id

        ORDER BY producto_id DESC");
        $productos = $producto->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($productos);
    }

    public function eliminarProducto(){
        $producto_id = $_POST['id'];
        // Verificar si hay productos que usan esta categoría
        $check_producto = $this->ejecutarConsulta("SELECT nombre_producto FROM producto WHERE producto_id = '$producto_id'");
        $nombre_producto = $check_producto->fetch(PDO::FETCH_ASSOC);
        //
        // Eliminar producto
        $eliminar_producto = $this->eliminarDatos("producto", "producto_id", $producto_id);
        if ($eliminar_producto->rowCount() == 1) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "producto eliminado",
                "texto" => "producto '" . $nombre_producto['nombre_producto'] . "' eliminada correctamente",
                "icono" => "success",
            ];
            return json_encode($alerta);
            exit();
        }
    }

    public function editarProducto(){
        $producto_id = $_POST['id_ProductEdit'];
        $nombre_producto = $_POST['nombre_producto_editar'];
        $otros_datos = $_POST['otros_datos_editar'];
        $categoria_id = $_POST['categoriaSelect'];
        $medida_id = $_POST['medida_selecionEdit'];
        $color_id = $_POST['color_selecionEdit'];
        // Verificar datos
        if ($producto_id == "" || $nombre_producto == "" || $otros_datos == "" || $categoria_id == "" || $medida_id == "" || $color_id == "") {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "Por favor, revise los campos obligatorios",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        // Actualizar producto
        $producto_datos_reg = [
            ["campo_nombre" => "nombre_producto", "campo_marcador" => ":Nombre", "campo_valor" => $nombre_producto],
            ["campo_nombre" => "otros_datos", "campo_marcador" => ":Otros", "campo_valor" => $otros_datos],
            ["campo_nombre" => "categoria_id", "campo_marcador" => ":Categoriaid", "campo_valor" => $categoria_id],
            ["campo_nombre" => "medida_id ", "campo_marcador" => ":Medida", "campo_valor" => $medida_id],
            ["campo_nombre" => "color_id", "campo_marcador" => ":Colorid", "campo_valor" => $color_id],
            ["campo_nombre" => "producto_actualizado", "campo_marcador" => ":Update", "campo_valor" => date("Y-m-d H:i:s")],
        ];
        $condicion = ["condicion_campo" => "producto_id", "condicion_marcador" => ":ID", "condicion_valor" => $producto_id];

        if ($this->actulizarDatos("producto", $producto_datos_reg, $condicion)) {
            $alerta = [
                "tipo" => "regresar",
                "titulo" => "Producto actualizado",
                "texto" => "Producto '" . $nombre_producto . "' actualizado correctamente",
                "icono" => "success",
                "url" => "" . APP_URL . "producto/"
            ];
            return json_encode($alerta);
            exit();
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No hemos podido actualizar el producto ".$nombre_producto.", por favor intente nuevamente",
                "icono"=>"error"
            ];
        }
    }

}
