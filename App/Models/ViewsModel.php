<?php
    namespace App\Models;

    class ViewsModel{
        protected function obtenerVistasModelo($vista){
            // Lista de pagina para el View
            $listaBlanca =["dashboard", "userNew", "userList", "userSearch",
            "userUpdate", "userPhoto", "logOut","userDelete", "categorias",
            "form-categoria", "producto", "tamaño", "color"];
            // Reglas para obtner las vistas
            if(in_array($vista, $listaBlanca)) {
                if (is_file("./App/Views/contenido/".$vista."-view.php")) {
                    $contenido = "./App/Views/contenido/".$vista."-view.php";
                }else{$contenido="404";}
            }else if($vista=="login" || $vista=="index"){$contenido="login";}
            else{$contenido="producto";}
            return $contenido;
        }
    }