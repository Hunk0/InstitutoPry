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
        return "select idestudiante, nombres, apellidos, correo, cedula, telefono, direccion, foto, estado from estudiante 
                       where idestudiante = '" . $this -> id . "'";
    }

    function consultarTodos(){
        return "select idestudiante, nombres, apellidos, correo, cedula, telefono, direccion, foto, estado from estudiante";
    }

    
    function existeCorreo(){
        return "SELECT administrador.idadministrador
                FROM administrador
                WHERE ( administrador.correo = '" . $this->correo . "'  OR ( SELECT profesor.idprofesor
                                                                        FROM profesor
                                                                        WHERE profesor.correo = '" . $this->correo . "' OR ( SELECT estudiante.idestudiante
                                                                                                                        FROM estudiante
                                                                                                                        WHERE estudiante.correo = '" . $this->correo . "')))";
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