<?php
    include_once __DIR__ . '/models/empleado/empleado.class.php';
    include_once __DIR__ . '/models/rol/rol.class.php';
    include_once __DIR__ . '/models/usuario/usuario_rol.class.php';
    include_once __DIR__ . '/models/auth/auth.class.php';

    $appAuth = new Auth();
    $appAuth -> verificarRol('Administrador');

    $app = new Empleado();
    $appRol = new Rol();
    $appUsuarioRol = new UsuarioRol();
    $accion = $_GET['accion'] ?? 'read';
    $id = $_GET['id'] ?? null;

    include_once __DIR__ . '/../templates/admin/sidebar.html';

    switch ($accion) {
        case 'create':
            if(isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $datos = $app -> create($data);
                $empleados = $app->getAll();
                include_once __DIR__ . '/../templates/empleado/index.php';
            } else {
                $datos['accion'] = 'create';
                $roles = $appRol->getAll();
                include_once __DIR__ . '/../templates/empleado/_form.php'; 
            }
            break;
        case 'update':
            if (isset($_POST['enviar'])) {  
                $data = $_POST['data'];
                $id = $_POST['id'] ?? $_GET['id'] ?? null;
                $datos = $app->update($id, $data);
                $empleados = $app->getAll();
                include_once __DIR__ . '/../templates/empleado/index.php';
            } else {
                $datos = $app -> getOne($id);
                $roles = $appRol->getAll();
                $datos['roles'] = $appUsuarioRol->getRolesById($id);
                $datos['accion'] = 'update';
                include_once __DIR__ . '/../templates/empleado/_form.php'; 
            }
            break;
        case 'delete':
            $afectados = $app->delete($id);
            $empleados = $app->getAll();
            include_once __DIR__ . '/../templates/empleado/index.php';
            break;

        case 'disable':
            if ($id == $_SESSION['usuario']['id_empleado']) {
                $alerta = ['mensaje' => 'No puedes desactivar tu propia cuenta.', 'tipo' => 'danger'];
            } else {
                $app->toggleActivo($id);
            }
            
            $empleados = $app->getAll();
            include __DIR__ . '/../templates/empleado/index.php';
            break;
        case 'read':
        default:
            $empleados = $app->getAll();
            include_once __DIR__ . '/../templates/empleado/index.php';
            break;    
    }
    require_once __DIR__ . '/../templates/admin/footer.html';
?>