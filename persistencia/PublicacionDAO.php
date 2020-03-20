<?php

class PublicacionDAO{
    private $id;
    private $nombre;
    private $descripccion;
    private $archivo;
    private $entrega;
    private $materiaid;

    function PublicacionDAO($id="", $nombre="", $descripccion="", $archivo="", $entrega="", $materiaid=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripccion =$descripccion;
        $this -> archivo = $archivo;
        $this -> entrega = $entrega;
        $this -> materiaid = $materiaid;
    }

    function consultar(){
        return "SELECT 	idpublicacion, 	nombre, 	descripccion, 	archivo, 	entrega,	materia_idmateria 
                FROM publicacion
                WHERE idpublicacion =" . $this->id . ";";  
    }

    function registrar(){
        return "insert into publicacion
                (nombre, 	descripccion,	archivo, 	entrega, 	materia_idmateria )
                values ('" . $this->nombre . "', '" . $this->descripccion . "', '" . $this->archivo . "', '" . $this->entrega . "', '" . $this->materiaid . "')";
    }

    function consultarEntregas(){
        return "SELECT identrega 
                FROM entrega
                WHERE publicacion_idpublicacion =" . $this->id . ";";  
    }

}

?>