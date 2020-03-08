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

    function registrarCurso(){
        return "insert into curso
                (nombre,  descripccion,  fecha, director)
                values ('" . $this->nombre . "', '" . $this->descripccion . "', '" . $this->fecha . "', '" . $this->director . "')";
    }

    function registrarModalidad(){
        return "insert into curso_has_modalidad
                (curso_idcurso, 	modalidad_idmodalidad, 	valor)
                values ( '" . $this->id . "', '" . $this->modalidad ."', '" . $this->valor . "')";
    }

    function consultarCurso(){
        return "SELECT curso.idcurso,  curso.nombre,  curso.descripccion,  curso.fechacierre, curso.director, curso_has_modalidad.valor 
                FROM curso 
                INNER JOIN curso_has_modalidad
                WHERE curso.idcurso = '" . $this -> id . "' AND curso_has_modalidad.modalidad_idmodalidad = '" . $this->modalidad . "'";
    }

    function consultarCursoOld(){
        return "SELECT idcurso, nombre, descripccion, fecha, director_iddirector 
                FROM curso 
                WHERE idcurso = '" . $this -> id . "'";
    }
/*
    function registrarCursoVirtual(){
        return "insert into virtual
                (valor,  cursoid)
                values ('" . $this->valor . "', '" . $this->id . "')";
    }

    function consultarCursoVirtual(){
        return "SELECT curso.idcurso,  curso.nombre,  curso.descripccion,  curso.fecha, virtual.valor,  matricula_virtual.estado, curso.director_iddirector 
                FROM virtual
                INNER JOIN curso, matricula_virtual
                WHERE curso.idcurso = '" . $this->id . "'";
    }

    function registrarCursoPresencial(){
        return "insert into presencial
                (valor,  cursoid)
                values ('" . $this->valor . "', '" . $this->id . "')";
    }

    function consultarCursoPresencial(){
        return "SELECT curso.idcurso,  curso.nombre,  curso.descripccion,  curso.fecha, presencial.valor,  matricula_presencial.estado, curso.director_iddirector 
                FROM presencial
                INNER JOIN curso, matricula_presencial
                WHERE curso.idcurso = '" . $this->id . "'";
    }
*/   

    function consultarTodosModalidad(){
        return "SELECT curso.idcurso, curso.nombre, curso. descripccion, curso.fechacierre, curso.director, curso_has_modalidad.modalidad_idmodalidad , curso_has_modalidad.valor
                FROM curso
                INNER JOIN curso_has_modalidad
                WHERE curso_has_modalidad.modalidad_idmodalidad = '" . $this->modalidad ."'";
    }

    function consultarTodos(){
        return "SELECT curso.idcurso, curso.nombre, curso. descripccion, curso.fechacierre, curso.director, curso_has_modalidad.modalidad_idmodalidad , curso_has_modalidad.valor
                FROM curso_has_modalidad 
                INNER JOIN curso ON curso.idcurso = curso_has_modalidad.curso_idcurso
                ORDER BY curso_has_modalidad.modalidad_idmodalidad";
    }

    
    function actualizar(){
        return "update CursoPresencial set 
                nombres = '" . $this -> nombres . "',
                apellidos ='" . $this -> apellidos . "', 
                cedula ='" . $this -> cedula . "',
                telefono='" . $this -> telefono . "',
                direccion='" . $this -> direccion . "' 
                where idCursoPresencial=" . $this -> id;
    }

    function actualizarEstado($estudianteid){
           return "UPDATE matricula 
                   SET matricula.estado = '".$this->estado."' 
                   WHERE matricula.curso_idcurso = ".$this->id." AND matricula.estudiante_idestudiante =" . $estudianteid . ";";                   
 }

}

?>