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

    
}
    

?>