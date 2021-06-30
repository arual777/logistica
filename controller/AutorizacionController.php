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
        if (isset($_POST["usuario"])&& isset($_POST["contrasenia"])){
            $usuario = $_POST["usuario"];
            $contrasenia  = $_POST["contrasenia"];
            $usuario = $this->usuarioModel->validarLogin($usuario, $contrasenia);

            if(count($usuario)> 0) {
                $_SESSION['usuario'] = $usuario[0]["id_Usuario"];
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
        echo $this->render->render("view/usuario.php");
    }
}

