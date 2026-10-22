<?php
    require_once __DIR__.'/../genericCRUD.php';

    class Servicio extends GenericCRUD {
        protected $table = "servicio";
        protected $primaryKey = "id_servicio";
        protected $columns = [
            "servicio" => PDO::PARAM_STR, 
            "descripcion" => PDO::PARAM_STR, 
            "precio_base" => PDO::PARAM_STR, 
            "imagen" => PDO::PARAM_STR
        ];

    }
?>