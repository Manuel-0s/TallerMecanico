<?php 
require_once __DIR__ . '/../genericCRUD.php';

class Usuario extends GenericCRUD {
    protected $table = "usuario";
    protected $primaryKey = "id_usuario";
    protected $columns = [
        "nombre" => PDO::PARAM_STR,
        "primer_apellido" => PDO::PARAM_STR,
        "segundo_apellido" => PDO::PARAM_STR,
        "correo" => PDO::PARAM_STR,
        "contrasena" => PDO::PARAM_STR,
        'activo' => PDO::PARAM_BOOL
    ];

    function create($data) {
        $data['contrasena'] = password_hash($data['contrasena'], PASSWORD_DEFAULT);
        $data['activo'] = isset($data['activo']) ? (bool) $data['activo'] : true; 
        return parent::create($data);
    }

    function update($id, $data) {
        if (!empty($data['contrasena'])) {
            $data['contrasena'] = password_hash($data['contrasena'], PASSWORD_DEFAULT);
        } else {
            $data['contrasena'] = $this->getOne($id)['contrasena'];
        }
        $data['activo'] = isset($data['activo']) ? (bool) $data['activo'] : true; 
        return parent::update($id, $data);
    }

    function disable($id) {
        $data = $this->getOne($id)['activo'] === false ? ['activo' => true] : ['activo' => false];

        $sqp = "UPDATE {$this->table} SET activo = :activo WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sqp);
        $stmt->bindValue(':activo', $data['activo'], PDO::PARAM_BOOL);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>