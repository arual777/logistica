<?php

class AutorizacionController
{
    private $render;
    private $usuarioModel;
    private $proformaModel;
    private $viajesModel;
    private $serviceModel;

    public function __construct($render, $usuarioModel, $proformaModel, $viajesModel, $serviceModel)
    {
        $this->render = $render;
        $this->usuarioModel = $usuarioModel;
        $this->proformaModel = $proformaModel;
        $this->viajesModel = $viajesModel;
        $this->serviceModel = $serviceModel;
    }

    public function execute()
    {
        echo $this->render->render("view/login.php");
    }

    public function login()
    {
        if (isset($_POST["usuario"])&& isset($_POST["contrasenia"])){
            $usuario = $_POST["usuario"];
            $contrasenia  = $_POST["contrasenia"];
            $usuario = $this->usuarioModel->validarLogin($usuario, $contrasenia);

            if(count($usuario)> 0) {
                //metemos al usuario en la sesion
                $_SESSION['usuario'] = $usuario[0]["id_Usuario"];
                $_SESSION['id_Rol'] = $usuario[0]["id_Rol"];

                echo $this->home();
            }else{
                $data = array();

                $data["mensajeError"] = "Usuario o contraseña invalidos";
                echo $this->render->render("view/login.php", $data);
            }
        }
        else{
            $data = array();
            $data["mensajeError"] = "Usuario o contraseña no pueden estar vacios";
            echo $this->render->render("view/login.php", $data);
        }
    }

    public function logout()
    {
        if (isset($_SESSION['usuario'])) {
            session_unset();
            session_destroy();
            echo $this->render->render("view/login.php");
        }
    }

    public function home()
    {
        $rol = $_SESSION['id_Rol'];
        switch($rol){
            case ADMINISTRADOR:
            case SUPERVISOR:
                $this->renderAdministradorSupervisorHome();
            break;
            case CHOFER:
                $this->renderChoferHome();
            break;
            case MECANICO:
                $this->renderMecanicoHome();
            break;
            default:
                echo $this->sinPermiso();
            break;
        }
    }

    public function sinPermiso(){
        echo $this->render->render("view/sinPermiso.php");
    }

    private function renderAdministradorSupervisorHome(){
        $proformas = $this->proformaModel->obtenerProformas();
        $data = array('proformas'=>$proformas);
        echo $this->render->render("view/proformas.php", $data);
    }

    private function renderChoferHome(){
        $usuario = $_SESSION['usuario'];
        $data["viajes"] = $this->viajesModel->obtenerViajesPorIdUsuario($usuario);
        echo $this->render->render( "view/viajes.php", $data );
    }

    private function renderMecanicoHome(){
        $usuario = $_SESSION['usuario'];
        $data["services"] = $this->serviceModel->obtenerServices();
        echo $this->render->render( "view/services.php", $data );
    }
}

