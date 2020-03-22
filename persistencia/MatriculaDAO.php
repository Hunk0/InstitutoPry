<?php

class MatriculaDAO{

    private $id;
    private $estudianteid;
    private $varianteid;    
    private $estado;

    function MatriculaDAO($id="", $estudianteid="", $varianteid="",  $estado=""){
        $this -> id = $id;
        $this -> estudianteid = $estudianteid;
        $this -> varianteid = $varianteid;
        $this -> estado = $estado;
    }

    function consultar(){
        return "SELECT idmatricula, 	estudiante_idestudiante, 	variante_idvariante, 	estado
                FROM matricula
                WHERE idmatricula =" . $this->id . ";";  
    }

    function eliminar(){
        return "DELETE FROM matricula 
                WHERE idmatricula =" . $this->id . ";";
    }
    function actualizarEstado(){
        return "UPDATE matricula 
                SET matricula.estado = '".$this->estado."' 
                WHERE idmatricula =" . $this->id . ";";                   
    }

    function registrar(){
        return "INSERT INTO matricula
                (estudiante_idestudiante, 	variante_idvariante, 	estado )
                values ('" . $this->estudianteid . "', '" . $this->varianteid . "', '" . $this->estado . "')";
    }

    function getVariante(){
        return "SELECT variante_idvariante
                FROM matricula
                WHERE idmatricula =" . $this->id . ";";
    }

    
}
    

?>