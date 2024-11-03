<?php
require_once __DIR__ . '/../config/Database.php';

class Grado {
    // Obtener todos los grados
    public static function getAll() {
        $db = Database::getConexion();
        $query = $db->query("SELECT * FROM grado");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un grado por su ID
    public static function getById($id) {
        $db = Database::getConexion();
        $query = $db->prepare("SELECT * FROM grado WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo grado
    public static function nuevo($grado) {
        $db = Database::getConexion();
        $query = $db->prepare("INSERT INTO grado (grado) VALUES (?)");
        $query->execute([$grado]);
    }

    // Editar un grado existente
    public static function editar($id, $grado) {
        $db = Database::getConexion();
        $query = $db->prepare("UPDATE grado SET grado = ? WHERE id = ?");
        $query->execute([$grado, $id]);
    }

    // Eliminar un grado
    public static function eliminar($id) {
        $db = Database::getConexion();
        $query = $db->prepare("DELETE FROM grado WHERE id = ?");
        $query->execute([$id]);
    }
}
