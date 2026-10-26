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

        function getCantServicios(){
            $sql = "SELECT s.servicio, count(s.id_servicio) AS cantidad
                FROM servicio s
                    JOIN cita_servicio cs ON s.id_servicio = cs.id_servicio
                GROUP BY s.servicio";
            $stmt = $this -> db -> query($sql);
            $datos = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }

    }
?>