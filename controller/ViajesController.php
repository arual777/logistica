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

           $data["viajes"] = $this->viajesModel->obtenerViajesPorIdUsuario($_SESSION['usuario']);
       }
        else{

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
        $idViaje = $_GET["id_viaje"];
        $estadoActual = $this-> viajesModel->consultarEstadoViaje($idViaje);


        if($_SESSION['id_Rol'] == CHOFER && $estadoActual != FINALIZADO) {
            $idViaje = $_GET["id_viaje"];
            $data = array("id" => $idViaje);
            echo $this->render->render("view/notificacion.php", $data);
        } else if ($_SESSION['id_Rol'] == CHOFER && $estadoActual == FINALIZADO){
            $data = array();
            $data["mensajeErrorPorFinalizacion"] = "Usted no puede crear ni editar viajes finalizados";
            echo $this->render->render("view/viajes.php", $data);
        } else{
            $data = array();
            $data["mensajeErrorPorRol"] = "Su rol actual le impide crear y editar notificaciones de los viajes";
            echo $this->render->render("view/viajes.php", $data);
        }
    }

   public function editarNotificacion(){
        $id = $_GET["id_viaje"];
        $estadoActual = $this-> viajesModel->consultarEstadoViaje($id);

        if($_SESSION['id_Rol'] == CHOFER && $estadoActual == ENCURSO) {

                $idViajeDetalle = $_GET["id_Viaje_Detalle"];
                $id = $_GET["id_viaje"];
                $viaje = $this->viajesModel->obtenerDetalleViajePorIdViajeDetalle($idViajeDetalle);
                $data = array("viajes" => $viaje, "idViajeDetalle" => $idViajeDetalle, "id" => $id);
                echo $this->render->render("view/notificacion.php", $data);

            } else if ($_SESSION['id_Rol'] == CHOFER && $estadoActual == FINALIZADO){
                $data = array();
                $data["mensajeError"] = "No es posible editar un viaje finalizado";
                echo $this->render->render("view/viajes.php", $data);
            } else{
            $data = array();
            $data["mensajeErrorPorRol"] = "Usted no tiene permiso para editar un viaje";
            echo $this->render->render("view/viajes.php", $data);
        }
    }

    public function crear(){
        $idViaje = $_GET["id_viaje"];

        $estadoActual = $this-> viajesModel->consultarEstadoViaje($idViaje);

        if($_SESSION['id_Rol'] == CHOFER && $estadoActual != FINALIZADO) {

            $idViaje = $_POST["idViaje"];
            $idViajeDetalle = $_POST["idViajeDetalle"];
            $km = $_POST["km"];
            $latitud = $_POST["latitud"];
            $longitud = $_POST["longitud"];
            $fecha = $_POST["fecha"];
            $combustibleCargado = $_POST["combustible"];
            $peajes = $_POST["peajes"];
            $extras = $_POST["extras"];

            if ($idViajeDetalle != "") {
                $this->viajesModel->editar($idViajeDetalle, $km, $latitud, $longitud, $fecha, $combustibleCargado, $extras, $peajes);
            } else {
                $this->viajesModel->crearNuevaNotificacion($idViaje, $km, $latitud, $longitud, $fecha, $combustibleCargado, $peajes, $extras);
                $this->cambiaEstadoViaje($idViaje, ENCURSO);
            }

            $notificaciones = $this->viajesModel->obtenerDetalleViaje($idViaje);
            $data = array('viajes' => $notificaciones, 'id' => $idViaje);
            echo $this->render->render("view/infoViaje.php", $data);

        }else{
            $data = array();
            $data["mensajeErrorViajeFinalizado"] = "Usted no puede editar un viaje finalizado";
            echo $this->render->render("view/infoViaje.php", $data);
        }
    }

    public function finalizarViaje(){

        if($_SESSION['id_Rol'] == CHOFER) {

            $idViaje = $_POST["idViaje"];
            $this->cambiaEstadoViaje($idViaje, FINALIZADO);

            $notificaciones = $this->viajesModel->obtenerDetalleViaje($idViaje);
            $mensaje = "Usted finalizó su viaje exitosamente";
            $data = array('viajes' => $notificaciones, 'id' => $idViaje, 'mensajeViajeFinalizadoExiosamente' => $mensaje);
            $id_vehiculo ['id']= $this->viajesModel->obtenerVehiculoDeUnViaje($idViaje);
            $this->viajesModel->cambiarVehiculoADisponibleAlFinalizarUnViaje($id_vehiculo['id'][0]['id_vehiculo']);
            echo $this->render->render("view/infoViaje.php", $data);

        }else{
            $data = array();
            $data["mensajeErrorPorFinalizacion"] = "Usted no tiene permiso para finalizar un viaje";
            echo $this->render->render("view/viajes.php", $data);
        }
    }

    private function cambiaEstadoViaje($idViaje, $estado){
        $this-> viajesModel->cambiarEstadoViaje($idViaje, $estado);
    }

}