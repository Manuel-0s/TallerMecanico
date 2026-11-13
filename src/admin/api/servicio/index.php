<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../models/servicio/servicios.class.php';
include_once __DIR__ . '/../../../helpers/FileUploader.php';

$app = new Servicio();
$uploader = new FileUploader();
$accion = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;
$datos = [];

switch ($accion) {
    case 'POST':
        $data = $_POST['data'];

        if (isset($id) && is_numeric($id)) {
            $data['imagen'] = $uploader->cargarArchivo(
                'imagen',
                __DIR__ . '/../../../assets/images/uploads'
            );

            $datos = [
                'mensaje' => 'servicio actualizado correctamente',
                'afectados' => $app->update($id, $data),
                'registro' => $app->getOne($id)
            ];
        } else {
            $data['imagen'] = $uploader->cargarArchivo(
                'imagen',
                __DIR__ . '/../../../assets/images/uploads'
            );

            $datos = [
                'registro' => $app->create($data),
                'mensaje' => 'servicio creado correctamente'
            ];
        }
        break;
    case 'DELETE':
        if (isset($id) && is_numeric($id)) {
            $datos = [
                'afectados' => $app->delete($id),
                'mensaje' => 'servicio eliminado correctamente'
            ];
        } else {
            $datos = ['mensaje' => 'No se pudo eliminar el servicio'];
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