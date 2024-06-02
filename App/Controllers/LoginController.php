<?php

namespace App\Controllers;

use App\Models\MainModel;

class LoginController extends MainModel
{

    // Controlador para iniciar sesion
    public function iniciarSesionControlador()
    {
        $nombreUsuario = $this->limpiarCadena($_POST['login_usuario']);
        $clave = $this->limpiarCadena($_POST['login_clave']);

        // verificar campos obligatorios
        if ($nombreUsuario == "" || $clave == "") {
            echo "<script>
                Swal.fire({
                        title: 'Ocurrió un error',
                        text: 'Por favor, revise los campos obligatorios',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
            </script>";
        } else {
            if ($this->verificarDatos("[a-zA-Z0-9]{4,20}", $nombreUsuario)) {
                echo "<script>
                Swal.fire({
                        title: 'Ocurrió un error',
                        text: 'El usuario no coincide con el formato requerido',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
            </script>";
            } else {
                if ($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
                    echo "<script>
                    Swal.fire({
                            title: 'Ocurrió un error',
                            text: 'La clave no coincide con el formato requerido',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        }); 
                </script>";
                } else {
                    $check_usuario = $this->ejecutarConsulta("SELECT * FROM usuario 
                    WHERE usuario_usuario  = '$nombreUsuario'");
                    if ($check_usuario->rowCount() > 0) {
                        //Selecion de todos los datos de la fila
                        $check_usuario = $check_usuario->fetch();
                        if ($check_usuario['usuario_usuario'] == $nombreUsuario && password_verify($clave, $check_usuario['usuario_clave'])) {
                           $_SESSION['id']=$check_usuario['usuario_id'];
                           $_SESSION['nombre']=$check_usuario['usuario_nombre'];
                           $_SESSION['apellido']=$check_usuario['usuario_apellido'];
                           $_SESSION['usuario']=$check_usuario['usuario_usuario'];
                           $_SESSION['foto']=$check_usuario['usuario_foto'];
                           if (headers_sent()) {
                              echo "<script>window.location.href='".APP_URL."dashboard/;'</script>";
                           }else{
                                header("Location: ".APP_URL."dashboard/");
                           }

                        } else {
                            echo "<script>
                            Swal.fire({
                                    title: 'Ocurrió un error',
                                    text: 'El usuario o clave incorrecto',
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar'
                                }); 
                        </script>";
                        }
                    } else {
                        echo "<script>
                        Swal.fire({
                                title: 'Ocurrió un error',
                                text: 'El usuario o clave incorrecto',
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            }); 
                    </script>";
                    }
                }
            }
        }
    }

    // Controlador para cerrar sesion
    public function cerrarSesionControlador()
    {
        session_destroy();
        if (headers_sent()) {
            echo "<script>window.location.href='".APP_URL."login/;'</script>";
        } else {
            header("Location: ".APP_URL."login/");
        }
    }
}
