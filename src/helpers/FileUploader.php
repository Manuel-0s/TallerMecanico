<?php
require_once __DIR__ . '/../admin/exceptions/exeptions.php';

class fileUploader {

    public function cargarArchivo(string $nombre, string $directorioDestino): ?string
    {
        if (
            !isset($_FILES['data']['error'][$nombre]) || 
            $_FILES['data']['error'][$nombre] === UPLOAD_ERR_NO_FILE
        ) {
            return null;
        }

        if ($_FILES['data']['error'][$nombre] !== UPLOAD_ERR_OK) {
            throw new ValidacionException(['foto' => 'Error al subir el archivo (verifica que no pese más de 2MB).']);
        }

        $archivo = $_FILES['data'];
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/bmp'];
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp', 'bmp'];

        $mimeReal = mime_content_type($archivo['tmp_name'][$nombre]);
        if (!in_array($mimeReal, $tiposPermitidos, true)) {
            throw new ValidacionException(['foto' => 'El archivo debe ser una imagen válida (jpg, jpeg, png, webp, bmp).']);
        }

        $extension = strtolower(pathinfo($archivo['name'][$nombre], PATHINFO_EXTENSION));
        if (!in_array($extension, $extensionesPermitidas, true) || $archivo['size'][$nombre] > 2 * 1024 * 1024) {
            throw new ValidacionException(['foto' => 'La imagen no debe pesar más de 2MB.']);
        }

        $nombreArchivo = md5($archivo['name'][$nombre] . microtime(true)) . '.' . $extension;
        $directorioDestino = rtrim($directorioDestino, DIRECTORY_SEPARATOR);

        if (!is_dir($directorioDestino) && !mkdir($directorioDestino, 0775, true) && !is_dir($directorioDestino)) {
            throw new ValidacionException(['foto' => 'No se pudo crear la carpeta de destino en el servidor.']);
        }

        if (move_uploaded_file($archivo['tmp_name'][$nombre], $directorioDestino . DIRECTORY_SEPARATOR . $nombreArchivo)) {
            return $nombreArchivo;
        }

        throw new ValidacionException(['foto' => 'No se pudo guardar la imagen en el servidor.']);
    }
}