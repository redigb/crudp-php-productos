<?php
namespace App\Controllers;
use App\Models\MainModel;
use PDO;

class ColorController extends MainModel{

    public function registrarColor(){
        #Datos 
        $codigo_color = $_POST['codigo_color'];
        $nombre_color = $_POST['nombre_color'];
        // vericar campos obligatorios
        if ($codigo_color == "" || $nombre_color == "") {
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
        $check_color = $this->ejecutarConsulta("SELECT codigo_color FROM color WHERE codigo_color = '$codigo_color'");
        if ($check_color->rowCount() > 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El color ya existe, elija otro",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        // Creacion de categoria
        $color_datos_reg = [
            [
                "campo_nombre" => "codigo_color",
                "campo_marcador" => ":Codigo",
                "campo_valor" => $codigo_color,
            ],
            [
                "campo_nombre" => "nombre_color",
                "campo_marcador" => ":Clase",
                "campo_valor" => $nombre_color,
            ],
            [
                "campo_nombre" => "color_creado",
                "campo_marcador" => ":Create",
                "campo_valor" => date("Y-m-d H:i:s"),
            ],
            [
                "campo_nombre" => "color_actualizado",
                "campo_marcador" => ":Update",
                "campo_valor" => date("Y-m-d H:i:s"),
            ],
        ];
        $registrar_color = $this->guardarDatos("color", $color_datos_reg);
        if ($registrar_color->rowCount() == 1) {
           $alerta = [
                "tipo" => "regresar",
                "titulo" => "Color creado",
                "texto" => "Color '".$nombre_color."' registrado correctamente",
                "icono" => "success",
                "url" => "".APP_URL."color/"
            ]; 
            return json_encode($alerta);
            exit();
        }else{
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El color no se registro",
                "icono" => "error"
            ]; 
            return json_encode($alerta);
            exit();
        }
    }

    public function cargarListaColor(){
        $color = $this->ejecutarConsulta("SELECT *  FROM color ORDER BY color_id  DESC");
        $colores = $color->fetchAll(PDO::FETCH_ASSOC); 
        return json_encode($colores);
    }

    public function eliminarColor(){
        $color_id = $_POST['id'];
        //Mostrar nombre
        $check_color = $this->ejecutarConsulta("SELECT nombre_color FROM color WHERE color_id = '$color_id'");
        $nombre_color = $check_color->fetch(PDO::FETCH_ASSOC);
        // Verificar si hay productos que usan esta categoría
        $check_relaciones = $this->ejecutarConsulta("SELECT producto_id FROM producto WHERE color_id = '$color_id'");
        if ($check_relaciones->rowCount() > 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El color '" .$nombre_color['nombre_color']. "' tiene relaciones, elija otra",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        $eliminar_color = $this->ejecutarConsulta("DELETE FROM color WHERE color_id = '$color_id'");
        if ($eliminar_color->rowCount() == 1) {
            $alerta = [
                "tipo" => "regresar",
                "titulo" => "Color eliminado",
                "texto" => "Color '" .$nombre_color['nombre_color']. "' eliminado correctamente",
                "icono" => "success",
                "url" => "".APP_URL."color/"
            ]; 
            return json_encode($alerta);
            exit();
        }
    }
}