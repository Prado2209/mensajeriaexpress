<?php

include "header.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f6f9;
    }

    .carousel {
      position: relative;
      width: 100%;
      max-width: 1200px;
      margin: auto;
      overflow: hidden;
      border-radius: 16px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    }

    .carousel-inner {
      display: flex;
      transition: transform 0.8s ease-in-out;
    }

    .card {
      min-width: 100%;
      min-height: 500px;
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      background-size: cover;
      background-position: center;
      position: relative;
    }

    /* Overlay semitransparente para que siempre se lea el texto */
    .card::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 1;
    }

    .card h2, .card p, .card ul {
      position: relative;
      z-index: 2;
      margin: 10px 0;
    }

    .card h2 {
      font-size: 36px;
      font-weight: bold;
      color: #fff;
    }

    .card p, .card ul {
      font-size: 18px;
      max-width: 700px;
    }

    /* Asignamos las imágenes */
    .card1 { background-image: url("img/carousel1.jfif"); }
    .card2 { background-image: url("img/carousel2.jfif"); }
    .card3 { background-image: url("img/carousel3.webp"); }
    .card4 { background-image: url("img/carousel4.jpg"); }

    /* Botones */
    .carousel button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(255, 255, 255, 0.8);
      border: none;
      color: #000;
      padding: 12px 18px;
      cursor: pointer;
      border-radius: 50%;
      font-size: 22px;
      transition: 0.3s;
      z-index: 3;
    }

    .carousel button:hover {
      background: rgba(255, 255, 255, 1);
      transform: translateY(-50%) scale(1.1);
    }

    .prev { left: 15px; }
    .next { right: 15px; }

    /* Responsivo */
    @media (max-width: 768px) {
      .card h2 { font-size: 24px; }
      .card p { font-size: 16px; padding: 0 20px; }
    }

    header {
  margin-bottom: 30px;
}

.carousel {
  margin-top: 30px; 
}

.card-content {
  background: rgba(0,0,0,0.6);
  padding: 20px;
  border-radius: 12px;
  display: inline-block;
}

.card::before {
  background: rgba(0,0,0,0.65); /* antes estaba en 0.5, ahora más oscuro */
}

.card h2 {
  font-size: 42px;       /* más grande */
  font-weight: 800;      /* más gruesa */
  color: #ffffff;        /* blanco brillante */
  text-shadow: 2px 2px 6px rgba(0,0,0,0.9); /* sombra más fuerte */
}

.card p, .card ul {
  font-size: 20px;
  font-weight: 500;
  color: #f1f1f1;
  text-shadow: 1px 1px 5px rgba(0,0,0,0.8);
}

  </style>
</head>
<body>

<div class="carousel">
  <div class="carousel-inner">
    <div class="card card1">
      <h2>¿Quiénes somos?</h2>
      <p>Somos una plataforma dedicada a ofrecer servicios de auditoría...</p>
    </div>
    <div class="card card2">
      <h2>Servicios Destacados</h2>
      <ul>
        <p>Auditorías de calidad</p>
        <p>Envíos nacionales e internacionales</p>
        <p>Seguimiento en tiempo real</p>
      </ul>
    </div>
    <div class="card card3">
      <h2>¿Por qué elegirnos?</h2>
      <ul>
        <p>Rapidez: Entregas en tiempo récord.</p>
        <p>Seguridad: Tu paquete en las mejores manos.</p>
      </ul>
    </div>
    <div class="card card4">
      <h2>¿Listo para comenzar?</h2>
      <p>Acércate a nuestra oficina más cercana y disfruta de nuestros servicios</p>
    </div>
  </div>

  <!-- Botones -->
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

  // autoplay cada 5s
  setInterval(() => showSlide(index + 1), 5000);
</script>

</body>
</html>


<?php

include "footer.php";

?>