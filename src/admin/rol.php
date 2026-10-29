<?php
require_once __DIR__ . '/models/rol/rol.class.php';
require_once __DIR__ . '/models/rol/rol_permiso.class.php';
require_once __DIR__ . '/models/permiso/permiso.class.php';

include_once __DIR__ . '/models/auth/auth.class.php';

$appAuth = new Auth();
$appAuth -> verificarRol('Administrador');

$app = new Rol();
$appRolPermiso = new RolPermiso();
$appPermiso = new Permiso();
$accion = $_GET['accion'] ?? 'read';
$id = $_GET['id'] ?? null;

include_once __DIR__ . '/../templates/admin/sidebar.html';

switch($accion){
    case 'create':
        if(isset($_POST['enviar'])){
            $data = $_POST['data'];
            $data['id_rol'] = $app->create($data)['id'];
            $appRolPermiso->create($data);
            $roles = $app->getAll();
            include_once __DIR__ . '/../templates/admin/rol/index.php';
        }else{
            $datos['accion'] = 'create';
            $permisos = $appPermiso->getAll();
            include_once __DIR__ . '/../templates/admin/rol/_form.php';
        }
        break;
    case 'update':
        if(isset($_POST['enviar'])){
            $data = $_POST['data'];
            $datos = $app->update($id, $data);
            $appRolPermiso->syncPermisos($id, $data);
            $roles = $app->getAll();
            include_once __DIR__ . '/../templates/admin/rol/index.php';
        }else{
            $datos = $app->getOne($id);
            $permisos = $appPermiso->getAll();
            $datos['permisos'] = $appRolPermiso->getPermisoById($id);
            $datos['accion'] = 'update';
            include_once __DIR__ . '/../templates/admin/rol/_form.php';
        }
        break;
    case 'delete':
        $afectados = $app->delete($id);
        $roles = $app->getAll();
        include_once __DIR__ . '/../templates/admin/rol/index.php';
        break;
    case 'read':
    default:
        $roles = $app->getAll();
        include_once __DIR__ . '/../templates/admin/rol/index.php';
        break;
}
require_once __DIR__ . '/../templates/admin/footer.html';
?>