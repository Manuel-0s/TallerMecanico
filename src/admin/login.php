<?php
require_once __DIR__ . '/models/usuario/usuario.class.php';
require_once __DIR__ . '/models/auth/auth.class.php';

$appUsuario = new Usuario();
$appAuth = new Auth();
$accion = $_GET['accion'] ?? 'show_login';

switch ($accion) {
    case 'login':
        if (isset($_POST['enviar'])) {
            $correo = $_POST['correo'] ?? '';
            $contrasena = $_POST['contrasena'] ?? '';

            if ($appAuth->login($correo, $contrasena)) {
                header('Location: index.php');
                exit;
            }
            $alerta = [
                'mensaje' => 'Correo o contraseña incorrectos',
                'tipo' => 'danger'
            ];
            require_once __DIR__ . '/../templates/login/login.html';
        }
        break;

    case 'logout':
        $appAuth -> logout();
            $alerta = [
                'mensaje' => 'Sesión cerrada correctamente',
                'tipo' => 'success'
            ];
            require_once __DIR__ . '/../templates/login/login.html';
            exit();
        break;
    case 'show_login':
    default:
        require_once __DIR__ . '/../templates/login/login.html';
        break;
}

?>