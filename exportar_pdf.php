<?php
require 'dompdf/vendor/autoload.php'; // o la ruta donde tengas Dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

// Conexión a la base de datos
include "bd/conexion.php";

$query = "SELECT * FROM auditorias";
$result = $conn->query($query);

// Construir HTML de la tabla
$html = '
<h2 style="text-align:center;">Reporte de Auditorías</h2>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
  <tr style="background:#007BFF; color:white;">
    <th>ID</th>
    <th>Nombre Auditor</th>
    <th>Teléfono</th>
    <th>Fecha Inicio</th>
    <th>Tipo de Registro</th>
    <th>Hallazgos</th>
    <th>Fecha Fin</th>
  </tr>';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $html .= "
        <tr>
          <td>{$row['id']}</td>
          <td>{$row['nombre_auditor']}</td>
          <td>{$row['telefono']}</td>
          <td>{$row['fecha_inicio']}</td>
          <td>{$row['tipo_registro']}</td>
          <td>{$row['hallazgos']}</td>
          <td>{$row['fecha_fin']}</td>
        </tr>";
    }
} else {
    $html .= '<tr><td colspan="7" style="text-align:center;">No se encontraron auditorías.</td></tr>';
}

$html .= '</table>';

// Configuración de Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape'); // Horizontal
$dompdf->render();

// Descargar el archivo
$dompdf->stream("auditorias.pdf", ["Attachment" => true]);
