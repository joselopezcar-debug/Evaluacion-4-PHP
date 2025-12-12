<?php
session_start();
require_once('./model/Usuario.php');
require_once('./config/Conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['email'] ?? '';
    $clave = $_POST['clave'] ?? '';
    
    $usuario = Usuario::autenticar($correo, $clave);
    
    if ($usuario) {
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php');
        exit();
    } else {
        header('Location: login.php?error=1');
        exit();
    }
}
?>