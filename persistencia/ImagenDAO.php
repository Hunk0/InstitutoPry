<?php

class ImagenDAO{
    private $id;
    private $nombre;
    private $cursoid;

    function ImagenDAO($id="", $nombre="", $cursoid=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> cursoid = $cursoid;
    }

    function registrar(){
        return "insert into imagen
                (nombre, 	curso_idcurso )
                values ('" . $this->nombre . "', '" . $this->cursoid . "')";
    }

    function consultar(){
        return "SELECT idimagen, nombre, curso_idcurso
                FROM imagen
                WHERE idimagen = '". $this->id ."'";
    }
}
    

?>