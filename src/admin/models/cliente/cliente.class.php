<?php 
require_once __DIR__ . '/../genericCRUD.php';

class Cliente extends GenericCRUD {
    protected $table = "cliente";
    protected $primaryKey = "id_cliente";
    protected $columns = [
        "nombre" => PDO::PARAM_STR, 
        "primer_apellido" => PDO::PARAM_STR, 
        "segundo_apellido" => PDO::PARAM_STR, 
        "telefono" => PDO::PARAM_STR, 
        "correo" => PDO::PARAM_STR
        ];   
}
?>