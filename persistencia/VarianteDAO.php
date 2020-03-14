<?php

class VarianteDAO{
    private $cursoid;
    private $modalidadid;
    private $costo;

    function VarianteDAO($cursoid="", $modalidadid="", $costo=""){
        $this -> cursoid = $cursoid;
        $this -> modalidadid = $modalidadid;
        $this -> costo = $costo;
    }

    function registrar(){
        return "insert into variante
                (curso_idcurso, 	modalidad_idmodalidad,	valor )
                values ('" .  $this -> cursoid . "', '" . $this -> modalidadid . "', '" . $this -> costo  .  "')";
    }

}
    

?>