<?php
require_once __DIR__ . '/../exceptions/exeptions.php';

class CitaValidator {
    public const ESTATUS = ['programada', 'atendida', 'cancelada'];

    public static function validar(array $data): void {
        $errores = [];

        if (empty($data['fecha']) || strtotime($data['fecha']) === false) {
            $errores['fecha'] = 'La fecha no es válida.';
        }
        if (empty($data['id_servicio']) || !is_array($data['id_servicio'])) {
            $errores['id_servicio'] = 'Selecciona al menos un servicio.';
        }
        if (isset($data['estatus']) && !in_array($data['estatus'], self::ESTATUS, true)) {
            $errores['estatus'] = 'El estatus no es válido.';
        }

        if ($errores) {
            throw new ValidacionException($errores);
        }
    }
}