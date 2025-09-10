<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'auditor') {
    header("Location: login.php");
    exit();
}
include "bd/conexion.php";
// Obtener totales de forma segura (evita warnings si la consulta falla)
$clientes = 0;
$pqrs     = 0;

if (isset($conn) && $conn && !$conn->connect_errno) {
    // Total clientes
    $res = $conn->query("SELECT COUNT(*) AS total FROM clientes");
    if ($res) {
        $row = $res->fetch_assoc();
        $clientes = isset($row['total']) ? (int)$row['total'] : 0;
        $res->free();
    } else {
        error_log("Error contando clientes: " . $conn->error);
    }

    // Total PQRS
    $res2 = $conn->query("SELECT COUNT(*) AS total FROM pqrs");
    if ($res2) {
        $row2 = $res2->fetch_assoc();
        $pqrs = isset($row2['total']) ? (int)$row2['total'] : 0;
        $res2->free();
    } else {
        error_log("Error contando pqrs: " . $conn->error);
    }
} else {
    error_log("Conexión a BD no disponible al obtener totales.");
}


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
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Auditoría registrada',
            'text' => 'La auditoría se ha guardado correctamente'
        ];
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Error',
            'text' => 'No se pudo registrar la auditoría'
        ];
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Auditor</title>
 <link rel="stylesheet" href="css/estilos.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
  background: linear-gradient(90deg, #000000ff, #1a1717ff);
  padding: 15px 30px;
  color: white;
  box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
}
.navbar .logo { 
  font-size: 1.4em; font-weight: bold; 
}
.navbar .menu { 
  list-style: none; display: flex; gap: 20px; 
}
.navbar .menu li { 
  display: inline; 
}
.navbar .menu a { 
  color: white; text-decoration: none; font-weight: 500; 
}
.navbar .menu a:hover { 
  text-decoration: underline; 
}
.navbar .usuario { 
  display: flex; align-items: center; gap: 15px; 
}
.btn-logout {
  padding: 6px 12px;
  background: #FF4D4D;
  color: white;
  border-radius: 6px;
  text-decoration: none;
}
.btn-logout:hover { 
  background: #cc0000; 
}

    .login-container {
      background: white; 
      padding: 30px; 
      border-radius: 12px; 
      box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
      width: 350px; }
    h2 { 
      text-align: center; 
      color: #000000ff; 
    }
    label { 
      display: block; 
      margin-top: 15px; f
      ont-weight: bold; 
    }
    input { 
      width: 100%; 
      padding: 10px; 
      margin-top: 5px; 
      border-radius: 8px; 
      border: 1px solid #ccc; 
    }
    textarea{
      width: 100%; 
      padding: 10px; 
      margin-top: 5px; 
      border-radius: 8px; 
      border: 1px solid #ccc; 
      resize: vertical;
    }
    select{
      width: 100%; 
      padding: 10px; 
      margin-top: 5px; 
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
    button:hover { 
      background: #212427ff; 
    }
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
      color: #000000ff;
      text-align: center;
    }
    form label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
}
table th, table td {
  padding: 10px;
  border: 1px solid #ddd;
  text-align: center;
}
table th {
  background: #000000ff;
  color: white;
}
table tr:hover {
  background: #f1f9ff;
}
.btn-export {
  background: #28a745;
  color: white;
  padding: 6px 10px;
  border-radius: 6px;
  text-decoration: none;
  font-size: 14px;
}
.btn-export:hover {
  background: #074114ff;
}

.card i, .navbar i, .menu i {
  color: #000 !important; /* negro */
}


  </style>
