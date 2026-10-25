<?php
require_once __DIR__ . '/../genericCRUD.php';

Class permiso extends GenericCRUD {
    protected $table = "permiso";
    protected $primaryKey = "id_permiso";
    protected $columns = [
        "permiso" => PDO::PARAM_STR,
        "descripcion" => PDO::PARAM_STR
    ];
}
?>