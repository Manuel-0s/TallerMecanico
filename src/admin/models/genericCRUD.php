<?php 
include_once 'sistema.class.php';

Class GenericCRUD extends Sistema {
    protected $table;
    protected $primaryKey;
    protected $columns;

    function create($data) {
        $datos = [];
        $columns = implode(', ', array_keys($this->columns));
        $placeholders = ':' . implode(', :', array_keys($this->columns));
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";

        $stmt = $this -> db -> prepare($sql);
        foreach ($this->columns as $column => $type) {
            $stmt -> bindParam(":{$column}", $data[$column], $type);
        }
        $stmt -> execute();

        $datos = $data;
        $datos['afectados'] = $stmt->rowCount();
        $datos['id'] = $this->db->lastInsertId();
        return $datos;
    }

    function getOne($id){
        $datos = [];
        if (is_numeric($id)){
            $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id";
            $stmt = $this -> db -> prepare($sql);
            $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
            $stmt -> execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $datos;
    }

    function getAll(){
        $datos = [];
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this -> db -> query($sql);
        $datos = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    function update($id, $data){
        $afectados = 0;
        if(is_numeric($id) && !empty($data)){
            $set = implode(', ', array_map(fn($col) => "{$col} = :{$col}", array_keys($this->columns)));
            $sql = "UPDATE {$this->table} SET {$set} WHERE {$this->primaryKey} = :id";

            $stmt = $this -> db -> prepare($sql);
            foreach ($this->columns as $column => $type) {
                $stmt -> bindParam(":{$column}", $data[$column], $type);
            }
            $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
            $stmt -> execute();
            $afectados = $stmt->rowCount();
        }
        return $afectados;
    }

    function delete($id){
        $afectados = 0;
        if(is_numeric($id)){
            $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
            $stmt = $this -> db -> prepare($sql);
            $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
            $stmt -> execute();
            $afectados = $stmt->rowCount();
        }
        return $afectados;
    }
}
?>