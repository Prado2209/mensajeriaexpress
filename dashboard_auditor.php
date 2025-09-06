<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'auditor') {
    header("Location: login.php");
    exit();
}
include "bd/conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_auditor = $_POST['nombre_auditor'];
    $telefono = $_POST['telefono'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $tipo_registro = $_POST['tipo_registro'];
    $hallazgos = $_POST['hallazgos'];
    $fecha_fin = $_POST['fecha_fin'];

    $sql = "INSERT INTO auditorias (nombre_auditor, telefono, fecha_inicio, tipo_registro, hallazgos, fecha_fin)
            VALUES ('$nombre_auditor', '$telefono', '$fecha_inicio', '$tipo_registro', '$hallazgos', '$fecha_fin')";

    if ($conn->query($sql) === TRUE) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                Swal.fire({
                  icon: 'success',
                  title: 'Auditoría registrada',
                  text: 'La auditoría se ha guardado correctamente'
                }).then(() => { window.location.href='registrar_auditoria.php'; });
              </script>";
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'No se pudo registrar la auditoría'
                }).then(() => { window.location.href='registrar_auditoria.php'; });
              </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Auditor</title>
 <link rel="stylesheet" href="css/estilos.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f6f9;
    }

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

    .login-container { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 350px; }
    h2 { text-align: center; color: #007BFF; }
    label { display: block; margin-top: 15px; font-weight: bold; }
    input { width: 100%; padding: 10px; margin-top: 5px; border-radius: 8px; border: 1px solid #ccc; }
    button { width: 100%; padding: 12px; margin-top: 20px; border: none; background: #007BFF; color: white; font-weight: bold; border-radius: 8px; cursor: pointer; transition: 0.3s; }
    button:hover { background: #0056b3; }
    .error { color: red; margin-top: 15px; text-align: center; }

.logo {
  font-size: 22px;
  font-weight: bold;
  color: white;
}

    .grid-container {
      display: grid;
      grid-template-columns: repeat(2, 1fr); /* 2 columnas */
      grid-gap: 20px;
      padding: 20px;
    }

    .card {
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    h3 {
      margin-top: 0;
      color: #007BFF;
    }
    form label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>

<nav class="navbar">
  <div class="logo">INSPECTIA - Calidad de Software | Mensajería Expréss</div>
  <div class="usuario">
    <span>👤 <?= $_SESSION['usuario'] ?></span>
    <a href="logout.php" class="btn-logout">Cerrar sesión</a>
  </div>
</nav>

<?php

// Filtros
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : '';
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : '';

// Construir consulta
$query = "SELECT * FROM auditorias WHERE nombre_auditor = '{$_SESSION['usuario']}'";

if ($tipo) $query .= " AND tipo_registro = '$tipo'";
if ($fecha_inicio) $query .= " AND fecha_inicio >= '$fecha_inicio'";
if ($fecha_fin) $query .= " AND fecha_fin <= '$fecha_fin'";

$query .= " ORDER BY fecha_inicio DESC";

$result = $conn->query($query);
?>

    <!-- Inicio dashboard-->

<div class="grid-container">
    <div class="card">
        <h3>Bienvenido, <?= $_SESSION['usuario'] ?> 👋</h3>
        <p>Rol: Auditor</p>
    </div>
    <div class="card">
      <h3>Resumen rápido</h3>
    <?php
    // Número de clientes
    $clientes = $conn->query("SELECT COUNT(*) as total FROM clientes")->fetch_assoc()['total'];
    // Número de PQRS
    $pqrs = $conn->query("SELECT COUNT(*) as total FROM pqrs")->fetch_assoc()['total'];
    ?>
    <p>Total de clientes: <b><?= $clientes ?></b></p>
    <p>Total de PQRS: <b><?= $pqrs ?></b></p>
    </div>
    <div class="card">
      <form method="POST">
              <h2>Nueva Auditoría</h2>
        <label>Nombre Auditor:</label>
        <input type="text" name="nombre_auditor" required value="<?= $_SESSION['usuario'] ?>">

        <label>Teléfono:</label>
        <input type="text" name="telefono">

        <label>Fecha Inicio:</label>
        <input type="date" name="fecha_inicio" required>

        <label>Tipo de Registro:</label>
        <select name="tipo_registro" required>
          <option value="">-- Selecciona tipo --</option>
          <option value="Calidad">Calidad</option>
          <option value="Entrega">Entrega</option>
          <option value="Otro">Otro</option>
        </select>

        <label>Hallazgos:</label>
        <textarea name="hallazgos"></textarea>

        <label>Fecha Fin:</label>
        <input type="date" name="fecha_fin">

        <button type="submit">Registrar Auditoría</button>
        </form>
    </div>
    <div class="card">
  <h2>Mis Auditorías</h2>

  <!-- Filtros -->
  <form method="GET" class="filtro">
    <label>Tipo:
      <select name="tipo">
        <option value="">Todos</option>
        <option value="Calidad" <?= $tipo=='Calidad'?'selected':'' ?>>Calidad</option>
        <option value="Entrega" <?= $tipo=='Entrega'?'selected':'' ?>>Entrega</option>
        <option value="Otro" <?= $tipo=='Otro'?'selected':'' ?>>Otro</option>
      </select>
    </label>

    <label>Fecha inicio:
      <input type="date" name="fecha_inicio" value="<?= $fecha_inicio ?>">
    </label>

    <label>Fecha fin:
      <input type="date" name="fecha_fin" value="<?= $fecha_fin ?>">
    </label>

    <button type="submit">Filtrar</button>
  </form>

  <!-- Resultados en tabla -->
  <table border="1" cellpadding="8" cellspacing="0" style="width:100%; margin-top:15px; border-collapse:collapse;">
    <tr style="background:#007BFF; color:white;">
      <th>ID</th>
      <th>Nombre Auditor</th>
      <th>Teléfono</th>
      <th>Fecha Inicio</th>
      <th>Tipo de Registro</th>
      <th>Hallazgos</th>
      <th>Fecha Fin</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['nombre_auditor'] ?></td>
          <td><?= $row['telefono'] ?></td>
          <td><?= $row['fecha_inicio'] ?></td>
          <td><?= $row['tipo_registro'] ?></td>
          <td><?= $row['hallazgos'] ?></td>
          <td><?= $row['fecha_fin'] ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="7" style="text-align:center;">No se encontraron auditorías.</td></tr>
    <?php endif; ?>
  </table>
</div>
