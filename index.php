<?php

/* Incluir archivo para la conexión a la base de datos
include_once 'config.php';

$usuarios = [
    ['nico@example.com', password_hash('password', PASSWORD_DEFAULT)],
];

$query = "INSERT INTO usuarios (email, contrasena) VALUES (?, ?)";

$stmt = $db->prepare($query);

foreach ($usuarios as $usuario) {
    $stmt->execute($usuario);
}

echo 'Usuarios insertados correctamente.';
*/

header("Location: templates/login.php");
exit;
?>