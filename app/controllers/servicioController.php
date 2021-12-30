<?php

class servicioController extends Controller {
    public static function index() {
        // session_start()
        isAdmin();
        $servicios = ServicioModel::all();

        $data = [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios,
            'bg'    => 'dark',
            'padding' => '0px',
        ];

        View::render('index', $data);
    }

    public static function crear() {
        // session_start();
        isAdmin();
        $servicio = new ServicioModel;
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->guardar();
                header('Location: /servicio');
            }
        }

        $alertas = ServicioModel::getAlertas();

        $data = [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas,
            'bg'    => 'dark',
            'padding' => '0px',
        ];

        View::render('crear', $data);
    }

    public static function actualizar() {
        // session_start();
        isAdmin();
        if(!is_numeric($_GET['id'])) return;

        $servicio = ServicioModel::find($_GET['id']);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->guardar();
                header('Location: /servicio');
            }
        }
        
        $data = [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas,
            'bg'    => 'dark',
            'padding' => '0px',
        ];

        View::render('actualizar', $data);
    }

    public static function eliminar() {
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $servicio = ServicioModel::find($id);
            $servicio->eliminar();
            header('Location: /servicio');
        }

    }
}
