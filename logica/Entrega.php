<?php

//require 'logica/Persona.php';
require 'persistencia/EntregaDAO.php';
require_once 'persistencia/Conexion.php';

class Entrega{

    private $id;
    private $archivo;
    private $estudianteid;
    private $publicacion;
    
    private $conexion;
    private $entregaDAO;

    function Entrega($id="", $archivo="", $estudianteid="", $publicacion=""){
        $this -> id = $id;
        $this -> archivo = $archivo;
        $this -> estudianteid = $estudianteid;
        $this -> publicacion = $publicacion;

        $this -> conexion = new Conexion();
        $this -> entregaDAO = new EntregaDAO($id, $archivo, $estudianteid, $publicacion );
    }

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> entregaDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> entregaDAO -> consultar());
        $resultado = $this -> conexion -> extraer();

        $this -> id = $resultado[0];
        $this -> archivo = $resultado[1];
        $this -> estudianteid = $resultado[2];
        $this -> publicacion = $resultado[3];

        $this -> entregaDAO = new EntregaDAO($this -> id, $this -> archivo, $this -> estudianteid, $this -> publicacion);

        $this -> conexion -> cerrar();
    }

    function getId(){
        return $this -> id;
    }

    function getArchivo(){
        return $this -> archivo;
    }

    function getCurso(){
        return $this -> archivo;
    }    

    function getEstudianteId(){
        return $this -> estudianteid;
    }

    function getPublicacion(){
        return $this -> publicacion;
    }
    
}

?>