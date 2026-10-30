<?php
require_once __DIR__ . '/../genericCRUD.php';
require_once __DIR__ . '/../usuario/usuario.class.php';

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

    private const ROL_EMPLEADO = 2;

    function create($data) {
        $data["id_rol"][] = self::ROL_EMPLEADO;

        $this->db->beginTransaction();
        try {
            $sql = "INSERT INTO usuario (correo, contrasena) VALUES (:correo, :contrasena)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':correo', $data['correo'], PDO::PARAM_STR);
            $stmt->bindValue(':contrasena', password_hash($data['contrasena'], PASSWORD_DEFAULT), PDO::PARAM_STR);
            $stmt->execute();

            $data['id_usuario'] = $this->db->lastInsertId();

            foreach ($data["id_rol"] as $idRol) {
                $sql = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
                $stmt->bindValue(':id_rol', $idRol, PDO::PARAM_INT);
                $stmt->execute();
            }

            parent::create($data);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw $e;
        }
    }
    
    function getOne($id) {
        $sql = "SELECT * FROM empleado e 
                JOIN usuario u ON e.id_usuario = u.id_usuario 
                WHERE e.id_empleado = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getAll() {
        $sql = "SELECT
                e.*,
                u.correo,
                u.activo,
                COALESCE(JSON_AGG(r.rol ORDER BY r.rol) FILTER (WHERE r.id_rol IS NOT NULL), '[]') AS roles
            FROM empleado e
                    JOIN usuario u            ON e.id_usuario = u.id_usuario
                    LEFT JOIN usuario_rol ur  ON u.id_usuario = ur.id_usuario
                    LEFT JOIN rol r           ON ur.id_rol = r.id_rol
            GROUP BY e.id_empleado, u.id_usuario;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function update($id, $data) {
        $data["id_rol"][] = self::ROL_EMPLEADO;
        
        $this->db->beginTransaction();
        try {
            $empleado = $this->getOne($id);
            $data['id_usuario'] = $empleado['id_usuario'];
            parent::update($id, $data);

            if (!empty($data['contrasena'])) {
                $data['contrasena'] = password_hash($data['contrasena'], PASSWORD_DEFAULT);
            }

            $sql = "UPDATE usuario 
                    SET correo = :correo,
                        contrasena = :contrasena
                    WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
            $stmt->bindParam(':id_usuario', $empleado['id_usuario'], PDO::PARAM_INT);
            $stmt->execute();
    
            if (isset($data['id_rol'])) {
                $sql = "DELETE FROM usuario_rol 
                        WHERE id_usuario = :id_usuario";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id_usuario', $empleado['id_usuario'], PDO::PARAM_INT);
                $stmt->execute();

                foreach ($data['id_rol'] as $idRol) {
                    $sql = "INSERT INTO usuario_rol (id_usuario, id_rol) 
                            VALUES (:id_usuario, :id_rol)";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':id_usuario', $empleado['id_usuario'], PDO::PARAM_INT);
                    $stmt->bindParam(':id_rol', $idRol, PDO::PARAM_INT);
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

    function delete($id) {
        $this->db->beginTransaction();
        try {
            $empleado = $this->getOne($id);
            $afectados = parent::delete($id);  

            $sql = "DELETE FROM usuario WHERE id_usuario = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $empleado['id_usuario'], PDO::PARAM_INT);
            $stmt->execute();                   

            $this->db->commit();
            return $afectados;
        } catch (Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw $e;
        }
    }

    function toggleActivo($id){
        $empleado = $this->getOne($id);
        $usuario = new Usuario();
        $usuario->toggleActivo($empleado['id_usuario']);
    }
}
?>