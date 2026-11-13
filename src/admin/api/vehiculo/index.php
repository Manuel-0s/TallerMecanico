<?php
header('Content-Type: application/json; charset=utf-8');

require_once '../../models/vehiculo/vehiculo.class.php';

$app = new Vehiculo();
$accion = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;
$datos = [];

switch ($accion) {
    case 'POST':
        $data = $_POST['data'] ?? [];

        if (isset($id) && is_numeric($id)) {
            $datos = [
                'mensaje' => 'vehículo actualizado correctamente',
                'afectados' => $app->update($id, $data),
                'registro' => $app->getOne($id),
            ];
        } else {
            $datos = [
                'mensaje' => 'vehículo creado correctamente',
                'registro' => $app->create($data),
            ];
        }
        break;

    case 'DELETE':
        if (isset($id) && is_numeric($id)) {
            $datos = [
                'mensaje' => 'vehículo eliminado correctamente',
                'afectados' => $app->delete($id),
            ];
        } else {
            $datos = ['mensaje' => 'No se pudo eliminar el vehículo'];
        }
        break;

    case 'GET':
    default:
        $datos = (isset($id) && is_numeric($id))
            ? $app->getOne($id)
            : $app->getAll();
        break;
}

echo json_encode($datos, JSON_UNESCAPED_UNICODE);
?>
