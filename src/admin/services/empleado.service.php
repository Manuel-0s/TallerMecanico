<?php
require_once __DIR__ . '/../models/empleado/empleado.class.php';
require_once __DIR__ . '/../exceptions/exeptions.php';
require_once __DIR__ . '/../../helpers/mail.php';
require_once __DIR__ . '/../../helpers/emailTemplate.php';
require_once __DIR__ . '/../../helpers/fileUploader.php';
require_once __DIR__ . '/../validators/empleado.validator.php';

class EmpleadoService {
    private string $rutaUploads;

    public function __construct(private Empleado $empleados) {
        $this->rutaUploads = __DIR__ . '/../../assets/images/uploads';
    }

    public function delete(mixed $id, mixed $idEmpleadoActual): void {
        $id = $this->validarExistencia($id);
        $idEmpleadoActual = EmpleadoValidator::validarIdEmpleado($idEmpleadoActual);
        $this->asegurarQueNoEsMiCuenta($id, $idEmpleadoActual, 'eliminar');

        $empleado = $this->empleados->getOne($id);

        try {
            $this->empleados->delete($id);
            if ($empleado && !empty($empleado['foto'])) {
                @unlink($this->rutaUploads . '/' . $empleado['foto']);
            }
        } catch (PDOException $e) {
            if ($e->getCode() === '23503' || $e->getCode() === '23505') {
                throw new ReglaException('No se puede eliminar: tiene registros relacionados.');
            }
            throw $e;
        }
    }

    public function create(array $data): void {
        EmpleadoValidator::validar($data);

        $uploader = new fileUploader();
        $foto = $uploader->cargarArchivo('foto', $this->rutaUploads);
        $data['foto'] = $foto;

        try {
            $this->persistirEmpleado(fn() => $this->empleados->create($data));
        } catch (Throwable $e) {
            if ($foto) {
                @unlink($this->rutaUploads . '/' . $foto);
            }
            throw $e;
        }

        $appMail = new Mail();
        $enlaceLogin = 'http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php';
        $html = plantillaBienvenida(
            $data['nombre'],
            $data['correo'],
            $data['contrasena'],
            $enlaceLogin
        );

        $appMail->enviar(
            [$data['correo']],
            'Bienvenido a Taller Mecánico - Datos de acceso',
            $html
        );
    }

    public function update(mixed $id, array $data): void {
        $id = $this->validarExistencia($id);
        $empleado = $this->empleados->getOne($id);

        EmpleadoValidator::validar($data, true);

        $uploader = new fileUploader();
        $nuevaFoto = $uploader->cargarArchivo('foto', $this->rutaUploads);
        $data['foto'] = $nuevaFoto ?? $empleado['foto'];

        try {
            $this->persistirEmpleado(fn() => $this->empleados->update($id, $data));

            if ($nuevaFoto && !empty($empleado['foto'])) {
                @unlink($this->rutaUploads . '/' . $empleado['foto']);
            }
        } catch (Throwable $e) {
            if ($nuevaFoto) {
                @unlink($this->rutaUploads . '/' . $nuevaFoto);
            }
            throw $e;
        }
    }

    public function alternarActivo(mixed $id, mixed $idEmpleadoActual): void {
        $id = $this->validarExistencia($id);
        $idEmpleadoActual = EmpleadoValidator::validarIdEmpleado($idEmpleadoActual);
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
            if ($e->getCode() === '23000') {
                $msg = $e->getMessage();
                if (str_contains($msg, 'uq_rfc')) {
                    throw new ReglaException('El RFC ya está registrado con otro empleado.');
                }
                if (str_contains($msg, 'uq_correo')) {
                    throw new ReglaException('El correo electrónico ya está registrado.');
                }
                throw new ReglaException('Ya existe un empleado con esos datos.');
            }
            throw $e;
        }
    }

    public function validarExistencia(mixed $id): int {
        $id = EmpleadoValidator::validarIdEmpleado($id);

        if (!$this->empleados->existeEmpleado($id)) {
            throw new ReglaException('No se puede completar la operación: el empleado no existe.');
        }

        return $id;
    }
}