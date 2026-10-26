<?php 
require_once __DIR__ . '/../genericCRUD.php';

Class Cita extends genericCRUD{
    protected $table = 'cita';
    protected $primaryKey = 'id_cita';
    protected $columns = [
        'fecha', 
        'estatus', 
        'observaciones',
        'id_vehiculo'];

        function getCitaEstatus(){
            $sql = "SELECT estatus, COUNT(*) AS total FROM {$this -> table} GROUP BY estatus";
            $stmt = $this -> db -> query($sql);
            $datos = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }
}

?>