<?php
require_once __DIR__ . '/models/usuario/usuario.class.php';
require_once __DIR__ . '/models/auth/auth.class.php';

$app = new Usuario();
$appUsuario = new Usuario();
$appAuth = new Auth();
$accion = $_GET['accion'] ?? 'show_login';

switch ($accion) {
    case 'login':
        if (isset($_POST['enviar'])) {
            $correo = $_POST['correo'] ?? '';
            $contrasena = $_POST['contrasena'] ?? '';

            if ($appAuth->login($correo, $contrasena)) {
                header('Location: usuario.php');
                exit;
            }
        }
        break;

    case 'logout':
       
        break;
    case 'show_login':
    default:
        require_once __DIR__ . '/../templates/login/login.html';
        break;
}

?>