<?php

class fileUploader
{
    public function cargarArchivo(string $nombre, string $directorioDestino): ?string
    {
        if (!isset($_FILES['data']['name'][$nombre]) || $_FILES['data']['error'][$nombre] !== UPLOAD_ERR_OK) {
            return null;
        }

        $archivo = $_FILES['data'];
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/bmp'];
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp', 'bmp'];

        if (!in_array($archivo['type'][$nombre], $tiposPermitidos, true)) {
            return null;
        }

        $extension = strtolower(pathinfo($archivo['name'][$nombre], PATHINFO_EXTENSION));
        if (!in_array($extension, $extensionesPermitidas, true) || $archivo['size'][$nombre] > 2 * 1024 * 1024) {
            return null;
        }

        $nombreArchivo = md5($archivo['name'][$nombre] . microtime(true)) . '.' . $extension;
        $directorioDestino = rtrim($directorioDestino, DIRECTORY_SEPARATOR);

        if (!is_dir($directorioDestino) && !mkdir($directorioDestino, 0775, true) && !is_dir($directorioDestino)) {
            return null;
        }

        if (move_uploaded_file($archivo['tmp_name'][$nombre], $directorioDestino . DIRECTORY_SEPARATOR . $nombreArchivo)) {
            return $nombreArchivo;
        }

        return null;
    }
}
