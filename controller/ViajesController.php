<?php


class ViajesController
{
    private $render;
    private $viajesModel;

    public function __construct($render, $viajesModel)
    {
        $this->render = $render;
        $this->viajesModel = $viajesModel;
    }

    public function execute()
    {
        echo $this->render->render("view/viajes.php");
    }

   public function listarViajes(){
        if($_SESSION['id_Rol'] == CHOFER){
            //si el rol del usuario en sesion es chofer
            //entonces obtengo los viajes de ese usuario
           $data["viajes"] = $this->viajesModel->obtenerViajesPorIdUsuario($_SESSION['usuario']);
       }
        else{
            //si el usuario en sesion no es chofer, es decir,
            // administrador / supervisor muestro todos los viajes de todos los choferes
            $data["viajes"] = $this->viajesModel->obtenerViajesPorOrdenFecha();
        }
        echo $this->render->render( "view/viajes.php", $data );
    }

    public function detalleViaje(){
        $id = $_GET["id"];
        $viaje = $this->viajesModel->obtenerDetalleViaje($id);
        $data = array("viajes" => $viaje, "id" =>$id);
        echo $this->render->render( "view/infoViaje.php", $data );
    }
    public function verFormNotificacion(){
        $id = $_GET["id_viaje"];
        $data = array("id" =>$id);
        echo $this->render->render("view/notificacion.php", $data);
    }

    public function editarNotificacion(){
        $id = $_GET["id_viaje"];
        $viaje = $this->viajesModel->obtenerDetalleViaje($id);
        $data = array("viajes" => $viaje, "id" =>$id);
        echo $this->render->render("view/notificacion.php", $data);
    }

    public function crear(){
        $idViaje= $_POST["idViaje"];
        $km= $_POST["km"];
        $latitud= $_POST["latitud"];
        $longitud= $_POST["longitud"];
        $fecha= $_POST["fecha"];
        $combustibleCargado= $_POST["combustible"];
        $peajes= $_POST["peajes"];
        $extras=$_POST["extras"];
        $this-> viajesModel->crearNuevaNotificacion($idViaje, $km, $latitud, $longitud, $fecha, $combustibleCargado, $peajes, $extras);

        $notificaciones = $this->viajesModel->obtenerDetalleViaje($idViaje);
        $data = array('viajes' => $notificaciones);
        echo $this->render->render("view/infoViaje.php", $data);//mostrar lista de notificaciones del chofer
    }
}