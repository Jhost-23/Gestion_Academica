<?php
require_once __DIR__ . '/../models/Grado.php'; // Asegúrate de que la ruta sea correcta

class GradoController {

    // Acción para mostrar todos los grados
    public function index() {
        $grados = Grado::getAll();
        $action = 'index'; // Acción actual
        require_once __DIR__ . '/../../app/views/grado/gestion_grado.php';
    }

    // Acción para crear un nuevo grado
    public function nuevo() {
        $action = 'nuevo'; // Acción actual
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $grado = $_POST['grado'];

            if (!empty($grado)) {
                Grado::nuevo($grado);
                header('Location: index.php?controller=Grado&action=index');
                exit();
            } else {
                $error = "El nombre del grado es obligatorio.";
            }
        }
        require_once __DIR__ . '/../../app/views/grado/gestion_grado.php';
    }

    // Acción para editar un grado
    public function editar() {
        $action = 'editar'; // Acción actual
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $grado = $_POST['grado'];

                if (!empty($grado)) {
                    Grado::editar($id, $grado);
                    header('Location: index.php?controller=Grado&action=index');
                    exit();
                } else {
                    $error = "El nombre del grado es obligatorio.";
                }
            }

            $grado = Grado::getById($id);
            require_once __DIR__ . '/../../app/views/grado/gestion_grado.php';
        }
    }

    // Acción para eliminar un grado
    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Grado::eliminar($id);
            header('Location: index.php?controller=Grado&action=index');
            exit();
        }
    }
}
