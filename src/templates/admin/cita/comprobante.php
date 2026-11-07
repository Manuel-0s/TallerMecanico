<?php
$e = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
$total = array_sum(array_column($servicios, 'precio_base'));
$cliente = trim($cita['nombre'] . ' ' . $cita['primer_apellido'] . ' ' . ($cita['segundo_apellido'] ?? ''));

// El logo va en base64 para evitar problemas de rutas
$rutaLogo = __DIR__ . '/../../../assets/images/logos/logo.png';
$logo = file_exists($rutaLogo)
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($rutaLogo))
    : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #222; }
        h1 { font-size: 20px; margin: 0; }
        .muted { color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th { background: #f0f0f0; text-align: left; padding: 8px; border-bottom: 1px solid #ccc; }
        td { padding: 8px; border-bottom: 1px solid #eee; }
        .derecha { text-align: right; }
        .total { font-size: 14px; font-weight: bold; }
        .seccion { margin-top: 22px; font-weight: bold; text-transform: uppercase; font-size: 11px; color: #555; }
    </style>
</head>
<body>
    <table style="margin-top:0">
        <tr>
            <td style="border:0">
                <?php if ($logo): ?><img src="<?= $logo ?>" height="40"><?php endif; ?>
            </td>
            <td class="derecha" style="border:0">
                <h1>Comprobante de cita</h1>
                <span class="muted">Folio #<?= (int) $cita['id_cita'] ?></span>
            </td>
        </tr>
    </table>

    <div class="seccion">Cita</div>
    <p>
        <strong>Fecha:</strong> <?= date('d/m/Y H:i', strtotime($cita['fecha'])) ?><br>
        <strong>Estatus:</strong> <?= $e(ucfirst($cita['estatus'])) ?>
    </p>

    <div class="seccion">Cliente</div>
    <p>
        <?= $e($cliente) ?><br>
        <span class="muted"><?= $e($cita['telefono']) ?> · <?= $e($cita['correo']) ?></span>
    </p>

    <div class="seccion">Vehículo</div>
    <p>
        <?= $e($cita['marca'] . ' ' . $cita['modelo'] . ' ' . $cita['anio']) ?><br>
        <span class="muted">Matrícula: <?= $e($cita['matricula']) ?></span>
    </p>

    <div class="seccion">Servicios</div>
    <table>
        <thead>
            <tr><th>Servicio</th><th class="derecha">Precio base</th></tr>
        </thead>
        <tbody>
            <?php foreach ($servicios as $s): ?>
            <tr>
                <td><?= $e($s['servicio']) ?></td>
                <td class="derecha">$<?= number_format((float) $s['precio_base'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td class="derecha total">Total estimado</td>
                <td class="derecha total">$<?= number_format((float) $total, 2) ?></td>
            </tr>
        </tbody>
    </table>

    <?php if (!empty($cita['observaciones'])): ?>
        <div class="seccion">Observaciones</div>
        <p><?= nl2br($e($cita['observaciones'])) ?></p>
    <?php endif; ?>

    <p class="muted" style="margin-top:30px; font-size:10px;">
        Documento generado el <?= date('d/m/Y H:i') ?>. El total es una estimación basada en precios base.
    </p>
</body>
</html>