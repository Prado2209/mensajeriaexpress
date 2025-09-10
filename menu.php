<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

?>

<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<nav class="navbar">
  <div class="logo">INSPECTIA | Mensajería Exprés</div>
  <ul class="menu">
    <li><a href="dashboard_admin.php">Dashboard</a></li>
    <li><a href="listar_clientes.php">Envíos</a></li>
    <li><a href="guardar_cliente.php">Nuevo Envío</a></li>
    <li><a href="listar_pqrs.php">PQRS</a></li>
  </ul>
  <div class="usuario">
    <span><i class="fa-solid fa-user"></i> <?= $_SESSION['usuario'] ?></span>
      <a class ="btn-logout" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
  </div>
</nav>

<style>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: linear-gradient(60deg, #000000ff, #353535ff);
  padding: 15px 30px;
  color: white;
  box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
}
.navbar .logo { font-size: 1.4em; font-weight: bold; }
.navbar .menu { list-style: none; display: flex; gap: 20px; }
.navbar .menu li { display: inline; }
.navbar .menu a { color: white; text-decoration: none; font-weight: 500; }
.navbar .menu a:hover { text-decoration: none; }
.navbar .usuario { display: flex; align-items: center; gap: 15px; }
.btn-logout {
  padding: 6px 12px;
  background: #FF4D4D;
  color: white;
  border-radius: 6px;
  text-decoration: none;
}
.btn-logout:hover { background: #cc0000; }

  .login-container {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    width: 350px;
    margin: 40px auto;
  }
  h2 { text-align: center; color: #000000ff; }
  .input-group { position: relative; margin-top: 15px; }
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