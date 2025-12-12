<?php
require_once ('./config/Conexion.php');

class Libro {
    public $id;
    public $titulo;

    public function __construct($id = null, $titulo = null) {
        $this->id = $id;
        $this->titulo = $titulo;
    }

    public static function listarTodos() {
        $pdo = Conexion::getConexion();
        $sql = "SELECT id, titulo FROM libro ORDER BY titulo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $arr = [];
        while ($r = $stmt->fetch()) {
            $arr[] = new Libro($r['id'], $r['titulo']);
        }
        return $arr;
    }

    public function obtenerLectorActivo($id_libro) {
        $pdo = Conexion::getConexion();
        $sql = "SELECT lec.nombre, lec.dni, p.fecha_prestamo
                FROM prestamo p
                JOIN lector lec ON p.id_lector = lec.id
                WHERE p.id_libro = :id_libro AND p.fecha_devolucion IS NULL
                LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_libro' => $id_libro]);
        $row = $stmt->fetch();
        if ($row) {
            return [
                'nombre' => $row['nombre'],
                'dni' => $row['dni'],
                'fecha_prestamo' => $row['fecha_prestamo']
            ];
        }
        return null;
    }
}
?>