<?php

class MateriaDAO{
    private $id;
    private $nombre;
    private $cursoid;
    private $profesorid;

    function MateriaDAO($id="", $nombre="", $cursoid="", $profesorid=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> cursoid = $cursoid;
        $this -> profesorid = $profesorid;
    }

    function consultar(){
        return "SELECT 	idmateria,	nombre,	curso_idcurso,	profesor_idprofesor
                FROM materia
                WHERE idmateria =" . $this->id . ";";  
    }

    function registrar(){
        return "insert into materia
                (nombre,	curso_idcurso,	profesor_idprofesor )
                values ('" .  $this -> nombre . "', '" . $this -> cursoid . "', '" . $this -> profesorid  .  "')";
    }
}
    

?>