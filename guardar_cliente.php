<?php 

include "menu.php";

?>
<link rel="stylesheet" href="css/estilos.css">

<h2 class="titulo-form">Registro de Cliente y Paquete</h2>

<form action="procesar_registro.php" method="POST" class="formulario">
  <div class="campo">
    <label>Nombre</label>
    <input type="text" name="nombre" required>
  </div>

  <div class="campo">
    <label>Correo</label>
    <input type="email" name="correo" required>
  </div>

  <div class="campo">
    <label>Teléfono</label>
    <input type="text" name="telefono">
  </div>

  <div class="campo">
    <label>Dirección</label>
    <input type="text" name="direccion">
  </div>

  <h3>Datos del Paquete</h3>

  <div class="campo">
    <label>Descripción</label>
    <input type="text" name="descripcion">
  </div>
  <div class="campo">
    <label>Dirección Ciudad Origen</label>
    <input type="text" name="ciudad_origen">
  </div>
  <div class="campo">
    <label>Dirección Ciudad Destino</label>
    <input type="text" name="ciudad_destino">
  <div class="campo">
    <label>Peso (kg)</label>
    <input type="number" step="0.01" name="peso">
  </div>
  <div class="campo">
    <label>Estado</label>
    <select name="tipo_registro" required>
          <option value="">-- Selecciona tipo --</option>
          <option value="Enviado">Enviado</option>
          <option value="En Tránsito">En Tránsito</option>
          <option value="Entregado">Entregado</option>
        </select>
  </div>

  <button type="submit" class="btn-animado">Registrar</button>
</form>

<?php include "footer.php"; ?>
