<?php
require_once __DIR__ . '/../models/empleado/empleado.class.php';
require_once __DIR__ . '/../exceptions/exeptions.php';

class EmpleadoService {
    public function __construct(private Empleado $empleados) {}

    public function eliminar(int $id, int $idEmpleadoActual): void {
        $this->asegurarQueNoEsMiCuenta($id, $idEmpleadoActual, 'eliminar');

        try {
            $this->empleados->delete($id);
        } catch (PDOException $e) {
            if ($e->getCode() === '23503') {
                throw new ReglaException('No se puede eliminar: tiene registros relacionados.');
            }
            throw $e;
        }
    }

    public function alternarActivo(int $id, int $idEmpleadoActual): void {
        $this->asegurarQueNoEsMiCuenta($id, $idEmpleadoActual, 'desactivar');
        $this->empleados->toggleActivo($id);
    }

    private function asegurarQueNoEsMiCuenta(int $id, int $idActual, string $accion): void {
        if ($id === $idActual) {
            throw new ReglaException("No puedes $accion tu propia cuenta.");
        }
    }
}