<?php

//require 'logica/Persona.php';
require 'persistencia/CursoDAO.php';
require_once 'persistencia/Conexion.php';

class Curso{

    private $id;
    private  $nombre;
    private  $descripccion;
    private  $fecha;
    private $director;
    private $modalidad;
    private  $valor;
    private $estado;
    
    private $conexion;
    private $cursoDAO;

    function Curso($id="",  $nombre="",  $descripccion="",  $fecha="", $director="", $modalidad="",  $valor="", $estado="" ){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripccion = $descripccion;
        $this -> fecha = $fecha;
        $this -> director = $director;
        $this -> modalidad = $modalidad;
        $this -> valor = $valor;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> cursoDAO = new CursoDAO($id,  $nombre,  $descripccion,  $fecha, $director, $modalidad,  $valor, $estado );
    }


    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> cursoDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> cursoDAO -> consultarCurso());
        $resultado = $this -> conexion -> extraer();

        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> descripccion = $resultado[2];
        $this -> fecha = $resultado[3];
        $this -> director = $resultado[4];
        $this -> valor = $resultado[5];

        $this -> conexion -> cerrar();
    }


    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> cursoDAO -> consultarTodos());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Curso($registro[0], $registro[1], $registro[2], $registro[3],  $registro[4], $registro[5], $registro[6], $registro[7]);
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function existeCorreo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> cursoDAO -> existeCorreo());
        if($this -> conexion -> numFilas() == 0){
            $this -> conexion -> cerrar();
            return false;
        } else {
            $this -> conexion -> cerrar();
            return true;            
        }
    }

    function consultarCursos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> cursoDAO -> consultarCursos());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Curso($registro[0]);            
            $registros[$i] -> consultar();
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function actualizarEstado($estudianteid){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> cursoDAO -> actualizarEstado($estudianteid));
        $this -> conexion -> cerrar();
    }


    function getId(){
        return $this -> id;
    }

    function getNombre(){
        return $this ->  nombre;
    }

    function getDescripccion(){
        return $this -> descripccion;
    }

    function getFecha(){
        return $this -> fecha;
    }

    function getDirector(){
        return $this -> director;
    }
    
    function getModalidad(){
        return $this -> modalidad;
    }

    function getValor(){
        return $this -> valor;
    }
    
    function getEstadoId(){
        return $this -> estado; 
    }
    
    function getEstado(){
        if ($this -> estado == 0){
            return "Esperando pago";
        }else if ($this -> estado == 1){
            return "Pago aceptado";
        }
    }

}

?>