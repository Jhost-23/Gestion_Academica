<?php
require_once __DIR__ . '/../models/Asignacion.php';
require_once __DIR__ . '/../models/Alumno.php';
require_once __DIR__ . '/../models/Curso.php';
class AsignacionController {
    public function index() {
        $asignaciones = Asignacion::getAll();
        $action = 'index';
        require_once __DIR__ . '/../../app/views/Asignacion/gestion_asignacion.php';
    }

    public function nuevo() {
        $action = 'nuevo';
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $carnet = $_POST['carnet'];
            $id_curso = $_POST['id_curso'];

            if (!empty($carnet) && !empty($id_curso)) {
                Asignacion::nuevo($carnet, $id_curso);
                echo "Asignación creada correctamente.";
                header('Location: index.php?controller=Asignacion&action=index');
                exit();
            } else {
                $error = "Todos los campos son obligatorios.";
            }
        }

        $alumnos = Alumno::getAll();
        $cursos = Curso::getAll();
        require_once __DIR__ . '/../../app/views/Asignacion/gestion_asignacion.php';
    }

    public function editar() {
        $action = 'editar';
        $error = null;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $carnet = $_POST['carnet'];
                $id_curso = $_POST['id_curso'];

                if (!empty($carnet) && !empty($id_curso)) {
                    Asignacion::editar($id, $carnet, $id_curso);
                    header('Location: index.php?controller=Asignacion&action=index');
                    exit();
                } else {
                    $error = "Todos los campos son obligatorios.";
                }
            }

            $asignacion = Asignacion::getById($id);
            $alumnos = Alumno::getAll();
            $cursos = Curso::getAll();
            require_once __DIR__ . '/../../app/views/Asignacion/gestion_asignacion.php';
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Asignacion::eliminar($id);
            header('Location: index.php?controller=Asignacion&action=index');
            exit();
        }
    }
}

?>
