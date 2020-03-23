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

<div class="card text-white text-center" style="height:360px; object-fit: contain;">
  <img src="https://middletownpubliclibraryri.org/wp-content/uploads/2018/02/science-background.png" class="d-block w-100" style="height:360px; object-fit: none;" >
  <div class="card-img-overlay">
    <br/><br/><br/><br/><br/>
    <h1 style=" color: white; text-shadow: 3px 3px 10px #6c757d;">Buscar Curso</h1>
    <div class="container d-flex justify-content-center" style="width: 40rem;">    
        <input id="filtro" type="text" class="shadow-lg form-control" id="exampleFormControlInput1" placeholder="Ej. matematicas, cocina, ingles...">
    </div>
    </div>
</div>

<div class="container">
    <br/><br/>
    <div id="resultadosBusqueda">
    <?php 
      $curso = new Curso();
      $cursos=$curso->consultarCursos();
      echo '<p>'.count($cursos).' registro encontrados</p>';
      
      foreach ($cursos as $c){
            echo '<br/>
                  <a href="index.php?pid='.base64_encode("presentacion/detallesCurso.php").'&idCur='.$c->getId().'" class="list-group-item-action">
                      <div class="row no-gutters list-group-item-action">
                          <div class="col-md-4">
                              <img src="https://concepto.de/wp-content/uploads/2013/08/geometria-e1551991013554.jpg" class="card-img" alt="...">
                          </div>
                          <div class="col-md-8">
                              <div class="card-body">
                                  <h5 class="card-title">'.$c->getNombre().'</h5>
                                  <p class="card-text">'.$c->getDescripccion().'</p>
                                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                              </div>
                          </div>
                      </div>
                  </a>';
      }
    ?>
    </div>

</div>

<script>
$(document).ready(function(){
	//keyup no cambia mucho con respecto a .on
    $("#filtro").on("input", function(){
		var shr = $("#filtro").val();
		if(shr.length>=0){
			<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/BuscadorAjax.php") . "&filtro=\"+shr;"; ?>
			$("#resultadosBusqueda").load(ruta);
			//console.log("sds");
		}
		
    });
});
</script>