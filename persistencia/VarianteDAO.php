<?php

class VarianteDAO{
    private $id;
    private $cursoid;
    private $modalidadid;
    private $costo;

    function VarianteDAO($id="", $cursoid="", $modalidadid="", $costo=""){
        $this -> id = $id;
        $this -> cursoid = $cursoid;
        $this -> modalidadid = $modalidadid;
        $this -> costo = $costo;
    }

    function consultar(){
        return "SELECT 	idvariante, 	curso_idcurso, 	modalidad_idmodalidad, 	valor 
                FROM variante
                WHERE idvariante =" . $this->id . ";";  
    }

    function registrar(){
        return "insert into variante
                (curso_idcurso, 	modalidad_idmodalidad,	valor )
                values ('" .  $this -> cursoid . "', '" . $this -> modalidadid . "', '" . $this -> costo  .  "')";
    }

    function getCurso(){
        return "SELECT curso_idcurso 
                FROM variante
                WHERE idvariante =" . $this->id . ";"; 
    }

    function InsertarSede($sedeid){
        return "INSERT INTO sede_has_variante
                (sede_idsede, 	variante_idvariante)
                VALUES ('".$sedeid."', '".$this->id."')";
    }


    function ultimoId(){
        return "SELECT MAX(idvariante) AS idvariante FROM variante";
    }
}
    

?>