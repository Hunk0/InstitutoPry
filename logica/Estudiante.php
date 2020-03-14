<?php

//require 'logica/Persona.php';
require 'persistencia/EstudianteDAO.php';
require_once 'persistencia/Conexion.php';

class Estudiante extends Persona{

    private $cedula;
    private $telefono;
    private $direccion;
    private $foto;
    

    private $conexion;
    private $estudianteDAO;

    function Estudiante($id="", $nombres="", $apellidos="" ,$correo="", $clave="", $cedula="", $telefono="", $direccion="", $foto=""){
        $this -> Persona($id, $nombres, $apellidos, $correo, $clave);
        $this -> cedula = $cedula;
        $this -> telefono = $telefono;
        $this -> direccion = $direccion;
        $this -> foto = $foto;
        $this -> conexion = new Conexion();
        $this -> estudianteDAO = new EstudianteDAO($id, $nombres, $apellidos ,$correo, $clave, $cedula, $telefono, $direccion, $foto);
    }

    function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> autenticar());
        if($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> id = $resultado[0];
            $this -> conexion -> cerrar();
            return true;
        }else{
            $this -> conexion -> cerrar();
            return false;
        }     
    }

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> nombres = $resultado[1];
        $this -> apellidos = $resultado[2];
        $this -> correo = $resultado[3];
        $this -> cedula = $resultado[4];
        $this -> telefono = $resultado[5];
        $this -> direccion = $resultado[6];
        $this -> foto = $resultado[7];

        $this -> conexion -> cerrar();
    }


    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> consultarTodos());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Estudiante($registro[0], $registro[1], $registro[2], $registro[3],  "", $registro[4], $registro[5], $registro[6], $registro[7]);
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function existeCorreo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> existeCorreo());
        if($this -> conexion -> numFilas() == 0){
            $this -> conexion -> cerrar();
            return false;
        } else {
            $this -> conexion -> cerrar();
            return true;            
        }
    }

    function consultarMatricula(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> consultarCursos());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Matricula($this->id, $registro[0], $registro[1], $registro[2]);
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function consultarCurso($cursoid){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> consultarCurso($cursoid));
        if($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> id = $resultado[0];            
            $curso = new Curso($resultado[0], "", "", "",  "", $resultado[1], "", $resultado[2]);;
            $curso -> consultar();
            $this -> conexion -> cerrar();
            return $curso;
        }else{
            $this -> conexion -> cerrar();
            return null;
        }   
    }


    function getId(){
        return $this -> id;
    }

    function getNombres(){
        return $this -> nombres;
    }

    function getApellidos(){
        return $this -> apellidos;
    }

    function getCorreo(){
        return $this -> correo;
    }

    function getCedula(){
        return $this -> cedula;
    }

    function getTel(){
        return $this -> telefono;
    }

    function getDir(){
        return $this -> direccion;
    }

    function getFoto(){
        return $this -> foto;
    }
        

}

?>