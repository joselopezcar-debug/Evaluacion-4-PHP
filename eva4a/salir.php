<?php
if (session_status() === PHP_SESSION_NONE){
    session_start();
}

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    
}
?>