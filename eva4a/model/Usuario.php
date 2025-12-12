<?php

class Usuario {
private $id;
    private $nombre;
    private $correo;
    private $clave;
    private $id_rol;
    
    public function __construct($id = null, $nombre = null, $correo = null, $clave = null, $id_rol = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->id_rol = $id_rol;
    }
    
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getCorreo() { return $this->correo; }
    public function getIdRol() { return $this->id_rol; }
    
    public static function autenticar($correo, $clave) {
        $conn = Conexion::obtenerConexion();
        $sql = "SELECT id, nombre, correo, clave, id_rol FROM usuario WHERE correo = :correo";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        
        $resultado = $stmt->fetch();
        
        if ($resultado && $clave === $resultado['clave']) {
            return new Usuario(
                $resultado['id'],
                $resultado['nombre'],
                $resultado['correo'],
                $resultado['clave'],
                $resultado['id_rol']
            );
        }
        return null;
    }
}
?>