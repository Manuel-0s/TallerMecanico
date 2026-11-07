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

    function getDetalle($id) {
        $sql = "SELECT c.*, v.matricula, v.marca, v.modelo, v.anio,
                    cl.nombre, cl.primer_apellido, cl.segundo_apellido,
                    cl.telefono, cl.correo
                FROM cita c
                    JOIN vehiculo v ON c.id_vehiculo = v.id_vehiculo
                    JOIN cliente cl ON v.id_cliente = cl.id_cliente
                WHERE c.id_cita = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getServiciosDetalle($id) {
        $sql = "SELECT s.servicio, s.descripcion, s.precio_base
                FROM cita_servicio cs
                    JOIN servicio s ON cs.id_servicio = s.id_servicio
                WHERE cs.id_cita = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>