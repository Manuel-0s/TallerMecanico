<?php
require_once __DIR__ . '/../genericCRUD.php';

class RolPermiso extends GenericCRUD {
    protected $table = 'rol_permiso';
    protected $primaryKey = 'id_rol';
    protected $columns = [
        'id_rol' => PDO::PARAM_INT,
        'id_permiso' => PDO::PARAM_INT
    ];

    function create($data) {   
        $columns = implode(', ', array_keys($this->columns));
        $placeholders = ':' . implode(', :', array_keys($this->columns));
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        
        $stmt = $this -> db -> prepare($sql);

        foreach ($data['id_permiso'] as $permisos){
            $stmt -> bindparam(':id_permiso', $permisos, PDO::PARAM_INT);
            $stmt -> bindparam(':id_rol', $data['id_rol'], PDO::PARAM_INT);
            $stmt -> execute();
        }
    }

    function getPermisoById($id){
        $datos = [];
        if (is_numeric($id)){
            $sql = "SELECT id_permiso FROM {$this->table} WHERE {$this->primaryKey} = :id";
            $stmt = $this -> db -> prepare($sql);
            $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
            $stmt -> execute();
            $datos = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
        return $datos;
    }

     function syncPermisos($id, $data){
        $afectados = 0;
        if (is_numeric($id)){

            if (!isset($data['id_permiso'])) {
                $data['id_permiso'] = [];
            }

            $this -> delete($id);

            $sql = "INSERT INTO {$this->table} (id_rol, id_permiso) VALUES (:id, :id_permiso)";
            $stmt = $this -> db -> prepare($sql);

            foreach ($data['id_permiso'] as $permisos) {
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> bindParam(":id_permiso", $permisos, PDO::PARAM_INT);
                $stmt -> execute();
            }

            $afectados = $stmt->rowCount();
        }
        return $afectados;
    }

}
?>