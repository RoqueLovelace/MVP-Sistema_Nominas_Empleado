<?php
require '../../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Configurar DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

// Capturar la fecha desde la solicitud GET
$specific_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// Validar la fecha
if (!DateTime::createFromFormat('Y-m-d', $specific_date)) {
    die('Fecha inválida.');
}

// Conectar a la base de datos y obtener los datos para la fecha específica
$host = 'localhost';
$dbname = 'nomina';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener los detalles de asistencia
    $stmt = $pdo->prepare("SELECT * FROM assistence WHERE date = :date");
    $stmt->bindParam(':date', $specific_date);
    $stmt->execute();
    $details = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Obtener los datos de trazabilidad
    $stmt_trazabilidad = $pdo->prepare("SELECT * FROM trazabilidad WHERE fecha = :date");
    $stmt_trazabilidad->bindParam(':date', $specific_date);
    $stmt_trazabilidad->execute();
    $trazabilidad_data = $stmt_trazabilidad->fetch(PDO::FETCH_ASSOC);
    
    // Generar el contenido HTML para el PDF
    ob_start();
    ?>
    <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalles del Día</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .details {
            margin-bottom: 20px;
        }

        .details p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Detalles del Día</h1>
        </div>
        <div class="details">
            <?php if ($details): ?>
            <h2>Detalles de la Información</h2>
            <h3>1.0 Datos de trazabilidad</h3>
            <p><strong>1.1 Código de consulta: </strong><?php echo htmlspecialchars($trazabilidad_data['codigo_consulta'] ?? 'No disponible'); ?></p>
            <p><strong>1.2 Hora generación del reporte: </strong><?php echo htmlspecialchars($trazabilidad_data['hora_generacion'] ?? 'No disponible'); ?></p>
            <p><strong>1.3 Zona horaria: </strong><?php echo htmlspecialchars($trazabilidad_data['zona_horaria'] ?? 'No disponible'); ?></p>
            <p><strong>1.4 IP de lugar de trabajo: </strong><?php echo htmlspecialchars($trazabilidad_data['ip_trabajo'] ?? 'No disponible'); ?></p>
            <br>
            <h3>2.0 Datos de contratación</h3>
            <p><strong>2.1 Supervisor directo: </strong>Juan Peréz</p>
            <p><strong>2.2 Tipo de contratación: </strong>Por proyecto</p>
            <p><strong>2.3 Tipo de firma para contrato: </strong>Firma autorafa (certificada) en versión digital</p>
            <p><strong>2.4 Seguridad social: </strong>NA</p>
            <p><strong>2.5 Descuento del ISR: </strong>10%</p>
            <p><strong>2.6 Fecha de inicio contrato: </strong>2024-09-11</p>
            <p><strong>2.7 Fecha fin de contrato: </strong>2024-12-01</p>
            <p><strong>2.8 Otros descuentos adicionales: </strong>Ejemplo 123</p>
            <br>
            <h3>3.0 Datos de colaborador</h3>
            <p><strong>3.1 Nombre: </strong>Juan Peréz</p>
            <p><strong>3.2 Carnet: </strong>GG56789009</p>
            <p><strong>3.3 Área asignada: </strong>Desarrollador</p>
            <p><strong>3.4 Medición de resultados: </strong>Scrum</p>
            <p><strong>3.5 Comentarios: </strong>Es un trabajador eficiente</p>
            <br>
            <h3>4.0 Detalles del tiempo trabajado</h3>
            <p><strong>4.1 Fecha de ejecución del trabajo: </strong><?php echo htmlspecialchars($details['date'] ?? 'No disponible'); ?></p>
            <p><strong>4.2 Hora de entrada: </strong><?php echo htmlspecialchars($details['time_entry'] ?? 'No disponible'); ?></p>
            <p><strong>4.3 Tiempo de almuerzo: </strong><?php echo htmlspecialchars($details['lunch_time'] ?? 'No disponible'); ?></p>
            <p><strong>4.4 Tiempo para necesidades biológicas: </strong>00:15:00</p>
            <p><strong>4.5 Tiempo de receso: </strong><?php echo htmlspecialchars($details['additional_time'] ?? 'No disponible'); ?></p>
            <p><strong>4.6 Hora de salida: </strong><?php echo htmlspecialchars($details['time_exit'] ?? 'No disponible'); ?></p>
            <p><strong>4.7 Horas totales del día trabajado: </strong><?php echo htmlspecialchars($details['work_completed'] ?? 'No disponible'); ?></p>
            <br>
            <h3>5.0 Detalles de reposición y horas extras</h3>
            <p><strong>5.1 Fecha de ejecución del trabajo: </strong><?php echo htmlspecialchars($details['date'] ?? 'No disponible'); ?></p>
            <p><strong>5.2 Tiempo por reponer: </strong><?php echo htmlspecialchars($details['time_to_recover'] ?? 'No disponible'); ?></p>
            <p><strong>5.3 Horas extras de este día: </strong><?php echo htmlspecialchars($details['break_completed'] ?? 'No disponible'); ?></p>
            <br>
            <h3>6.0 Comentarios adicionales</h3>
            <p><strong>6.1 Argumento de horas extra: </strong><?php echo htmlspecialchars($details['justificacion'] ?? 'No disponible'); ?></p>
            <p><strong>6.2 Enlace para comprobar horas extras: </strong><a href="https://www.youtube.com">Enlace</a></p>
            <p><strong>6.3 Argumento de reposición de horas: </strong><?php echo htmlspecialchars($details['justificacion'] ?? 'No disponible'); ?></p>
            <p><strong>6.4 Enlace para comprobar horas de reposición: </strong><a href="https://www.youtube.com">Enlace</a></p>
            <p><strong>6.5 Observaciones: </strong>Ejemplo</p>
            <br>
            <?php else: ?>
            <p>No hay datos disponibles para la fecha seleccionada.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
    <?php
    $html = ob_get_clean();
    
    // Cargar el contenido HTML en DOMPDF
    $dompdf->loadHtml($html);
    
    // (Opcional) Configurar el tamaño y orientación del papel
    $dompdf->setPaper('A4', 'portrait');
    
    // Renderizar el PDF
    $dompdf->render();
    
    // Enviar el PDF al navegador
    $dompdf->stream('detalle_dia.pdf', array('Attachment' => 0));
    
} catch (PDOException $e) {
    echo "Error al conectar con la base de datos: " . $e->getMessage();
}
?>
