<?php 
    require_once __DIR__ . '/../sistema.class.php';

    class Vehiculo extends Sistema {

        function create($data) {
            $datos = [];
            $sql = "INSERT INTO vehiculo (matricula, marca, modelo, anio, id_cliente)
                        VALUES (:matricula, :marca, :modelo, :anio, :id_cliente)";

            $data['matricula'] = strtoupper(trim($data['matricula']));

            $stmt = $this -> db -> prepare($sql);
            $stmt -> bindParam(':matricula', $data['matricula'], PDO::PARAM_STR);
            $stmt -> bindParam(':marca', $data['marca'], PDO::PARAM_STR);
            $stmt -> bindParam(':modelo', $data['modelo'], PDO::PARAM_STR);
            $stmt -> bindParam(':anio', $data['anio'], PDO::PARAM_INT);
            $stmt -> bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
            $stmt -> execute();

            $datos = $data;
            $datos['afectados'] = $stmt->rowCount();
            $datos['id'] = $this->db->lastInsertId();
            return $datos;
        }

        function getOne($id){
            $datos = [];
            if (is_numeric($id)){
                $sql = "SELECT * FROM vehiculo WHERE id_vehiculo = :id";
                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $datos;
        }

        function getAll(){
            $datos = [];
            $sql = "SELECT * FROM vehiculo";
            $stmt = $this -> db -> query($sql);
            $datos = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }

        function update($id, $data){
            $afectados = 0;
            if(is_numeric($id) && !empty($data)){
                $sql = "UPDATE vehiculo 
                SET matricula = :matricula,
                    marca = :marca,
                    modelo = :modelo,
                    anio = :anio,
                    id_cliente = :id_cliente
                WHERE id_vehiculo = :id";

                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(":matricula", $data['matricula'], PDO::PARAM_STR);
                $stmt -> bindParam(":marca", $data['marca'], PDO::PARAM_BOOL);
                $stmt -> bindParam(":modelo", $data['modelo'], PDO::PARAM_STR);
                $stmt -> bindParam(":anio", $data['anio'], PDO::PARAM_INT);
                $stmt -> bindParam(":id_cliente", $data['id_cliente'], PDO::PARAM_STR);
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $afectados = $stmt -> rowCount();
            }
            return $afectados;
        }

        function delete($id){
            $afectados = 0;
            if (is_numeric($id)){
                $sql = "DELETE FROM vehiculo WHERE id_vehiculo = :id";
                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $afectados = $stmt -> rowCount();
            }
            return $afectados;
        }
    }
?>