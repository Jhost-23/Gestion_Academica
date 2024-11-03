<?php

require_once __DIR__ . '/../config/Database.php';

class Usuario {

    // Obtener todos los usuarios
    public static function getAll() {
        $db = Database::getConexion();
        $query = $db->query("SELECT * FROM usuarios");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo usuario
    public static function nuevo($nombreCompleto, $correoElectronico, $rol, $usuarioLogin, $contrasenaHash, $numeroTel) {
        $db = Database::getConexion();
        $stmt = $db->prepare("INSERT INTO usuarios (nombre_completo, correo, rol, usuario, contrasena, numero_tel) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute(params: [$nombreCompleto, $correoElectronico, $rol, $usuarioLogin, $contrasenaHash, $numeroTel]);
    }

    // Obtener usuario por id
    public static function getById($id) {
        $db = Database::getConexion();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Editar usuario
    public static function editar($id, $nombreCompleto, $correoElectronico, $rol, $usuarioLogin, $numeroTel) {
        $db = Database::getConexion();
        $stmt = $db->prepare("UPDATE usuarios SET nombre_completo = ?, correo = ?, rol = ?, usuario = ?, numero_tel = ? WHERE id = ?");
        return $stmt->execute([$nombreCompleto, $correoElectronico, $rol, $usuarioLogin, $numeroTel, $id]);
    }

    // Eliminar usuario
    public static function eliminar($id) {
        $db = Database::getConexion();
        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
