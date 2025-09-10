<?php
include "bd/conexion.php";
include "header.php";
//include "menu.php";

$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$direccion = $_POST['direccion'] ?? '';

$descripcion = $_POST['descripcion'] ?? '';
$peso = $_POST['peso'] ?? 0;
$estado = $_POST['estado'] ?? 'Pendiente';

// Verificar si el correo ya existe
$check = $conn->query("SELECT id_cliente FROM clientes WHERE correo = '$correo'");

if ($check && $check->num_rows > 0) {
    // Mostrar alerta de error si el correo ya está en uso
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Correo duplicado',
              text: 'El correo $correo ya está registrado. Intenta con otro diferente.',
              confirmButtonColor: '#d33',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.href = 'guardar_cliente.php';
            });
          </script>";
    exit;
}

// Insertar cliente
$sql_cliente = "INSERT INTO clientes (nombre, correo, telefono, direccion) 
                VALUES ('$nombre', '$correo', '$telefono', '$direccion')";

if ($conn->query($sql_cliente) === TRUE) {
    $id_cliente = $conn->insert_id;

    // Insertar paquete
    $sql_paquete = "INSERT INTO paquetes (id_cliente, descripcion, peso, estado, fecha_envio) 
                    VALUES ($id_cliente, '$descripcion', '$peso', '$estado', NOW())";
    $conn->query($sql_paquete);

    // Alerta de éxito
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'success',
              title: 'Registro exitoso',
              text: 'Cliente y paquete registrados correctamente.',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.href = 'listar_clientes.php';
            });
          </script>";
} else {
    // Alerta de error
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'No se pudo registrar el cliente.',
              confirmButtonColor: '#d33',
              confirmButtonText: 'Cerrar'
            }).then(() => {
              window.location.href = 'index.php';
            });
          </script>";
}

$conn->close();
?>
