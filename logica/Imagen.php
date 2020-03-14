<?php

//require 'logica/Persona.php';
require 'persistencia/ImagenDAO.php';
require_once 'persistencia/Conexion.php';

class Imagen{

    private $id;
    private $nombre;
    private $cursoid;
    
    private $conexion;
    private $imagenDAO;

    function Imagen($id="", $nombre="", $cursoid=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> cursoid = $cursoid;

        $this -> conexion = new Conexion();
        $this -> imagenDAO = new ImagenDAO($id, $nombre, $cursoid );
    }

    
}

?>