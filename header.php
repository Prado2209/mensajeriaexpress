<!-- header.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Sistema de Mensajería</title>
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>

.logo a {
  text-decoration: none;
  color: #fff;              /* color inicial (puedes ajustarlo) */
  font-weight: bold;
  font-size: 22px;
  position: relative;
  transition: color 0.3s ease;
}

/* Línea blanca que aparece con transición */
.logo a::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: -4px;             /* distancia del subrayado */
  width: 0;
  height: 2px;
  background: #fff;         /* subrayado blanco */
  transition: width 0.3s ease;
}

/* Efecto hover */
.logo a:hover {
  color: #FFD700;           /* dorado */
}

.logo a:hover::after {
  width: 100%;              /* se extiende el subrayado */
}

</style>
</head>
<body>
  <header>
    <nav class="navbar">
      <div class="logo"><a class="logo" href="index.php">INSPECTIA | Mensajería Expréss</a></div>
      <ul class="menu">

        <li><a href="index.php">Inicio</a></li>
        <li><a href="crear_usuario_form.php">Registrarse</a></li>
        <li><a href="login.php">Iniciar Sesión</a></li>
        <li><a href="pqrs.php">PQRS</a></li>
        <li><a href="sobre_nosotros.php">Sobre nosotros</a></li>
        <!-- <li><a href="listar_clientes.php">Clientes</a></li>-->
      </ul>
    </nav>
  </header>
  <main>
