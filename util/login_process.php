<?php
// Incluir tu archivo de configuración de la base de datos
include_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $recordar = isset($_POST['recordar']) ? true : false;

    // Validación de datos
    if (empty($email) || empty($contrasena)) {
        // Mostrar un mensaje de error y redirigir a la página de inicio de sesión
        echo "<script>alert('Por favor, complete todos los campos.'); window.location.href = 'login.php';</script>";
        exit;
    }

    // Verificar la autenticación en la base de datos
    try {
        $stmt = $db->prepare("SELECT id, contrasena FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y la contraseña es válida
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            // Iniciar sesión (puedes usar sesiones PHP)
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];

            // Recordar el correo electrónico si se marcó la casilla "Recordarme"
            if ($recordar) {
                setcookie('recordar_email', $email, time() + 30 * 24 * 60 * 60); // Validez por 30 días
            }

            // Redirigir al usuario a la página deseada
            header('Location: ../templates/botones.php');
            exit;
        } else {
            // Mostrar un mensaje de error y redirigir a la página de inicio de sesión
            echo "<script>alert('Credenciales incorrectas.'); window.location.href = '../templates/login.php';</script>";
            exit;
        }
    } catch (PDOException $e) {
        // Mostrar un mensaje de error y redirigir a la página de inicio de sesión
        echo "<script>alert('Error de base de datos.'); window.location.href = '../templates/login.php';</script>";
        exit;
    }
}
?>
