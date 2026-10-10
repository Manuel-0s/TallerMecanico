<?php 
    require_once __DIR__ . '/../sistema.class.php';

    class Cliente extends Sistema {

        function create($data) {
            $datos = [];

            $sql = "INSERT INTO cliente (nombre, primer_apellido, segundo_apellido, telefono, correo)
                        VALUES (:nombre, :primer_apellido, :segundo_apellido, :telefono, :correo)";

            $stmt = $this -> db -> prepare($sql);
            $stmt -> bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $stmt -> bindParam(':primer_apellido', $data['primer_apellido'], PDO::PARAM_STR);
            $stmt -> bindParam(':segundo_apellido', $data['segundo_apellido'], PDO::PARAM_STR);
            $stmt -> bindParam(':telefono', $data['telefono'], PDO::PARAM_INT);
            $stmt -> bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $stmt -> execute();

            $datos = $data;
            $datos['afectados'] = $stmt->rowCount();
            $datos['id'] = $this->db->lastInsertId();
            return $datos;
        }

        function getOne($id){
            $datos = [];
            if (is_numeric($id)){
                $sql = "SELECT * FROM cliente WHERE id_cliente = :id";
                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $datos;
        }

        function getAll(){
            $datos = [];
            $sql = "SELECT * FROM cliente";
            $stmt = $this -> db -> query($sql);
            $datos = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }

        function update($id, $data){
            $afectados = 0;
            if(is_numeric($id) && !empty($data)){
                $sql = "UPDATE cliente 
                SET nombre = :nombre,
                    primer_apellido = :primer_apellido,
                    segundo_apellido = :segundo_apellido,
                    telefono = :telefono,
                    correo = :correo
                WHERE id_cliente = :id";

                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
                $stmt -> bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_BOOL);
                $stmt -> bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
                $stmt -> bindParam(":telefono", $data['telefono'], PDO::PARAM_INT);
                $stmt -> bindParam(":correo", $data['correo'], PDO::PARAM_STR);
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $afectados = $stmt -> rowCount();
            }
            return $afectados;
        }

        function delete($id){
            $afectados = 0;
            if (is_numeric($id)){
                $sql = "DELETE FROM cliente WHERE id_cliente = :id";
                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $afectados = $stmt -> rowCount();
            }
            return $afectados;
        }
    }
?>