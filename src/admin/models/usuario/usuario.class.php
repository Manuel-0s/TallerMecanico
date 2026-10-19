<?php 
require_once __DIR__ . '/../genericCRUD.php';

class Usuario extends GenericCRUD {
    protected $table = "usuario";
    protected $primaryKey = "id_usuario";
    protected $columns = [
        "nombre" => PDO::PARAM_STR,
        "primer_apellido" => PDO::PARAM_STR,
        "segundo_apellido" => PDO::PARAM_STR,
        "telefono" => PDO::PARAM_INT,
        "correo" => PDO::PARAM_STR
    ];

    }
?>