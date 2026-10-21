<?php
require_once __DIR__ . '/../genericCRUD.php';

class Rol extends GenericCRUD {
    protected $table = "rol";
    protected $primaryKey = "id_rol";
    protected $columns = [
        "rol" => PDO::PARAM_STR,
        "descripcion" => PDO::PARAM_STR
    ];
}
?>