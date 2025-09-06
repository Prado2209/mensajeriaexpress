<?php
include "bd/conexion.php";

// 1. Asegurar que la columna rol permita 'auditor'
$conn->query("ALTER TABLE usuarios 
    MODIFY COLUMN rol ENUM('admin','operador','auditor') DEFAULT 'operador'
");

// 2. Crear o actualizar usuario auditor
$usuario = "auditor";
$correo = "auditor@correo.com";
$password = password_hash("123456", PASSWORD_DEFAULT);
$rol = "auditor";

$sql = "INSERT INTO usuarios (usuario, correo, password, rol)
        VALUES ('$usuario', '$correo', '$password', '$rol')
        ON DUPLICATE KEY UPDATE password='$password', rol='$rol'";

if ($conn->query($sql) === TRUE) {
    echo "✅ Usuario auditor creado o actualizado correctamente.<br>";
} else {
    echo "❌ Error al crear el usuario auditor: " . $conn->error;
}

// 3. Probar login automáticamente
$sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify("123456", $row['password'])) {
        echo "✅ Contraseña verificada correctamente. Puedes iniciar sesión como auditor1 (123456).";
    } else {
        echo "❌ La contraseña no coincide.";
    }
} else {
    echo "❌ Usuario no encontrado.";
}

$conn->close();
?>
