<?php

class MatriculaDAO{
    private $estudianteid;
    private $cursoid;
    private $modalidadid;
    private $estado;

    function MatriculaDAO($estudianteid="", $cursoid="", $modalidadid="", $estado=""){
        $this -> estudianteid = $estudianteid;
        $this -> cursoid = $cursoid;
        $this -> modalidadid = $modalidadid;
        $this -> estado = $estado;
    }

    function consultar(){
        return "SELECT estudiante_idestudiante,  curso_idcurso,  modalidad_idmodalidad,  estado
                FROM matricula
                WHERE estudiante_idestudiante =". $this -> estudianteid ." AND curso_idcurso=".$this -> cursoid;
    }

    function actualizarEstado(){
        return "UPDATE matricula 
                SET matricula.estado = '".$this->estado."' 
                WHERE matricula.curso_idcurso = ".$this->cursoid." AND matricula.estudiante_idestudiante =" . $this->estudianteid . ";";                   
    }

    function getCurso(){
        return "SELECT curso_idcurso
                FROM matricula
                WHERE curso_idcurso = '" . $this -> cursoid . "' AND modalidad_idmodalidad = '" . $this -> modalidadid . "'";
    }
    
}
    

?>