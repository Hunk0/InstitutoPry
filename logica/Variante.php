<?php

//require 'logica/Persona.php';
require 'persistencia/VarianteDAO.php';
require_once 'persistencia/Conexion.php';

class Variante{

    private $id;
    private $cursoid;
    private $modalidadid;
    private $costo;
    
    private $conexion;
    private $varianteDAO;

    function Variante($id="", $cursoid="", $modalidadid="", $costo=""){
        $this -> id = $id;
        $this -> cursoid = $cursoid;
        $this -> modalidadid = $modalidadid;
        $this -> costo = $costo;

        $this -> conexion = new Conexion();
        $this -> varianteDAO = new VarianteDAO($id, $cursoid, $modalidadid, $costo );
    }

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> varianteDAO -> registrar());
        echo $this -> varianteDAO -> registrar();
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> varianteDAO -> consultar());
        $resultado = $this -> conexion -> extraer();

        $this -> id = $resultado[0];
        $this -> cursoid = $resultado[1];
        $this -> modalidadid = $resultado[2];
        $this -> costo = $resultado[3];

        $this -> varianteDAO = new VarianteDAO($this -> id, $this -> cursoid, $this -> modalidadid, $this -> costo );

        $this -> conexion -> cerrar();
    }

    function consultarCurso(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> varianteDAO -> getCurso());
        if($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> cursoid = $resultado[0];            
            $curso = new Curso($resultado[0]);
            $curso -> consultar();
            $this -> conexion -> cerrar();
            return $curso;
        }else{
            $this -> conexion -> cerrar();
            return null;
        }
    }

    function consultarMatriculas(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> varianteDAO -> consultarMatriculas());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Matricula($registro[0]);
            $registros[$i] -> consultar();
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function getModalidad(){
        if($this -> modalidadid != null){
            $modalidad = new Modalidad($this -> modalidadid);
            $modalidad -> consultar();
            return $modalidad;
        }else{
            return null;
        }
    }

    function ultimoId(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> varianteDAO -> ultimoId());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> varianteDAO = new VarianteDAO($resultado[0]);
        $this -> conexion -> cerrar();
    }

    function InsertarSede($sedeid){
        //if($like!=""){
            $this -> conexion -> abrir();
            $this -> conexion -> ejecutar($this -> varianteDAO -> InsertarSede($sedeid));
            //echo ($this -> pacienteDAO -> consultarTodosLike($like));
            $this -> conexion -> cerrar();
       //}
    }

    function consultarSedes(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> varianteDAO -> consultarSedes());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Sede($registro[0]);
            $registros[$i] -> consultar();
        }

        $this -> conexion -> cerrar();
        return $registros;
    }
    

    function getId(){
        return $this -> id;
    }

    function getCurso(){
        return $this -> cursoid;
    }    

    function getModalidadId(){
        return $this -> modalidadid;
    }

    function getCosto(){
        return $this -> costo;
    }
    
}

?>