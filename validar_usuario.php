<?php
session_start();
include "bd/conexion.php";
include "header.php";
//include "menu.php";

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

// Buscar por usuario o correo
$sql = "SELECT * FROM usuarios WHERE usuario='$usuario' OR correo='$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Validar contraseña encriptada
    if (password_verify($password, $row['password'])) {
        $_SESSION['usuario'] = $row['usuario'];

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                Swal.fire({
                  icon: 'success',
                  title: 'Bienvenido',
                  text: 'Acceso correcto, redirigiendo...',
                  timer: 2000,
                  showConfirmButton: false
                }).then(() => {
                  window.location.href = 'dashboard.php';
                });
              </script>";
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                Swal.fire({
                  icon: 'error',
                  title: 'Contraseña incorrecta',
                  text: 'Inténtalo nuevamente',
                  confirmButtonColor: '#d33'
                }).then(() => {
                  window.location.href = 'login.php';
                });
              </script>";
    }
} else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Usuario no encontrado',
              text: 'Revisa tus datos',
              confirmButtonColor: '#d33'
            }).then(() => {
              window.location.href = 'login.php';
            });
          </script>";
}

$conn->close();
?>
