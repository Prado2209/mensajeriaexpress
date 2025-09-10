<?php
include "bd/conexion.php";
include "header.php";
//include "menu.php";

$usuario = "admin";
$correo = "admin@correo.com";
$password = password_hash("123456", PASSWORD_DEFAULT); // Encripta la clave

$sql = "INSERT INTO usuarios (usuario, correo, password) 
        VALUES ('$usuario', '$correo', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "✅ Usuario administrador creado correctamente";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
