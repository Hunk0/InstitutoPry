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


<div class="container">
  <div class="row">      
      <div class="col">
        <?php /*
        <div class="row h-100"> 
			  <div id="col" class="col-md-12 my-auto"> 
        */?>
        <div class="mySlides">
                <div class="numbertext">1 / 6</div>
                <img src="https://www.stoodnt.com/blog/wp-content/uploads/2019/12/study_music.jpg" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">2 / 6</div>
                <img src="https://www.stoodnt.com/blog/wp-content/uploads/2019/12/study_music.jpg" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">3 / 6</div>
                <img src="https://www.stoodnt.com/blog/wp-content/uploads/2019/12/study_music.jpg" style="width:100%">
            </div>
                
            <div class="mySlides">
                <div class="numbertext">4 / 6</div>
                <img src="https://www.stoodnt.com/blog/wp-content/uploads/2019/12/study_music.jpg" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">5 / 6</div>
                <img src="https://www.stoodnt.com/blog/wp-content/uploads/2019/12/study_music.jpg" style="width:100%">
            </div>
                
            <div class="mySlides">
                <div class="numbertext">6 / 6</div>
                <img src="https://www.stoodnt.com/blog/wp-content/uploads/2019/12/study_music.jpg" style="width:100%">
            </div>

            <div class="caption-container">
                <p id="caption"></p>
            </div>

            <div class="row" style="margin-right: 0px; margin-left: 0px;">
                <div class="column">
                <img class="demo cursor" src="https://www.stoodnt.com/blog/wp-content/uploads/2019/12/study_music.jpg" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
                </div>
                <div class="column">
                <img class="demo cursor" src="https://www.stoodnt.com/blog/wp-content/uploads/2019/12/study_music.jpg" style="width:100%" onclick="currentSlide(2)" alt="Cinque Terre">
                </div>
                <div class="column">
                <img class="demo cursor" src="https://www.stoodnt.com/blog/wp-content/uploads/2019/12/study_music.jpg" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
                </div>
                <div class="column">
                <img class="demo cursor" src="https://www.stoodnt.com/blog/wp-content/uploads/2019/12/study_music.jpg" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
                </div>
                <div class="column">
                <img class="demo cursor" src="https://www.stoodnt.com/blog/wp-content/uploads/2019/12/study_music.jpg" style="width:100%" onclick="currentSlide(5)" alt="Nature and sunrise">
                </div>    
                <div class="column">
                <img class="demo cursor" src="https://www.stoodnt.com/blog/wp-content/uploads/2019/12/study_music.jpg" style="width:100%" onclick="currentSlide(6)" alt="Snowy Mountains">
                </div>
            </div>
        <?php /*
        </div> 
        </div>
        */ ?>
      </div>
      <div class="col">
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
            
            <div class="col-md-5">
                <label for="slcModalidad">Modalidades:</label>
                <select class="custom-select" id="slcModalidad" required>
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

            <div class="container text-right">
                <br/><h2 id="Valor">Precio: $<?php echo $variantes[0]->getCosto()?></h2>
                <a href="#" class="btn btn-outline-success" role="button" aria-pressed="true">Inscribirse</a>
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
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

<script>
   $('#slcModalidad').change(function () {
     variante = $(this).val();
     <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&idVariante=\"+variante ;\n"; ?>
     $("#Valor").load(ruta);
    });
</script>
