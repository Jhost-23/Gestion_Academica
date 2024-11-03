<?php
require_once __DIR__ . '/../config/Database.php';

class Asignacion {
    // Obtener todas las asignaciones
    public static function getAll() {
        $db = Database::getConexion();
        $query = $db->query("SELECT asignacion_cursos.*, alumnos.nombre AS nombre_alumno, cursos.nombre_curso 
                             FROM asignacion_cursos 
                             LEFT JOIN alumnos ON asignacion_cursos.carnet = alumnos.carnet 
                             LEFT JOIN cursos ON asignacion_cursos.id_curso = cursos.id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una asignación por su ID
    public static function getById($id) {
        $db = Database::getConexion();
        $query = $db->prepare("SELECT * FROM asignacion_cursos WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar una nueva asignación
    public static function nuevo($carnet, $id_curso) {
        $db = Database::getConexion();
        $query = $db->prepare("INSERT INTO asignacion_cursos (carnet, id_curso) VALUES (?, ?)");

        if (!$query->execute([$carnet, $id_curso])) {
            echo "Error al insertar la asignación: ";
            print_r($query->errorInfo());
        }
    }

    // Editar una asignación existente
    public static function editar($id, $carnet, $id_curso) {
        $db = Database::getConexion();
        $query = $db->prepare("UPDATE asignacion_cursos SET carnet = ?, id_curso = ? WHERE id = ?");
        if (!$query->execute([$carnet, $id_curso, $id])) {
            echo "Error al actualizar la asignación: ";
            print_r($query->errorInfo());
        }
    }

    // Eliminar una asignación
    public static function eliminar($id) {
        $db = Database::getConexion();
        $query = $db->prepare("DELETE FROM asignacion_cursos WHERE id = ?");
        if (!$query->execute([$id])) {
            echo "Error al eliminar la asignación: ";
            print_r($query->errorInfo());
        }
    }
}

?>
