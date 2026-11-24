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
        EmpleadoValidator::validar($data);

        $appMail = new Mail();

        $enlaceLogin = 'http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php';
        $html = plantillaBienvenida(
            $data['nombre'],
            $data['correo'],
            $data['contrasena'],
            $enlaceLogin
        );

        $this->persistirEmpleado(fn() => $this->empleados->create($data));

        $appMail->enviar(
            [$data['correo']],
            'Bienvenido a Taller Mecánico - Datos de acceso',
            $html
        );
    }

    public function update(int $id, array $data): void {
        $id = EmpleadoValidator::validarIdEmpleado($id);
        $empleado = $this->empleados->getOne($id);

        if (!$empleado) {
            throw new ReglaException('No se encontró el empleado seleccionado.');
        }

        $data['foto'] = $data['foto'] ?? $empleado['foto'];
        $data['id_rol'] = $data['id_rol'] ?? [];
        EmpleadoValidator::validar($data, true);

        $this->persistirEmpleado(fn() => $this->empleados->update($id, $data));
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

    private function persistirEmpleado(callable $operacion): void {
        try {
            $operacion();
        } catch (PDOException $e) {
            if ($e->getCode() === '23505') {
                throw new ReglaException('Ya existe un empleado con ese correo electrónico.');
            }

            throw $e;
        }
    }
}