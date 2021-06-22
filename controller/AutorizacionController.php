<?php

class AutorizacionController
{
    private $render;
    private $usuarioModel;
    public function __construct($render, $usuarioModel)
    {
        $this->render = $render;
        $this->usuarioModel = $usuarioModel;
    }

    public function execute()
    {
        echo $this->render->render("view/login.php");
    }

    public function login()
    {
        if(isset($_SESSION['usuario'])){
            header("Location:view/usuario.php");
            exit();
        }else if(!isset($_POST['usuario'],$_POST['contrasenia'])) {
            header("Location:view/login.php");
            exit();
        }

        if (isset($_POST["usuario"])&& isset($_POST["contrasenia"])){
            $usuario = $_POST["usuario"];
            $contrasenia  = $_POST["contrasenia"];
            $usuarioExistente= $this->usuarioModel->validarLogin($usuario, $contrasenia);

            if($usuarioExistente){
                echo $this->render->render("view/usuario.php");
            }else{
                 $data = array();
                 $data["mensajeError"] = "Usuario no existente";
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
            header("Location:view/login.php");
        } else {
            header("Location:view/login.php");
            exit();
        }
    }
}

