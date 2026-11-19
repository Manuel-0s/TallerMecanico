<?php
    require_once __DIR__ . '/models/empleado/empleado.class.php';
    require_once __DIR__ . '/models/rol/rol.class.php';
    require_once __DIR__ . '/models/usuario/usuario_rol.class.php';
    require_once __DIR__ . '/models/auth/auth.class.php';
    require_once __DIR__ . '/services/empleado.service.php';
    require_once __DIR__ . '/../helpers/FileUploader.php';
    
    $appAuth = new Auth();
    $appAuth -> verificarRol('Administrador');

    $uploader = new FileUploader();
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
                $data['foto'] = $uploader->cargarArchivo('foto', __DIR__ . '/../assets/images/uploads');

                try {
                    $empleadoService->create($data);
                    $alerta = ['mensaje' => 'Empleado registrado correctamente.', 'tipo' => 'success'];
                    $empleados = $app->getAll();
                    require_once __DIR__ . '/../templates/empleado/index.php';
                } catch (ReglaException $e) {
                    $alerta = ['mensaje' => $e->getMessage(), 'tipo' => 'error'];
                    $datos = $data;      
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
                $data = $_POST['data'];
                $empleado = $app->getOne($id);
                $foto = $uploader->cargarArchivo('foto', __DIR__ . '/../assets/images/uploads');
                $data['foto'] = $foto ?? $empleado['foto'];
                
                try {
                    $datos = $app->update($id, $data);
                    $alerta = ['mensaje' => 'Empleado actualizado correctamente.', 'tipo' => 'success'];
                    $empleados = $app->getAll();
                    require_once __DIR__ . '/../templates/empleado/index.php';
                }catch (Exception $e) {
                    $alerta = [
                        'mensaje' => $e->getCode() === '23505'
                            ? 'Ya existe un empleado con ese correo electrónico.'
                            : 'No se pudo actualizar el empleado. Intenta de nuevo.',
                        'tipo' => 'error'
                    ];
                    $datos = $data;
                    $datos['accion'] = 'update';
                    $datos['roles'] = $data['id_rol'] ?? [];
                    $roles = $appRol->getAll();
                    require_once __DIR__ . '/../templates/empleado/_form.php';
                }
            } else {
                $datos = $app -> getOne($id);
                $roles = $appRol->getAll();
                $datos['roles'] = $appUsuarioRol->getRolesById($id);
                $datos['accion'] = 'update';
                require_once __DIR__ . '/../templates/empleado/_form.php'; 
            }
            break;
        case 'delete':
            try {
                $empleadoService->delete((int) $id, (int) $_SESSION['usuario']['id_empleado']);
                $alerta = ['mensaje' => 'Registro eliminado.', 'tipo' => 'success'];
            } catch (ReglaException $e) {
                $alerta = ['mensaje' => $e->getMessage(), 'tipo' => 'danger'];
            }
            $empleados = $app->getAll();
            require_once __DIR__ . '/../templates/empleado/index.php';
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
            require_once __DIR__ . '/../templates/empleado/index.php';
            break;    
    }
    require_once __DIR__ . '/../templates/admin/footer.html';
?>