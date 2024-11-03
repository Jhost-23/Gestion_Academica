<?php
require_once __DIR__ . '/../config/Database.php'; // Asegúrate de que la ruta sea correcta

class Especialidad {
    // Obtener todas las especialidades
    public static function getAll() {
        $db = Database::getConexion();
        $query = $db->query("SELECT * FROM especialidades");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una especialidad por su ID
    public static function getById($id) {
        $db = Database::getConexion();
        $query = $db->prepare("SELECT * FROM especialidades WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar una nueva especialidad
    public static function nuevo($descripcion) {
        $db = Database::getConexion();
        $query = $db->prepare("INSERT INTO especialidades (descripcion) VALUES (?)");
        $query->execute([$descripcion]);
    }

    // Editar una especialidad existente
    public static function editar($id, $descripcion) {
        $db = Database::getConexion();
        $query = $db->prepare("UPDATE especialidades SET descripcion = ? WHERE id = ?");
        $query->execute([$descripcion, $id]);
    }

    // Eliminar una especialidad
    public static function eliminar($id) {
        $db = Database::getConexion();
        $query = $db->prepare("DELETE FROM especialidades WHERE id = ?");
        $query->execute([$id]);
    }
}
