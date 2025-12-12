<?php
require_once('./model/Persona.php');
require_once('./config/Conexion.php');

class Lector extends Persona {
    private $dni;
    public $cantidadPrestamos = 0; // propiedad para el conteo

    public function __construct($id = null, $nombre = null, $correo = null, $dni = null) {
        parent::__construct($id, $nombre, $correo);
        $this->dni = $dni;
    }

    public function getDni() { return $this->dni; }

    // Método estático que lista lectores con la cantidad total de préstamos (incluye activos y devueltos)
    public static function listarConConteoPrestamos() {
        $pdo = Conexion::getConexion();
        $sql = "SELECT l.id, l.nombre, l.correo, l.dni, COUNT(p.id) AS prestamos
                FROM lector l
                LEFT JOIN prestamo p ON p.id_lector = l.id
                GROUP BY l.id, l.nombre, l.correo, l.dni
                ORDER BY l.nombre";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = [];
        while ($r = $stmt->fetch()) {
            $lector = new Lector($r['id'], $r['nombre'], $r['correo'], $r['dni']);
            $lector->cantidadPrestamos = (int)$r['prestamos'];
            $result[] = $lector;
        }
        return $result; // array de objetos Lector
    }
}
?>