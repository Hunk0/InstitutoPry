<?php

class SedeDAO{

    private $id;
    private $nombre;
    private $direccion;
    private $posx;  //'2020-03-08'
    private $posy;


    function SedeDAO($id="",  $nombre="",  $direccion="",  $posx="", $posy=""){        
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> direccion = $direccion;
        $this -> posx = $posx;  //'2020-03-08'
        $this -> posy = $posy;        
    }

    function registrar(){
        return "INSERT INTO sede
                (nombre,	direccion,	posX,	posY)
                values ( '" . $this->nombre . "', '" . $this->direccion ."', '" . $this->posx ."', '" . $this->posy . "')";
    }

    function consultar(){
        return "SELECT idsede, 	nombre, 	direccion, 	posX, 	posY 
                FROM sede
                WHERE idsede='".$this->id."'";
    }

    function consultarTodas(){
        return "SELECT idsede, 	nombre, 	direccion, 	posX, 	posY 
                FROM sede";
    }

    function consultarMatriculas(){
        return "SELECT count(matricula_idmatricula)
                FROM sede_has_matricula
                WHERE sede_idsede = '".$this->id."'";
    }

}

?>