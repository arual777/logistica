<?php


class RegistroController
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
        echo $this->render->render("view/registro.php");
    }

    public function registrar()
    {
        if(empty($_POST['nombre'])||empty($_POST['apellido'])||empty($_POST['dni'])||empty($_POST['fecha_nac'])
            ||empty($_POST['email'])||empty($_POST['password'])){
            $data = array();
            $data["mensajeError"] = "Complete este campo";
            echo $this->render->render("view/registro.php",$data);
            exit();
        }
        if (isset($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['fecha_nac'], $_POST['email'],
            $_POST['password'])) {
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
            $id_Rol = 1;
            $activacionDelUsuario= 0;
            if (isset($_POST['codigoLicencia'], $_POST['tipoLicencia'])) {
                $codigoLicencia = $_POST['codigoLicencia'];
                $tipoLicencia = $_POST['tipoLicencia'];
                $licenciaExistente = $this->usuarioModel->buscarUsuarioPorCodigoDeLicencia($codigoLicencia);
                if($licenciaExistente){
                    $data['licenciaExistente'] = "Esta licencia, ya se encuentra en nuestro registro, por favor verifica que hayas puesto tu licencia de forma correcta";
                    echo $this->render->render("view/registro.php", $data);
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
                $this->usuarioModel->insertarUsuario($tipoLicencia, $mail, $password,$activacionDelUsuario,$usuario, $apellido,
                    $dni, $fecha_nac, $codigoLicencia,$id_Rol);
                $data = array();
                $data['registroExitoso'] = "Tu registro fue exitoso, por favor espera a que un administrador te asigne un rol para poder iniciar sesión";
                $this->render->render("view/login.php",$data);
                header("Location:/logistica/Autorizacion/?registro=true");
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

