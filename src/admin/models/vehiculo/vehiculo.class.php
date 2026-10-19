<?php 
require_once __DIR__ . '/../genericCRUD.php';

class Vehiculo extends genericCRUD {
    protected $table = "vehiculo";
    protected $primaryKey = "id_vehiculo";
    protected $columns = [
        "matricula" => PDO::PARAM_STR, 
        "marca" => PDO::PARAM_STR, 
        "modelo" => PDO::PARAM_STR, 
        "anio" => PDO::PARAM_STR, 
        "id_cliente" => PDO::PARAM_INT
    ];

    function create($data) {
        $data['matricula'] = strtoupper(trim($data['matricula']));
        return parent::create($data);
    }
}
?>