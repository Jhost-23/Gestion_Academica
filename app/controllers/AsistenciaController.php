<?php
require_once __DIR__ . '/../models/Asistencia.php';
require_once __DIR__ . '/../models/Curso.php';

class AsistenciaController {
    public function __construct() {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=gestion_academica', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            Asistencia::setConexion($pdo);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }

    public function index() {
        $asistencias = Asistencia::getAll();
        $cursos = Curso::getAll();
        require_once __DIR__ . '/../../app/views/asistencia/gestion_asistencia.php';
    }

    public function nuevo() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_curso = $_POST['id_curso'];
            $fecha = $_POST['fecha'];
            $asistencias = $_POST['asistencia'] ?? [];

            $alumnos = Asistencia::getAlumnosByCurso($id_curso);

            foreach ($alumnos as $alumno) {
                $estado = isset($asistencias[$alumno['carnet']]) ? $asistencias[$alumno['carnet']] : 'Ausente';
                Asistencia::nuevo($alumno['carnet'], $id_curso, $fecha, $estado);
            }

            header("Location: index.php?controller=Asistencia&action=index");
            exit();
        }

        $cursos = Curso::getAll();
        require_once __DIR__ . '/../../app/views/asistencia/gestion_asistencia.php';
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $asistencia = Asistencia::getById($id);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id_curso = $_POST['id_curso'];
                $fecha = $_POST['fecha'];
                $asistencias = $_POST['asistencia'] ?? [];
                $alumnos = Asistencia::getAlumnosByCurso($id_curso);
                foreach ($alumnos as $alumno) {
                    $estado = isset($asistencias[$alumno['carnet']]) ? $asistencias[$alumno['carnet']] : 'Ausente';
                    Asistencia::editar($id, $alumno['carnet'], $id_curso, $fecha, $estado);
                }
                header("Location: index.php?controller=Asistencia&action=index");
                exit();
            }
            $cursos = Curso::getAll();
            $alumnos = Asistencia::getAlumnosByCurso($asistencia['id_curso']);
            require_once __DIR__ . '/../../app/views/asistencia/gestion_asistencia.php';
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Asistencia::eliminar(id: $id);
            header("Location: index.php?controller=Asistencia&action=index");
            exit();
        }
    }

    public function imprimir() {
        $asistencias = Asistencia::getAll();
        $action = 'imprimir'; // Acción para la impresión
        require_once __DIR__ . '/../../app/views/Asistencia/imprimir_asistencia.php';
    }

    public function getAlumnos() {
        if (isset($_GET['id_curso'])) {
            Asistencia::getAlumnosJson($_GET['id_curso']);
        }
    }

    
}
?>
