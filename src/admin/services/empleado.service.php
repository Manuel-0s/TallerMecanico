<?php
require_once __DIR__ . '/../models/empleado/empleado.class.php';
require_once __DIR__ . '/../exceptions/exeptions.php';
require_once __DIR__ . '/../../helpers/mail.php';
require_once __DIR__ . '/../../helpers/emailTemplate.php';
require_once __DIR__ . '/../validators/empleado.validator.php';

class EmpleadoService {
    public function __construct(private Empleado $empleados) {}

    public function delete(int $id, int $idEmpleadoActual): void {
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

    public function create(array $data): void {
        $appMail = new Mail();

        $enlaceLogin = 'http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php';
        $html = plantillaBienvenida(
            $data['nombre'],
            $data['correo'],
            $data['contrasena'],
            $enlaceLogin
        );

        EmpleadoValidator::validar($data);

        try {
            $this->empleados->create($data);
        } catch (PDOException $e) {
            if ($e->getCode() === '23505') {
                throw new ReglaException('Ya existe un empleado con ese correo electrónico.');
            }
            throw $e;
        }

        $appMail->enviar(
            [$data['correo']],
            'Bienvenido a Taller Mecánico - Datos de acceso',
            $html
        );
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