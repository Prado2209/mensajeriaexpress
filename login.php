<?php
session_start();
include "bd/conexion.php";
include "header.php";

// Si ya hay sesión activa, redirigir según rol
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol'] === 'admin') {
        header("Location: dashboard_admin.php");
    } elseif ($_SESSION['rol'] === 'auditor') {
        header("Location: dashboard_auditor.php");
    } else {
        header("Location: index.php");
    }
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // Crear sesión
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['rol'] = $row['rol'];

            // Redirigir según rol
            if ($row['rol'] === 'admin') {
                header("Location: dashboard_admin.php");
            } elseif ($row['rol'] === 'auditor') {
                header("Location: dashboard_auditor.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "❌ Contraseña incorrecta";
        }
    } else {
        $error = "❌ Usuario no encontrado";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/estilos.css">
  <style>
    body { font-family: Arial; background: #f4f6f9; display: block; justify-content: center; align-items: center; height: 100vh; }
    .navbar { display: flex;
  justify-content: space-between;
  align-items: center;
  background: #007bff;
  padding: 15px 40px;
  position: sticky;
  top: 0;
  z-index: 100;
  box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .login-container{
      display: block;
      margin: 0 auto;
    }
    .login-container { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 350px; }
    h2 { text-align: center; color: #007BFF; }
    label { display: block; margin-top: 15px; font-weight: bold; }
    input { width: 100%; padding: 10px; margin-top: 5px; border-radius: 8px; border: 1px solid #ccc; }
    button { width: 100%; padding: 12px; margin-top: 20px; border: none; background: #007BFF; color: white; font-weight: bold; border-radius: 8px; cursor: pointer; transition: 0.3s; }
    button:hover { background: #0056b3; }
    .error { color: red; margin-top: 15px; text-align: center; }
  p{
      font-style: italic; 
  }
  </style>
</head>
<body>

<div class="login-container">
  <h2>Iniciar Sesión</h2>
  <form method="POST">
    <label>Usuario:</label>
    <input type="text" name="usuario" required>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <button type="submit">Entrar</button>
  </form>

  <?php if($error): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>
</div>

</body>
</html>

<?php

include "footer.php";

?>