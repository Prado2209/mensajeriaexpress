<?php
session_start();
include "bd/conexion.php";
include "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo   = $_POST["correo"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE correo=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        if (password_verify($password, $usuario["password"])) {
            $_SESSION["id_usuario"] = $usuario["id_usuario"];
            $_SESSION["usuario"]    = $usuario["usuario"];
            $_SESSION["rol"]        = $usuario["rol"];

            header("Location: dashboard_auditor.php");
            exit();
        } else {
            echo "❌ Contraseña incorrecta";
        }
    } else {
        echo "❌ Usuario no encontrado";
    }
}
?>

<form method="POST">
  <input type="email" name="correo" placeholder="Correo" required><br>
  <input type="password" name="password" placeholder="Contraseña" required><br>
  <button type="submit">Ingresar</button>
</form>
