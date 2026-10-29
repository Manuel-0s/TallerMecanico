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
        $this->db->beginTransaction();
        try {
            $appUsuario = new Usuario($this->db);
            $appUsuario->create([
                'correo' => $data['correo'],
                'contrasena'=> $data['contrasena'],
                'activo' => $data['activo'] ?? 1,
            ]);

            $data['id_usuario'] = $appUsuario->getOneByCorreo($data['correo'])['id_usuario'];

            $data["id_rol"][] = self::ROL_EMPLEADO;

            foreach ($data["id_rol"] as $idRol) {
                $stmt = $this->db->prepare(
                    "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)"
                );
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

    function delete($id) {
        $this->db->beginTransaction();
        try {
            $empleado = $this->getOne($id);
            if (!$empleado) {
                throw new Exception("Empleado no encontrado");
            }
            $stmt = $this->db->prepare("DELETE FROM empleado WHERE id_empleado = :id_empleado");
            $stmt->bindValue(':id_empleado', $id, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $this->db->prepare("DELETE FROM usuario WHERE id_usuario = :id_usuario");
            $stmt->bindValue(':id_usuario', $empleado['id_usuario'], PDO::PARAM_INT);
            $stmt->execute();

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