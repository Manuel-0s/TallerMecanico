<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../models/cita/cita.class.php';

$app = new Cita();
$accion = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;
$datos = [];
$eventos = [];

$colores = [
    'programada' => '#3788d8',
    'atendida'   => '#198754',
    'cancelada'  => '#dc3545',
];

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
                'id' => $cita['id_cita'],
                'title' => $cita['nombre'] . ' ' . $cita['primer_apellido'] . ' ' . $cita['segundo_apellido'] . ' - ' . $cita['matricula'], 
                'start' => $cita['fecha'],
                'color' => $colores[$cita['estatus']] ?? '#6c757d',
                'extendedProps' => [
                    'estatus' => $cita['estatus'],
                    'telefono' => $cita['telefono'],
                    'correo' => $cita['correo'],
                    'marca' => $cita['marca'],
                    'modelo' => $cita['modelo'],
                    'anio' => $cita['anio'],
                ],
            ]; 
        }
        break;
}
echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
?>