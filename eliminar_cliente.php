<?php
include "bd/conexion.php";
include "header.php";   
//include "menu.php";

$id = $_GET['id'] ?? 0;

// Eliminar primero paquetes relacionados
$conn->query("DELETE FROM paquetes WHERE id_cliente = $id");

// Luego eliminar cliente
$sql = "DELETE FROM clientes WHERE id_cliente = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'success',
              title: 'Eliminado',
              text: 'El cliente y sus paquetes fueron eliminados correctamente',
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
              text: 'No se pudo eliminar el cliente',
              confirmButtonColor: '#d33',
              confirmButtonText: 'Cerrar'
            }).then(() => {
              window.location.href = 'listar_clientes.php';
            });
          </script>";
}

$conn->close();
?>
