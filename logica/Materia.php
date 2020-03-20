<?php

//require 'logica/Persona.php';
require 'persistencia/MateriaDAO.php';
require_once 'persistencia/Conexion.php';

class Materia{

    private $id;
    private $nombre;
    private $cursoid;
    private $profesorid;
    
    private $conexion;
    private $materiaDAO;

    function Materia($id="", $nombre="", $cursoid="", $profesorid=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> cursoid = $cursoid;
        $this -> profesorid = $profesorid;

        $this -> conexion = new Conexion();
        $this -> materiaDAO = new MateriaDAO($id, $nombre, $cursoid, $profesorid );
    }

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> materiaDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> materiaDAO -> consultar());
        $resultado = $this -> conexion -> extraer();

        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> cursoid = $resultado[2];
        $this -> profesorid = $resultado[3];

        $this -> materiaDAO = new MateriaDAO($this -> id,  $this -> nombre, $this -> cursoid, $this -> profesorid);

        $this -> conexion -> cerrar();
    }

    function consultarNotas(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> materiaDAO -> consultarNotas());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Nota($registro[0]);
            $registros[$i] -> consultar();
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function consultarPublicaciones(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> materiaDAO -> consultarPublicaciones());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Publicacion($registro[0]);
            $registros[$i] -> consultar();
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
    
    function getCursoId(){
        return $this -> cursoid;
    }
    
    function getProfesorId(){
        return $this -> profesorid;
    }

}

?>