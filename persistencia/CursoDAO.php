<?php

class CursoDAO{

    private $id;
    private $nombre;
    private $descripccion;
    private $fecha;  //'2020-03-08'
    private $director;
    private $modalidad;
    private $valor;
    private $estado;

    function CursoDAO($id="",  $nombre="",  $descripccion="",  $fecha="", $director="", $modalidad="",  $valor="", $estado="" ){        
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripccion = $descripccion;
        $this -> fecha = $fecha;  //'2020-03-08'
        $this -> director = $director;
        $this -> modalidad = $modalidad;
        $this -> valor = $valor;
        $this -> estado = $estado;
        
    }

    function registrar(){
        return "insert into curso
                (nombre,  descripccion,  fechacierre, director)
                values ('" . $this->nombre . "', '" . $this->descripccion . "', '" . $this->fecha . "', '" . $this->director . "')";
    }

    function registrarModalidad(){
        return "insert into curso_has_modalidad
                (curso_idcurso, 	modalidad_idmodalidad, 	valor)
                values ( '" . $this->id . "', '" . $this->modalidad ."', '" . $this->valor . "')";
    }

    function consultar(){
        return "SELECT idcurso,  nombre,  descripccion,  fechacierre, director
                FROM curso
                WHERE idcurso = '". $this->id ."'";
    }

    function ultimoId(){
        return "SELECT MAX(idcurso) AS idcurso FROM curso";
    }

/*
    function consultarCurso(){
        return "SELECT curso.idcurso,  curso.nombre,  curso.descripccion,  curso.fechacierre, curso.director, curso_has_modalidad.valor 
                FROM curso 
                INNER JOIN curso_has_modalidad
                WHERE curso.idcurso = '" . $this -> id . "' AND curso_has_modalidad.modalidad_idmodalidad = '" . $modalidad . "'";
    }
*/
    function consultarCursoOld(){
        return "SELECT idcurso, nombre, descripccion, fecha, director_iddirector 
                FROM curso 
                WHERE idcurso = '" . $this -> id . "'";
    }

    function consultarTodosModalidad(){
        return "SELECT curso.idcurso, curso.nombre, curso. descripccion, curso.fechacierre, curso.director, curso_has_modalidad.modalidad_idmodalidad , curso_has_modalidad.valor
                FROM curso
                INNER JOIN curso_has_modalidad
                WHERE curso_has_modalidad.modalidad_idmodalidad = '" . $this->modalidad ."'";
    }

    function consultarTodosM(){
        return "SELECT curso.idcurso, curso.nombre, curso. descripccion, curso.fechacierre, curso.director, curso_has_modalidad.modalidad_idmodalidad , curso_has_modalidad.valor
                FROM curso_has_modalidad 
                INNER JOIN curso ON curso.idcurso = curso_has_modalidad.curso_idcurso
                ORDER BY curso_has_modalidad.modalidad_idmodalidad";
    }

    function consultarTodos(){
        return "SELECT curso.idcurso, curso.nombre, curso. descripccion, curso.fechacierre, curso.director, curso_has_modalidad.modalidad_idmodalidad , curso_has_modalidad.valor
                FROM curso_has_modalidad 
                INNER JOIN curso ON curso.idcurso = curso_has_modalidad.curso_idcurso
                ORDER BY curso_has_modalidad.modalidad_idmodalidad";
    }
    
    function consultarCursos(){
        return "SELECT idcurso
                FROM curso
                ORDER BY fechacierre";
    }
    

}

?>