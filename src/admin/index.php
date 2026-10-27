<?php
require_once __DIR__ . '/models/cita/cita.class.php';
require_once __DIR__ . '/models/servicio/servicios.class.php';
require_once __DIR__ . '/models/auth/auth.class.php';

$appAuth = new Auth();
$appAuth -> verificarRol('Mecanico');

$appCita = new Cita();
$citasEstatus = $appCita->getCitaEstatus();

$appServicio = new Servicio();
$totalServicios = $appServicio->getCantServicios();

$citasPorEstatus = [
    'cancelada' => 0,
    'atendida' => 0,
    'programada' => 0
];
foreach ($citasEstatus as $cita) {
    $estatus = strtolower($cita['estatus']);
    if (array_key_exists($estatus, $citasPorEstatus)) {
        $citasPorEstatus[$estatus] = (int) $cita['total'];
    }
}

$servicios = [
    'nombres' => array_column($totalServicios, 'servicio'),
    'cantidades' => array_map('intval', array_column($totalServicios, 'cantidad'))
];
$totalCitas = array_sum($citasPorEstatus);
$servicioMasSolicitado = 'Sin registros';
if (!empty($servicios['cantidades'])) {
    $servicioIndex = array_search(max($servicios['cantidades']), $servicios['cantidades'], true);
    $servicioMasSolicitado = $servicios['nombres'][$servicioIndex];
}

require_once __DIR__ . '/../templates/admin/sidebar.html';
require_once __DIR__ . '/../templates/admin/index.html';
require_once __DIR__ . '/../templates/admin/footer.html';
?>