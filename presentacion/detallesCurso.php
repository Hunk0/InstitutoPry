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

if(isset($_GET["idCur"])){
    $curso = new Curso($_GET["idCur"]);
    $curso -> consultar();

    $variantes = $curso->consultarVariantes();
    $materias = $curso -> consultarMaterias();
}
?>
<br/><br/><br/><br/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial;
  margin: 0;
}

* {
  box-sizing: border-box;
}

img {
  vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}
</style>


<div class="container" >
  <div class="row">      
      <div class="col">
        <?php /*
        <div class="row h-100"> 
			  <div id="col" class="col-md-12 my-auto"> 
        */?>
        
            <?php
              $galeria=$curso->consultarGaleria();
              for($i=0; $i<count($galeria); $i++){
                //style width:100% => height: 425px;
                echo '<div class="mySlides text-center" >
                        <div class="numbertext">'.($i+1).' / '.count($galeria).'</div>
                        <img src="img/'.$galeria[$i]->getNombre().'" style="max-width: 567px; max-height: 425px;">
                      </div>';
              }
            ?>

          
            <div class="row" style="display: flex;
            flex-wrap: wrap; /* Optional. only if you want the items to wrap */
            justify-content: center; /* For horizontal alignment */
            align-items: center; /* For vertical alignment */">
                <?php
                  $galeria=$curso->consultarGaleria();
                  for($i=0; $i<count($galeria); $i++){
                    //style="width:100%"
                    echo '<div class="column">
                            <img class="demo cursor" src="img/'.$galeria[$i]->getNombre().'" style="width:100%" onclick="currentSlide('.($i+1).')">
                          </div>';
                  }
                ?>
            </div>
      </div>
      <div class="col align-self-center">
        
            <h1><?php echo $curso->getNombre()?></h1>
            <hr>
            <p class="col-12 "><?php echo "Detalles: <br/>".$curso->getDescripccion()?></p>

            <div class="col-md-5">
                <label>Contenido:</label>
                <ul>
                  <?php
                    foreach($materias as $m){
                      echo "<li>".$m->getNombre()."</li>";
                    }
                  ?>
                </ul>
            </div>

            <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/estudiante/inscripccion.php") ?> method="post">
              <div class="col-md-5">
                  <div class="form-group">
                    <label for="slcModalidad">Modalidades:</label>
                    <select class="custom-select" name="variante" id="slcModalidad" required>
                        <?php foreach($variantes as $v){
                          $modalidad = $v->getModalidad();
                          echo "<option value='".$v->getId()."'>".$modalidad->getNombre()."</option>";
                        } 
                        ?>
                    </select>
                    <div class="invalid-tooltip">
                        Please select a valid state.
                    </div>
                  </div>
              </div>

              <div class="container text-right">
                  <br/><h2 id="Valor">Precio: $<?php echo $variantes[0]->getCosto()?></h2>
                  <?php
                    if(isset($_SESSION["rol"])){
                      if($_SESSION["rol"]=="estudiante"){
                        $estudiante=new Estudiante($_SESSION["id"]);
                        $estudiante->consultar();
                        $matriculas = $estudiante->consultarMatriculas();
                        $habilitado=1;
                        foreach($matriculas as $m){
                          $v=$m->getVariante();
                          $c=new Curso($v->getCurso());
                          $c->consultar();
                          if($c->getId()==$curso->getId()){
                              $habilitado=0;
                          }                          
                        }  
                        $fechaactual=date("Y-m-d");
                        if($curso->getFecha()<$fechaactual){
                          $habilitado=0;
                        }
                        echo '<button type="submit" name="registrar" class="btn btn-success" '.(($habilitado==0)?'disabled':' ').' >Inscribirse</button>';
                        echo '<footer class="blockquote-footer">Este curso '.(($curso->getFecha()<$fechaactual)?'expiro':'expira').' el <cite title="Source Title">'.$curso->getFecha().'</cite></footer>';
                        //echo "<br/>".date("Y-m-d")."<br/>".strtotime($curso->getFecha())."</br>".$curso->getFecha();
                      }
                    }else{
                      echo '<a type="button" href="#" data-toggle="modal" data-target="#sesion" class="btn btn-outline-success" role="button" aria-pressed="true">Inscribirse</a>';
                    }
                  ?>                  
              </div> 
            </form> 

      </div>
  </div>
</div>


<div class="modal fade" id="sesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inicia sesion para continuar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>      
      <form method="post" action="index.php?pid=<?php echo base64_encode("presentacion/autenticar.php") ?>">
        <div class="modal-body">
                <div class="alert alert-warning" role="alert">
                  Debes iniciar sesion para poder hacer esto!
                </div>
                <div class="form-group">
                  <input type="email" name="correo" class="form-control" placeholder="Correo*" required="required">
                </div>
                <div class="form-group">
                  <input type="password" name="clave" class="form-control" placeholder="Clave*" required="required">
                </div>
                <div class="container" style="text-align: center;">
                <h>No tienes una cuenta? </h><a href=<?php echo "index.php?pid=" . base64_encode("presentacion/registro.php")?> >Registrate</a>
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

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  //var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace("active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += "active";
  //captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

<script>
   $('#slcModalidad').change(function () {
     variante = $(this).val();
     <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&idVariante=\"+variante ;\n"; ?>
     $("#Valor").load(ruta);
    });
</script>
