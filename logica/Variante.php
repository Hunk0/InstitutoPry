<?php

//require 'logica/Persona.php';
require 'persistencia/VarianteDAO.php';
require_once 'persistencia/Conexion.php';

class Variante{

    private $cursoid;
    private $modalidadid;
    private $costo;
    
    private $conexion;
    private $varianteDAO;

    function Variante($cursoid="", $modalidadid="", $costo=""){
        $this -> cursoid = $cursoid;
        $this -> modalidadid = $modalidadid;
        $this -> costo = $costo;

        $this -> conexion = new Conexion();
        $this -> varianteDAO = new VarianteDAO($cursoid, $modalidadid, $costo );
    }

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> varianteDAO -> registrar());
        echo $this -> varianteDAO -> registrar();
        $this -> conexion -> cerrar();
    }
    
}

?>