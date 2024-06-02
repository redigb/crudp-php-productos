<?php

namespace App\Controllers;

use App\Models\MainModel;

class UserController extends MainModel
{

    # Controlador para registrar ususarios
    public function registrarUsuarioControlador()
    {
        # Almacenando datos
        $nombre = $this->limpiarCadena($_POST['usuario_nombre']);
        $apellido = $this->limpiarCadena($_POST['usuario_apellido']);

        $usuario = $this->limpiarCadena($_POST['usuario_usuario']);
        $email = $this->limpiarCadena($_POST['usuario_email']);
        $clave = $this->limpiarCadena($_POST['usuario_clave_1']);
        $clave2 = $this->limpiarCadena($_POST['usuario_clave_2']);
        // vericar campos obligatorios
        if ($nombre == "" || $apellido == "" || $usuario == "" || $clave == "" || $clave2 == "") {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "Por favor, revise los campos obligatorios",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        // verificar la integridad de los datos
        if ($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $nombre)) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El nombre no coincide con el formato requerido",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        if ($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $apellido)) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El apellido no coincide con el formato requerido",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        if ($this->verificarDatos("[a-zA-Z0-9]{4,20}", $usuario)) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El usuario no coincide con el formato requerido",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        if ($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "La clave no coincide con el formato requerido",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        if ($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}", $clave2)) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "La clave repetida no coincide con el formato requerido",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        // Verificar email
        if ($email != "") {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $check_email = $this->ejecutarConsulta("SELECT usuario_email FROM usuario WHERE usuario_email  = '$email'");
                //numero total de consultas rowCount()
                if ($check_email->rowCount() > 0) {
                    $alerta = [
                        "tipo" => "simple",
                        "titulo" => "Ocurrió un error",
                        "texto" => "El correo electrónico ya está en uso",
                        "icono" => "error"
                    ];
                    return json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error",
                    "texto" => "Correo electrónico no válido",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
        }

        // Claves iguales
        if ($clave != $clave2) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "Las claves no coinciden",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        } else {
            $clavehash = password_hash($clave, PASSWORD_BCRYPT, ['cost' => 10]);
        }

        // Verificar usuario existente
        $check_usuario = $this->ejecutarConsulta("SELECT usuario_usuario FROM usuario WHERE usuario_usuario  = '$usuario'");
        if ($check_usuario->rowCount() > 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El usuario ya existe, elija otro",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        // Directorio de images
        $img_dir = "../Views/assets/fotos/";
        // Comprobar imagen si se selecciono una imagen
        if ($_FILES['usuario_foto']['name'] != "" && $_FILES['usuario_foto']['size'] > 0) {
            // Crear directorio
            if (!file_exists($img_dir)) {
                if (!mkdir($img_dir, 0777)) {
                    $alerta = [
                        "tipo" => "simple",
                        "titulo" => "Ocurrió un error",
                        "texto" => "No se pudo crear el directorio de imágenes",
                        "icono" => "error"
                    ];
                }
            }

            // Verificar formato de la imagen -> nombre temporal de la imagen
            if (
                mime_content_type($_FILES['usuario_foto']['tmp_name']) != "image/jpeg" &&
                mime_content_type($_FILES['usuario_foto']['tmp_name']) != "image/png"
            ) {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error",
                    "texto" => "La imagen no es de tipo JPG o PNG",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
            // Verificar tamaño de la imagen
            if (($_FILES['usuario_foto']['size'] / 1024) > 5120) {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error",
                    "texto" => "La imagen es demasiado grande de 5 MB permitido",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            //Nombre de la imagen
            $nombre_imagen = str_ireplace(" ", "_", $nombre);
            // Para que no se repita la imagen
            $nombre_imagen = $nombre_imagen . "_" . rand(0, 100);
            // Extension de la imagen
            switch (mime_content_type($_FILES['usuario_foto']['tmp_name'])) {
                case "image/jpeg":
                    $extension = ".jpg";
                    break;
                case "image/png":
                    $extension = ".png";
                    break;
                default:
                    $extension = ".jpg";
            }
            $nombre_imagen = $nombre_imagen . $extension;
            // Permiso de lectura y escritura
            chmod($img_dir, 0777);
            if (!move_uploaded_file($_FILES['usuario_foto']['tmp_name'], $img_dir . $nombre_imagen)) {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error",
                    "texto" => "No se pudo subir la imagen",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            } // Si nose ejecuta el if es por que se guardo exitosamente
        } else {
            $nombre_imagen = "";
        }

        $usuario_datos_reg = [
            [
                "campo_nombre" => "usuario_nombre",
                "campo_marcador" => ":Nombre",
                "campo_valor" => $nombre,
            ],
            [
                "campo_nombre" => "usuario_apellido",
                "campo_marcador" => ":Apellido",
                "campo_valor" => $apellido,
            ],
            [
                "campo_nombre" => "usuario_usuario",
                "campo_marcador" => ":Usuario",
                "campo_valor" => $usuario,
            ],
            [
                "campo_nombre" => "usuario_email",
                "campo_marcador" => ":Email",
                "campo_valor" => $email,
            ],
            [
                "campo_nombre" => "usuario_foto",
                "campo_marcador" => ":Foto",
                "campo_valor" => $nombre_imagen,
            ],
            [
                "campo_nombre" => "usuario_clave",
                "campo_marcador" => ":Clave",
                "campo_valor" => $clavehash,
            ],
            [
                "campo_nombre" => "usuario_creado",
                "campo_marcador" => ":Create",
                "campo_valor" => date("Y-m-d H:i:s"),
            ],
            [
                "campo_nombre" => "usuario_actualizado",
                "campo_marcador" => ":Update",
                "campo_valor" => date("Y-m-d H:i:s"),
            ],
        ];

        $registrar_usuario = $this->guardarDatos("usuario", $usuario_datos_reg);
        if ($registrar_usuario->rowCount() == 1) {
           $alerta = [
                "tipo" => "limpiar",
                "titulo" => "Usuario creado",
                "texto" => "Usuario ".$nombre." ".$apellido." registrado correctamente",
                "icono" => "success"
            ]; 
            return json_encode($alerta);
            exit();
        }else{
            // Eliminar la imagen caso no se registre en la base de datos
            if (is_file($img_dir.$nombre_imagen)) {
                chmod($img_dir.$nombre_imagen, 0777);
                unlink($img_dir.$nombre_imagen);
            }
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error",
                "texto" => "El usuario no se registro correctamente",
                "icono" => "error"
            ]; 
            return json_encode($alerta);
            exit();
        }
    }
}
