<?php
  $estudiante = new Estudiante($_SESSION["id"]);
  $estudiante -> consultar();
?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark " style="background-color: #31569d !important;">
  <a class="navbar-brand"  href="index.php">
    <i class="fas fa-graduation-cap"></i>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Nosotros</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href='index.php?pid=<?php echo base64_encode("presentacion/buscarCurso.php")?>'>Cursos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contacto</a>
      </li>
    </div> 

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
    </div> 
    <ul class="navbar-nav ml-auto"> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="border-radius: 50%; width: 30px; border-style: double;"> Estudiante  ­
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="min-width: 0px; left: 50% !important;  right: auto !important;  text-align: center !important;  transform: translate(-50%, 0) !important;">
            <a class="dropdown-item" href="#">Mi cuenta</a>
            <a class="dropdown-item" href='index.php?pid=<?php echo base64_encode("presentacion/estudiante/sesionEstudiante.php")?>#Cursos'>Mis cursos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href=<?php echo "index.php?salir=true"?>>Cerrar sesion</a>
          </div>
        </li>           
    </ul>      
  </div>
</nav>
