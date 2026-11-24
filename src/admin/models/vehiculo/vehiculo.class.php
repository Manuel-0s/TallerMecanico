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
        $data = $this->normalizarMatricula($data);
        return parent::create($data);
    }

    function update($id, $data) {
        $data = $this->normalizarMatricula($data);
        return parent::update($id, $data);
    }

    private function normalizarMatricula($data) {
        if (isset($data['matricula']) && is_string($data['matricula'])) {
            $data['matricula'] = strtoupper(trim($data['matricula']));
        }

        return $data;
    }

    function getAllConCliente() {
        $sql = "SELECT v.*,
                       c.nombre AS cliente_nombre,
                       c.primer_apellido AS cliente_primer_apellido,
                       c.segundo_apellido AS cliente_segundo_apellido,
                       c.telefono AS cliente_telefono,
                       c.correo AS cliente_correo
                FROM vehiculo v
                JOIN cliente c ON v.id_cliente = c.id_cliente
                ORDER BY v.matricula";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>