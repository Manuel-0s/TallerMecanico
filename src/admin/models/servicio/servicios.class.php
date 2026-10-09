<?php
    require_once __DIR__.'/../sistema.class.php';

    class Servicio extends Sistema {

        function create($data) {
            if(!isset($data['servicio'])){
                return ['error' => 'faltan datos requeridos'];
            }

            $datos = [];
            $data['imagen'] = $this -> cargarArchivo($nombre = 'imagen', $ruta = '/../../images/uploads/');
            
            $sql = "INSERT INTO servicio (servicio, descripcion, precio_base, imagen)
                        VALUES (:servicio, :descripcion, :precio_base, :imagen)";       

            $stmt = $this -> db -> prepare($sql);
            $stmt -> bindParam(':servicio', $data['servicio'], PDO::PARAM_STR);
            $stmt -> bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
            $stmt -> bindParam(':precio_base', $data['precio_base'], PDO::PARAM_STR);
            $stmt -> bindParam(':imagen', $data['imagen'], PDO::PARAM_STR);
            $stmt -> execute();
            
            $datos = $data;
            $datos['afectados'] = $stmt->rowCount();
            $datos['id'] = $this->db->lastInsertId();
            return $datos;
        }

        function getOne($id) {
            $datos = [];
            if (is_numeric($id)) {
                $sql = "SELECT * FROM servicio WHERE id_servicio = :id";
                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
                $stmt -> execute();
                $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $datos;
        }

        function getAll() {
            $datos = [];
            $sql = "SELECT * FROM servicio";
            $stmt = $this -> db -> query($sql);
            $datos = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        }

        function update($id, $data) {
            $imagen = $this -> cargarArchivo($nombre = 'imagen', $ruta = '/../../images/uploads/');
          
            if($imagen !== null) {
                $data['imagen'] = $imagen;
            } else {
                $imagenActual = $this->getOne($id);
                $data['imagen'] = $imagenActual['imagen'];
            }

            $afectados = 0;
            if (is_numeric($id) && !empty($data)) {
                $sql = "UPDATE servicio 
                    SET servicio = :servicio,
                        descripcion = :descripcion, 
                        precio_base = :precio_base,
                        imagen = :imagen
                    WHERE id_servicio = :id";

                $stmt = $this -> db -> prepare($sql);
                $stmt -> bindParam(':servicio', $data['servicio'], PDO::PARAM_STR);
                $stmt -> bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
                $stmt -> bindParam(':precio_base', $data['precio_base'], PDO::PARAM_STR);
                $stmt -> bindParam(':imagen', $data['imagen'], PDO::PARAM_STR);
                $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
                $stmt -> execute();
                $afectados = $stmt -> rowCount();
            }
            return $afectados;
        }

        function delete($id) {
            $afectados = 0;
            if (is_numeric($id)) {
                $sql = "DELETE FROM servicio WHERE id_servicio = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute(); 
                $afectados = $stmt->rowCount();
            }
            return $afectados;
        }
    }
?>