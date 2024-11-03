<?php
require_once __DIR__ . '/../models/Especialidad.php';

class EspecialidadController {

    // Acción para mostrar todas las especialidades
    public function index() {
        $especialidades = Especialidad::getAll();
        $action = 'index'; // Acción actual
        require_once __DIR__ . '/../../app/views/especialidad/gestion_especialidad.php';
    }

    // Acción para crear una nueva especialidad
    public function nuevo() {
        $action = 'nuevo'; // Acción actual
        $error = null; // Inicializa el error como nulo

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descripcion = $_POST['descripcion'];

            // Validación de campos
            if (!empty($descripcion)) {
                Especialidad::nuevo($descripcion);
                header('Location: index.php?controller=Especialidad&action=index');
                exit();
            } else {
                $error = "La descripción es obligatoria.";
            }
        }

        require_once __DIR__ . '/../../app/views/especialidad/gestion_especialidad.php';
    }

    // Acción para editar una especialidad
    public function editar() {
        $action = 'editar'; // Acción actual
        $error = null; // Inicializa el error como nulo

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $descripcion = $_POST['descripcion'];

                // Validación de campos
                if (!empty($descripcion)) {
                    Especialidad::editar($id, $descripcion);
                    header('Location: index.php?controller=Especialidad&action=index');
                    exit();
                } else {
                    $error = "La descripción es obligatoria.";
                }
            }

            $especialidad = Especialidad::getById($id);
            require_once __DIR__ . '/../../app/views/especialidad/gestion_especialidad.php';
        }
    }

    // Acción para eliminar una especialidad
    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Especialidad::eliminar($id);
            header('Location: index.php?controller=Especialidad&action=index');
            exit();
        }
    }
}
