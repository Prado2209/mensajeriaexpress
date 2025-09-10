<?php
include "bd/conexion.php";
include "menu.php";

// Función para escapar
function h($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

$sql = "SELECT c.id_cliente, c.nombre, c.correo, c.telefono, c.direccion,
               p.id_paquete, p.descripcion, p.ciudad_origen, p.ciudad_destino, p.peso, p.estado, p.fecha_envio
        FROM clientes c
        LEFT JOIN paquetes p ON c.id_cliente = p.id_cliente
        ORDER BY c.id_cliente DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Clientes y Paquetes</title>
  <link rel="stylesheet" href="css/estilos.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f6fa;
      margin: 0;
      padding: 20px;
    }

    h2 {
      text-align: center;
      margin-bottom: 15px;
      color: #333;
    }

    .search-box {
      text-align: center;
      margin-bottom: 20px;
    }

    .search-box input {
      width: 50%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 0 auto;
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px 15px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    th {
      background: #000000ff;
      color: white;
      font-size: 14px;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    td {
      font-size: 14px;
      color: #333;
    }

    .acciones {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .acciones a {
      display: block;
      text-decoration: none;
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: bold;
      transition: all 0.3s;
    }

    .acciones a.EditarBotonAcciones {
      background: #007BFF;
      color: white;
    }

    .acciones a.EditarBotonAcciones:hover {
      background: #0056b3;
    }

    .acciones a.EliminarBotonAcciones {
      background: #FF4D4D;
      color: white;
    }

    .acciones a.EliminarBotonAcciones:hover {
      background: #cc0000;
    }

    /* Responsive */
    @media (max-width: 992px) {
      .search-box input { width: 90%; }
      table { font-size: 12px; }
      th, td { padding: 8px; }
    }

    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr { display: block; }
      th { display: none; }
      td {
        padding: 10px;
        text-align: right;
        position: relative;
      }
      td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: bold;
        color: #555;
        text-align: left;
      }
    }
  </style>
</head>
<body>

<h2>Listado de Clientes y Paquetes</h2>

<div class="search-box">
  <input type="text" id="searchInput" placeholder="🔍 Buscar por nombre, correo, ciudad, estado...">
</div>

<table id="clientesTable">
  <tr>
    <th>ID Cliente</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Teléfono</th>
    <th>Dirección</th>
    <th>ID Paquete</th>
    <th>Descripción</th>
    <th>Ciudad Origen</th>
    <th>Ciudad Destino</th>
    <th>Peso (kg)</th>
    <th>Estado</th>
    <th>Fecha Envío</th>
    <th>Acciones</th>
  </tr>

<?php if ($result && $result->num_rows > 0): ?>
  <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td data-label="ID Cliente"><?= h($row['id_cliente']) ?></td>
      <td data-label="Nombre"><?= h($row['nombre']) ?></td>
      <td data-label="Correo"><?= h($row['correo']) ?></td>
      <td data-label="Teléfono"><?= h($row['telefono']) ?></td>
      <td data-label="Dirección"><?= h($row['direccion']) ?></td>
      <td data-label="ID Paquete"><?= h($row['id_paquete']) ?></td>
      <td data-label="Descripción"><?= h($row['descripcion']) ?></td>
      <td data-label="Ciudad Origen"><?= h($row['ciudad_origen']) ?></td>
      <td data-label="Ciudad Destino"><?= h($row['ciudad_destino']) ?></td>
      <td data-label="Peso"><?= h($row['peso']) ?></td>
      <td data-label="Estado"><?= h($row['estado']) ?></td>
      <td data-label="Fecha Envío"><?= h($row['fecha_envio']) ?></td>
      <td class="acciones">
        <a class="EditarBotonAcciones" href="editar_cliente.php?id=<?= urlencode($row['id_cliente']) ?>">✏️ Editar</a>
        <a class="EliminarBotonAcciones" href="#" onclick="confirmarEliminar(<?= $row['id_cliente'] ?>)">🗑 Eliminar</a>
      </td>
    </tr>
  <?php endwhile; ?>
<?php else: ?>
  <tr><td colspan="13">⚠️ No hay registros</td></tr>
<?php endif; ?>
</table>

<script>
function confirmarEliminar(id) {
  Swal.fire({
    title: '¿Seguro que deseas eliminar?',
    text: "¡Esta acción no se puede deshacer!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'eliminar_cliente.php?id=' + id;
    }
  })
}

// Filtro de búsqueda en tiempo real
document.getElementById("searchInput").addEventListener("keyup", function() {
  let filter = this.value.toLowerCase();
  let rows = document.querySelectorAll("#clientesTable tr:not(:first-child)");

  rows.forEach(row => {
    let text = row.innerText.toLowerCase();
    row.style.display = text.includes(filter) ? "" : "none";
  });
});
</script>

</body>
</html>
