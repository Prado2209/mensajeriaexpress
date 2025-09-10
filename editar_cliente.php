<?php
include "bd/conexion.php";
include "menu.php";
//include "menu.php";

$id = $_GET['id'] ?? 0;

// Obtener datos del cliente
$sql_cliente = "SELECT * FROM clientes WHERE id_cliente = $id";
$result_cliente = $conn->query($sql_cliente);
$cliente = $result_cliente->fetch_assoc();

// Obtener datos del paquete (si existe)
$sql_paquete = "SELECT * FROM paquetes WHERE id_cliente = $id";
$result_paquete = $conn->query($sql_paquete);
$paquete = $result_paquete->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Cliente y Paquete</title>
  <link rel="stylesheet" href="css/estilos.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="login-container">
  <h2>Editar cliente y envío</h2>
  <form class="formulario" method="POST" action="procesar_edicion.php" id="form-edicion">
      <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">
    <div class="input-group">
      <i class="fa-solid fa-user"></i>
    <input type="text" name="nombre" value="<?= htmlspecialchars($cliente['nombre']) ?>" required>
    </div>

    <div class="input-group">
      <i class="fa-solid fa-envelope"></i>
    <input type="email" name="correo" value="<?= htmlspecialchars($cliente['correo']) ?>" required>
    </div>

    <div class="input-group">
      <i class="fa-solid fa-lock"></i>
    <input type="text" name="telefono" value="<?= htmlspecialchars($cliente['telefono'] ?? '') ?>">
    </div>

     <div class="input-group">
      <i class="fa-solid fa-lock"></i>
    <input type="text" name="direccion" value="<?= htmlspecialchars($cliente['direccion'] ?? '') ?>">
    </div>
    <h3>Datos del envío</h3>
      <input type="hidden" name="id_paquete" value="<?= $paquete['id_paquete'] ?? '' ?>">

     <div class="input-group">
      <i class="fa-solid fa-lock"></i>
    <input type="text" name="descripcion" value="<?= htmlspecialchars($paquete['descripcion'] ?? '') ?>">
    </div>
    <div class="input-group">
      <i class="fa-solid fa-lock"></i>
    <input type="number" step="0.01" name="peso" value="<?= htmlspecialchars($paquete['peso'] ?? '') ?>">
    </div>
    <div class="input-group">
      <i class="fa-solid fa-lock"></i>
<select name="estado">
      <option value="Pendiente" <?= ($paquete['estado'] ?? '') == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
      <option value="En tránsito" <?= ($paquete['estado'] ?? '') == 'En tránsito' ? 'selected' : '' ?>>En tránsito</option>
      <option value="Entregado" <?= ($paquete['estado'] ?? '') == 'Entregado' ? 'selected' : '' ?>>Entregado</option>
    </select>    </div>

    <button type="submit">Guardar cambios</button>
  </form>
</div>

<script>
document.getElementById("form-edicion").addEventListener("submit", function(e) {
  e.preventDefault();
  Swal.fire({
    title: '¿Guardar cambios?',
    text: "Se actualizarán los datos del cliente y su paquete",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, guardar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      e.target.submit(); // Enviar el formulario
    }
  })
});
</script>

