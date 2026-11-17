<?php
    include_once __DIR__ . '/models/empleado/empleado.class.php';
    include_once __DIR__ . '/models/rol/rol.class.php';
    include_once __DIR__ . '/models/usuario/usuario_rol.class.php';
    include_once __DIR__ . '/models/auth/auth.class.php';
    include_once __DIR__ . '/../helpers/FileUploader.php';
    
    $appAuth = new Auth();
    $appAuth -> verificarRol('Administrador');

    $uploader = new FileUploader();
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
                $data['foto'] = $uploader->cargarArchivo('foto', __DIR__ . '/../assets/images/uploads');

                try {
                    $datos = $app -> create($data);
                    $alerta = ['mensaje' => 'Empleado registrado correctamente.', 'tipo' => 'success'];
                    $empleados = $app->getAll();
                    include_once __DIR__ . '/../templates/empleado/index.php';
                } catch (Exception $e) {
                    $alerta = [
                        'mensaje' => $e->getCode() === '23505'
                            ? 'Ya existe un empleado con ese correo electrónico.'
                            : 'No se pudo registrar el empleado. Intenta de nuevo.',
                        'tipo' => 'error'
                    ];
                    $datos = $data;      
                    $datos['accion'] = 'create';
                    $roles = $appRol->getAll();
                    include_once __DIR__ . '/../templates/empleado/_form.php';
                }
            } else {
                $datos['accion'] = 'create';
                $roles = $appRol->getAll();
                include_once __DIR__ . '/../templates/empleado/_form.php'; 
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
                    include_once __DIR__ . '/../templates/empleado/index.php';
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
                    include_once __DIR__ . '/../templates/empleado/_form.php';
                }
            } else {
                $datos = $app -> getOne($id);
                $roles = $appRol->getAll();
                $datos['roles'] = $appUsuarioRol->getRolesById($id);
                $datos['accion'] = 'update';
                include_once __DIR__ . '/../templates/empleado/_form.php'; 
            }
            break;
        case 'delete':
            if ($id == $_SESSION['usuario']['id_empleado']) {
                $alerta = ['mensaje' => 'No puedes eliminar tu propia cuenta.', 'tipo' => 'danger'];
            } else {
                try {
                    $afectados = $app->delete($id);
                    $alerta = ['mensaje' => 'Registro eliminado.', 'tipo' => 'success'];
                } catch (PDOException $e) {
                    $alerta = [
                        'mensaje' => $e->getCode() === '23503'
                            ? 'No se puede eliminar: tiene registros relacionados.'
                            : 'No se pudo eliminar el registro.',
                        'tipo' => 'error'
                    ];
                }
            }
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