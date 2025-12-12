<?php
session_start();

require_once('./model/Usuario.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
$clave  = isset($_POST['clave']) ? trim($_POST['clave']) : '';

if ($correo === '' || $clave === '') {
    header('Location: login.php?error=' . urlencode('Todos los campos son obligatorios'));
    exit;
}

$usuario = Usuario::login($correo, $clave);
if ($usuario) {
    $_SESSION['usuario'] = $usuario;
    header('Location: index.php');
    exit;
} else {
    header('Location: login.php?error=' . urlencode('Credenciales incorrectas'));
    exit;
}
?>