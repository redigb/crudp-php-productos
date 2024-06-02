<?php
// Carga de archivos requeridos - Para todo las dependencias nesesarias
//Para no tener que importarlas manualmente
spl_autoload_register(function($clase){
    // obtener el archivo de ejeccion
    $archivo=__DIR__."/".$clase.".php";
    $archivo=str_replace('\\', '/', $archivo);
    if (is_file($archivo)) {
        require_once $archivo;
    }
});
