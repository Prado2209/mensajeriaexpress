<?php

include "header.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Información</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f6f9;
    }

    header {
      background: #f4f6f9;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
    }
    header p{
      color: #000000ff;
    }

h2{
  text-align: center;
}

p{
  color: #000000ff;
  font-style: italic;
  font-size: 18px;  
}
  .carousel {
    position: relative;
    width: 80%;
    margin: auto;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }

  .carousel-inner {
    display: flex;
    transition: transform 0.5s ease-in-out;
  }

  .carousel .card {
    min-width: 100%; /* cada tarjeta ocupa todo el ancho */
    box-sizing: border-box;
    padding: 20px;
    background: white;
  }

  .carousel button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 123, 255, 0.8);
    border: none;
    color: white;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 50%;
    font-size: 18px;
  }

  .carousel button:hover {
    background: rgba(0, 86, 179, 0.9);
  }

  .prev { left: 10px; }
  .next { right: 10px; }
</style>
</head>
<body>

<header>
  <h1>Bienvenido a Mensajería Expréss</h1>
  <p>Tu solución rápida y confiable para envíos y mensajería.</p></header>
<div class="carousel">
  <div class="carousel-inner">
    <div class="card">
      <h2>¿Quiénes somos?</h2>
      <p>Somos una plataforma dedicada a ofrecer servicios de mensajería y paquetería 
        con la máxima eficiencia y seguridad. Ya sea que necesites enviar documentos 
        importantes o paquetes voluminosos, estamos aquí para ayudarte.</p>
    </div>
    <div class="card">
      <h2>Servicios Destacados</h2>
      <ul>
        <p>Envíos nacionales e internacionales</p>
        <p>Seguimiento en tiempo real</p>
        <p>Atención al cliente 24/7</p>
        <p>Tarifas competitivas</p>
      </ul>
    </div>
    <div class="card">
      <h2>¿Por qué elegirnos?</h2>
      <ul>
        <p>Rapidez: Entregas en tiempo récord.</p>
        <p>Seguridad: Tu paquete en las mejores manos.</p>
        <p>Facilidad: Plataforma intuitiva y fácil de usar.</p>
        <p>Soporte: Asistencia personalizada para cada cliente.</p>
      </ul>

    </div>
    <div class="card">
      <h2>¿Listo para comenzar?</h2>
      <p>Acércate a nuestra oficina más cercana y disfruta de nuestros servicios</p>
    </div>
  </div>

  <!-- Botones de control -->
  <button class="prev">❮</button>
  <button class="next">❯</button>
</div>

<script>
  const carousel = document.querySelector(".carousel-inner");
  const cards = document.querySelectorAll(".carousel .card");
  const prevBtn = document.querySelector(".prev");
  const nextBtn = document.querySelector(".next");

  let index = 0;

  function showSlide(i) {
    if (i < 0) index = cards.length - 1;
    else if (i >= cards.length) index = 0;
    else index = i;
    carousel.style.transform = `translateX(${-index * 100}%)`;
  }

  prevBtn.addEventListener("click", () => showSlide(index - 1));
  nextBtn.addEventListener("click", () => showSlide(index + 1));

  // Opcional: autoplay cada 5s
  setInterval(() => showSlide(index + 1), 5000);
</script>

<?php

include "footer.php";

?>