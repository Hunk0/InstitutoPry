<?php

//require 'logica/Persona.php';
require 'persistencia/NotaDAO.php';
require_once 'persistencia/Conexion.php';

class Nota{

    private $id;
    private $materiaid;
    private $estudianteid;
    private $nota;
    
    private $conexion;
    private $notaDAO;

    function Nota($id="", $materiaid="", $estudianteid="", $nota=""){
        $this -> id = $id;
        $this -> materiaid = $materiaid;
        $this -> estudianteid = $estudianteid;
        $this -> nota = $nota;

        $this -> conexion = new Conexion();
        $this -> notaDAO = new NotaDAO($id, $materiaid, $estudianteid, $nota );
    }

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> notaDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> notaDAO -> consultar());
        $resultado = $this -> conexion -> extraer();

        $this -> id = $resultado[0];
        $this -> materiaid = $resultado[1];
        $this -> estudianteid = $resultado[2];
        $this -> nota = $resultado[3];

        $this -> notaDAO = new NotaDAO($this -> id,  $this -> materiaid, $this -> estudianteid, $this -> nota);

        $this -> conexion -> cerrar();
    }

    function actualizar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> notaDAO -> actualizar());
        $this -> conexion -> cerrar();
    }

    function getId(){
        return $this -> id;
    }

    function getMateriaId(){
        return $this -> materiaid;
    }

    function getEstudianteId(){
        return $this -> estudianteid;
    }

    function getNota(){
        return $this -> nota;
    }
}

?>