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
            $sql = "SELECT * FROM usuario u 
                    JOIN empleado e ON u.id_usuario = e.id_usuario
                    WHERE correo = :correo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                session_regenerate_id(true);
                unset($usuario['contrasena'], $usuario['token']);
                $_SESSION['usuario'] = $usuario;
                $_SESSION['roles'] = $this->getRoles($usuario['correo']);
                $_SESSION['permisos'] = $this->getPermisos($usuario['correo']);

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
        $sql = "SELECT DISTINCT r.rol FROM usuario u
                JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                JOIN rol r ON ur.id_rol = r.id_rol
                WHERE u.correo = :correo;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function getPermisos($correo) {
        $sql = "SELECT p.permiso FROM usuario u
                JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                JOIN rol r ON ur.id_rol = r.id_rol
                JOIN rol_permiso rp ON r.id_rol = rp.id_rol
                JOIN permiso p ON rp.id_permiso = p.id_permiso
                WHERE u.correo = :correo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function verificarRol ($rol) {
        if (isset($_SESSION['usuario']['activo']) && !$_SESSION['usuario']['activo']) {
            $this->logout();
            $alerta = [
                'mensaje' => 'Tu cuenta se encuentra desactivada.',
                'tipo' => 'danger'
            ];
            require_once __DIR__ . '/../../../templates/login/login.html';
            exit;
        }

        if (isset($_SESSION['roles']) && in_array($rol, $_SESSION['roles'])) {
            return true;
        }
        
        $alerta = [
            'mensaje' => 'No tienes permiso para acceder a esta sección.',
            'tipo' => 'danger'
        ];
        $this -> logout();
        require_once __DIR__ . '/../../../templates/login/login.html';
    }

    function verificarPermiso ($permiso) {
        if (isset($_SESSION['permisos']) && in_array($permiso, $_SESSION['permisos'])) {
            return true;
        }
        exit();
    }

    function guardarToken($correo, $token) {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL) && strlen($token) == 64) {
            $sql = "UPDATE usuario SET token = :token WHERE correo = :correo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        }
        return false;
    }

    function validarToken($token) {
        if (strlen($token) == 64) {
            $sql = "SELECT * FROM usuario WHERE token = :token";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        }
        return false;
    }
    
    function restablecerContraseña($token, $contrasena) {
        $afectados = 0;
        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $sql = "UPDATE usuario SET contrasena = :contrasena, token = NULL WHERE token = :token";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":contrasena", $contrasena_hash, PDO::PARAM_STR);
        $stmt->bindParam(":token", $token, PDO::PARAM_STR);
        $stmt->execute();
        $afectados = $stmt->rowCount();
        return $afectados;
    }
}

?>