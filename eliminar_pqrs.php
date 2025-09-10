<?php
include "bd/conexion.php";
include "menu.php";
$id = $_GET['id'];

$sql = "DELETE FROM pqrs WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'success',
              title: 'Eliminado',
              text: 'El PQRS se eliminó correctamente'
            }).then(() => { window.location.href='listar_pqrs.php'; });
          </script>";
} else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'No se pudo eliminar'
            }).then(() => { window.location.href='listar_pqrs.php'; });
          </script>";
}
$conn->close();
?>
