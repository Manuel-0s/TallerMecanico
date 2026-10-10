<?php 
    require_once __DIR__ . '/../sistema.class.php';

    class Empleado extends Sistema {

        function create($data) {
            $datos = [];

            $sql = "INSERT INTO empleado (nombre, primer_apellido, segundo_apellido, rol)
                        VALUES (:nombre, :primer_apellido, :segundo_apellido, :rol)";

            $stmt = $this -> db -> prepare($sql);
            $stmt -> bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $stmt -> bindParam(':primer_apellido', $data['primer_apellido'], PDO::PARAM_STR);
            $stmt -> bindParam(':segundo_apellido', $data['segundo_apellido'], PDO::PARAM_STR);
            $stmt -> bindParam(':rol', $data['rol'], PDO::PARAM_STR);
            $stmt -> execute();

            $datos = $data;
            $datos['afectados'] = $stmt->rowCount();
            $datos['id'] = $this->db->lastInsertId();
            return $datos;
        }

        function getOne($id){
            $datos = [];
            if (is_numeric($id)){
                $sql = "SELECT * FROM empleado WHERE id_empleado = :id";
                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $datos;
        }

        function getAll(){
            $datos = [];
            $sql = "SELECT * FROM empleado";
            $stmt = $this -> db -> query($sql);
            $datos = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }

        function update($id, $data){
            $afectados = 0;
            if(is_numeric($id) && !empty($data)){
                $sql = "UPDATE empleado 
                SET nombre = :nombre,
                    primer_apellido = :primer_apellido,
                    segundo_apellido = :segundo_apellido,
                    rol = :rol
                WHERE id_empleado = :id";

                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
                $stmt -> bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
                $stmt -> bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
                $stmt -> bindParam(":rol", $data['rol'], PDO::PARAM_STR);
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $afectados = $stmt -> rowCount();
            }
            return $afectados;
        }

        function delete($id){
            $afectados = 0;
            if (is_numeric($id)){
                $sql = "DELETE FROM empleado WHERE id_empleado = :id";
                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $afectados = $stmt -> rowCount();
            }
            return $afectados;
        }
    }
?>