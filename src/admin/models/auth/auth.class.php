<?php
require_once __DIR__ . '/../sistema.class.php';

Class Auth extends Sistema {

    function __construct() {
            parent::__construct();

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }


    function login($correo, $contrasena) {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT * FROM usuario WHERE correo = :correo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                session_regenerate_id(true);
                unset($usuario['contrasena']);
                $_SESSION['usuario'] = $usuario;
                $_SESSION['valido'] = true;
                $_SESSION['roles'] = $this->getRoles($usuario['correo']);
                $_SESSION['permisos'] = $this->getPermisos($usuario['correo']);

                echo '<pre>';
                print_r($_SESSION);
                echo '</pre>';


                return true;
            }
        }
        $this->logout();    
        return false;
    }

    function logout(){
        unset($_SESSION['usuario']);
        unset($_SESSION['valido']);
        unset($_SESSION['roles']);
        unset($_SESSION['permisos']);
        session_destroy();
    }

    function getRoles($correo) {
        $sql = "SELECT r.rol FROM usuario u
                JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                JOIN rol r ON ur.id_rol = r.id_rol
                WHERE u.correo = :correo;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function getPermisos($correo) {
        $sql = "SELECT r.rol FROM usuario u
                JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                JOIN rol r ON ur.id_rol = r.id_rol
                JOIN rol_permiso rp ON r.id_rol = rp.id_rol
                JOIN permiso p ON rp.id_permiso = p.id_permiso
                WHERE u.correo = :correo;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}


?>