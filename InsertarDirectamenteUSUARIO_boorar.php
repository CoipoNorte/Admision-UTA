<?php
// Incluir tu archivo de configuración de la base de datos
include_once 'config.php';

// Datos del nuevo usuario
$email = "don_ivan@example.com";
$contrasena = "password";

// Hashear la contraseña
$hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

try {
    // Insertar el nuevo usuario en la base de datos
    $stmt = $db->prepare("INSERT INTO usuarios (email, contrasena) VALUES (:email, :contrasena)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':contrasena', $hashedPassword);
    $stmt->execute();

    echo "Usuario insertado correctamente.";
} catch (PDOException $e) {
    // Manejar errores de base de datos
    echo "Error al insertar usuario: " . $e->getMessage();
}
?>