<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Usuario</title>
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f6fa;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 800px;
      margin: 60px auto;
      text-align: center;
    }
    h1 {
      color: #333;
      margin-bottom: 30px;
    }
    .opciones {
      display: flex;
      justify-content: center;
      gap: 40px;
    }
    .card {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 220px;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      cursor: pointer;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .card a {
      text-decoration: none;
      color: #007BFF;
      font-size: 18px;
      font-weight: bold;
      display: block;
      margin-top: 15px;
    }
    .user-info {
      margin-bottom: 20px;
      font-size: 18px;
      color: #555;
    }
    .logout {
      margin-top: 40px;
    }
    .logout a {
      padding: 10px 20px;
      background: #FF4D4D;
      color: white;
      border-radius: 6px;
      text-decoration: none;
    }
    .logout a:hover {
      background: #cc0000;
    }
  </style>
</head>
<body>

<?php include "menu.php"; ?>

<div class="container">
  <h1>Bienvenido, <?= $_SESSION['usuario'] ?> 👋</h1>
  <p class="user-info">Selecciona una opción para continuar</p>

  <div class="opciones">
    <div class="card">
      <img src="https://img.icons8.com/ios-filled/100/007BFF/add-user-group-man-man.png" alt="Registrar">
      <a href="guardar_cliente.php">Registrar Cliente</a>
    </div>
    <div class="card">
      <img src="https://img.icons8.com/ios-filled/100/007BFF/conference.png" alt="Listar">
      <a href="listar_clientes.php">Listar Clientes</a>
    </div>
    <div class="card">
      <img src="https://img.icons8.com/?size=100&id=IchwUEgoxNcw&format=png&color=000000" alt="Listar">
      <a href="listar_pqrs.php">Listar PQRS</a>
    </div>
  </div>
</div>

</body>
</html>

<?php

include "footer.php";

?>
