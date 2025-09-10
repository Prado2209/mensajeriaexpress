<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Sobre Nosotros | INSPECTIA</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f9f9f9;
      color: #333;
    }

    .about-container {
      max-width: 1200px;
      margin: 60px auto;
      padding: 20px;
      text-align: center;
    }

    .about-header h1 {
      font-size: 36px;
      color: #000;
      margin-bottom: 10px;
    }

    .about-header p {
      font-size: 18px;
      color: #666;
      margin-bottom: 40px;
    }

    .about-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }

    .about-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 20px;
      transition: 0.3s;
    }

    .about-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    }

    .about-card img {
      width: 100%;
      height: 300px;
      border-radius: 12px;
      margin-bottom: 15px;
    }

    .about-card i {
      font-size: 32px;
      color: #000;
      margin-bottom: 10px;
    }

    .about-card h3 {
      font-size: 22px;
      margin: 10px 0;
    }

    .about-card p {
      font-size: 14px;
      color: #555;
      line-height: 1.6;
    }
  </style>
</head>
<body>

  <div class="about-container">
    <div class="about-header">
      <h1>Sobre Nosotros</h1>
      <p>Somos INSPECTIA, una empresa de mensajería exprés comprometida con la calidad, la seguridad y la rapidez.</p>
    </div>

    <div class="about-grid">
      <!-- Misión -->
      <div class="about-card">
        <i class="fa-solid fa-bullseye"></i>
        <h3>Nuestra Misión</h3>
        <img src="img/mision.jpg" alt="Valores">
        <p>Ofrecer un servicio de mensajería exprés confiable y seguro, asegurando que cada envío llegue en el menor tiempo posible con la mejor calidad.</p>
        <p>Apicar estándares de calidad que garanticen un servicio superior</p>
      </div>

      <!-- Visión -->
      <div class="about-card">
        <i class="fa-solid fa-eye"></i>
        <h3>Nuestra Visión</h3>
        <img src="img/vision.jpg" alt="Visión">
        <p>Ser la empresa líder en mensajería en Latinoamérica, reconocida por la innovación tecnológica y la excelencia en el servicio al cliente.</p>
      </div>

      <!-- Valores -->
      <div class="about-card">
        <i class="fa-solid fa-handshake"></i>
        <h3>Muestros Valores</h3>
        <img src="img/valores.jpg" alt="Valores">
        <p>Nos guiamos por la responsabilidad, la confianza, la innovación y el compromiso con nuestros clientes y colaboradores.</p>
<?php

include "footer.php";

?>
