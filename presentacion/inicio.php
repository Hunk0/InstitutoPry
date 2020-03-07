<?php
if(isset($_SESSION['id']) && isset($_SESSION['rol'])){
  if($_SESSION['rol']=="admin"){
    include 'presentacion/administrador/mnuAdministrador.php';
  }
  if($_SESSION['rol']=="estudiante"){
    include 'presentacion/estudiante/mnuEstudiante.php';
  }
}else{
  include 'presentacion/mnuVisitante.php';
}

/*
$mail="";
if(isset($_POST['mail'])){
  $mail=$_POST['mail'];
}
$pass="";
if(isset($_POST['pass'])){
  $pass=$_POST['pass'];
}
$error=0;
if(isset($_POST['autenticar'])){
  $administrador = new Administrador("", "" , $mail, $pass);
  //$profesor = new Profesor("", "" , $mail, $pass);
  $estudiante = new Estudiante("", "" ,"", $mail, $pass);
    if($administrador -> autenticar()){
        $_SESSION['id'] = $administrador -> getId();
        $pid= base64_encode("presentacion/sesionAdministrador.php");
        header('Location: index.php?pid=' . $pid);
    }
    else if( $profesor -> autenticar()){    
        $_SESSION['id'] = $profesor -> getId();
        $pid= base64_encode("presentacion/profesor/sesionProfesor.php");
        header('Location: index.php?pid=' . $pid);
    }
    else if($estudiante -> autenticar()){
        $_SESSION['id'] = $estudiante -> getId();
        $pid= base64_encode("presentacion/estudiante/sesionEstudiante.php");
        header('Location: index.php?pid=' . $pid);
    }else{      
        $error=1;
    }
}

if($error==1){
    echo '
          <div id="alert" class="fixed-top alert alert-danger alert-dismissible fade show" role ="alert" style=" position: absolute;">
            Error: Email o Contraseña invalidos
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>        
        ';        
}*/

?>

