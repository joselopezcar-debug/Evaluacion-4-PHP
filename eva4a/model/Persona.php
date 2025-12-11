<?php
abstract class Persona {
    private $id;
    private $nombre;
    private $correo;

    public function Getid() {
        return $this -> id;
    }
    public function Setid() {
        $this -> id = $id;
    }

    public function Getnombre() {
        return $this -> nombre;
    }
    public function Setnombre() {
        $this -> nombre = $nombre;
    }

    public function Getcorreo() {
        return $this -> correo;
    }
    public function Setcorreo() {
        $this -> correo = $correo;
    }
}
?>