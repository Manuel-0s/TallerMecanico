<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../models/servicio/servicios.class.php';

$app = new Servicio();
$accion = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;
$datos = [];

switch ($accion) {
    case 'POST':
        break;
    case 'DELETE':
        
        break;
    case 'GET':    
    default:
        $datos = (isset($id) && is_numeric($id)) ? $app->getOne($id) : $app->getAll();
        break;
}
echo json_encode($datos, JSON_UNESCAPED_UNICODE);
?>