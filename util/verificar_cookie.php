<?php
// Verificar si hay una cookie "recordar_email" establecida
if (isset($_COOKIE['recordar_email'])) {
    $recordar_email = $_COOKIE['recordar_email'];
} else {
    $recordar_email = "";
}
?>