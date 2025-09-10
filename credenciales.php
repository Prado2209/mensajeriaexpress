<?php
include "bd/conexion.php";

$usuario = "admin";
$correo = "admin@correo.com";
$password = password_hash("123456", PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (usuario, correo, password) 
        VALUES ('$usuario', '$correo', '$password')";
$conn->query($sql);

echo "Usuario admin creado";
?>
