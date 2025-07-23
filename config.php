<?php
// config.php
/* $host = "localhost";
   $port = "";
   $dbname = "";
   $user = "";
   $password = "";
   
   $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
   
   try {
       $db = new PDO($dsn);
       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $e) {
       die("Error de conexión a la base de datos: " . $e->getMessage());
   } */


// config.php para MySQL sin contraseña

/*
Crear db admision
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL
);
*/

$host = "localhost";
$dbname = "admision";
$user = "root";
$password = ""; // sin contraseña

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>

?>