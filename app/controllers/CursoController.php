<?php

require_once __DIR__ . '/../models/Curso.php'; // Ruta correcta al modelo Curso
require_once __DIR__ . '/../models/Profesor.php'; // Incluir el modelo Profesor
require_once __DIR__ . '/../models/Grado.php'; // Incluir el modelo Grado

class CursoController {

    
    // Acción para mostrar todos los cursos
    public function index() {
        $cursos = Curso::getAll();
        $action = 'index'; // Acción actual
        require_once __DIR__ . '/../../app/views/cursos/gestion_curso.php';
    }

    // Acción para crear un nuevo curso
    public function nuevo() {
        $action = 'nuevo'; // Acción actual
        $error = null; // Inicializa el error como nulo

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $id_profesor = $_POST['id_profesor'];
            $id_grado = $_POST['id_grado'];

            // Validación de campos
            if (!empty($nombre) && !empty($descripcion) && !empty($id_profesor) && !empty($id_grado)) {
                Curso::nuevo($nombre, $descripcion, $id_profesor, $id_grado);
                header('Location: index.php?controller=Curso&action=index');
                exit();
            } else {
                $error = "Todos los campos son obligatorios.";
            }
        }

        // Carga profesores y grados para el formulario
        $profesores = Profesor::getAll();
        $grados = Grado::getAll();
        require_once __DIR__ . '/../../app/views/cursos/gestion_curso.php';
    }

    // Acción para editar un curso
    public function editar() {
        $action = 'editar'; // Acción actual
        $error = null; // Inicializa el error como nulo

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $id_profesor = $_POST['id_profesor'];
                $id_grado = $_POST['id_grado'];

                // Validación de campos
                if (!empty($nombre) && !empty($descripcion) && !empty($id_profesor) && !empty($id_grado)) {
                    Curso::editar($id, $nombre, $descripcion, $id_profesor, $id_grado);
                    header('Location: index.php?controller=Curso&action=index');
                    exit();
                } else {
                    $error = "Todos los campos son obligatorios.";
                }
            }

            $curso = Curso::getById($id);
            $profesores = Profesor::getAll();
            $grados = Grado::getAll();
            require_once __DIR__ . '/../../app/views/cursos/gestion_curso.php';
        }
    }

    // Acción para eliminar un curso
    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Curso::eliminar($id);
            header('Location: index.php?controller=Curso&action=index');
            exit();
        }
    }
}
