<?php
require_once __DIR__ . '/../exceptions/exeptions.php';

class EmpleadoValidator {
    public static function validar(array $data, bool $esActualizacion = false): void {
        $errores = [];
        $correo = $data['correo'] ?? null;
        $contrasena = $data['contrasena'] ?? '';
        $roles = $data['roles'] ?? [];

        if (!is_string($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores['correo'] = 'El correo no es valido.';
        }

        if ((!$esActualizacion && empty($contrasena)) ||
            ($contrasena !== '' && (!is_string($contrasena) || strlen($contrasena) < 8))) {
            $errores['contrasena'] = 'La contraseña debe tener al menos 8 caracteres.';
        }

        if (!is_array($roles) || empty($roles)) {
            $errores['roles'] = 'Debe seleccionar al menos un rol.';
        } elseif (self::contieneIdRolInvalido($roles)) {
            $errores['roles'] = 'Los roles seleccionados no son válidos.';
        }

        if (empty($data['nombre']) || !is_string($data['nombre'])) {
            $errores['nombre'] = 'El nombre es obligatorio.';
        }

        if (empty($data['primer_apellido']) || !is_string($data['primer_apellido'])) {
            $errores['primer_apellido'] = 'El primer apellido es obligatorio.';
        }

        if ($errores) {
            throw new ValidacionException($errores);
        }

        
    }

    public static function validarIdEmpleado(mixed $idEmpleado): int {
        $idValidado = filter_var($idEmpleado, FILTER_VALIDATE_INT);

        if ($idValidado === false || $idValidado < 1) {
            throw new ValidacionException([
                'id_empleado' => 'El empleado seleccionado no es válido.'
            ]);
        }

        return $idValidado;
    }

    private static function contieneIdRolInvalido(array $idRoles): bool {
        foreach ($idRoles as $idRol) {
            $idValidado = filter_var($idRol, FILTER_VALIDATE_INT);
            if ($idValidado === false || $idValidado < 1) {
                return true;
            }
        }

        return false;
    }
}