</head>
<body>
<?php if (isset($_SESSION['alert'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
  icon: '<?= $_SESSION['alert']['icon'] ?>',
  title: '<?= $_SESSION['alert']['title'] ?>',
  text: '<?= $_SESSION['alert']['text'] ?>',
  confirmButtonColor: '#000'
});
</script>
<?php unset($_SESSION['alert']); endif; ?>

<nav class="navbar">
  <div class="logo">
    <i class="fa-solid fa-shield-halved"></i> INSPECTIA - Auditorías
  </div>
  <div class="usuario">
    <span><i class="fa-solid fa-user"></i> <?= $_SESSION['usuario'] ?></span>
    <a href="logout.php" class="btn-logout">
      <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
    </a>
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
    <h3><i class="fa-solid fa-user-tie"></i> Bienvenido</h3>
    <p><?= $_SESSION['usuario'] ?> (Rol: Auditor)</p>
  </div>

  <div class="card">
    <h3><i class="fa-solid fa-chart-line"></i> Resumen rápido</h3>
    <p>Total de clientes: <b><?= htmlspecialchars($clientes) ?></b></p>
    <p>
      Total de PQRS: 
      <b>
      <a href="#" onclick="mostrarPQRS(); return false;" style="color:#007BFF; cursor:pointer;">
      <?= htmlspecialchars($pqrs) ?>
      </a>
      </b>
    </p>

  </div>

  <div class="card">
    <h3><i class="fa-solid fa-file-circle-plus"></i> Nueva Auditoría</h3>
    <form method="POST">
      <label><i class="fa-solid fa-user"></i> Nombre Auditor:</label>
      <input type="text" name="nombre_auditor" required value="<?= $_SESSION['usuario'] ?>">

      <label><i class="fa-solid fa-phone"></i> Teléfono:</label>
      <input type="text" name="telefono">

      <label><i class="fa-solid fa-calendar-days"></i> Fecha Inicio:</label>
      <input type="date" name="fecha_inicio" required>

      <label><i class="fa-solid fa-list"></i> Tipo de Registro:</label>
      <select name="tipo_registro" required>
        <option value="">-- Selecciona tipo --</option>
        <option value="Calidad">Calidad</option>
        <option value="Entrega">Entrega</option>
        <option value="Otro">Otro</option>
      </select>

      <label><i class="fa-solid fa-pen-to-square"></i> Hallazgos:</label>
      <textarea name="hallazgos"></textarea>

      <label><i class="fa-solid fa-calendar-check"></i> Fecha Fin:</label>
      <input type="date" name="fecha_fin">

      <button type="submit"><i class="fa-solid fa-save"></i> Registrar Auditoría</button>
    </form>
  </div>

  <div class="card">
    <h3><i class="fa-solid fa-folder-open"></i> Mis Auditorías</h3>
    <form method="GET" class="filtro">
      <label><i class="fa-solid fa-filter"></i> Tipo:
        <select name="tipo">
          <option value="">Todos</option>
          <option value="Calidad" <?= $tipo=='Calidad'?'selected':'' ?>>Calidad</option>
          <option value="Entrega" <?= $tipo=='Entrega'?'selected':'' ?>>Entrega</option>
          <option value="Otro" <?= $tipo=='Otro'?'selected':'' ?>>Otro</option>
        </select>
      </label>
      <label><i class="fa-solid fa-calendar-day"></i> Fecha inicio:
        <input type="date" name="fecha_inicio" value="<?= $fecha_inicio ?>">
      </label>
      <label><i class="fa-solid fa-calendar-day"></i> Fecha fin:
        <input type="date" name="fecha_fin" value="<?= $fecha_fin ?>">
      </label>
      <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Filtrar</button>
    </form>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Auditor</th>
          <th>Teléfono</th>
          <th>Inicio</th>
          <th>Tipo</th>
          <th>Hallazgos</th>
          <th>Fin</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
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
            <td>
              <a href="exportar_pdf.php?id=<?= $row['id'] ?>" target="_blank" class="btn-export">
                <i class="fa-solid fa-file-pdf"></i> PDF
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="8">No se encontraron auditorías.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php
// Traer datos reales de PQRS
$pqrsData = [];
$resPqrs = $conn->query("SELECT id, nombre, correo, tipo, mensaje, fecha, respuesta, fecha_respuesta FROM pqrs ORDER BY fecha DESC LIMIT 50");
if ($resPqrs) {
    while ($row = $resPqrs->fetch_assoc()) {
        $pqrsData[] = $row;
    }
    $resPqrs->free();
}
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  const pqrsData = <?= json_encode($pqrsData) ?>;

  function mostrarPQRS() {
    if (!pqrsData || pqrsData.length === 0) {
      Swal.fire({
        icon: 'info',
        title: 'Sin PQRS',
        text: 'No hay registros de PQRS para mostrar.'
      });
      return;
    }

    let tabla = `
      <div style="max-height:300px; overflow-y:auto;">
        <table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse; font-size:13px;">
          <thead style="background:#000; color:white;">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Tipo</th>
              <th>Mensaje</th>
              <th>Fecha</th>
              <th>Respuesta</th>
              <th>Fecha Respuesta</th>
            </tr>
          </thead>
          <tbody>
    `;

    pqrsData.forEach(p => {
      tabla += `
        <tr>
          <td>${p.id}</td>
          <td>${p.nommbre}</td>
          <td>${p.correo}</td>
          <td>${p.tipo}</td>
          <td>${p.mensaje}</td>
          <td>${p.fecha}</td>
          <td>${p.fecha_respuesta ? p.fecha_respuesta : '<i>No respondido</i>'}</td>
        </tr>
      `;
    });

    tabla += `
          </tbody>
        </table>
      </div>
    `;

    Swal.fire({
      title: 'Listado de PQRS',
      html: tabla,
      width: '80%',
      confirmButtonText: 'Cerrar',
      confirmButtonColor: '#000'
    });
  }
</script>

<?php

include "footer.php";

?>