<?php
require_once __DIR__ . '/models/usuario/usuario.class.php';
require_once __DIR__ . '/models/auth/auth.class.php';
require_once __DIR__ . '/../helpers/mail.php';
require_once __DIR__ . '/../helpers/emailTemplate.php';

$appMail = new Mail();
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

        case 'enviar':
            if (!isset($_POST['enviar'])) {
                require_once __DIR__ . '/../templates/login/_form_email.html';
                break;
            }

            $correo = trim($_POST['correo'] ?? '');

            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $alerta = ['mensaje' => 'Correo inválido', 'tipo' => 'danger'];
                require_once __DIR__ . '/../templates/login/_form_email.html';
                break;
            }

            $token = bin2hex(random_bytes(32));

            if ($appAuth->guardarToken($correo, $token)) {
                $enlace = 'http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php?accion=recover&token=' . $token;
                $appMail->enviar([$correo], 'Recupera tu cuenta', plantillaRecuperacion($enlace));
            }

            $alerta = [
                'mensaje' => 'Si la cuenta existe, te enviamos un correo con las instrucciones.',
                'tipo'    => 'success'
            ];
            require_once __DIR__ . '/../templates/login/_form_email.html';
            break;

    case 'recuperar':
        require_once __DIR__ . '/../templates/login/_form_email.html';
        break;

    case 'recover':
        if(!isset($_GET['token'])) {
            break;
        }

        $token = $_GET['token'];
        
        if(strlen($token) != 64){ 
            $alerta = [
                'mensaje' => 'Token inválido o expirado',
                'tipo' => 'danger'
            ];
            require_once __DIR__ . '/../templates/login/login.html';
            break;
        }

        if($appAuth -> validarToken($token)){
            require_once __DIR__ . '/../templates/login/_form_password.html';
            exit();

        } else {
            $alerta = [
                'mensaje' => 'Genera un nuevo enlace para recuperar tu contraseña',
                'tipo' => 'danger'
            ];
        }
        require_once __DIR__ . '/../templates/login/login.html';
        break;

    case 'restablecer':
        if(!isset($_POST['enviar'])){
            require_once __DIR__ . '/../templates/login/_form_password.html';
            break;
        }

        $token = $_POST['token'] ?? '';
        $password1 = $_POST['password1'] ?? '';
        $password2 = $_POST['password2'] ?? '';

        if (strlen($token) !== 64 || !ctype_xdigit($token)) {
            $alerta = [
                'mensaje' => 'Token inválido o expirado',
                'tipo' => 'danger'
            ];
            require_once __DIR__ . '/../templates/login/login.html';
            break;
        }

        if ($password1 === '' || $password2 === '') {
            $alerta = [
                'mensaje' => 'Las contraseñas no pueden estar vacías',
                'tipo' => 'danger'
            ];
            require_once __DIR__ . '/../templates/login/_form_password.html';
            break;
        }

        if ($password1 !== $password2) {
            $alerta = [
                'mensaje' => 'Las contraseñas no coinciden',
                'tipo' => 'danger'
            ];
            require_once __DIR__ . '/../templates/login/_form_password.html';
            break;
        }

        if ($appAuth-> restablecerContraseña($token, $password1)) {
             $alerta = [
                'mensaje' => 'Contraseña restablecida correctamente',
                'tipo' => 'success'
            ];
            require_once __DIR__ . '/../templates/login/login.html';
        } else {
            $alerta = [
                'mensaje' => 'Token inválido o expirado',
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