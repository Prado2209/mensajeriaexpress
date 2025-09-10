<?php 

include "menu.php";

?>
<link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="login-container">
  <h2>Registrar cliente y envío</h2>
  <form action="procesar_registro.php" class="formulario" method="POST">
    <div class="input-group">
      <i class="fa-solid fa-user"></i>
      <input type="text" name="nombre" placeholder="Nombre del cliente" required value="<?= isset($_POST['nombre']) ? h($_POST['nombre']) : '' ?>">
    </div>

    <div class="input-group">
      <i class="fa-solid fa-envelope"></i>
      <input type="email" name="correo" placeholder="Correo electrónico" required value="<?= isset($_POST['correo']) ? h($_POST['correo']) : '' ?>">
    </div>

    <div class="input-group">
      <i class="fa-solid fa-phone"></i>
      <input type="tel" name="telefono" placeholder="Número de teléfono" required value="<?= isset($_POST['telefono']) ? h($_POST['telefono']) : '' ?>">
    </div>

    <div class="input-group">
      <i class="fa-solid fa-street-view"></i>
      <input type="text" name="direccion" placeholder="Dirección de residencia" required>
    </div>
      <h2>Datos del envío</h2>
    <div class="input-group">
      <i class="fa-solid fa-pen"></i>
      <input type="text" name="descripcion" placeholder="Descripción del envío" required>
    </div>
        <div class="input-group">
      <i class="fa-solid fa-street-view"></i>
      <input type="text" name="origen" placeholder="Dirección ciudad de origen" required>
    </div>
        <div class="input-group">
      <i class="fa-solid fa-street-view"></i>
      <input type="text" name="destino" placeholder="Dirección ciudad de destino" required>
    </div>
    <div class="input-group">
      <i class="fa-solid fa-weight-scale"></i>
      <input type="number" name="peso" step="0.01" placeholder="Peso en kilogramos" required>
    </div>
    <div class="input-group">
      <i class="fa-solid fa-bars"></i>
      <select name="tipo_registro" required>
          <option value="">-- Selecciona tipo --</option>
          <option value="Enviado">Enviado</option>
          <option value="En Tránsito">En Tránsito</option>
          <option value="Entregado">Entregado</option>
        </select>
    </div>



    <button type="submit">Registrar</button>
  </form>
</div>

<?php 

include "footer.php"; 

?>
