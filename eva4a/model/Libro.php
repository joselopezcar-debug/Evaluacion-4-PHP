<?php
require_once('./config/Conexion.php');
class Libro {
    private $id;
    private $titulo;
    private $autor;
    private $anio_publicacion;
    
    public function getId() { return $this->id; }
    public function getTitulo() { return $this->titulo; }
    public function getAutor() { return $this->autor; }
    public function getAnioPublicacion() { return $this->anio_publicacion; }
    
    public function setId($id) { $this->id = $id; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setAutor($autor) { $this->autor = $autor; }
    public function setAnioPublicacion($anio) { $this->anio_publicacion = $anio; }
    
    public static function listarTodos() {
        $conn = Conexion::obtenerConexion();
        $sql = "SELECT id, titulo FROM libro ORDER BY titulo";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $resultados = $stmt->fetchAll();
        $libros = [];
        
        foreach ($resultados as $row) {
            $libro = new Libro();
            $libro->setId($row['id']);
            $libro->setTitulo($row['titulo']);
            $libros[] = $libro;
        }
        
        return $libros;
    }
    
    public function obtenerLectorActivo($id_libro) {
        $conn = Conexion::obtenerConexion();
        $sql = "SELECT 
                    lec.nombre as lector_nombre,
                    lec.dni as lector_dni,
                    pre.fecha_prestamo,
                    lib.titulo as libro_titulo
                FROM prestamo pre
                JOIN lector lec ON pre.id_lector = lec.id
                JOIN libro lib ON pre.id_libro = lib.id
                WHERE pre.id_libro = :id_libro 
                AND pre.fecha_devolucion IS NULL
                LIMIT 1";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch();
    }
}
?>