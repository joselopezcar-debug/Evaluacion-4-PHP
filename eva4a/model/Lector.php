<?php
require_once('./model/Persona.php');
require_once('./config/Conexion.php');
class Lector extends Persona {
    private $dni;
    
    public function getDni() {
        return $this->dni;
    }
    
    public function setDni($dni) {
        $this->dni = $dni;
    }
    
    public static function listarConConteoPrestamos() {
        $conn = Conexion::obtenerConexion();
        $sql = "SELECT l.id, l.nombre, l.dni, l.correo, 
                       COUNT(p.id) as cantidad_prestamos
                FROM lector l
                LEFT JOIN prestamo p ON l.id = p.id_lector
                GROUP BY l.id
                ORDER BY l.nombre";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $resultados = $stmt->fetchAll();
        $lectores = [];
        
        foreach ($resultados as $row) {
            $lector = new Lector();
            $lector->setId($row['id']);
            $lector->setNombre($row['nombre']);
            $lector->setDni($row['dni']);
            $lector->setCorreo($row['correo']);
            
            $lector->cantidad_prestamos = $row['cantidad_prestamos'];
            
            $lectores[] = $lector;
        }
        
        return $lectores;
    }
}
?>