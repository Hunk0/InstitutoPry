<?php

class ProfesorDAO{
    private $id;
    private $nombres;
    private $apellidos;
    private $cedula;
    private $correo;
    private $clave;

    function ProfesorDAO($id="", $nombres="", $apellidos="", $cedula="", $correo="", $clave=""){
        $this -> id = $id;
        $this -> nombres = $nombres;
        $this -> apellidos =$apellidos;
        $this -> cedula = $cedula;
        $this -> correo = $correo;
        $this -> clave = $clave;
    }

    function registrar(){
        return "insert into profesor 
                (nombres, apellidos, cedula, correo,	clave)
                values ('" . $this->nombres . "', '" . $this->apellidos . "', '" . $this->cedula . "', '" . $this->correo . "',  md5('" . $this->clave . "'))";
    }

    function maxid(){
        return "SELECT MAX(idprofesor) AS idprofesor FROM profesor";
    }

    function autenticar(){
        return "select idprofesor from profesor
                where correo = '" . $this -> correo . "' and clave = md5('" . $this -> clave . "')";
    }

    function consultar(){
        return "select idprofesor, nombres, apellidos, correo, cedula from profesor
                where idprofesor = '" . $this -> id . "'";
    }

    function consultarTodos(){
        return "select idprofesor, nombres,  apellidos, correo, cedula
                from profesor";
    }

    function consultarMaterias(){
        return "SELECT idmateria
                FROM materia 
                WHERE profesor_idprofesor = '".$this->id."'";
    }

    function existeCorreo(){
        return "SELECT administrador.idadministrador OR profesor.idprofesor OR estudiante.idestudiante
                FROM administrador
                INNER JOIN profesor, estudiante
                WHERE administrador.correo = '" . $this->correo . "' OR profesor.correo = '" . $this->correo . "' OR estudiante.correo = '" . $this->correo . "';";
    }

    function cantCursos(){
        return "SELECT count(idcurso)
                FROM curso
                WHERE director = '".$this->id."'";
    }

    function cantMaterias(){
        return "SELECT count(idmateria)
                FROM materia
                WHERE profesor_idprofesor = '".$this->id."'";
    }

    function eliminar(){
        return "DELETE 
                FROM profesor
                WHERE idprofesor = '".$this->id."'";
    }
}

?>