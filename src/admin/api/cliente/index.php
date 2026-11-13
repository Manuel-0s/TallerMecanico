<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../models/cliente/cliente.class.php';

$app = new Cliente();
$accion = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;
$datos = [];

switch ($accion) {
    case 'POST':
        if (isset($id) && is_numeric($id)) {
            $data = $_POST['data'];
            $datos['afectados'] = $app->update($id, $data); 
            $datos = ['mensaje' => 'cliente actualizado correctamente'];
            $datos['registro'] = $app->getOne($id);
        } else {
            $data = $_POST['data'];
            $datos['afectados'] = $app->create($data);
            $datos = ['mensaje' => 'cliente creado correctamente'];
        }
        break;
    case 'DELETE':
        if (isset($id) && is_numeric($id)) {
            $datos['afectados'] = $app->delete($id);
            $datos = ['mensaje' => 'cliente eliminado correctamente'];
        } else {
            $datos = ['mensaje' => 'No se pudo eliminar el servicio'];
        }
        break;
    case 'GET':    
    default:
        $datos = (isset($id) && is_numeric($id)) ? $app->getOne($id) : $app->getAll();
        break;
}
echo json_encode($datos, JSON_UNESCAPED_UNICODE);
?>