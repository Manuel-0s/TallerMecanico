<?php 
    require_once __DIR__ . '/../sistema.class.php';

    class Cita extends Sistema {

        function create($data) {
            $datos = [];

            $sql = "INSERT INTO cita (fecha, estatus, observaciones, id_vehiculo)
                        VALUES (:fecha, :estatus, :observaciones, :id_vehiculo)";

            $stmt = $this -> db -> prepare($sql);
            $stmt -> bindParam(':fecha', $data['fecha'], PDO::PARAM_STR);
            $stmt -> bindParam(':estatus', $data['estatus'], PDO::PARAM_STR);
            $stmt -> bindParam(':observaciones', $data['observaciones'], PDO::PARAM_STR);
            $stmt -> bindParam(':id_vehiculo', $data['id_vehiculo'], PDO::PARAM_INT);
            $stmt -> execute();

            $datos = $data;
            $datos['afectados'] = $stmt->rowCount();
            $datos['id'] = $this->db->lastInsertId();
            return $datos;
        }

        function getOne($id){
            $datos = [];
            if (is_numeric($id)){
                $sql = "SELECT * FROM cita WHERE id_cita = :id";
                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $datos;
        }

        function getAll(){
            $datos = [];
            $sql = "SELECT * FROM cita";
            $stmt = $this -> db -> query($sql);
            $datos = $stmt -> fetch(PDO::FETCH_ASSOC);
            return $datos;
        }

        function update($id, $data){
            $afectados = 0;
            if(is_numeric($id) && !empty($data)){
                $sql = "UPDATE cita 
                SET fecha = :fecha,
                    estatus = :estatus,
                    observaciones = :observaciones,
                    id_vehiculo = :id_vehiculo
                WHERE id_cita = :id";

                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(":fecha", $data['fecha'], PDO::PARAM_STR);
                $stmt -> bindParam(":estatus", $data['estatus'], PDO::PARAM_BOOL);
                $stmt -> bindParam(":observaciones", $data['observaciones'], PDO::PARAM_STR);
                $stmt -> bindParam(":id_vehiculo", $data['id_vehiculo'], PDO::PARAM_INT);
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $afectados = $stmt -> rowCount();
            }
            return $afectados;
        }

        function delete($id){
            $afectados = 0;
            if (is_numeric($id)){
                $sql = "DELETE FROM cita WHERE id_cita = :id";
                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam("id:", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $afectados = $stmt -> rowCount();
            }
            return $afectados;
        }
    }
?>