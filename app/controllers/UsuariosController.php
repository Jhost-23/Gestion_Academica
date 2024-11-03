<?php

require_once __DIR__ . '/../models/Usuario.php';

class UsuariosController {

    /*** Acción para mostrar todos los usuarios */
    public function index() {
        $usuarios = Usuario::getAll();
        $action = 'index';
        $mensaje = '';

        if (isset($_GET['mensaje'])) {
            $mensaje = $_GET['mensaje'];
        }

        require_once __DIR__ . '/../../app/views/usuarios/gestion_usuario.php';
    }

    /*** Acción para crear un nuevo usuario */
    public function nuevo() {
        $action = 'nuevo';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombreCompleto = $_POST['nombre_completo'] ?? null;
            $correoElectronico = $_POST['correo'] ?? null;
            $rol = $_POST['rol'] ?? null;
            $usuarioLogin = $_POST['usuario'] ?? null;
            $contrasena = $_POST['contrasena'] ?? null;
            $numeroTel = $_POST['numero_tel'] ?? null;  // Número de teléfono

            if (!empty($nombreCompleto) && !empty($correoElectronico) && !empty($rol) && !empty($usuarioLogin) && !empty($contrasena) && !empty($numeroTel)) {
                $contrasenaHash = password_hash($contrasena, PASSWORD_BCRYPT);
                Usuario::nuevo($nombreCompleto, $correoElectronico, $rol, $usuarioLogin, $contrasenaHash, $numeroTel);
                $mensaje = "Usuario creado con éxito.";
                header('Location: index.php?controller=Usuarios&action=index&mensaje=' . urlencode($mensaje));
                exit();
            } else {
                $error = "Todos los campos son obligatorios.";
            }
        }

        require_once __DIR__ . '/../../app/views/usuarios/gestion_usuario.php';
    }

    /*** Acción para editar un usuario */
    public function editar() {
        $action = 'editar';
        $error = '';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombreCompleto = $_POST['nombre_completo'] ?? null;
                $correoElectronico = $_POST['correo'] ?? null;
                $rol = $_POST['rol'] ?? null;
                $usuarioLogin = $_POST['usuario'] ?? null;
                $numeroTel = $_POST['numero_tel'] ?? null;  // Número de teléfono

                if (!empty($nombreCompleto) && !empty($correoElectronico) && !empty($rol) && !empty($usuarioLogin) && !empty($numeroTel)) {
                    $usuario = Usuario::getById($id);
                    if ($usuario) {
                        Usuario::editar($id, $nombreCompleto, $correoElectronico, $rol, $usuarioLogin, $numeroTel);
                        $mensaje = "Usuario editado con éxito.";
                        header('Location: index.php?controller=Usuarios&action=index&mensaje=' . urlencode($mensaje));
                        exit();
                    } else {
                        $error = "El usuario no existe.";
                    }
                } else {
                    $error = "Todos los campos son obligatorios.";
                }
            } else {
                $usuario = Usuario::getById($id);
                if (!$usuario) {
                    $error = "El usuario no existe.";
                }
            }
        }

        require_once __DIR__ . '/../../app/views/usuarios/gestion_usuario.php';
    }

    /*** Acción para eliminar un usuario */
    public function eliminar() {
        $error = '';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuario = Usuario::getById($id);
            if ($usuario) {
                Usuario::eliminar($id);
                $mensaje = "Usuario eliminado con éxito.";
                header('Location: index.php?controller=Usuarios&action=index&mensaje=' . urlencode($mensaje));
                exit();
            } else {
                $error = "El usuario no existe.";
            }
        }
    }
}
?>
