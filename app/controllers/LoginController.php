<?php

require_once __DIR__ . '/../config/Database.php';

class LoginController {

    public function index() {
        require_once __DIR__ . '/../views/login/index.php';
    }

    public function authenticate() {
        session_start();
        $conexion = Database::getConexion();

        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];

        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['login_id'] = $usuario['id']; // Asegúrate de que este campo exista en tu base de datos
                $_SESSION['id_usuario'] = $usuario['id']; // Agregamos esta línea
                $_SESSION['login_name'] = $usuario['nombre_completo'];
                $_SESSION['login_rol'] = $usuario['rol'];
                $_SESSION['login_time'] = time();

                if ($usuario['rol'] == 'administrador') {
                    header("Location: index.php?controller=admin&action=dashboard");
                } elseif ($usuario['rol'] == 'profesor') {
                    header("Location: index.php?controller=profesor&action=dashboard");
                } elseif ($usuario['rol'] == 'alumno') {
                    header("Location: index.php?controller=alumno&action=dashboard");
                }
            } else {
                echo '<script>alert("Contraseña incorrecta. Verifique sus credenciales."); window.location = "index.php?controller=login&action=index";</script>';
            }
        } else {
            echo '<script>alert("Usuario inválido. Verifique sus credenciales."); window.location = "index.php?controller=login&action=index";</script>';
        }

        exit();
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=login&action=index");
    }
}