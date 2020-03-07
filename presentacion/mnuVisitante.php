

<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #31569d !important;">
  <a class="navbar-brand"  href="index.php">
    <i class="fas fa-graduation-cap"></i>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
    </div> 

    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarNavAltMarkup">
        <ul class="navbar-nav ml-auto">
                <br/>
                <?php
                    if(isset($_GET["pid"])){
                        if(base64_decode($_GET["pid"])!="presentacion/autenticar.php"){
                            echo '<a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#exampleModal">Iniciar Sesion</a>';
                        }
                        if(base64_decode($_GET["pid"])!="presentacion/registro.php"){
                            echo '<a class="nav-item nav-link" href=' . "index.php?pid=" . base64_encode("presentacion/registro.php") . '>Registrarse</a>';
                        }           
                    }else{
                        echo '<a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#exampleModal">Iniciar Sesion</a>';
                        echo '<a class="nav-item nav-link" href=' . "index.php?pid=" . base64_encode("presentacion/registro.php") . '>Registrarse</a>';
                    }                   
                ?>        
        </ul>
    </div>      
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