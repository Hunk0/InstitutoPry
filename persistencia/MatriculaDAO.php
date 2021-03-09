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

    function consultarPendientes(){
        return "SELECT idmatricula, 	estudiante_idestudiante, 	variante_idvariante, 	estado
                FROM matricula
                WHERE estado = '0';";  
    }

    function eliminarMSede(){
        return "DELETE FROM sede_has_matricula
                WHERE matricula_idmatricula  =" . $this->id . ";";
    }

    function eliminarMatricula(){
        return "DELETE FROM matricula 
                WHERE idmatricula =" . $this->id . ";";
    }
    function actualizarEstado(){
        return "UPDATE matricula 
                SET matricula.estado = '".$this->estado."' 
                WHERE idmatricula =" . $this->id . ";";                   
    }

    function ultimoId(){
        return "SELECT MAX(idmatricula) AS idmatricula FROM matricula";
    }

    function InsertarSede($sedeid){
        return "INSERT INTO sede_has_matricula
                (sede_idsede, 	matricula_idmatricula )
                VALUES ('".$sedeid."', '".$this->id."')";
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