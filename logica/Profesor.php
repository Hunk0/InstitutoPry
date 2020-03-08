<?php

//require 'logica/Persona.php';
require 'persistencia/ProfesorDAO.php';
require_once 'persistencia/Conexion.php';

class Profesor extends Persona{

    private $cedula;
    
    

    private $conexion;
    private $profesorDAO;

    function Profesor($id="", $nombres="", $apellidos="" ,$correo="", $clave="", $cedula=""){
        $this -> Persona($id, $nombres, $apellidos, $correo, $clave);
        $this -> cedula = $cedula;
        $this -> conexion = new Conexion();
        $this -> profesorDAO = new ProfesorDAO($id, $nombres, $apellidos, $cedula, $correo, $clave);
    }

    function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> profesorDAO -> autenticar());
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
        $this -> conexion -> ejecutar($this -> profesorDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> profesorDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> nombres = $resultado[1];
        $this -> apellidos = $resultado[2];
        $this -> correo = $resultado[3];
        $this -> cedula = $resultado[4];

        $this -> conexion -> cerrar();
    }


    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> profesorDAO -> consultarTodos());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Profesor($registro[0], $registro[1], $registro[2], $registro[3],  $registro[4]);
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function existeCorreo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> profesorDAO -> existeCorreo());
        if($this -> conexion -> numFilas() == 0){
            $this -> conexion -> cerrar();
            return false;
        } else {
            $this -> conexion -> cerrar();
            return true;            
        }
    }

    function getCorreo(){
        return $this -> correo;
    }

    function getCedula(){
        return $this -> cedula;
    }


}

?>