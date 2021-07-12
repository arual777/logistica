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
        $data["viaje"] = $this->viajesModel->obtenerDetalleViaje($id);
        echo $this->render->render( "view/infoViaje.php", $data );
    }
}