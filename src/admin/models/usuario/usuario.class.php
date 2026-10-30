<?php 
require_once __DIR__ . '/../genericCRUD.php';

class Usuario extends GenericCRUD {
    protected $table = "usuario";
    protected $primaryKey = "id_usuario";
    protected $columns = [
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

    function toggleActivo($id) {
        $sql = "UPDATE usuario 
                SET activo = NOT activo 
                WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function getOneByCorreo($correo) {
        $sql = "SELECT * FROM {$this->table} WHERE correo = :correo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>