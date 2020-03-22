<?php
  if($_SESSION['rol']=="estudiante"){
    include 'presentacion/estudiante/mnuEstudiante.php';
  }

  if($_SESSION['rol']=="profesor"){
    include 'presentacion/profesor/mnuProfesor.php';
  }
  $materia=new Materia($_GET["idMateria"]);
  $materia->consultar();
  $curso = new Curso($materia->getCursoId());
  $curso -> consultar();
  $variantes = $curso->consultarVariantes();
  $acceso=0;
  foreach($variantes as $v){
    $modalidad = $v->getModalidad();
    if($modalidad->getPrivilegio()>$acceso){
        $acceso=$modalidad->getPrivilegio();
    }
  }
  if($acceso>0){
    $mensaje="";
    if($_SESSION['rol']=="profesor"){
      if(isset($_POST["publicar"])){
        $nombre = $_POST["nombre"];
        $descripccion = nl2br(htmlentities($_POST["descripccion"], ENT_QUOTES, 'UTF-8'));
        $entrega = (isset($_POST["entrega"]))?1:0;
  
        $nombrearchivo = round(microtime(true) * 1000); 
        $path = $_FILES['material']['name'];   
        $tipoarchivo = $_FILES['material']['type'];
        $tamarchivo = $_FILES['material']['size'];   
        $ext = pathinfo($path, PATHINFO_EXTENSION);   
        if ($tamarchivo <= 300000) {    
            if (strlen($nombrearchivo) <= 45) {
                // ruta de la carpeta destino en el servidor
                $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/InstitutoPry/archivos/';
                // movemos la imagen de la carpeta temporal al directorio escogido
                
                if($tamarchivo==0){
                  $publicacion = new Publicacion("", $nombre, $descripccion, "", $entrega, $_GET["idMateria"]);
                  $publicacion -> registrar();
                }else{
                  move_uploaded_file($_FILES['material']['tmp_name'], $carpeta_destino . $nombrearchivo.".".$ext); 
                  $publicacion = new Publicacion("", $nombre, $descripccion, $nombrearchivo.".".$ext, $entrega, $_GET["idMateria"]);
                  $publicacion -> registrar();
                }
                
  
                //$pelicula = new Pelicula("", $titulo, $sinopsis,  $nombrearchivo, (int)$_POST["director"], (int)$_POST["genero"]);
                //$pelicula->registrar();    
                //header('location: index.php?pid='.base64_encode("presentacion/pelicula/consultarPelicula.php"));              
            } else {
                $mensaje = "El nombre de de la
                foto es muy largo.";
            }
        } else {
            $mensaje = "El tamano de el archivo es muy grande.";
        }
      }
    }
?>
  <br/><br/><br/>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">				
          <div class="card-body">
            <div class="row">
              <div class="col-md-auto">
                <h1 class="display-4">Plataforma de actividades</h1>
                <?php echo "<tr><td colspan='9'> </td></tr>" ?>
              </div>
              <div class="col">
              <?php
                if(isset($_POST["publicar"]) && $mensaje==""){
                  echo '<div class="align-items-center" style="height:100px; display: grid;">
                      <div id="alert" class="alert alert-success alert-dismissible fade show" role ="alert" >
                        Se ha publicado una nueva actividad!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      </div>';
                }
              ?>
              </div>
            </div>										
          </div>
        </div>
      </div>
    </div>
  </div>
  <br/>
  <div class="container">
    <div class="card">
      <?php if($_SESSION["rol"]=="profesor"){  ?>
        <div class="card-header text-right">
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Nueva publicacion
          </button>
        </div>
        <div class="collapse" id="collapseExample">
          <br/>
          <div class="card mx-auto" style="width: 80%">
            <div class="card card-body">
              <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/consultarPublicaciones.php")."&idMateria=".$_GET["idMateria"]?> method="post" enctype="multipart/form-data">   
                  <h1>Nueva publicacion:</h1>                              
                  <div class="form-group">
                      <label for="desc">Nombre*:</label>
                      <input type="text" name="nombre" class="form-control" required="required">
                  </div>

                  <div class="form-group">
                      <label for="desc">Descripccion*:</label>
                      <textarea type="text" name="descripccion" class="form-control" id="desc" required="required" rows="3" ></textarea>
                  </div>

                  <div class="form-group custom-file">
                    <label for="desc">Material:</label>
                    <input type="file" name="material" class="custom-file-input" id="customFileLang" lang="es">
                    <label class="custom-file-label" for="customFileLang" data-browse="Elegir">Seleccionar Archivo</label>
                  </div>

                  <div class="form-group form-check">
                    <br/>
                    <input type="checkbox" name="entrega" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Requiere subir entrega</label>
                  </div>

                  <button type="submit" name="publicar" class="btn btn-primary">Publicar</button>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>
      <div class="container">
        <br/><br/>  
        <h1>Actividades</h1>
        <hr><br/>
        <div class="container" style="width: 90%">
        <?php        
          $publicaciones = $materia->consultarPublicaciones();
          foreach($publicaciones as $p){
            echo '<h3>
                    • <a href="index.php?pid='.base64_encode("presentacion/detallesEntrega.php").'&idPublicacion='.$p->getId().'" style="text-decorations:none; color:inherit;">'.$p->getNombre().'<a/>
                    <small class="text-muted">'.(($p->getEntrega()==1)?'Requiere entrega':'').'</small>
                  </h3>';
          }
        ?>
        </div>
        <br/>
      </div>
      
    </div>  
  </div>
<?php }else{?>
  <br/><br/><br/><br/>
  <h1 class="display-4" id="countdown" ></h1>
  <script>
      var timeleft = 3;
      var downloadTimer = setInterval(function(){
      if(timeleft <= 0){
          clearInterval(downloadTimer);
          document.getElementById("countdown").innerHTML = "";
      } else {
          document.getElementById("countdown").innerHTML ="Esta materia no tiene acceso a plataforma, regresando al inicio en " + timeleft + " segundos";
      }
      timeleft -= 1;
      }, 1000);
  </script>
<?php 
  print "<script>window.setTimeout(function() { window.location = 'index.php?pid=" . base64_encode("presentacion/inicio.php")."' }, 4000);</script>";
} ?>
<script type="text/javascript">
	$(document).ready(function() {
	// show the alert
		setTimeout(function() {
			$(".alert").alert('close');
		}, 2000);
	});
</script>   
<script type="application/javascript">
    $(document).on('change', '.custom-file-input', function (event) {
        $(this).next('.custom-file-label').html(event.target.files[0].name);
    })
</script>