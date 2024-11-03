<?php
require_once __DIR__ . '/../models/Calificacion.php';
require_once __DIR__ . '/../models/Curso.php';
require_once __DIR__ . '/../models/Alumno.php';

class CalificacionController {

    public function index() {
        $calificaciones = Calificacion::getAll();
        $action = 'index';
        require_once __DIR__ . '/../../app/views/calificaciones/gestion_calificacion.php';
    }

    public function nuevo() {
        $action = 'nuevo';
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $carnet = $_POST['carnet'];
            $id_curso = $_POST['id_curso'];
            $unidad = $_POST['unidad'];
            $nota = $_POST['nota'];

            if (!empty($carnet) && !empty($id_curso) && !empty($unidad) && !empty($nota)) {
                Calificacion::nuevo($carnet, $id_curso, $unidad, $nota);
                header('Location: index.php?controller=Calificacion&action=index');
                exit();
            } else {
                $error = "Todos los campos son obligatorios.";
            }
        }

        $cursos = Curso::getAll();
        $alumnos = Alumno::getAll();
        require_once __DIR__ . '/../../app/views/calificaciones/gestion_calificacion.php';
    }

    public function editar() {
        $action = 'editar';
        $error = null;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $carnet = $_POST['carnet'];
                $id_curso = $_POST['id_curso'];
                $unidad = $_POST['unidad'];
                $nota = $_POST['nota'];

                if (!empty($carnet) && !empty($id_curso) && !empty($unidad) && !empty($nota)) {
                    Calificacion::editar($id, $carnet, $id_curso, $unidad, $nota);
                    header('Location: index.php?controller=Calificacion&action=index');
                    exit();
                } else {
                    $error = "Todos los campos son obligatorios.";
                }
            }

            $calificacion = Calificacion::getById($id);
            $cursos = Curso::getAll();
            $alumnos = Alumno::getAll();
            require_once __DIR__ . '/../../app/views/calificaciones/gestion_calificacion.php';
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Calificacion::eliminar($id);
            header('Location: index.php?controller=Calificacion&action=index');
            exit();
        }
    }

    public function imprimir() {
        $calificaciones = Calificacion::getAll();
        $action = 'imprimir';
        require_once __DIR__ . '/../../app/views/calificacio/imprimir_calificacion.php';
    }
}
