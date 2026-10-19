<?php
require_once __DIR__ . '/config.php';

class Sistema {
    public $db;

    public function __construct() {
        $dsn = DB_DRIVER . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
            
        try {
            $this->db = new PDO($dsn, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    function CargarArchivo($nombre, $ruta){
        $imagen = $_FILES['data'];
            
        if (!isset($imagen['name'][$nombre]) || $imagen['error'][$nombre] !== UPLOAD_ERR_OK) {
            return null;
        }

        $data['nombre'] = $imagen['name'][$nombre];

        $tipos = ['image/jpeg', 'image/png', 'image/webp', 'image/bmp'];
        $extensiones = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

        if (!in_array($imagen['type'][$nombre], $tipos)){
            return null;
        }

        $extension = strtolower(pathinfo($data['nombre'], PATHINFO_EXTENSION));
        if (!in_array($extension, $extensiones)){
            return null;
        }

        $tamanoMaximo = 2 * 1024 * 1024; 
        if($imagen['size'][$nombre] > $tamanoMaximo){
            return null;
        }

        $nuevoNombre = md5('cruzAzulCampeon' . $data['nombre'] . time());
        $nuevoNombre = $nuevoNombre . '.' . $extension;

        if(move_uploaded_file($imagen['tmp_name'][$nombre], __DIR__ . $ruta . $nuevoNombre)){
            return $nuevoNombre; 
        }
            
        return null;
    }
}
?>