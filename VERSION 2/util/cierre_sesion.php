<?php
// Verificar si se ha enviado el formulario de cierre de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cerrar_sesion'])) {
    // Destruir la sesión actual
    session_start();
    session_destroy();

    // Redirigir a la página de inicio de sesión
    header('Location: login.php');
    exit;
}
?>