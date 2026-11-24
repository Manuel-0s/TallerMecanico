<?php
require_once __DIR__ . '/../models/cliente/cliente.class.php';
require_once __DIR__ . '/../validators/cliente.validator.php';
require_once __DIR__ . '/../exceptions/exeptions.php';

class ClienteService {
    public function __construct(private Cliente $clientes) {}

    public function obtenerVehiculos($idCliente): array {
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
}
