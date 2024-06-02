<?php

namespace App\Controllers;

use App\Models\MainModel;
use PDO;

class CategoriaController extends MainModel
{

    public function registrarCategoria()
    {
        #Datos 
        $nombre_categoria = $_POST['categoria_nombre'];
        $ubicacion_categoria = $_POST['categoria_ubicacion'];

        // vericar campos obligatorios
        if ($nombre_categoria == "" || $ubicacion_categoria == "") {
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
        // Verificar usuario existente
        $check_categoria = $this->ejecutarConsulta("SELECT categoria_nombre FROM categoria WHERE categoria_nombre  = '$nombre_categoria'");
        if ($check_categoria->rowCount() > 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "La categoria ya existe, elija otro",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }


        // Creacion de categoria
        $categoria_datos_reg = [
            [
                "campo_nombre" => "categoria_nombre",
                "campo_marcador" => ":Nombre",
                "campo_valor" => $nombre_categoria,
            ],
            [
                "campo_nombre" => "categoria_ubicacion",
                "campo_marcador" => ":Ubicacion",
                "campo_valor" => $ubicacion_categoria,
            ],
            [
                "campo_nombre" => "categoria_creada",
                "campo_marcador" => ":Create",
                "campo_valor" => date("Y-m-d H:i:s"),
            ],
            [
                "campo_nombre" => "categoria_actualizada",
                "campo_marcador" => ":Update",
                "campo_valor" => date("Y-m-d H:i:s"),
            ],
        ];
        $registrar_categoria = $this->guardarDatos("categoria", $categoria_datos_reg);
        if ($registrar_categoria->rowCount() == 1) {
            $alerta = [
                "tipo" => "regresar",
                "titulo" => "Categoria creada",
                "texto" => "Categoria '" . $nombre_categoria . "' registrado correctamente",
                "icono" => "success",
                "url" => "" . APP_URL . "categorias/"
            ];
            return json_encode($alerta);
            exit();
        } else {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "La categoria no se registro correctamente",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
    }

    public function cargarListaCategoria()
    {
        // Emular paginas en caso la dataa sea demasiado grande
        $categoria = $this->ejecutarConsulta("SELECT *  FROM categoria ORDER BY categoria_id DESC");
        $categorias = $categoria->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($categorias);
    }

    /*public function actualizarCategoria(){
        $categoria_id = $_POST['categoria_id'];
        $nombre_categoria = $_POST['categoria_nombre'];
        $ubicacion_categoria = $_POST['categoria_ubicacion'];

        // vericar campos obligatorios
        if ($nombre_categoria == "" || $ubicacion_categoria == "") {
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
        // Verificar usuario existente
        $check_categoria = $this->ejecutarConsulta("SELECT categoria_nombre FROM categoria WHERE categoria_nombre  = '$nombre_categoria'");
        if ($check_categoria->rowCount() > 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "La categoria ya existe, elija otro",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }


        // Creacion de categoria
        $categoria_datos_reg = [
            [
                "campo_nombre" => "categoria_nombre",
                "campo_marcador" => ":Nombre",
                "campo_valor" => $nombre_categoria,
            ],
            [
                "campo_nombre" => "categoria_ubicacion",
                "campo_marcador" => ":Ubicacion",
                "campo_valor" => $ubicacion_categoria,
            ],
            [
                "campo_nombre" => "categoria_creada",
                "campo_marcador" => ":Create",
                "campo_valor" => date("Y-m-d H:i:s"),
            ],
            [
                "campo_nombre" => "categoria_actualizada",
                "campo_marcador" => ":Update",
                "campo_valor" => date("Y-m-d H:i:s"),
            ],    
        ];
       // $actualizar_categoria = $this->actualizarDatos("categoria", $categoria_id, $categoria_datos_reg);
        if ($actualizar_categoria->rowCount() == 1) {
           $alerta = [
                "tipo" => "regresar",
                "titulo" => "Categoria actualizada",
                "texto" => "Categoria '".$nombre_categoria."' actualizada correctamente",
                "icono" => "success",
                "url" => "".APP_URL."categorias/"
            ]; 
            return json_encode($alerta);
            exit();
        }  
    }*/

    public function eliminarCategoria()
    {
        $categoria_id = $_POST['id'];
        //verificar relaciones
        $check_categoria = $this->ejecutarConsulta("SELECT categoria_nombre FROM categoria WHERE categoria_id = '$categoria_id'");
        $nombre_categoria = $check_categoria->fetch(PDO::FETCH_ASSOC);
        // Verificar si hay productos que usan esta categoría
        $check_relaciones = $this->ejecutarConsulta("SELECT producto_id FROM producto WHERE categoria_id = '$categoria_id'");
        if ($check_relaciones->rowCount() > 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "La categoría '" . $nombre_categoria['categoria_nombre'] . "' tiene relaciones, elija otra",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        // Eliminar categoría
        $eliminar_categoria = $this->eliminarDatos("categoria", "categoria_id", $categoria_id);
        if ($eliminar_categoria->rowCount() == 1) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Categoria eliminada",
                "texto" => "Categoria '" . $nombre_categoria['categoria_nombre'] . "' eliminada correctamente",
                "icono" => "success",
            ];
            return json_encode($alerta);
            exit();
        }
    }
}
