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
      max-width: 1000px;
      margin: 60px auto;
      text-align: center;
    }
    h1 {
      color: #333;
      margin-bottom: 30px;
    }
    .opciones {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 30px;
      justify-content: center;
    }
    .card {
      background: white;
      padding: 30px 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      cursor: pointer;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .card img {
  width: 80px;   /* mismo tamaño para todos */
  height: 80px;
  display: block;
  margin: 0 auto 10px auto; /* centrado y espacio inferior */
  object-fit: contain; /* asegura que no se deforme */
}


    .card a {
      text-decoration: none;
      color: #000000ff;
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
  <!-- Nuevo Envío -->
  <div class="card">
    <img src="https://img.icons8.com/ios-filled/100/000000/add-user-group-man-man.png" alt="Registrar">
    <a href="guardar_cliente.php">Nuevo Envío</a>
  </div>

  <!-- Listar Envíos -->
  <div class="card">
    <img src="https://img.icons8.com/ios-filled/100/000000/conference.png" alt="Listar">
    <a href="listar_clientes.php">Listar Envíos</a>
  </div>

  <!-- Listar PQRS -->
  <div class="card">
    <img src="https://img.icons8.com/ios-filled/100/000000/faq.png" alt="PQRS">
    <a href="listar_pqrs.php">Listar PQRS</a>
  </div>

  <!-- Perfil de Usuario -->
  <div class="card">
    <img src="https://img.icons8.com/ios-filled/100/000000/user-male-circle.png" alt="Perfil">
    <a href="perfil_usuario.php">Mi Perfil</a>
  </div>

  <!-- Historial de Envíos -->
  <div class="card">
    <img src="https://img.icons8.com/ios-filled/100/000000/order-history.png" alt="Historial">
    <a href="historial_envios.php">Historial</a>
  </div>
</div>

</div>

</body>
</html>

<?php
include "footer.php";
?>
