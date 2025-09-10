<?php

include "bd/conexion.php";
include "menu.php";

$sql = "SELECT * FROM pqrs ORDER BY fecha DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de PQRS</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 0; }
    .container { max-width: 1100px; margin: 50px auto; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    h2 { text-align: center; color: #000000ff; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    table, th, td { border: 1px solid #ddd; }
    th { background: #000000ff; color: white; padding: 12px; text-align: center; }
    td { padding: 10px; text-align: center; }
    tr:nth-child(even) { background: #f9f9f9; }
    tr:hover { background: #eef6ff; }
    .btn { padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 14px; transition: 0.3s; margin: 2px; display: inline-block; }
    .btn-delete { background: #ff4d4d; color: white; }
    .btn-delete:hover { background: #cc0000; }
    .btn-reply { background: #28a745; color: white; }
    .btn-reply:hover { background: #1e7e34; }
  </style>
</head>
<body>

<div class="container">
  <h2>Listado de PQRS</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Tipo</th>
      <th>Mensaje</th>
      <th>Fecha</th>
      <th>Respuesta</th>
      <th>Acciones</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row["id"] ?></td>
          <td><?= htmlspecialchars($row["nombre"]) ?></td>
          <td><?= htmlspecialchars($row["correo"]) ?></td>
          <td><?= $row["tipo"] ?></td>
          <td><?= htmlspecialchars($row["mensaje"]) ?></td>
          <td><?= $row["fecha"] ?></td>
          <td>
            <?php if ($row["respuesta"]): ?>
              ✅ <?= htmlspecialchars($row["respuesta"]) ?><br>
              <small><i><?= $row["fecha_respuesta"] ?></i></small>
            <?php else: ?>
              ❌ Sin respuesta
            <?php endif; ?>
          </td>
          <td>
            <a href="eliminar_pqrs.php?id=<?= $row['id'] ?>" 
               class="btn btn-delete"
               onclick="return confirmDelete(event, <?= $row['id'] ?>)">Eliminar</a>

            <a href="#" 
               class="btn btn-reply"
               onclick="replyPQRS(<?= $row['id'] ?>, '<?= addslashes($row['mensaje']) ?>')">Responder</a>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="8">No hay registros de PQRS</td></tr>
    <?php endif; ?>
  </table>
</div>

<script>
function confirmDelete(event, id) {
  event.preventDefault();
  Swal.fire({
    title: "¿Eliminar PQRS?",
    text: "Esta acción no se puede deshacer",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar"
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "eliminar_pqrs.php?id=" + id;
    }
  });
}

function replyPQRS(id, mensaje) {
  Swal.fire({
    title: 'Responder PQRS',
    html: `
      <p><b>Mensaje recibido:</b><br>${mensaje}</p>
      <textarea id="respuesta" class="swal2-textarea" placeholder="Escribe tu respuesta..."></textarea>
    `,
    showCancelButton: true,
    confirmButtonText: 'Enviar Respuesta',
    cancelButtonText: 'Cancelar',
    preConfirm: () => {
      const respuesta = Swal.getPopup().querySelector('#respuesta').value;
      if (!respuesta) {
        Swal.showValidationMessage('Por favor escribe una respuesta');
      }
      return respuesta;
    }
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "responder_pqrs.php?id=" + id + "&respuesta=" + encodeURIComponent(result.value);
    }
  });
}
</script>

</body>
</html>
