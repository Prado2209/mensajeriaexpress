<?php
include "bd/conexion.php";
include "header.php";

// Desactiva errores fatales de MySQLi
mysqli_report(MYSQLI_REPORT_OFF);

$alerta = ""; // aquí guardamos el script de SweetAlert

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario  = $_POST["usuario"];
    $correo   = $_POST["correo"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $rol      = $_POST["rol"];

    $sql = "INSERT INTO usuarios (usuario, correo, password, rol) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $usuario, $correo, $password, $rol);

    if ($stmt->execute()) {
        // ✅ Registro exitoso
        $alerta = "
          <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'success',
              title: 'Registro exitoso',
              text: 'Usuario registrado correctamente.',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.href = 'login.php';
            });
          </script>";
    } else {
        // ❌ Error (duplicado u otro)
        if ($stmt->errno == 1062) {
            $mensaje = "El usuario \"$usuario\" ya está registrado. Intenta con otro.";
        } else {
            $mensaje = "Ha ocurrido un error inesperado.";
        }

        $alerta = "
          <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Error en el registro',
              text: '$mensaje',
              confirmButtonColor: '#d33',
              confirmButtonText: 'Cerrar'
            });
          </script>";
    }
}
?>

<style>
  .login-container {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    width: 350px;
    margin: 40px auto;
  }
  h2 { text-align: center; color: #000000ff; }
  .input-group { position: relative; margin-top: 15px; }
  .input-group i {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    color: #555;
  }
  .input-group input, 
  .input-group select {
    width: 100%;
    padding: 10px 10px 10px 35px;
    border-radius: 8px;
    border: 1px solid #ccc;
  }
  button {
    width: 100%;
    padding: 12px;
    margin-top: 20px;
    border: none;
    background: #000000ff;
    color: white;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
  }
  button:hover { background: #32363aff; }
</style>

<div class="login-container">
  <h2>Registrar Usuario</h2>
  <form class="formulario" method="POST">
    <div class="input-group">
      <i class="fa-solid fa-user"></i>
      <input type="text" name="usuario" placeholder="Usuario" required>
    </div>

    <div class="input-group">
      <i class="fa-solid fa-envelope"></i>
      <input type="email" name="correo" placeholder="Correo" required>
    </div>

    <div class="input-group">
      <i class="fa-solid fa-lock"></i>
      <input type="password" name="password" placeholder="Contraseña" required>
    </div>

    <div class="input-group">
      <i class="fa-solid fa-id-badge"></i>
      <select name="rol" required>
        <option value="auditor">Auditor de calidad</option>
      </select>
    </div>

    <button type="submit">Registrar</button>
  </form>
</div>

<?php
// Renderizamos la alerta al final para no romper estilos
echo $alerta;

include "footer.php";
?>
