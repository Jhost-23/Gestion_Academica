<?php

require_once __DIR__ . '/../config/Database.php';

class Alumno {

    public static function getAsignacionesYCalificaciones($carnet) {
        $db = Database::getConexion();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("
            SELECT 
                cursos.nombre_curso,
                cursos.descripcion AS descripcion_curso,
                calificaciones.unidad,
                calificaciones.nota,
                asignacion_cursos.creado_en AS fecha_asignacion
            FROM 
                alumnos
            JOIN 
                asignacion_cursos ON alumnos.carnet = asignacion_cursos.carnet
            JOIN 
                cursos ON asignacion_cursos.id_curso = cursos.id
            LEFT JOIN 
                calificaciones ON asignacion_cursos.carnet = calificaciones.carnet 
                AND asignacion_cursos.id_curso = calificaciones.id_curso
            WHERE 
                alumnos.carnet = :carnet;
        ");
        $stmt->bindParam(':carnet', $carnet, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($result)) {
                echo "No se encontraron asignaciones y calificaciones para el carnet: $carnet.";
            }
            return $result;
        } else {
            print_r($stmt->errorInfo());
            return [];
        }
    }

    public static function getAll() {
        $db = Database::getConexion();
        $query = $db->query("SELECT alumnos.*, usuarios.usuario AS nombre_usuario, grado.grado AS nombre_grado 
                             FROM alumnos 
                             JOIN usuarios ON alumnos.usuario = usuarios.usuario 
                             LEFT JOIN grado ON alumnos.id_grado = grado.id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($carnet) {
        $db = Database::getConexion();
        $stmt = $db->prepare("SELECT * FROM alumnos WHERE carnet = ?");
        $stmt->execute([$carnet]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function nuevo($nombre, $apellido, $usuarioLogin, $idGrado, $descripcion) {
        $db = Database::getConexion();
        $stmt = $db->prepare("INSERT INTO alumnos (nombre, apellido, usuario, id_grado, descripcion) 
                              VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $apellido, $usuarioLogin, $idGrado, $descripcion]);
    }

    public static function editar($carnet, $nombre, $apellido, $usuarioLogin, $idGrado, $descripcion) {
        $db = Database::getConexion();
        $stmt = $db->prepare("UPDATE alumnos 
                              SET nombre = ?, apellido = ?, usuario = ?, id_grado = ?, descripcion = ? 
                              WHERE carnet = ?");
        return $stmt->execute([$nombre, $apellido, $usuarioLogin, $idGrado, $descripcion, $carnet]);
    }

    public static function eliminar($carnet) {
        $db = Database::getConexion();
        $stmt = $db->prepare("DELETE FROM alumnos WHERE carnet = ?");
        return $stmt->execute([$carnet]);
    }

    public static function getGrados() {
        $db = Database::getConexion();
        $query = $db->query("SELECT * FROM grado");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
