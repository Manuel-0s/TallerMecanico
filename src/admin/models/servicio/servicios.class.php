<?php
    require_once __DIR__.'/../genericCRUD.php';
    require_once __DIR__.'/../sistema.class.php';

    class Servicio extends GenericCRUD {
        protected $table = "servicio";
        protected $primaryKey = "id_servicio";
        protected $columns = [
            "servicio" => PDO::PARAM_STR, 
            "descripcion" => PDO::PARAM_STR, 
            "precio_base" => PDO::PARAM_STR, 
            "imagen" => PDO::PARAM_STR
        ];

        function create($data) {
            if(!isset($data['servicio'])){
                return ['error' => 'faltan datos requeridos'];
            }
            $data['imagen'] = $this -> cargarArchivo($nombre = 'imagen', $ruta = '/../../images/uploads/');
            return parent::create($data);
        }

        function update($id, $data) {
            $imagen = $this -> cargarArchivo($nombre = 'imagen', $ruta = '/../../images/uploads/');
          
            if($imagen !== null) {
                $data['imagen'] = $imagen;
            } else {
                $imagenActual = $this->getOne($id);
                $data['imagen'] = $imagenActual['imagen'];
            }
            return parent::update($id, $data);
        }
    }
?>