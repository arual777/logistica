<?php
include("helper/Seguridad.php");

class AutorizacionController
{
    private $render;

    public function __construct($render)
    {
        $this->render = $render;
    }

    public function execute()  //método que renderiza la vista del login
    {
        echo $this->render->render("view/login.php");
    }

    /*
     * método que realiza la validación del usuario e inicia la sesion.
     * toma la contraseña y la encripta para validarla con la contraseña almacenada en la BD
    */
    public function login()
    {
        if (isset($_POST["nombre"])&& isset($_POST["contrasenia"])){
            $data = array();
            $data["nombre"] = $_POST["nombre"];
            $data["contrasenia"]  = $_POST["contrasenia"];
            $seguridad = new Seguridad();
            $contraseniaEncriptada = $seguridad->encriptar($data["contrasenia"]);
        }
        //Falta hacer la validación
        //cuando es exitoso, devuelve la vista de usuario

        echo $this->render->render("view/usuario.php");
    }

    /*
      metodo que se encarga de cerrar la sesion
     */
    public function logout()
    {

    }
}