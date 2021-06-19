<?php

class AutorizacionController  //Podemos cambiar el nombre a loginout
{
    private $render;
    private $usuarioModel;
    //el controlador necesita un render para poder mostrar las vistas
    public function __construct($render, $usuarioModel)
    {
        $this->render = $render;
        $this->usuarioModel = $usuarioModel;
    }

    public function execute()  //método que renderiza la vista del login
    {
        echo $this->render->render("view/login.php");
    }

    /*
     * método que realiza la validación del usuario
     * toma la contraseña y la encripta para validarla con la contraseña almacenada en la BD
    */
    public function login()
    {
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

    /*
      metodo que se encarga de cerrar la sesion
     */
    public function logout()
    {

    }
}