<?php
include "bd/conexion.php";
include "header.php";

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$tipo = $_POST['tipo'];
$mensaje = $_POST['mensaje'];

$sql = "INSERT INTO pqrs (nombre, correo, tipo, mensaje)
        VALUES ('$nombre', '$correo', '$tipo', '$mensaje')";

if ($conn->query($sql) === TRUE) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'success',
              title: 'Enviado',
              text: 'Tu PQRS ha sido registrado correctamente',
              confirmButtonText: 'OK'
            }).then(() => { window.location.href='pqrs.php'; });
          </script>";
} else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Hubo un problema al registrar tu PQRS',
              confirmButtonText: 'OK'
            }).then(() => { window.location.href='pqrs.php'; });
          </script>";
}

$conn->close();
?>
