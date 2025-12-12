<?php
class Conexion {
<?php

class Conexion {
    private static $instancia = null;
    
    private function __construct() {}
    
    public static function obtenerConexion() {
        if (self::$instancia === null) {
            try {
                $host = '127.0.0.1';
                $dbname = 'bd_biblioteca';
                $usuario = 'root';
                $password = '';
                
                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
                self::$instancia = new PDO($dsn, $usuario, $password);
                self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instancia->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}
    }
}
?>