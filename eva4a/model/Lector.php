<?php
require_once("./model/Persona.php");
class Lector extends Persona {
    private $dni;
    
    public function getDni(){
        return $this -> dni;
    }
    public function setDni(){
        $this -> dni = $dni;
    }
}
?>