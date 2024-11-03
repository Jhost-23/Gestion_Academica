<?php
session_start(); // Iniciar sesión si no se ha hecho ya

class AdminController {

    public function dashboard() {
        // Verificar si el usuario es administrador
        $this->verificarRol('administrador');
        
        // Mostrar la vista del menú del administrador
        require_once __DIR__ . '/../views/admin_menu.php';
    }

    // Función para verificar el rol del usuario
    private function verificarRol($rol_requerido) {
        if (!isset($_SESSION['login_rol']) || $_SESSION['login_rol'] !== $rol_requerido) {
            // Redirigir al login si el usuario no tiene el rol requerido
            header("Location: index.php?controller=login&action=index");
            exit();
        }
    }
}
?>
