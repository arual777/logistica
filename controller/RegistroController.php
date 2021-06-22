<?php


class RegistroController
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
        echo $this->render->render("view/registro.php");
    }

    public function registrar()
    {
        if(empty($_POST['nombre'])||empty($_POST['apellido'])||empty($_POST['dni'])||empty($_POST['fecha_nac'])||empty($_POST['email'])||empty($_POST['password'])){
            $data = array();
            $data["mensajeError"] = "Complete este campo";
            echo $this->render->render("view/registro.php",$data);
            exit();
        }
        if (isset($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['fecha_nac'], $_POST['email'], $_POST['password'])) {
            $usuario = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $dni = $_POST['dni'];
            $fecha_nac = $_POST['fecha_nac'];
            $mail = $_POST['email'];
            $password = $_POST['password'];
            $usuarioExistente = $this->usuarioModel->buscarUsuarioPorEmail($mail);
            $dniExistente = $this->usuarioModel->buscarUsuarioPorDNI($dni);
            $codigoLicencia = "0";
            $tipoLicencia = 1;
            if (isset($_POST['codigoLicencia'], $_POST['tipoLicencia'])) {
                $codigoLicencia = $_POST['codigoLicencia'];
                $tipoLicencia = $_POST['tipoLicencia'];
                $licenciaExistente = $this->usuarioModel->buscarUsuarioPorCodigoDeLicencia($codigoLicencia);
                if($licenciaExistente){
                    $data['licenciaExistente'] = "Esta licencia, ya se encuentra en nuestro registro, por favor verifica que hayas puesto tu licencia de forma correcta";
                    echo $this->render->render("view/registro.php", $data);
                    echo $codigoLicencia;
                    exit();
                }
            }
            if ($usuarioExistente) {
                $data = array();
                $data['usuarioExistente'] = "Este email ya existe, por favor elija otro";
                echo $this->render->render("view/registro.php", $data);
                exit();
            } else if ($dniExistente) {
                $data['dniExistente'] = "Este DNI, ya se encuentra en nuestro registro, por favor verifica que hayas puesto tu DNI de forma correcta";
                echo $this->render->render("view/registro.php", $data);
                exit();
            } else {
                $this->usuarioModel->insertarUsuario($tipoLicencia, $mail, $password, $usuario, $apellido, $dni, $fecha_nac, $codigoLicencia);
                echo $this->render->render("view/login.php");
                exit();

            }
        } else {
            $data = array();
            $data["mensajeError"] = "Complete este campo";
            echo $this->render->render("view/registro.php",$data);
            exit();
        }

    }


}

