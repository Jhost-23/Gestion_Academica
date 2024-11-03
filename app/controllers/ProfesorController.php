<?php
session_start(); // Iniciar sesión si no se ha hecho ya
require_once __DIR__ . '/../models/Profesor.php'; // Asegúrate de que la ruta sea correcta

class ProfesorController {

    // Acción para mostrar el dashboard del profesor
    public function dashboard() {
        // Verificar si el usuario es profesor
        $this->verificarRol('profesor');

        // Obtener el ID del profesor logueado
        $id_profesor = $_SESSION['id_usuario']; // Este ahora se establece correctamente

        // Obtener los cursos asignados al profesor
        $cursos_asignados = Profesor::getCursoAsignado($id_profesor);

        // Mostrar la vista del dashboard del profesor con los cursos asignados
        require_once __DIR__ . '/../views/profesor_menu.php';
    }

    // Función para verificar el rol del usuario
    private function verificarRol($rol_requerido) {
        if (!isset($_SESSION['login_rol']) || $_SESSION['login_rol'] !== $rol_requerido) {
            header("Location: index.php?controller=login&action=index");
            exit();
        }
    }

    // Mostrar todos los profesores (solo para administrador)
    public function index(): void {
        $this->verificarRol('administrador'); // Solo el administrador puede acceder
        $profesores = Profesor::getAll();
        $action = 'index'; // Acción actual
        require_once __DIR__ . '/../views/profesores/gestion_profesor.php';
    }

    // Crear un nuevo profesor (solo para administrador)
    public function nuevo() {
        $this->verificarRol('administrador'); // Solo el administrador puede acceder
        $action = 'nuevo'; // Acción actual
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $especialidad = $_POST['especialidad'];
            $id_usuario = $_POST['id_usuario'];

            if (!empty($nombre) && !empty($apellido) && !empty($especialidad) && !empty($id_usuario)) {
                Profesor::nuevo($nombre, $apellido, $especialidad, $id_usuario);
                header('Location: index.php?controller=Profesor&action=index');
                exit();
            } else {
                $error = "Todos los campos son obligatorios.";
            }
        }
        require_once __DIR__ . '/../views/profesores/gestion_profesor.php';
    }

    // Editar un profesor (solo para administrador)
    public function editar() {
        $this->verificarRol('administrador'); // Solo el administrador puede acceder
        $action = 'editar'; // Acción actual
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $especialidad = $_POST['especialidad'];
                $id_usuario = $_POST['id_usuario'];

                if (!empty($nombre) && !empty($apellido) && !empty($especialidad) && !empty($id_usuario)) {
                    Profesor::editar($id, $nombre, $apellido, $especialidad, $id_usuario);
                    header('Location: index.php?controller=Profesor&action=index');
                    exit();
                } else {
                    $error = "Todos los campos son obligatorios.";
                }
            }

            $profesor = Profesor::getById($id);
            require_once __DIR__ . '/../views/profesores/gestion_profesor.php';
        }
    }

    // Eliminar un profesor (solo para administrador)
    public function eliminar() {
        $this->verificarRol('administrador'); // Solo el administrador puede acceder
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Profesor::eliminar($id);
            header('Location: index.php?controller=Profesor&action=index');
            exit();
        }
    }

    // Método para acceder al módulo de asistencia
    public function asistencia() {
        $this->verificarRol('profesor'); // Solo el profesor puede acceder
        // Aquí puedes implementar la lógica para mostrar la asistencia
        require_once __DIR__ . '/../views/asistencia/gestion_asistencia.php'; // Cambia la ruta si es necesario
    }

    // Método para acceder al módulo de calificaciones
    public function calificaciones() {
        $this->verificarRol('profesor'); // Solo el profesor puede acceder
        // Aquí puedes implementar la lógica para mostrar las calificaciones
        require_once __DIR__ . '/../views/calificaciones/gestion_calificacion.php'; // Cambia la ruta si es necesario
    }
}
?>