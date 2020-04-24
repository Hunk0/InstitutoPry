<?php

//require 'logica/Persona.php';
require 'persistencia/sedeDAO.php';
require_once 'persistencia/Conexion.php';

class Sede{

    private $id;
    private $nombre;
    private $direccion;
    private $posx;
    private $posy;
    
    private $conexion;
    private $sedeDAO;

    function Sede($id="",  $nombre="",  $direccion="",  $posx="", $posy="" ){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> direccion = $direccion;
        $this -> posx = $posx;
        $this -> posy = $posy;
        $this -> conexion = new Conexion();
        $this -> sedeDAO = new SedeDAO($id,  $nombre,  $direccion,  $posx, $posy);
    }


    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> sedeDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> sedeDAO -> consultar());
        $resultado = $this -> conexion -> extraer();

        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> direccion = $resultado[2];
        $this -> posx = $resultado[3];
        $this -> posy = $resultado[4];

        $this -> conexion -> cerrar();
    }

    function consultarTodas(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> sedeDAO -> consultarTodas());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Sede($registro[0]);
            $registros[$i] -> consultar();
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function consultarMatriculas(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> sedeDAO -> consultarMatriculas());
        $resultado = $this -> conexion -> extraer();
        return $resultado[0];
        $this -> conexion -> cerrar();
    }

    function getId(){
        return $this -> id;
    }

    function getNombre(){
        return $this ->  nombre;
    }

    function getDireccion(){
        return $this -> direccion;
    }

    function getPosx(){
        return $this -> posx;
    }

    function getPosy(){
        return $this -> posy;
    }
    
    

    function getValor(){
        return $this -> valor;
    }
    

}

?>