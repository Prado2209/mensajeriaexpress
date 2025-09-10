<?php
include "menu.php";
include "bd/conexion.php";

// función de seguridad para evitar XSS
function h($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

// consulta: une cliente con paquete
$sql = "SELECT p.id_paquete, c.nombre AS cliente, p.ciudad_destino, p.estado, p.fecha_envio
        FROM paquetes p
        INNER JOIN clientes c ON p.id_cliente = c.id_cliente
        ORDER BY p.fecha_envio DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Historial de Envíos</title>
  <link rel="stylesheet" href="css/estilos.css">
  <style>
    .container {
      max-width: 900px;
      margin: 80px auto;
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 { color: #333; text-align: center; margin-bottom: 20px; }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table th, table td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
    }
    table th {
      background: #000000ff;
      color: white;
    }
    tr:nth-child(even) { background-color: #f9f9f9; }
  </style>
</head>
<body>
<div class="container">
  <h2>Historial de Envíos</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Destino</th>
        <th>Estado</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= h($row['id_paquete']) ?></td>
            <td><?= h($row['cliente']) ?></td>
            <td><?= h($row['ciudad_destino']) ?></td>
            <td><?= h($row['estado']) ?></td>
            <td><?= h($row['fecha_envio']) ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="5">No hay envíos registrados.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>
<?php include "footer.php"; ?>
