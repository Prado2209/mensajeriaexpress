<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!-- <link rel="stylesheet" href="css/estios.css"> -->
<nav class="navbar">
  <div class="logo">Mensajería Exprés</div>
  <ul class="menu">
    <li><a href="dashboard_admin.php">Dashboard</a></li>
    <li><a href="listar_clientes.php">Envíos</a></li>
    <li><a href="guardar_cliente.php">Nuevo Envío</a></li>
    <li><a href="listar_pqrs.php">PQRS</a></li>
  </ul>
  <div class="usuario">
    <span>👤 <?= $_SESSION['usuario'] ?></span>
    <a href="logout.php" class="btn-logout">Cerrar sesión</a>
  </div>
</nav>

<style>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: linear-gradient(90deg, #007BFF, #00C6FF);
  padding: 15px 30px;
  color: white;
  box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
}
.navbar .logo { font-size: 1.4em; font-weight: bold; }
.navbar .menu { list-style: none; display: flex; gap: 20px; }
.navbar .menu li { display: inline; }
.navbar .menu a { color: white; text-decoration: none; font-weight: 500; }
.navbar .menu a:hover { text-decoration: underline; }
.navbar .usuario { display: flex; align-items: center; gap: 15px; }
.btn-logout {
  padding: 6px 12px;
  background: #FF4D4D;
  color: white;
  border-radius: 6px;
  text-decoration: none;
}
.btn-logout:hover { background: #cc0000; }
</style>
