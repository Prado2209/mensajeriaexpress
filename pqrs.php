<?php

include 'header.php';
include 'bd/conexion.php';

?>

   <!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario PQRS</title>
  <link rel="stylesheet" href="css/estilos.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .input-group {
  position: relative;
  margin-top: 15px;
}

.input-group i {
  position: absolute;
  top: 50%;               /* posición vertical */
  left: 12px;             /* distancia al borde */
  transform: translateY(-50%); /* centra el icono en el alto del input */
  font-size: 16px;
  color: #555;
  pointer-events: none;   /* el icono no bloquea el clic */
}

.input-group input,
.input-group select,
.input-group textarea {
  width: 100%;
  padding: 12px 12px 12px 40px; /* deja espacio para el icono */
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 14px;
  line-height: 1.4em;
  box-sizing: border-box;
}

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
    background: #32363aff; 
  }

</style>
</head>
<body>

<div class="login-container">
  <h2>Formulario PQRS</h2>
  <form action="procesar_pqrs.php" class="formulario" method="POST">
    <div class="input-group">
  <i class="fa-solid fa-user"></i>
  <input type="text" name="nombre" placeholder="Nombre" required>
</div>

<div class="input-group">
  <i class="fa-solid fa-envelope"></i>
  <input type="email" name="correo" placeholder="Correo" required>
</div>

<div class="input-group">
  <i class="fa-solid fa-list"></i>
  <select id="tipo" name="tipo" required>
    <option value="">Tipo de solicitud</option>
    <option value="Petición">Petición</option>
    <option value="Queja">Queja</option>
    <option value="Reclamo">Reclamo</option>
    <option value="Sugerencia">Sugerencia</option>
  </select>
</div>

<div class="input-group">
  <i class="fa-solid fa-comment-dots"></i>
  <textarea name="mensaje" required rows="4" placeholder="Agregue una breve redacción sobre su solicitud."></textarea>
</div>

    <button type="submit">Enviar PQRS</button>
  </form>
</div>
</body>
</html>


<?php

include 'footer.php';

?>