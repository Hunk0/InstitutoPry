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
<div>
  <br/><br/>
  <div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" style="height:90vh;">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" style="height:90vh; object-fit: contain;">
        <div class="carousel-item active" style="height:90vh; object-fit: contain;">
          <img src="https://files.stocky.ai/uploads/2019/05/image-Happy-students-working-together-in-the-computer-room-stocky-ai-10420602.jpg" class="d-block w-100" alt="..." >
          <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
          </div>
        </div>
        <div class="carousel-item" style="height:90vh; object-fit: contain;">
          <img src="https://previews.123rf.com/images/ammentorp/ammentorp1403/ammentorp140300141/27147687-diverse-group-of-students-using-computer-for-finding-information-for-their-academic-project-happy-yo.jpg" class="d-block w-100" alt="..." >
          <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </div>
        <div class="carousel-item" style="height:90vh; object-fit: contain;">
          <img src="https://media.gettyimages.com/photos/happy-students-in-computer-class-picture-id170507140" class="d-block w-100" alt="..." >
          <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-3 text-break">Cursos increibles esperandote!</h1>
      <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
      <p><a class="btn btn-primary btn-lg" href='index.php?pid=<?php echo base64_encode("presentacion/buscarCurso.php")?>' role="button">Ver Cursos »</a></p>
    </div>
  </div>
<div class="container">
  <br/><br/>

  <div class="card-deck">
  <div class="card">
    <div class="mx-auto" style="width: 200px;">
      <img src="https://icons-for-free.com/iconfiles/png/512/lamp+study+icon-1320190818298952428.png" class="card-img-top" alt="...">
    </div>    
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <div class="mx-auto" style="width: 200px;">
      <img src="https://www.marswebsolution.com/images/seo.png" class="card-img-top" alt="...">
    </div>
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <div class="mx-auto" style="width: 200px;">
      <img src="https://cdn0.iconfinder.com/data/icons/education-flat-7/128/14_Certificate-512.png" class="card-img-top" alt="...">
    </div>
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>
</br></br>
  <div class="card text-center">
    <div class="card-header">
      Featured
    </div>
    <div class="card-body">
      <h5 class="card-title">Special title treatment</h5>
      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    <div class="card-footer text-muted">
      2 days ago
    </div>
  </div>
</div>