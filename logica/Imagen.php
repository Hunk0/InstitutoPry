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

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> imagenDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> imagenDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        
        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> cursoid = $resultado[2];

        $this -> notaDAO = new ImagenDAO($this -> id,  $this -> nombre, $this -> cursoid);

        $this -> conexion -> cerrar();
    }

    function getId(){
        return  $this -> id;
    }

    function getNombre(){
        return $this -> nombre;
    }

    function getCursoId(){
        return $this -> cursoid;
    }   
}

?>