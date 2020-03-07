<?php

class AdministradorDAO{
    private $id;
    private $nombres;
    private $apellidos;
    private $correo;
    private $clave;

    function AdministradorDAO($id="", $nombres="", $apellidos="", $correo="", $clave=""){
        $this -> id = $id;
        $this -> nombres = $nombres;
        $this -> apellidos = $apellidos;
        $this -> correo = $correo;
        $this -> clave = $clave;
    }

    function autenticar(){
        return "select idadministrador from administrador
                where correo = '" . $this -> correo . "' and clave = md5('" . $this -> clave . "')";
    }

    function consultar(){
        return "select idadministrador, nombres, apellidos, correo from administrador
                where idadministrador = '" . $this -> id . "'";
    }

}

?>