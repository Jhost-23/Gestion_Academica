<?php
class Database {
    private static $conexion = null;

    public static function getConexion() {
        if (self::$conexion === null) {
            try {
                self::$conexion = new PDO('mysql:host=localhost;dbname=gestion_academica', 'root', '');
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());  // Cambiado a die() para claridad en errores críticos
            }
        }
        return self::$conexion;
    }
}
?>
