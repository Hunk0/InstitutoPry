<?php

//require 'logica/Persona.php';
require 'persistencia/AdministradorDAO.php';
require_once 'persistencia/Conexion.php';

class Administrador extends Persona{
    private $conexion;
    private $administradorDAO;

    function Administrador($id="", $nombres="", $apellidos="", $correo="", $clave=""){
        $this -> Persona($id, $nombres, $apellidos, $correo, $clave);
        $this -> conexion = new Conexion();
        $this -> administradorDAO = new AdministradorDAO($id, $nombres, $apellidos, $correo, $clave);
    }

    function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> administradorDAO -> autenticar());
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

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> administradorDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> nombres = $resultado[1];
        $this -> apellidos = $resultado[2];
        $this -> correo = $resultado[3];
        $this -> conexion -> cerrar();
    }
}

?>