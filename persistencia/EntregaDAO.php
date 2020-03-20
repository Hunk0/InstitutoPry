<?php

class EntregaDAO{
    private $id;
    private $archivo;
    private $estudianteid;
    private $publicacionid;

    function EntregaDAO($id="", $archivo="", $estudianteid="", $publicacionid=""){
        $this -> id = $id;
        $this -> archivo = $archivo;
        $this -> estudianteid = $estudianteid;
        $this -> publicacionid = $publicacionid;
    }

    function registrar(){
        return "insert into entrega
                (archivo, 	estudiante_idestudiante, 	publicacion_idpublicacion )
                values ('" . $this->archivo . "', '" . $this->estudianteid . "', '" . $this->publicacionid . "')";
    }

    function consultar(){
        return "SELECT identrega, 	archivo, 	estudiante_idestudiante, 	publicacion_idpublicacion 
                FROM entrega
                WHERE identrega = '". $this->id ."'";
    }

}
    

?>