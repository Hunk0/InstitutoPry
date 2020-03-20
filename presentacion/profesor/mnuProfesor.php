<nav class="navbar fixed-top navbar-expand-lg navbar-dark " style="background-color: #31569d !important;">
  <a class="navbar-brand"  href="index.php">
    <i class="fas fa-graduation-cap"></i>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mis Cursos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href='index.php?pid=<?php echo base64_encode("presentacion/profesor/consultarProfesor.php")?>'>Rendimiento</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mis Materias
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href='index.php?pid=<?php echo base64_encode("presentacion/profesor/consultarMaterias.php").'&Notas'?>'>Notas</a>
          <a class="dropdown-item" href='index.php?pid=<?php echo base64_encode("presentacion/profesor/consultarMaterias.php").'&Plataforma'?>'>Plataforma</a>
        </div>
      </li>
    </div> 
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
            Docente  ­
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="min-width: 0px; left: 50% !important;  right: auto !important;  text-align: center !important;  transform: translate(-50%, 0) !important;">
            <a class="dropdown-item" href="#">Mi cuenta</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href=<?php echo "index.php?salir=true"?>>Cerrar sesion</a>
          </div>
        </li>     

    </ul>      
  </div>
</nav>