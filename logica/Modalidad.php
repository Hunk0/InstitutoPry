<?php

//require 'logica/Persona.php';
require 'persistencia/ModalidadDAO.php';
require_once 'persistencia/Conexion.php';

class Modalidad{

    private $id;
    private $nombre;
    private $privilegio;
    
    private $conexion;
    private $modalidadDAO;

    function Modalidad($id="",  $nombre="",  $privilegio="" ){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> privilegio = $privilegio;

        $this -> conexion = new Conexion();
        $this -> modalidadDAO = new ModalidadDAO($id,  $nombre, $privilegio );
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> modalidadDAO -> consultar());
        $resultado = $this -> conexion -> extraer();

        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> privilegio = $resultado[2];

        $this -> modalidadDAO = new ModalidadDAO($this -> id, $this -> nombre, $this -> privilegio );

        $this -> conexion -> cerrar();
    }

    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> modalidadDAO -> consultarTodos());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Modalidad($registro[0], $registro[1], $registro[2]);
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function getId(){
        return $this -> id;
    }

    function getNombre(){
        return $this -> nombre;
    }

    function getPrivilegio(){
        return $this -> privilegio;
    }
}

?>