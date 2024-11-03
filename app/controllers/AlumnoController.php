<?php
session_start();

require_once __DIR__ . '/../models/Alumno.php';
require_once __DIR__ . '/../models/Usuario.php';

class AlumnoController {
    public function dashboard() {
        $this->verificarRol('alumno');
    
        // Obtener el carnet del alumno desde la sesión (se asume que ahora contiene el carnet de la tabla alumnos)
        $carnet = $_SESSION['login_id']; // Este valor debe ser el carnet de la tabla 'alumnos'
        
        // Obtener asignaciones y calificaciones para el carnet del alumno en sesión
        $asignacionesYCalificaciones = Alumno::getAsignacionesYCalificaciones($carnet);
    
        require_once __DIR__ . '/../views/alumno_menu.php';
    }
    
    

    // Método para verificar el rol del usuario
    private function verificarRol($rol_requerido) {
        if (!isset($_SESSION['login_rol']) || $_SESSION['login_rol'] !== $rol_requerido) {
            header("Location: index.php?controller=login&action=index");
            exit();
        }
    }

    public function index() {
        $this->verificarRol('administrador');
        $alumnos = Alumno::getAll();
        $usuarios = Usuario::getAll();
        $grados = Alumno::getGrados();
        $action = 'index';
        $mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';

        require_once __DIR__ . '/../views/alumnos/gestion_alumno.php';
    }

    public function nuevo() {
        $this->verificarRol('administrador');
        $action = 'nuevo';
        $usuarios = Usuario::getAll();
        $grados = Alumno::getGrados();
        $mensaje = '';
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? null;
            $apellido = $_POST['apellido'] ?? null;
            $usuarioLogin = $_POST['usuario'] ?? null; 
            $idGrado = $_POST['id_grado'] ?? null;
            $descripcion = $_POST['descripcion'] ?? '';
        
            if (!$nombre || !$apellido || !$usuarioLogin || !$idGrado) {
                $error = 'Todos los campos son obligatorios.';
            } else {
                if (Alumno::nuevo($nombre, $apellido, $usuarioLogin, $idGrado, $descripcion)) {
                    header("Location: index.php?controller=Alumno&action=index&mensaje=Alumno creado exitosamente.");
                    exit;
                } else {
                    $error = 'Error al crear el alumno.';
                }
            }
        }

        require_once __DIR__ . '/../views/alumnos/gestion_alumno.php';
    }

    public function editar() {
        $this->verificarRol('administrador');
        $action = 'editar';
        $carnet = $_GET['carnet'] ?? null;
        $alumno = Alumno::getById($carnet);
        $usuarios = Usuario::getAll();
        $grados = Alumno::getGrados();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? null;
            $apellido = $_POST['apellido'] ?? null;
            $usuarioLogin = $_POST['usuario'] ?? null; 
            $idGrado = $_POST['id_grado'] ?? null;
            $descripcion = $_POST['descripcion'] ?? '';
    
            if (!$nombre || !$apellido || !$usuarioLogin || !$idGrado) {
                $error = 'Todos los campos son obligatorios.';
            } else {
                if (Alumno::editar($carnet, $nombre, $apellido, $usuarioLogin, $idGrado, $descripcion)) {
                    header("Location: index.php?controller=Alumno&action=index&mensaje=Alumno editado exitosamente.");
                    exit;
                } else {
                    $error = 'Error al editar el alumno.';
                }
            }
        }

        require_once __DIR__ . '/../views/alumnos/gestion_alumno.php';
    }

    public function eliminar() {
        $this->verificarRol('administrador');
        $carnet = $_GET['carnet'] ?? null;
        if (Alumno::eliminar($carnet)) {
            header("Location: index.php?controller=Alumno&action=index&mensaje=Alumno eliminado exitosamente.");
            exit;
        } else {
            $error = 'Error al eliminar el alumno.';
        }
    }
}
