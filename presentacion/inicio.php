<?php
if(isset($_SESSION['id']) && isset($_SESSION['rol'])){
  if($_SESSION['rol']=="admin"){
    include 'presentacion/administrador/mnuAdministrador.php';
  }
  if($_SESSION['rol']=="estudiante"){
    include 'presentacion/estudiante/mnuEstudiante.php';
  }
  if($_SESSION['rol']=="profesor"){
    include 'presentacion/profesor/mnuProfesor.php';
  }
}else{
  include 'presentacion/mnuVisitante.php';
}
?>

<div class="container">
  
</div>