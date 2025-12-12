<?php
abstract class Persona {
    protected $id;
    protected $nombre;
    protected $correo;
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function getCorreo() {
        return $this->correo;
    }
    
    public function setCorreo($correo) {
        $this->correo = $correo;
    }
}
?>