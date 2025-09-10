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
    $correo = $_POST['correo'];

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
    
  .login-container {
    margin-top: 100px;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    width: 350px;
    margin: 40px auto;
  }
  h2 { text-align: center; 
    color: #000000ff; 
  }
  .input-group { 
    position: relative; 
    margin-top: 15px; 
  }
  .input-group i {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    color: #555;
  }
  .input-group input, 
  .input-group select {
    width: 100%;
    padding: 10px 10px 10px 35px;
    border-radius: 8px;
    border: 1px solid #ccc;
  }
  button {
    width: 100%;
    padding: 12px;
    margin-top: 20px;
    border: none;
    background: #000000ff;
    color: white;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
  }
  button:hover { background: #32363aff; }

</style>
  </style>
</head>
<body>
<div class="login-container">
  <h2>Iniciar Sesión</h2>
  <form class="formulario" method="POST">
    <div class="input-group">
      <i class="fa-solid fa-user"></i>
      <input type="text" name="usuario" placeholder="Usuario" required>
    </div>

    <div class="input-group">
      <i class="fa-solid fa-lock"></i>
      <input type="password" name="password" placeholder="Contraseña" required>
    </div>

    <button type="submit">Ingresar</button>
  </form>
</div>

  <?php if($error): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>
</div>

</body>
</html>

<?php

include "footer.php";

?>