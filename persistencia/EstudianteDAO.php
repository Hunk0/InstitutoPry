<?php

class EstudianteDAO{
    private $id;
    private $nombres;
    private $apellidos;
    private $correo;
    private $clave;

    private $cedula;
    private $telefono;
    private $direccion;
    private $foto;

    function EstudianteDAO($id="", $nombres="",$apellidos="", $correo="", $clave="", $cedula="", $telefono="", $direccion="", $foto=""){
        
        $this -> id = $id;
        $this -> nombres = $nombres;
        $this -> apellidos = $apellidos;
        $this -> correo = $correo;
        $this -> clave = $clave;

        $this -> cedula = $cedula;
        $this -> telefono = $telefono;
        $this -> direccion = $direccion;
        $this -> foto = $foto;
    }

    function registrar(){
        return "insert into estudiante 
                (nombres, apellidos, correo, clave, cedula, telefono, direccion)
                values ('" . $this->nombres . "', '" . $this->apellidos . "', '" . $this->correo . "',  md5('" . $this->clave . "'), '" . $this->cedula . "', '" . $this->telefono . "', '" . $this->direccion . "')";
    }


    function autenticar(){
        return "select idestudiante from estudiante
                where correo = '" . $this -> correo . "' and clave= md5('" . $this -> clave . "')";
    }

    function consultar(){
        return "SELECT idestudiante, nombres, apellidos, correo, cedula, telefono, direccion, foto 
                FROM estudiante 
                WHERE idestudiante = '" . $this -> id . "'";
    }

    function consultarTodos(){
        return "SELECT idestudiante, nombres, apellidos, correo, cedula, telefono, direccion, foto 
                FROM estudiante";
    }

    function consultarMatriculas(){
        return "SELECT idmatricula, 	estudiante_idestudiante, 	variante_idvariante, 	estado 
                FROM matricula
                WHERE estudiante_idestudiante =".$this -> id;
    }

    function consultarNotas($materiaid){
        return "SELECT idnota 
                FROM nota
                WHERE estudiante_idestudiante ='".$this -> id."' AND materia_idmateria ='".$materiaid."'";
    }

    function consultarCurso($cursoid){
        return "SELECT curso_idcurso, modalidad_idmodalidad, estado
                FROM matricula
                WHERE estudiante_idestudiante =".$this -> id." AND curso_idcurso=".$cursoid;
    }

    
    function existeCorreo(){
        return "SELECT administrador.idadministrador OR profesor.idprofesor OR estudiante.idestudiante
                FROM administrador
                INNER JOIN profesor, estudiante
                WHERE administrador.correo = '" . $this->correo . "' OR profesor.correo = '" . $this->correo . "' OR estudiante.correo = '" . $this->correo . "';";
    }

    function actualizar(){
        return "update estudiante set 
                nombres = '" . $this -> nombres . "',
                apellidos ='" . $this -> apellidos . "', 
                cedula ='" . $this -> cedula . "',
                telefono='" . $this -> telefono . "',
                direccion='" . $this -> direccion . "' 
                where idestudiante=" . $this -> id;
    }

    function actualizarFoto(){
        return "update paciente set
                foto = '" . $this -> foto . "'
                where idpaciente=" . $this -> id;
    }

}

?>