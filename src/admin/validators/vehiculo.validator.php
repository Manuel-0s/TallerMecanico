<?php
require_once __DIR__ . '/../exceptions/exeptions.php';

class VehiculoValidator {
    public static function validarCampos(array $data): void {
        $errores = [];
        $matricula = $data['matricula'] ?? null;
        $marca = $data['marca'] ?? null;
        $modelo = $data['modelo'] ?? null;
        $anio = $data['anio'] ?? null;
        $idCliente = filter_var($data['id_cliente'] ?? null, FILTER_VALIDATE_INT);

        if (!is_string($matricula) || !preg_match('/^[A-Z]{3}[0-9]{4}$/D', $matricula)) {
            $errores['matricula'] = 'La matrícula debe tener tres letras y cuatro números.';
        }

        if (!is_string($marca) || !preg_match('/^[A-Za-z\s]{1,50}$/D', $marca)) {
            $errores['marca'] = 'La marca es obligatoria y debe contener entre 1 y 50 caracteres alfabéticos.';
        }

        if (!is_string($modelo) || !preg_match('/^[A-Za-z0-9\s]{1,50}$/D', $modelo)) {
            $errores['modelo'] = 'El modelo es obligatorio y debe contener entre 1 y 50 caracteres alfanuméricos.';
        }

        if (!is_string($anio) || !preg_match('/^(19[0-9]{2}|20[0-9]{2}|2100)$/D', $anio)) {
            $errores['anio'] = 'El año debe estar entre 1900 y 2100.';
        }

        if ($idCliente === false || $idCliente < 1) {
            $errores['id_cliente'] = 'Selecciona un cliente válido.';
        }

        if ($errores) {
            throw new ValidacionException($errores);
        }
    }

    public static function validarIdVehiculo(mixed $idVehiculo): int {
        $idValidado = filter_var($idVehiculo, FILTER_VALIDATE_INT);

        if ($idValidado === false || $idValidado < 1) {
            throw new ValidacionException([
                'id_vehiculo' => 'El vehículo seleccionado no es válido.'
            ]);
        }

        return $idValidado;
    }
}
