<?php
    require_once __DIR__ . '/models/empleado/empleado.class.php';
    require_once __DIR__ . '/models/rol/rol.class.php';
    require_once __DIR__ . '/models/usuario/usuario_rol.class.php';
    require_once __DIR__ . '/models/auth/auth.class.php';
    require_once __DIR__ . '/services/empleado.service.php';
    
    $appAuth = new Auth();
    $appAuth -> verificarRol('Administrador');

    $app = new Empleado();
    $appRol = new Rol();
    $appUsuarioRol = new UsuarioRol();
    $empleadoService = new EmpleadoService($app);

    $accion = $_GET['accion'] ?? 'read';
    $id = $_GET['id'] ?? null;

    require_once __DIR__ . '/../templates/admin/sidebar.html';

    switch ($accion) {
        case 'create':
            if(isset($_POST['enviar'])) {
                $data = $_POST['data'];
                try {
                    $empleadoService->create($data);
                    $alerta = ['mensaje' => 'Empleado registrado correctamente.', 'tipo' => 'success'];
                    $empleados = $app->getAll();
                    require_once __DIR__ . '/../templates/empleado/index.php';
                } catch (ReglaException $e) {
                    $alerta = ['mensaje' => $e->getMessage(), 'tipo' => 'error'];
                    $datos = $data;
                    $datos['id_roles'] = $data['roles'] ?? [];
                    $datos['accion'] = 'create';
                    $roles = $appRol->getAll();
                    require_once __DIR__ . '/../templates/empleado/_form.php';
                }
            } else {
                $datos['accion'] = 'create';
                $roles = $appRol->getAll();
                require_once __DIR__ . '/../templates/empleado/_form.php'; 
            }
            break;
        case 'update':
            if (isset($_POST['enviar'])) {  
                $data = $_POST['data'] ?? [];

                try {
                    $empleadoService->update($id, $data);
                    $alerta = ['mensaje' => 'Empleado actualizado correctamente.', 'tipo' => 'success'];
                    $empleados = $app->getAll();
                    require_once __DIR__ . '/../templates/empleado/index.php';
                } catch (ReglaException $e) {
                    $alerta = ['mensaje' => $e->getMessage(), 'tipo' => 'error'];
                    $datos = $data;
                    $empleado = $app->getOne($id);
                    $datos['foto'] = $datos['foto'] ?? ($empleado['foto'] ?? null);
                    $datos['id'] = $id;
                    $datos['accion'] = 'update';
                    $datos['id_roles'] = $data['roles'] ?? [];
                    echo '<pre>';
                    print_r($datos);
                    echo '</pre>';
                    $roles = $appRol->getAll();
                    require_once __DIR__ . '/../templates/empleado/_form.php';
                }
            } else {
                try {
                    $empleadoService->validarExistencia($id);
                    $datos = $app->getOne($id);
                    $roles = $appRol->getAll();
                    $datos['id_roles'] = $appUsuarioRol->getRolesById($id);
                    $datos['accion'] = 'update';
                    echo '<pre>';
                    print_r($datos);
                    echo '</pre>';
                    require_once __DIR__ . '/../templates/empleado/_form.php';
                }  catch (ReglaException $e) {
                    $alerta = ['mensaje' => $e->getMessage(), 'tipo' => 'error'];
                    $empleados = $app->getAll();
                    require_once __DIR__ . '/../templates/empleado/index.php';
                }
            }
            break;
        case 'delete':
            try {
                $empleadoService->delete($id, $_SESSION['usuario']['id_empleado']);
                $alerta = ['mensaje' => 'Registro eliminado.', 'tipo' => 'success'];
            } catch (ReglaException $e) {
                $alerta = ['mensaje' => $e->getMessage(), 'tipo' => 'danger'];
            }
            $empleados = $app->getAll();
            require_once __DIR__ . '/../templates/empleado/index.php';
            break;

        case 'disable':
            try {
                $empleadoService->alternarActivo($id, $_SESSION['usuario']['id_empleado']);
                $alerta = ['mensaje' => 'Estado del empleado actualizado.', 'tipo' => 'success'];
            } catch (ReglaException $e) {
                $alerta = ['mensaje' => $e->getMessage(), 'tipo' => 'danger'];
            }
            $empleados = $app->getAll();
            include __DIR__ . '/../templates/empleado/index.php';
            break;
        case 'read':
        default:
            $empleados = $app->getAll();
            require_once __DIR__ . '/../templates/empleado/index.php';
            break;    
    }
    require_once __DIR__ . '/../templates/admin/footer.html';
?>