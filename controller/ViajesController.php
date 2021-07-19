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

        if($_SESSION['id_Rol'] == CHOFER) {
            $id = $_GET["id_viaje"];
            $data = array("id" => $id);
            echo $this->render->render("view/notificacion.php", $data);
        } else{
            $data = array();
            $data["mensajeError"] = "Su rol no le permite crear ni editar notificaciones de los viajes en curso";
            echo $this->render->render("view/viajes.php", $data);
        }
    }

   public function editarNotificacion(){
        $id = $_GET["id_viaje"];
        $estadoActual = $this-> viajesModel->consultarEstadoViaje($id);

        if($_SESSION['id_Rol'] == CHOFER) {
            if ($estadoActual == ENCURSO) {

                $idViajeDetalle = $_GET["id_Viaje_Detalle"];
                $id = $_GET["id_viaje"];
                $viaje = $this->viajesModel->obtenerDetalleViajePorIdViajeDetalle($idViajeDetalle);
                $data = array("viajes" => $viaje, "idViajeDetalle" => $idViajeDetalle, "id" => $id);
                echo $this->render->render("view/notificacion.php", $data);
            } else {
                $data = array();
                $data["mensajeError"] = "No es posible editar un viaje finalizado";
                echo $this->render->render("view/infoViaje.php", $data);
            }
        }
        else{
            $data = array();
            $data["mensajeErrorRol"] = "Usted no tiene permiso para editar un viaje";
            echo $this->render->render("view/infoViaje.php", $data);
        }
    }

    public function crear(){
        $idViaje= $_POST["idViaje"];
        $idViajeDetalle = $_POST["idViajeDetalle"];
        $km= $_POST["km"];
        $latitud= $_POST["latitud"];
        $longitud= $_POST["longitud"];
        $fecha= $_POST["fecha"];
        $combustibleCargado= $_POST["combustible"];
        $peajes= $_POST["peajes"];
        $extras=$_POST["extras"];

        if($idViajeDetalle != "")
        {
            $this->viajesModel->editar($idViajeDetalle, $km, $latitud, $longitud, $fecha, $combustibleCargado, $extras, $peajes);
        }
        else
        {
            $this-> viajesModel->crearNuevaNotificacion($idViaje, $km, $latitud, $longitud, $fecha, $combustibleCargado, $peajes, $extras);
            $this->cambiaEstadoViaje($idViaje, ENCURSO);
        }

        $notificaciones = $this->viajesModel->obtenerDetalleViaje($idViaje);
        $data = array('viajes' => $notificaciones, 'id'=>$idViaje);
        echo $this->render->render("view/infoViaje.php", $data);//mostrar lista de notificaciones del chofer
    }

    public function finalizarViaje(){

        if($_SESSION['id_Rol'] == CHOFER) {

            $idViaje = $_POST["idViaje"];
            $this->cambiaEstadoViaje($idViaje, FINALIZADO);

            $notificaciones = $this->viajesModel->obtenerDetalleViaje($idViaje);
            $data = array('viajes' => $notificaciones);
            echo $this->render->render("view/infoViaje.php", $data);

        }else{
            $data = array();
            $data["mensajeErrorPorFinalizacion"] = "Usted no tiene permiso para finalizar un viaje en curso";
            echo $this->render->render("view/infoViaje.php", $data);
        }
    }

    //
    // Recibe Id del viaje y un estado
    // Realiza una actualizacion del estado del viaje en la Db
    private function cambiaEstadoViaje($idViaje, $estado){
        $this-> viajesModel->cambiarEstadoViaje($idViaje, $estado);
    }

}