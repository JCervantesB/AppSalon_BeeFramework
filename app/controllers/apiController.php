<?php

class apiController extends Controller {
    public static function index() {
        $servicios = ServicioModel::all();
        echo json_encode($servicios, JSON_UNESCAPED_UNICODE);
    }
    public static function citas() {

        // Almacena la cita y devuelve el id
        $cita = new CitaModel($_POST);
        $resultado = $cita->guardar();
        $id = $resultado['id'];

        // Almacen la cita y el servicio

        $idServicios = explode(",", $_POST['servicios']);

        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];

            $citaServicio = new CitaServicioModel($args);
            $citaServicio->guardar();
        }
        // Retornamos una respuesta
        $respuesta = [
            'servicios' => $resultado
        ];

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

        $data = [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
            'bg'    => 'dark',
            'padding' => '0px',
        ];

        View::render('citas', $data);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = CitaModel::find($id);
            $cita->eliminar();            
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}
