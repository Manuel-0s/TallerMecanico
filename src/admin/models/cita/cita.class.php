<?php
require_once __DIR__ . '/../genericCRUD.php';

Class Cita extends genericCRUD{
    protected $table = 'cita';
    protected $primaryKey = 'id_cita';
    protected $columns = [
        "fecha" => PDO::PARAM_STR, 
        "estatus" => PDO::PARAM_STR,
        "observaciones" => PDO::PARAM_STR,
        "id_vehiculo" => PDO::PARAM_INT
        ];

    function getCitaEstatus(){
        $sql = "SELECT estatus, COUNT(*) AS total FROM {$this -> table} GROUP BY estatus";
        $stmt = $this -> db -> query($sql);
        $datos = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    function getDetalle($id) {
        $sql = "SELECT c.*, v.matricula, v.marca, v.modelo, v.anio,
                    cl.nombre, cl.primer_apellido, cl.segundo_apellido,
                    cl.telefono, cl.correo
                FROM cita c
                    JOIN vehiculo v ON c.id_vehiculo = v.id_vehiculo
                    JOIN cliente cl ON v.id_cliente = cl.id_cliente
                WHERE c.id_cita = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getServiciosDetalle($id) {
        $sql = "SELECT s.servicio, s.descripcion, s.precio_base
                FROM cita_servicio cs
                    JOIN servicio s ON cs.id_servicio = s.id_servicio
                WHERE cs.id_cita = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function createExist($data) {
        $this->db->beginTransaction();

        try{
            $id_cita = parent::create($data)["id"];

            $sql = "INSERT INTO cita_servicio (id_cita, id_servicio) VALUES (:id_cita, :id_servicio)";
            $stmt = $this->db->prepare($sql);

            foreach ($data['id_servicio'] as $id_servicio) {
                $stmt->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);
                $stmt->bindParam(':id_servicio', $id_servicio, PDO::PARAM_INT);
                $stmt->execute();
            }

            $this->db->commit();
        }catch(Exception $e){
            if($this->db->inTransaction()){
                $this->db->rollBack();
            }
            throw $e;
        }
    }

    function createNew($data) {
        $this->db->beginTransaction();

        try{
            $sql = "INSERT INTO cliente (nombre, primer_apellido, segundo_apellido, telefono, correo) 
                    VALUES (:nombre, :primer_apellido, :segundo_apellido, :telefono, :correo)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':primer_apellido', $data['primer_apellido']);
            $stmt->bindParam(':segundo_apellido', $data['segundo_apellido']);
            $stmt->bindParam(':telefono', $data['telefono']);
            $stmt->bindParam(':correo', $data['correo']);
            $stmt->execute();

            $id_cliente = $this->db->lastInsertId();

            $sql = "INSERT INTO vehiculo (matricula, marca, modelo, anio, id_cliente) 
                    VALUES (:matricula, :marca, :modelo, :anio, :id_cliente)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':matricula', $data['matricula']);
            $stmt->bindParam(':marca', $data['marca']);
            $stmt->bindParam(':modelo', $data['modelo']);
            $stmt->bindParam(':anio', $data['anio']);
            $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $stmt->execute();

            $data["id_vehiculo"] = $this->db->lastInsertId();

            $id_cita = parent::create($data)["id"];

            $sql = "INSERT INTO cita_servicio (id_cita, id_servicio) VALUES (:id_cita, :id_servicio)";
            $stmt = $this->db->prepare($sql);

            foreach ($data['id_servicio'] as $id_servicio) {
                $stmt->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);
                $stmt->bindParam(':id_servicio', $id_servicio, PDO::PARAM_INT);
                $stmt->execute();
            }

            $this->db->commit();
        }catch(Exception $e){
            if($this->db->inTransaction()){
                $this->db->rollBack();
            }
            throw $e;
        }
    }

    function getServiciosByCita($id){
        $datos = [];
        if (is_numeric($id)){
            $sql = "SELECT cs.id_servicio FROM cita c
                    JOIN cita_servicio cs ON c.id_cita = cs.id_cita
                    WHERE c.id_cita = :id";
            $stmt = $this -> db -> prepare($sql);
            $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
            $stmt -> execute();
            $datos = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
        return $datos;
    }

    function getOne($id) {
        $sql = "SELECT c.*, v.matricula FROM cita c
                JOIN vehiculo v ON c.id_vehiculo = v.id_vehiculo
                WHERE c.id_cita = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function update($id, $data) { 
        $this->db->beginTransaction();
        try {
            parent::update($id, $data);

            if (isset($data['id_servicio'])) {
                $sql = "DELETE FROM cita_servicio 
                        WHERE id_cita = :id_cita";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id_cita', $id, PDO::PARAM_INT);
                $stmt->execute();

                foreach ($data['id_servicio'] as $idRol) {
                    $sql = "INSERT INTO cita_servicio (id_cita, id_servicio) 
                            VALUES (:id_cita, :id_servicio)";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':id_cita', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':id_servicio', $idRol, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw $e;
        }
    }
}
?>