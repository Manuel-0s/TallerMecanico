<?php
require_once __DIR__ . '/../models/cliente/cliente.class.php';
require_once __DIR__ . '/../validators/vehiculo.validator.php';
require_once __DIR__ . '/../exceptions/exeptions.php';

class VehiculoService {
    public function __construct(
        private Vehiculo $vehiculos,
        private Cliente $clientes
    ) {}

    public function registrarVehiculo(array $data): void {
        $data = $this->normalizarDatos($data);
        VehiculoValidator::validarCampos($data);
        $this->asegurarClienteExistente((int) $data['id_cliente']);
        $this->persistirVehiculo(fn() => $this->vehiculos->create($data));
    }

    public function actualizarVehiculo(mixed $idVehiculo, array $data): void {
        $idVehiculo = VehiculoValidator::validarIdVehiculo($idVehiculo);
        $this->obtenerVehiculo($idVehiculo);

        $data = $this->normalizarDatos($data);
        VehiculoValidator::validarCampos($data);
        $this->asegurarClienteExistente((int) $data['id_cliente']);
        $this->persistirVehiculo(fn() => $this->vehiculos->update($idVehiculo, $data));
    }

    public function obtenerVehiculo(mixed $idVehiculo): array {
        $idVehiculo = VehiculoValidator::validarIdVehiculo($idVehiculo);
        $vehiculo = $this->vehiculos->getOne($idVehiculo);

        if (!$vehiculo) {
            throw new ReglaException('No se encontró el vehículo seleccionado.');
        }

        return $vehiculo;
    }

    private function asegurarClienteExistente(int $idCliente): void {
        if (!$this->clientes->getOne($idCliente)) {
            throw new ReglaException('El cliente seleccionado no existe.');
        }
    }

    private function normalizarDatos(array $data): array {
        foreach (['matricula', 'marca', 'modelo', 'anio'] as $campo) {
            if (isset($data[$campo]) && is_string($data[$campo])) {
                $data[$campo] = trim($data[$campo]);
            }
        }

        if (isset($data['matricula']) && is_string($data['matricula'])) {
            $data['matricula'] = strtoupper($data['matricula']);
        }

        return $data;
    }

    private function persistirVehiculo(callable $operacion): void {
        try {
            $operacion();
        } catch (PDOException $e) {
            if ($e->getCode() === '23505') {
                throw new ReglaException('Ya existe un vehículo registrado con esa matrícula.');
            }

            throw $e;
        }
    }
}
