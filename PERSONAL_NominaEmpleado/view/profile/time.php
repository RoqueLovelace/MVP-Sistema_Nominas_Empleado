<?php
date_default_timezone_set('America/El_Salvador');
header('Content-Type: application/json');

// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo json_encode([
    'time' => date('H:i:s')
]);
?>
