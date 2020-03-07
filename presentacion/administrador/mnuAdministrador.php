

<nav class="navbar fixed-top navbar-expand-lg navbar-dark " style="background-color: #31569d !important;">
  <a class="navbar-brand"  href="index.php">
    <i class="fas fa-graduation-cap"></i>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
    </div> 
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
            Administrador  ­
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




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Iniciar Sesion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="index.php?pid=<?php echo base64_encode("presentacion/autenticar.php") ?>">
        <div class="modal-body">
                <div class="form-group">
                  <input type="email" name="correo" class="form-control" placeholder="Correo*" required="required">
                </div>
                <div class="form-group">
                  <input type="password" name="clave" class="form-control" placeholder="Clave*" required="required">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button name="autenticar" type="submit" class="btn btn-primary">Autenticar</button>
        </div>
      </form>
    </div>
  </div>
 </div>
</div>