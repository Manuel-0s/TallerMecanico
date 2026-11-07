<?php
use Dompdf\Dompdf;
use Dompdf\Options;

require_once __DIR__ . '/../config/config.php';

class Pdf {

    function generar(string $html, string $nombre = 'documento.pdf', bool $descargar = false): void {
        $opciones = new Options();
        $opciones->set('defaultFont', 'DejaVu Sans'); // soporta acentos y ñ
        $opciones->set('isRemoteEnabled', false);

        $dompdf = new Dompdf($opciones);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Attachment: true descarga, false lo abre en el navegador
        $dompdf->stream($nombre, ['Attachment' => $descargar]);
    }
}