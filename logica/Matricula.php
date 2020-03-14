<?php
//require 'logica/Persona.php';
require 'persistencia/MatriculaDAO.php';
require_once 'persistencia/Conexion.php';

class Matricula{

    private $estudianteid;
    private $cursoid;
    private $modalidadid;
    private $estado;
    
    function Matricula($estudianteid="", $cursoid="", $modalidadid="", $estado=""){
        $this -> estudianteid = $estudianteid;
        $this -> cursoid = $cursoid;
        $this -> modalidadid = $modalidadid;
        $this -> estado = $estado;

        $this -> conexion = new Conexion();
        $this -> matriculaDAO = new MatriculaDAO($estudianteid, $cursoid, $modalidadid, $estado);
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> matriculaDAO -> consultar());
        $resultado = $this -> conexion -> extraer();

        $this -> estudianteid = $resultado[0];
        $this -> cursoid = $resultado[1];
        $this -> modalidadid = $resultado[2];
        $this -> estado = $resultado[3];
        $this -> matriculaDAO = new MatriculaDAO($this -> estudianteid, $this -> cursoid, $this -> modalidadid, $this -> estado);

        $this -> conexion -> cerrar();
    }

    function actualizarEstado(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> matriculaDAO -> actualizarEstado());
        $this -> conexion -> cerrar();
    }

    function getCurso(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> matriculaDAO -> getCurso());
        if($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> id = $resultado[0];            
            $curso = new Curso($resultado[0]);
            $curso -> consultar();
            $this -> conexion -> cerrar();
            return $curso;
        }else{
            $this -> conexion -> cerrar();
            return null;
        }
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

    function getModalidad(){
        return $this -> modalidadid;
    }
}

?>