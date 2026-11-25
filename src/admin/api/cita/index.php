<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../models/cita/cita.class.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['usuario'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autenticado'], JSON_UNESCAPED_UNICODE);
    exit;
}
if (!in_array('Administrador', $_SESSION['roles'] ?? [], true)) {
    http_response_code(403);
    echo json_encode(['error' => 'Sin permiso'], JSON_UNESCAPED_UNICODE);
    exit;
}

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
        if (isset($_POST['estatus'])) {
            $ok = $app->generarOrden($id, $_POST['estatus']);
            echo json_encode(['ok' => $ok], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $data = $_POST['data'];
        $datos['afectados'] = $app->update($id, $data); 
        $datos = ['mensaje' => 'servicio actualizado correctamente'];
        $datos['registro'] = $app->getOne($id);
        break;
    case 'DELETE':
        break;
    case 'GET':    
    default:
        $datos = (isset($id) && is_numeric($id)) ? $app->getOne($id) : $app->getAll();
        foreach ($datos as $cita) {
            $servicios = $app->getServiciosDetalle($cita['id_cita']);

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
                    'servicios' => array_column($servicios, 'servicio'),
                ],
            ]; 
        }
        break;
}
echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
?>