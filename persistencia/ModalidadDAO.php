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

    function consultar(){
        return "SELECT 	idmodalidad, nombre,	privilegio
                FROM modalidad
                WHERE idmodalidad =" . $this->id . ";";  
    }

    function consultarTodos(){
        return "SELECT idmodalidad,	nombre,	privilegio
                FROM modalidad";
    }
}
    

?>