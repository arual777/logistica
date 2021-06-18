<?php

class Render{
    private $mustache;

    public function __construct($partialsPathLoader){
        Mustache_Autoloader::register();
        $this->mustache = new Mustache_Engine(
            array(
            'partials_loader' => new Mustache_Loader_FilesystemLoader( $partialsPathLoader )
        ));
    }
         // A este método le pasamos lo que se va a mostrar en pantalla (renderizar) y una lista de datos que es optativa
    public function render($contentFile , $data = array() ){

        $contentAsString =  file_get_contents($contentFile);
        //Llamamos al método render y le pasamos los contenidos a mostrar
        return  $this->mustache->render($contentAsString, $data);
    }
}