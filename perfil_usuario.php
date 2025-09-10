<?php include "menu.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi Perfil</title>
  <link rel="stylesheet" href="css/estilos.css">
  <style>
    .container {
      max-width: 600px;
      margin: 80px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: center;
    }
    img {
      border-radius: 50%;
      width: 120px;
      height: 120px;
      margin-bottom: 15px;
    }
    h2 { color: #333; margin-bottom: 20px; }
    p { color: #555; margin: 5px 0; }
  </style>
</head>
<body>
<div class="container">
  <img src="https://img.icons8.com/ios-filled/150/00000/user-male-circle.png" alt="Perfil">
  <h2>Mi Perfil</h2>
  <p><strong>Usuario:</strong> <?= $_SESSION['usuario'] ?></p>
  <p><strong>Correo:</strong> usuario@correo.com</p>
  <p><strong>Rol:</strong> <?= $_SESSION['rol']?></p>
</div>
</body>
</html>
<?php include "footer.php"; ?>
