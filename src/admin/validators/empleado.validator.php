<?php
require_once __DIR__ . '/../exceptions/exeptions.php';

class EmpleadoValidator {
    public static function validar(array $data): void {
        $errores = [];

        if (empty($data['correo']) || !filter_var($data['correo'], FILTER_VALIDATE_EMAIL)) {
            $errores['correo'] = 'El correo no es valido.';
        }

        if (empty($data['contrasena']) || strlen($data['contrasena']) < 8) {
            $errores['contrasena'] = 'La contraseña debe tener al menos 8 caracteres.';
        }

        if (empty($data['id_rol']) || !is_array($data['id_rol'])) {
            $errores['id_rol'] = 'Debes seleccionar al menos un rol.';
        }

        if (empty($data['nombre'])) {
            $errores['nombre'] = 'El nombre es obligatorio.';
        }

        if (empty($data['primer_apellido'])) {
            $errores['primer_apellido'] = 'El primer apellido es obligatorio.';
        }

        if ($errores) {
            throw new ValidacionException($errores);
        }
    }
}