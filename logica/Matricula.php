<?php
//require 'logica/Persona.php';
require 'persistencia/MatriculaDAO.php';
require_once 'persistencia/Conexion.php';

class Matricula{

    private $id;
    private $estudianteid;
    private $varianteid;
    private $estado;
    
    function Matricula($id="", $estudianteid="", $varianteid="", $estado=""){
        $this -> id = $id;
        $this -> estudianteid = $estudianteid;
        $this -> varianteid = $varianteid;
        $this -> estado = $estado;

        $this -> conexion = new Conexion();
        $this -> matriculaDAO = new MatriculaDAO($id, $estudianteid, $varianteid, $estado);
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> matriculaDAO -> consultar());
        $resultado = $this -> conexion -> extraer();

        $this -> id = $resultado[0];
        $this -> estudianteid = $resultado[1];
        $this -> varianteid = $resultado[2];
        $this -> estado = $resultado[3];
        $this -> matriculaDAO = new MatriculaDAO($this -> id, $this -> estudianteid, $this -> varianteid, $this -> estado);

        $this -> conexion -> cerrar();
    }

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> matriculaDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function actualizarEstado(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> matriculaDAO -> actualizarEstado());
        $this -> conexion -> cerrar();
    }

    function getVariante(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> matriculaDAO -> getVariante());
        if($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> varianteid = $resultado[0];            
            $variante = new Variante($resultado[0]);
            $variante -> consultar();
            $this -> conexion -> cerrar();
            return $variante;
        }else{
            $this -> conexion -> cerrar();
            return null;
        }
    }

    
    function getId(){
        return $this -> id;
    }

    function getEstudianteId(){
        return $this -> estudianteid;
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

    function getVarianteId(){
        return $this -> varianteid;
    }
}

?>