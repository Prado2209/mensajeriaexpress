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
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
      display: block;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .navbar {
      display: flex;
    }
    .form-container {
      background: white;
      margin: 0 auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      width: 400px;
      animation: fadeIn 0.6s ease-in-out;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #007BFF;
    }
    label {
      font-weight: bold;
      margin-top: 10px;
      display: block;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }
    button {
      width: 100%;
      padding: 12px;
      background: #007BFF;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #0056b3;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(-20px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Formulario PQRS</h2>
    <form action="procesar_pqrs.php" method="POST">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="correo">Correo:</label>
      <input type="email" id="correo" name="correo" required>

      <label for="tipo">Tipo:</label>
      <select id="tipo" name="tipo" required>
        <option value="">Seleccione</option>
        <option value="Petición">Petición</option>
        <option value="Queja">Queja</option>
        <option value="Reclamo">Reclamo</option>
        <option value="Sugerencia">Sugerencia</option>
      </select>

      <label for="mensaje">Mensaje:</label>
      <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

      <button type="submit">Enviar PQRS</button>
    </form>
  </div>
</body>
</html>


<?php

include 'footer.php';

?>