<?php
require_once __DIR__ . '/../config/Database.php';

class Profesor {
    // Obtener todos los profesores
    public static function getAll() {
        $db = Database::getConexion();
        $query = $db->query("SELECT * FROM profesores");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un profesor por su ID
    public static function getById($id) {
        $db = Database::getConexion();
        $query = $db->prepare("SELECT * FROM profesores WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener el curso asignado a un profesor
    public static function getCursoAsignado($id_profesor) {
        $db = Database::getConexion();
        $query = $db->prepare("SELECT cursos.nombre_curso, grado.grado 
                               FROM cursos 
                               JOIN grado ON cursos.id_grado = grado.id 
                               WHERE cursos.id_profesor = ?");
        $query->execute([$id_profesor]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo profesor
    public static function nuevo($nombre, $apellido, $especialidad, $id_usuario) {
        $db = Database::getConexion();
        $query = $db->prepare("INSERT INTO profesores (nombre, apellido, especialidad, id_usuario) VALUES (?, ?, ?, ?)");
        $query->execute([$nombre, $apellido, $especialidad, $id_usuario]);
    }

    // Editar un profesor
    public static function editar($id, $nombre, $apellido, $especialidad, $id_usuario) {
        $db = Database::getConexion();
        $query = $db->prepare("UPDATE profesores SET nombre = ?, apellido = ?, especialidad = ?, id_usuario = ? WHERE id = ?");
        $query->execute([$nombre, $apellido, $especialidad, $id_usuario, $id]);
    }

    // Eliminar un profesor
    public static function eliminar($id) {
        $db = Database::getConexion();
        $query = $db->prepare("DELETE FROM profesores WHERE id = ?");
        $query->execute([$id]);
    }
}
?>
