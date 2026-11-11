<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../models/cita/cita.class.php';

$app = new Cita();
$accion = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;
$datos = [];
$eventos = [];

switch ($accion) {
    case 'POST':
        break;
    case 'DELETE':
        break;
    case 'GET':    
    default:
        $datos = (isset($id) && is_numeric($id)) ? $app->getOne($id) : $app->getAll();
        foreach ($datos as $cita) {
            $eventos [] = [
                'title' => $cita['servicio'] . ' - ' . $cita['marca'] . ' ' . $cita['modelo'],
                'date' => $cita['fecha'],
                'color' => '#3788d8',
            ]; 
        }
        break;
}
echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
?>