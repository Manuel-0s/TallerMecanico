<?php
require_once __DIR__ . '/../models/cliente/cliente.class.php';
require_once __DIR__ . '/../validators/cliente.validator.php';
require_once __DIR__ . '/../exceptions/exeptions.php';

class ClienteService {
    public function __construct(private Cliente $clientes) {}

    public function registrarCliente(array $data): void {
        $this->persistirCliente(fn() => $this->clientes->create($data));
    }

    public function actualizarCliente(mixed $idCliente, array $data): void {
        $this->persistirCliente(fn() => $this->clientes->update($idCliente, $data));
    }

    public function obtenerVehiculos(mixed $idCliente): array {
        $idCliente = ClienteValidator::validarIdCliente($idCliente);
        $cliente = $this->clientes->getOne($idCliente);

        if (!$cliente) {
            throw new ReglaException('No se encontró el cliente seleccionado.');
        }

        return [
            'cliente' => $cliente,
            'vehiculos' => $this->clientes->getCars($idCliente)
        ];
    }

    private function persistirCliente(callable $operacion): void {
        try {
            $operacion();
        } catch (PDOException $e) {
            if ($e->getCode() === '23505') {
                throw new ReglaException('Ya existe un cliente registrado con ese correo electrónico.');
            }

            throw $e;
        }
    }
}
