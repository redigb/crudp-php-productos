<?php

namespace App\Controllers;

use App\Models\MainModel;
use PDO;

class MedidaController extends MainModel
{

    public function registrarMedida()
    {
        #Datos 
        $codigo_tamaño = $_POST['codigo_tamaño'];
        $clasificacion = $_POST['clasificacion'];
        // vericar campos obligatorios
        if ($codigo_tamaño == "" || $clasificacion == "") {
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
        $check_tamaño = $this->ejecutarConsulta("SELECT codigo_tamaño FROM tamaño WHERE codigo_tamaño = '$codigo_tamaño'");
        if ($check_tamaño->rowCount() > 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El tamaño ya existe, elija otro",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }


        // Creacion de categoria
        $tamaño_datos_reg = [
            [
                "campo_nombre" => "codigo_tamaño",
                "campo_marcador" => ":Codigo",
                "campo_valor" => $codigo_tamaño,
            ],
            [
                "campo_nombre" => "clasificacion",
                "campo_marcador" => ":Clase",
                "campo_valor" => $clasificacion,
            ],
            [
                "campo_nombre" => "tamaño_creado",
                "campo_marcador" => ":Create",
                "campo_valor" => date("Y-m-d H:i:s"),
            ],
            [
                "campo_nombre" => "tamaño_actualizado",
                "campo_marcador" => ":Update",
                "campo_valor" => date("Y-m-d H:i:s"),
            ],
        ];
        $registrar_tamaño = $this->guardarDatos("tamaño", $tamaño_datos_reg);
        if ($registrar_tamaño->rowCount() == 1) {
            $alerta = [
                "tipo" => "regresar",
                "titulo" => "Tamaño creado",
                "texto" => "Tamaño '" . $codigo_tamaño . "' registrado correctamente",
                "icono" => "success",
                "url" => "" . APP_URL . "tamaño/"
            ];
            return json_encode($alerta);
            exit();
        } else {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El tamaño no se registro",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
    }

    public function cargarListaMedida()
    {
        $tamaño = $this->ejecutarConsulta("SELECT *  FROM tamaño ORDER BY tamaño_id DESC");
        $tamaños = $tamaño->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($tamaños);
    }

    public function eliminarMedida()
    {
        $medida_id = $_POST['id'];
        //Mostrar nombre
        $check_medida = $this->ejecutarConsulta("SELECT codigo_tamaño FROM tamaño WHERE tamaño_id = '$medida_id'");
        $nombre_medida = $check_medida->fetch(PDO::FETCH_ASSOC);
        // Verificar si hay productos que usan esta categoría
        $check_relaciones = $this->ejecutarConsulta("SELECT producto_id FROM producto WHERE medida_id = '$medida_id'");
        if ($check_relaciones->rowCount() > 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El tmaño '" .$nombre_medida['codigo_tamaño']. "' tiene relaciones, elija otra",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        $eliminar_medida = $this->ejecutarConsulta("DELETE FROM tamaño WHERE tamaño_id = '$medida_id'");
        if ($eliminar_medida->rowCount() == 1) {
            $alerta = [
                "tipo" => "regresar",
                "titulo" => "Tamaño eliminado",
                "texto" => "Tamaño '" .$nombre_medida['codigo_tamaño']. "' eliminado correctamente",
                "icono" => "success",
                "url" => "" . APP_URL . "tamaño/"
            ];
            return json_encode($alerta);
            exit();
        }
    }
}
