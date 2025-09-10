<?php
include "bd/conexion.php";
include "header.php";

$id = $_GET['id'];
$respuesta = $_GET['respuesta'];

$sql = "UPDATE pqrs 
        SET respuesta='$respuesta', fecha_respuesta=NOW() 
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'success',
              title: 'Respuesta registrada',
              text: 'La respuesta fue guardada exitosamente'
            }).then(() => { window.location.href='listar_pqrs.php'; });
          </script>";
} else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'No se pudo guardar la respuesta'
            }).then(() => { window.location.href='listar_pqrs.php'; });
          </script>";
}

$conn->close();
?>
