<?php

class ModalidadDAO{
    private $id;
    private $nombre;
    private $privilegio;

    function ModalidadDAO($id="", $nombre="", $privilegio=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> privilegio = $privilegio;
    }

    function consultarTodos(){
        return "SELECT idmodalidad,	nombre,	privilegio
                FROM modalidad";
    }
}
    

?>