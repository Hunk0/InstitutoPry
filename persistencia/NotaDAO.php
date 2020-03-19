<?php

class NotaDAO{
    private $id;
    private $materiaid;
    private $estudianteid;
    private $nota;

    function NotaDAO($id="", $materiaid="", $estudianteid="", $nota=""){
        $this -> id = $id;
        $this -> materiaid = $materiaid;
        $this -> estudianteid = $estudianteid;
        $this -> nota = $nota;
    }

    function registrar(){
        return "insert into nota 
                (materia_idmateria, estudiante_idestudiante, nota )
                values ('" . $this->materiaid . "', '" . $this->estudianteid . "', '" . $this->nota .  "')";
    }

    function consultar(){
        return "SELECT 	idnota, 	materia_idmateria, 	estudiante_idestudiante, 	nota 
                FROM nota
                WHERE idnota =" . $this->id . ";";  
    }

    function actualizar(){
        return "UPDATE nota 
                SET nota.nota  = '".$this->nota."' 
                WHERE idnota =" . $this->id . ";";                   
    }
}
    

?>