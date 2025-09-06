<?php

include "bd/conexion.php";
//include "header.php";
//include "menu.php";

$id_cliente = $_POST['id_cliente'];
$nombre     = $_POST['nombre'];
$correo     = $_POST['correo'];
$telefono   = $_POST['telefono'];
$direccion  = $_POST['direccion'];

$sql = "UPDATE clientes SET 
        nombre='$nombre',
        correo='$correo',
        telefono='$telefono',
        direccion='$direccion'
        WHERE id_cliente=$id_cliente";

if ($conn->query($sql) === TRUE) {
    echo "✅ Cliente actualizado correctamente.";
} else {
    echo "❌ Error al actualizar: " . $conn->error;
}

echo "<br><a href='listar_clientes.php'>Volver al listado</a>";

$conn->close();
?>