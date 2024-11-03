<?php
require_once __DIR__ . '/../config/Database.php'; // Asegúrate de que la ruta sea correcta

class Curso {

 

    // Obtener todos los cursos con nombre del grado y profesor
    public static function getAll() {
        $db = Database::getConexion();
        $query = $db->query("SELECT cursos.*, 
                                    grado.grado AS nombre_grado, 
                                    profesores.nombre AS nombre_profesor 
                             FROM cursos 
                             JOIN grado ON cursos.id_grado = grado.id 
                             LEFT JOIN profesores ON cursos.id_profesor = profesores.id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un curso por su ID
    public static function getById($id) {
        $db = Database::getConexion();
        $query = $db->prepare("SELECT * FROM cursos WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar un nuevo curso
    public static function nuevo($nombre, $descripcion, $id_profesor, $id_grado) {
        $db = Database::getConexion();
        $query = $db->prepare("INSERT INTO cursos (nombre_curso, descripcion, id_profesor, id_grado) VALUES (?, ?, ?, ?)");
        $query->execute([$nombre, $descripcion, $id_profesor, $id_grado]);
    }

    // Editar un curso existente
    public static function editar($id, $nombre, $descripcion, $id_profesor, $id_grado) {
        $db = Database::getConexion();
        $query = $db->prepare("UPDATE cursos SET nombre_curso = ?, descripcion = ?, id_profesor = ?, id_grado = ? WHERE id = ?");
        $query->execute([$nombre, $descripcion, $id_profesor, $id_grado, $id]);
    }

    // Eliminar un curso
    public static function eliminar($id) {
        $db = Database::getConexion();
        $query = $db->prepare("DELETE FROM cursos WHERE id = ?");
        $query->execute([$id]);
    }
}
?>
