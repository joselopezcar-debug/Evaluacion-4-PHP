<?php
require_once('./config/Conexion.php');

class Usuario {
    public $id;
    public $nombre;
    public $correo;
    public $id_rol;

    public function __construct($id = null, $nombre = null, $correo = null, $id_rol = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->id_rol = $id_rol;
    }

    public static function login($correo, $clave) {
        $pdo = Conexion::getConexion();
        $sql = "SELECT id, nombre, correo, id_rol FROM usuario WHERE correo = :correo AND clave = :clave LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['correo' => $correo, 'clave' => $clave]);
        $row = $stmt->fetch();
        if ($row) {
            return new Usuario($row['id'], $row['nombre'], $row['correo'], $row['id_rol']);
        }
        return null;
    }
}
?>