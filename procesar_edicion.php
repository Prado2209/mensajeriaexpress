<?php
include "bd/conexion.php";
include "header.php";
//include "menu.php";

$id = $_POST['id'] ?? 0;
$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$direccion = $_POST['direccion'] ?? '';

$sql = "UPDATE clientes 
        SET nombre='$nombre', correo='$correo', telefono='$telefono', direccion='$direccion' 
        WHERE id_cliente = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'success',
              title: 'Cambios guardados',
              text: 'El cliente fue actualizado correctamente',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.href = 'listar_clientes.php';
            });
          </script>";
} else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'No se pudo actualizar el cliente',
              confirmButtonColor: '#d33',
              confirmButtonText: 'Cerrar'
            }).then(() => {
              window.location.href = 'listar_clientes.php';
            });
          </script>";
}

$conn->close();
?>
