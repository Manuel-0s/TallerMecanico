<?php
require_once __DIR__ . '/../genericCRUD.php';

Class UsuarioRol extends GenericCRUD {
    protected $table = "usuario_rol";
    protected $primaryKey = "id_usuario";
    protected $columns = [
        "id_usuario" => PDO::PARAM_INT,
        "id_rol" => PDO::PARAM_INT
    ];

    function create($data) {   
        $columns = implode(', ', array_keys($this->columns));
        $placeholders = ':' . implode(', :', array_keys($this->columns));
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        
        $stmt = $this -> db -> prepare($sql);

        foreach ($data['id_rol'] as $roles){
            $stmt -> bindparam(':id_rol', $roles, PDO::PARAM_INT);
            $stmt -> bindparam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
            $stmt -> execute();
        }
    }

    function getRolesById($id){
        $datos = [];
        if (is_numeric($id)){
            $sql = "SELECT ur.id_rol FROM empleado e
                    JOIN usuario u ON e.id_usuario = u.id_usuario
                    JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                    WHERE e.id_empleado = :id";
            $stmt = $this -> db -> prepare($sql);
            $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
            $stmt -> execute();
            $datos = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
        return $datos;
    }

    function syncRoles($id, $data){
        $afectados = 0;
        if (is_numeric($id)){

            if (!isset($data['id_rol'])) {
                $data['id_rol'] = [];
            }

            $this -> delete($id);

            $sql = "INSERT INTO {$this->table} (id_usuario, id_rol) VALUES (:id, :id_rol)";
            $stmt = $this -> db -> prepare($sql);

            foreach ($data['id_rol'] as $roles) {
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> bindParam(":id_rol", $roles, PDO::PARAM_INT);
                $stmt -> execute();
            }

            $afectados = $stmt->rowCount();
        }
        return $afectados;
    }
}
?>