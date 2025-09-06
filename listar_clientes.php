<?php

include "bd/conexion.php";
include "menu.php";

// Función para escapar y evitar NULL
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
</head>
<style>
  .EditarBotonAcciones {
      display: block;
      color: #000000ff;
      border: none;
      padding: 3px 5px;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
      width: 100%;
      position: relative;
      overflow: hidden;

}
</style>
<body>

<h2>Listado de Clientes y Paquetes</h2>

<table>
  <tr>
    <th>ID Cliente</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Teléfono</th>
    <th>Dirección</th>
    <th>ID Paquete</th>
    <th>Descripción</th>
    <th>Dirección Ciudad Origen</th>
    <th>Dirección Ciudad Destino</th>
    <th>Peso (kg)</th>
    <th>Estado</th>
    <th>Fecha Envío</th>
    <th>Acciones</th>
  </tr>

<?php if ($result && $result->num_rows > 0): ?>
  <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= h($row['id_cliente']) ?></td>
      <td><?= h($row['nombre']) ?></td>
      <td><?= h($row['correo']) ?></td>
      <td><?= h($row['telefono']) ?></td>
      <td><?= h($row['direccion']) ?></td>
      <td><?= h($row['id_paquete']) ?></td>
      <td><?= h($row['descripcion']) ?></td>
      <td><?= h($row['ciudad_origen']) ?></td>
      <td><?= h($row['ciudad_destino']) ?></td>
      <td><?= h($row['peso']) ?></td>
      <td><?= h($row['estado']) ?></td>
      <td><?= h($row['fecha_envio']) ?></td>
      <td class="acciones">
        <a class="EditarBotonAcciones" href="editar_cliente.php?id=<?= urlencode($row['id_cliente']) ?>">Editar</a>
        <a class="EditarBotonAcciones" href="#" onclick="confirmarEliminar(<?= $row['id_cliente'] ?>)">Eliminar</a>
      </td>
    </tr>
  <?php endwhile; ?>
<?php else: ?>
  <tr><td colspan="11">No hay registros</td></tr>
<?php endif; ?>

</table>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</script>

