<?php
require_once __DIR__ . '/../genericCRUD.php';

class Empleado extends GenericCRUD {
    protected $table = "empleado";
    protected $primaryKey = "id_empleado";
    protected $columns = [
        "nombre" => PDO::PARAM_STR, 
        "primer_apellido" => PDO::PARAM_STR, 
        "segundo_apellido" => PDO::PARAM_STR, 
        "rfc" => PDO::PARAM_STR, 
        "foto" => PDO::PARAM_STR,
        "id_usuario" => PDO::PARAM_INT
    ];

    function create($data) {
        $this -> db -> beginTransaction();
        try {
            $sql = "INSERT INTO usuario (correo, contrasena, activo) 
                VALUES (:correo, :contrasena, :activo)";

            $id_usuario = $appUsuario->getOneByCorreo($data['correo'])['id_usuario'];

            $sql = "INSERT INTO usuario_rol (id_usuario, id_rol)
                VALUES (:id_usuario, :id_rol)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindValue(':id_rol', 2, PDO::PARAM_INT);
            $stmt->execute();

            parent::create(array_merge($data, ['id_usuario' => $id_usuario]));

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    function getAll() {
        $sql = "SELECT e.*, u.correo FROM empleado e
                JOIN usuario u ON e.id_usuario = u.id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>