<?php
include_once("helper/MysqlDatabase.php");
include_once("helper/Render.php");
include_once("helper/UrlHelper.php");
include_once("helper/Seguridad.php");
include_once("model/UsuarioModel.php");
include_once("model/PermisoModel.php");
include_once("model/ProformaModel.php");
include_once("model/ViajesModel.php");
include_once("model/VehiculosModel.php");
include_once("model/ServiceModel.php");

include_once("controller/AutorizacionController.php");
include_once("controller/UsuarioController.php");
include_once("controller/RegistroController.php");
include_once("controller/ProformaController.php");
include_once("controller/ViajesController.php");
include_once("controller/VehiculosController.php");
include_once("controller/ServiceController.php");

include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once("Router.php");
include_once("Constantes.php");

class Configuration
{
    private function getDatabase()
    {
        $config = $this->getConfig();
        return new MysqlDatabase(
            $config["servername"],
            $config["username"],
            $config["password"],
            $config["dbname"]
        );
    }

    private function getConfig()
    {
        return parse_ini_file("config/config.ini");
    }

    public function getRender()
    {
        return new Render('view/partial');
    }

    //Este método devuelve un objeto de la clase autorización controler y le pasa el parámetro que necesita
    public function getAutorizacionController()
    {
        $render = $this->getRender();
        $usuarioModel = $this->getusuarioModel();
        $proformaModel = $this->getProformaModel();
        $viajesModel = $this->getViajesModel();
        return new AutorizacionController($render, $usuarioModel, $proformaModel, $viajesModel);
    }

    public function getRegistroController()
    {
        $render = $this->getRender();
        $usuarioModel = $this->getusuarioModel();
        return new RegistroController($render, $usuarioModel);
    }

    public function getUsuarioController()
    {
        $render = $this->getRender();
        $usuarioModel = $this->getusuarioModel();
        return new UsuarioController($render, $usuarioModel);
    }

    public function getProformaController()
    {
        $render = $this->getRender();
        $proformaModel = $this->getProformaModel();
        return new ProformaController($render, $proformaModel);
    }

    public function getViajesController()
    {
        $render = $this->getRender();
        $model = $this->getViajesModel();
        return new ViajesController($render, $model);
    }

    public function getVehiculosController()
    {
        $render = $this->getRender();
        $model = $this->getVehiculosModel();
        return new VehiculosController($render, $model);
    }

    public function getServiceController()
    {
        $render = $this->getRender();
        $model = $this->getServiceModel();
        return new ServiceController($render, $model);
    }

    public function getusuarioModel()
    {
        $database = $this->getDatabase();
        $seguridad = $this->getSeguridad();
        return new UsuarioModel($database, $seguridad);
    }

    public function getPermisoModel()
    {
        $database = $this->getDatabase();
        return new PermisoModel($database);
    }

    public function getProformaModel()
    {
        $database = $this->getDatabase();
        return new ProformaModel($database);
    }

    public function getViajesModel()
    {
        $database = $this->getDatabase();
        return new ViajesModel($database);
    }

    public function getVehiculosModel()
    {
        $database = $this->getDatabase();
        return new VehiculosModel($database);
    }

    public function getServiceModel(){
        $database = $this->getDatabase();
        return new ServiceModel($database);
    }

    public function getRouter(){
        return new Router($this);
    }

    public function getUrlHelper(){
        return new UrlHelper();
    }

    public function getSeguridad(){
        return new Seguridad();
    }
}