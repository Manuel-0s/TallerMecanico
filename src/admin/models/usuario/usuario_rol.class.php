<?php
require_once __DIR__ . '/../genericCRUD.php';

Class UsuarioRol extends GenericCRUD {
    protected $table = "usuario_rol";
    protected $primaryKey = "id_usuario_rol";
    protected $columns = [
        "id_usuario" => PDO::PARAM_INT,
        "id_rol" => PDO::PARAM_INT
    ];

    function create($data) {   
        $datos = [];
        $columns = implode(', ', array_keys($this->columns));
        $placeholders = ':' . implode(', :', array_keys($this->columns));
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        
        $stmt = $this -> db -> prepare($sql);

        foreach ($data['id_rol'] as $roles){
            $stmt -> bindparam(':id_rol', $roles, PDO::PARAM_INT);
            $stmt -> bindparam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
            echo $stmt -> queryString;
            $stmt -> execute();
        }
        
        $datos = $data;
        $datos['afectados'] = $stmt->rowCount();
        $datos['id'] = $this->db->lastInsertId();
        return $datos;
    }
}
?>