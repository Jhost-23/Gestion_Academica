<?php
require_once __DIR__ . '/../config/Database.php';

class Calificacion {

    public static function getAll() {
        $db = Database::getConexion();
        $query = $db->query("SELECT c.*, alumnos.nombre AS nombre_alumno, cursos.nombre_curso
                             FROM calificaciones c
                             JOIN alumnos ON c.carnet = alumnos.carnet
                             JOIN cursos ON c.id_curso = cursos.id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::getConexion();
        $query = $db->prepare("SELECT c.*, alumnos.nombre AS nombre_alumno, cursos.nombre_curso
                               FROM calificaciones c
                               JOIN alumnos ON c.carnet = alumnos.carnet
                               JOIN cursos ON c.id_curso = cursos.id
                               WHERE c.id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function nuevo($carnet, $id_curso, $unidad, $nota) {
        $db = Database::getConexion();
        $query = $db->prepare("INSERT INTO calificaciones (carnet, id_curso, unidad, nota) VALUES (?, ?, ?, ?)");
        $query->execute([$carnet, $id_curso, $unidad, $nota]);
    }

    public static function editar($id, $carnet, $id_curso, $unidad, $nota) {
        $db = Database::getConexion();
        $query = $db->prepare("UPDATE calificaciones SET carnet = ?, id_curso = ?, unidad = ?, nota = ? WHERE id = ?");
        $query->execute([$carnet, $id_curso, $unidad, $nota, $id]);
    }

    public static function eliminar($id) {
        $db = Database::getConexion();
        $query = $db->prepare("DELETE FROM calificaciones WHERE id = ?");
        $query->execute([$id]);
    }
}
