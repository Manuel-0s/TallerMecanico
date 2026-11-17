<?php
    function mensajeError(Throwable $e, string $accion = 'completar la operación'): string {
        return match ($e->getCode()) {
            '23505' => 'Ya existe un registro con esos datos.',
            '23503' => 'No se puede eliminar: tiene registros relacionados.',
            '23502' => 'Faltan datos obligatorios.',
            default => "No se pudo $accion. Intenta de nuevo.",
        };
    }

    function alerta(string $mensaje, string $tipo = 'success'): array {
        return ['mensaje' => $mensaje, 'tipo' => $tipo];
    }
?>