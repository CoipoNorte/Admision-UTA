<?php
// Verificar si el usuario está autenticado
session_start();
if (!isset($_SESSION['usuario_id'])) {
    // Si no está autenticado, redirigir a la página de inicio de sesión
    header('Location: login.php');
    exit;
}
?>