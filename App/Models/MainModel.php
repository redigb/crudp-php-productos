<?php

namespace App\Models;

use PDO;
use PDOException;

//Si existe la ruta config lo va añadir a la ruta actual mediante dir
// Verificar si el archivo server.php existe en la ruta especificada
$configPath = __DIR__ . "/../../Config/server.php";
if (file_exists($configPath)) {
    require_once $configPath;
    // echo "Archivo de configuración cargado correctamente.<br>"; // Mensaje de depuración
}

class MainModel
{
    private $server = DB_SERVER;
    private $db = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;

    // Crear la conexion a la base de datos
    protected function conectar()
    {
        $conexion = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->db, $this->user, $this->pass);
        //Queremos usar caracteres especiales ->mas para el termino español
        $conexion->exec("SET CHARACTER SET utf8");
        return $conexion;
    }
    // Ejecutar una consulta SQL
    protected function ejecutarConsulta($consulta){
        //Ejecutar la consulta
        $sql = $this->conectar()->prepare($consulta);
        $sql->execute();
        return $sql;
    }
    // Filtro de consultas sQL
    public function limpiarCadena(String $cadena){
        //Diccionario de filtrado de caracteres -> para evitar SQL Injection
        $palabras = [
            "<script>", "</script>", "<script src", "<script type=", "SELECT * FROM",
            "SELECT ", " SELECT ", "DELETE FROM", "INSERT INTO", "DROP TABLE", "DROP DATABASE",
            "TRUNCATE TABLE", "SHOW TABLES", "SHOW DATABASES", "<?php", "?>", "--", "^", "<", ">", "==", "=", ";", "::"
        ];
        // quitar espacios en blanco y tabulaciones
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        // quitar caracteres especiales
        foreach ($palabras as $palabra) {
            $cadena = str_replace($palabra, "", $cadena);
        }
        // quitar espacios en blanco y tabulaciones
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        return $cadena;
    }
    // Validacion de datos
    protected function verificarDatos($filtro, $datos)
    {
        // Comparacion con una expresion irregular
        if (preg_match("/^" . $filtro . "$/", $datos)) {
            return false;
        } else {
            return true;
        }
    }
    // Guardar datos en la base de datos
    protected function guardarDatos($tabla, $datos){
        $query = "INSERT INTO $tabla (";
        $C = 0; //-> Reseteamos el contador
        // Nombre de la columna
        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave["campo_nombre"];
            $C++;
        }
        $query .= ") VALUES(";
        $C = 0; //-> Reseteamos el contador
        // Datos de insercion a las columnas
        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave["campo_marcador"];
            $C++;
        }
        $query .= ")";
        $C = 0; //-> Reseteamos el contador
        // preparar la consulta
        $sql = $this->conectar()->prepare($query);
        // cambiar el marcador por el valor real
        foreach ($datos as $clave) {
            $sql->bindParam($clave["campo_marcador"], $clave["campo_valor"]);
        }
        // Ejecutar la consulta
        $sql->execute();
        return $sql;

        // Ejecutar la consulta y manejar errores
        /*try {
            if ($sql->execute()) {
                return json_encode(["tipo" => "success", "mensaje" => "Inserción correcta"]);
            } else {
                return json_encode(["tipo" => "error", "mensaje" => "Inserción fallida"]);
            }
        } catch (PDOException $e) {
            return json_encode(["tipo" => "error", "mensaje" => "Error: " . $e->getMessage()]);
        }*

        // Funciona pero carga la consulta y no muestra el mensje
        /* $query = "INSERT INTO $tabla(";
        $columnas = [];
        $marcadores = [];
        foreach ($datos as $clave) {
            $columnas[] = $clave["campo_nombre"];
            $marcadores[] = $clave["campo_marcador"];
        }
        $query .= implode(", ", $columnas) . ") VALUES (" . implode(", ", $marcadores) . ")";

        // Mensaje de depuración para ver la consulta SQL
        echo "Consulta SQL: $query<br>";

        $sql = $this->conectar()->prepare($query);

        foreach ($datos as $clave) {
            // bindValue es más adecuado para valores inmediatos
            $sql->bindValue($clave["campo_marcador"], $clave["campo_valor"]);
        }

        try {
            $sql->execute();
            return $sql;
        } catch (PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }*/
    }
    // Seleccionar datos de consultas a una tabla
    public function selecionarDatos($tipo, $tabla, $campo, $id){
        $tipo = $this->limpiarCadena($tipo);
        $tabla = $this->limpiarCadena($tabla);
        $campo = $this->limpiarCadena($campo);
        $id = $this->limpiarCadena($id);
        if ($tipo == "Unico") {
            // Consultar un registro por su id
            $sql = $this->conectar()->prepare("SELECT * FROM $tabla WHERE $campo = :ID");
            $sql->bindParam(":ID", $id);
        } else if ($tipo == "Normal"){
            // Consultar todos los registros segun el campo
            $sql = $this->conectar()->prepare("SELECT $campo FROM $tabla");
        }
        $sql->execute();
        return $sql;
    }
    // Actualizar datos de una fila a una tabla
    public function actulizarDatos($tabla, $datos, $condicion)
    {
        $query = "UPDATE $tabla SET ";
        $C = 0;
        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave["campo_nombre"] . "=" . $clave["campo_marcador"];
            $C++;
        }
        $query .= " WHERE " . $condicion["condicion_campo"] . "=" . $condicion["condicion_marcador"];
        $sql = $this->conectar()->prepare($query);
        foreach ($datos as $clave) {
            // Cambia el marcador por el valor real
            $sql->bindParam($clave["campo_marcador"], $clave["campo_valor"]);
        }
        $sql->bindParam($condicion["condicion_marcador"], $condicion["condicion_valor"]);
        // Ejecutar la consulta
        /*$sql->execute();
        return $sql;*/
         // Ejecutar la consulta y manejar errores
        try {
            if ($sql->execute()) {
                return json_encode(["tipo" => "success", "mensaje" => "Inserción correcta"]);
            } else {
                return json_encode(["tipo" => "error", "mensaje" => "Inserción fallida"]);
            }
        } catch (PDOException $e) {
            return json_encode(["tipo" => "error", "mensaje" => "Error: " . $e->getMessage()]);
        }
    }
    // Eliminar datos de una tabla
    public function eliminarDatos($tabla, $campo, $id)
    {
        $sql = $this->conectar()->prepare("DELETE FROM $tabla WHERE $campo = :ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }
    // Paginador de tablas
    protected function paginarTablas($pagina, $numeroPagina, $url, $botones)
    {
        $tabla = '<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';
        if ($pagina <= 1) {
            $tabla .= '<a class="pagination-previous is-disabled" disabled >Anterior</a>
                <ul class="pagination-list">';
        } else {
            $tabla .= '<a class="pagination-previous" href="' . $url . ($pagina - 1) . '">Anterior</a>
                <ul class="pagination-list">}
                    <li><a class="pagination-link" href="' . $url . '1/">1</a></li>
                    <li><span class="pagination-ellipsis">&hellip;</span></li>';
        }
        $ci = 0;
        for ($i = $pagina; $i <= $numeroPagina; $i++) {
            if ($ci >= $botones) {
                break;
            }
            if ($pagina == $i) {
                $tabla .= '<li><a class="pagination-link is-current" href="' . $url . $i . '/">' . $i . '</a></li>';
            } else {
                $tabla .= '<li><a class="pagination-link" href="' . $url . $i . '/">' . $i . '</a></li>';
            }
            $ci++;
        }

        if ($pagina == $numeroPagina) {
            $tabla .= '</ul>
                <a class="pagination-next is-disabled" disabled >Siguiente</a>';
        } else {
            $tabla .= '
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                    <li><a class="pagination-link" href="' . $url . $numeroPagina . '/">' . $numeroPagina . '</a></li>
                </ul>
                <a class="pagination-next"href="' . $url . ($pagina + 1) . '>Siguiente</a>';
        }
        $tabla .= '</nav>';
    }
}
