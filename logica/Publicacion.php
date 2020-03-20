<?php

require 'persistencia/PublicacionDAO.php';
require_once 'persistencia/Conexion.php';

class Publicacion {
    private $id;
    private $nombre;
    private $descripccion;
    private $archivo;
    private $entrega;
    private $materiaid;

    private $publicacionDAO;


    function Publicacion($id="", $nombre="", $descripccion="", $archivo="", $entrega="", $materiaid=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripccion = $descripccion;
        $this -> archivo = $archivo;
        $this -> entrega = $entrega;
        $this -> materiaid = $materiaid;
        $this -> conexion = new Conexion();
        $this -> publicacionDAO = new PublicacionDAO($id, $nombre, $descripccion, $archivo, $entrega, $materiaid);
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> publicacionDAO -> consultar());
        $resultado = $this -> conexion -> extraer();

        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> descripccion = $resultado[2];
        $this -> archivo = $resultado[3];
        $this -> entrega = $resultado[4];
        $this -> materiaid = $resultado[5];

        $this -> notaDAO = new PublicacionDAO($this -> id, $this -> nombre, $this -> descripccion, $this -> archivo, $this -> entrega = $resultado[4], $this -> materiaid);

        $this -> conexion -> cerrar();
    }

    function consultarEntregas(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> publicacionDAO -> consultarEntregas());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Entrega($registro[0]);            
            $registros[$i] -> consultar();
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> publicacionDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function getId(){
        return $this -> id;
    }

    function getNombre(){
        return $this -> nombre;
    }

    function getDescripccion(){
        return $this -> descripccion;
    }

    function getArchivo(){
        return $this -> archivo;
    }
      
    function getEntrega(){
        return $this -> entrega;
    }

    function getMateriaId(){
        return $this -> materiaid;
    }
}

?>