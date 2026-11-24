<?php
require_once __DIR__ . '/../exceptions/exeptions.php';

class ClienteValidator {
    public static function validarIdCliente($idCliente): int {
        $idValidado = filter_var($idCliente, FILTER_VALIDATE_INT);

        if ($idValidado === false || $idValidado < 1) {
            throw new ValidacionException([
                'id_cliente' => 'El cliente seleccionado no es válido.'
            ]);
        }

        return $idValidado;
    }
}
