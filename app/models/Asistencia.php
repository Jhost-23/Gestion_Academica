<?php
require_once __DIR__ . '/../config/Database.php'; // Asegúrate de que la ruta sea correcta

class Asistencia {
    private static $pdo;

    public static function setConexion($pdo) {
        self::$pdo = $pdo;
    }

    public static function getAll() {
        try {
            $query = "SELECT a.*, alu.nombre AS nombre_alumno, alu.apellido AS apellido_alumno, cur.nombre_curso 
                      FROM asistencia a 
                      JOIN alumnos alu ON a.carnet = alu.carnet 
                      JOIN cursos cur ON a.id_curso = cur.id";

            $stmt = self::$pdo->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public static function getAlumnosByCurso($idCurso) {
        $query = self::$pdo->prepare("SELECT * FROM alumnos WHERE id_grado = (SELECT id_grado FROM cursos WHERE id = ?)");
        $query->execute([$idCurso]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear nueva asistencia
    public static function nuevo($carnet, $id_curso, $fecha, $estado) {
        $stmt = self::$pdo->prepare("INSERT INTO asistencia (carnet, id_curso, fecha, estado) VALUES (?, ?, ?, ?)");
        $stmt->execute([$carnet, $id_curso, $fecha, $estado]);
    }

    public static function editar($id, $carnet, $id_curso, $fecha, $estado) {
        $stmt = self::$pdo->prepare("UPDATE asistencia SET carnet = ?, id_curso = ?, fecha = ?, estado = ? WHERE id = ?");
        return $stmt->execute([$carnet, $id_curso, $fecha, $estado, $id]);
    }

    public static function eliminar($id) {
        $stmt = self::$pdo->prepare("DELETE FROM asistencia WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function getById($id) {
        $stmt = self::$pdo->prepare("SELECT * FROM asistencia WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAlumnosJson($idCurso) {
        $alumnos = self::getAlumnosByCurso($idCurso);
        echo json_encode($alumnos);
        exit();
    }
}
?>
