<?php
require_once __DIR__ . '/../models/cita/cita.class.php';
require_once __DIR__ . '/../validators/cita.validator.php';

class CitaService {
    public function __construct(private Cita $citas) {}

    public function agendar(array $data, string $tipoRegistro): void {
        CitaValidator::validar($data);
        $this->asegurarFechaNoPasada($data['fecha']);

        $data['estatus'] = 'programada';

        $tipoRegistro === 'nuevo'
            ? $this->citas->createNew($data)
            : $this->citas->createExist($data);
    }

    private function asegurarFechaNoPasada(string $fecha): void {
        if (strtotime($fecha) < strtotime('today')) {
            throw new ReglaException('No se puede agendar una cita en una fecha pasada.');
        }
    }
}