<?php

class Persona {
    protected $id;
    protected $nombres;
    protected $apellidos;
    protected $correo;
    protected $clave;

    function Persona($id="", $nombres="", $apellidos="", $correo="", $clave=""){
        $this -> id = $id;
        $this -> nombres = $nombres;
        $this -> apellidos = $apellidos;
        $this -> correo = $correo;
        $this -> clave = $clave;
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
        
}

?>