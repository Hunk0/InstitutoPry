<?php
    include 'presentacion/profesor/mnuProfesor.php';

    if(isset($_GET["idMateria"])){
      $materia = new Materia($_GET["idMateria"]);
      $materia -> consultar();

      $curso = new Curso($materia->getCursoId());
      $curso -> consultar();
      /*
      $variantes = $curso -> consultarVariantes();
      
      $matriculas = array();
      foreach($variantes as $v){
        $matriculas += $v->consultarMatriculas();
      }*/
      $matriculas = $curso->consultarMatriculas();
      $estudiantes = array();
      for($i=0; $i<count($matriculas) ; $i++){
          $estudiantes[$i] = new Estudiante($matriculas[$i]->getEstudianteId());
          $estudiantes[$i] -> consultar();
      }
      
    }
    
?>
<br/><br/><br/><br/>
<div class="container">
  <div class="row">
    <div class="col-md-auto">
      <h1 class="display-4">Lista de estudiantes</h1>
      <?php echo "<tr><td colspan='9'>".count($estudiantes)." registros encontrados</td></tr>" ?>
    </div>
    <div class="col">
						<?php
							if(isset($_GET["Success"])){
								echo '<div class="align-items-center" style="height:100px; display: grid;">
										<div id="alert" class="alert alert-success alert-dismissible fade show" role ="alert" >
											Se ha añadido una nueva columna de notas!
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										</div>';
							}
						?>
		</div>
  </div>
  <hr><br/>	
  <div class="card">	
    <div class="card-header">
      <div class="row">
        <div class="col">
        <input id="filtro" type="text" class="form-control" placeholder="Buscar estudiante" style="width: 40rem;">
        </div>
        <div class="col-md-auto">
          
        </div>
        <div class="col-md-auto">
          <button type="button" class="btn btn-outline-primary" id="nuevaNota" >Agregar Nota</button>
        </div>
        <div class="col-md-auto">
          <a type="button" href="index.php?pid=<?php echo base64_encode("presentacion/profesor/asistenciaPdf.php")?>&idMateria=<?php echo $_GET["idMateria"]?>" class="btn btn-outline-info">Generar Pdf</a>
        </div>
      </div>
    </div>			
    <div class="card-body">	
    <div id="tabla" class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr class="text-center">
              <th>#</th>
              <th>Nombre</th>
              <?php
                if(count($estudiantes)>0){
                  $notas = $estudiantes[0]->consultarNotas($materia->getId());
                  for($i=0;$i<count($notas);$i++){
                    echo '<th> Nota '.($i+1).'</th>';
                  }
                }   
              ?>
              <th>Nota promedio</th>
            </tr>
          </thead>          
          <tbody>
              <?php
                foreach ($estudiantes as $e){
                  echo '<tr>';
                  echo '<td scope="row">'.$e->getId().'</td>';
                  echo '<td>'.$e->getNombres().' '.$e->getApellidos().'</td>';
                  $notas = $e->consultarNotas($materia->getId());
                  $i=0;
                  foreach($notas as $n){
                    $i+=$n->getNota();
                    echo '<td class="text-center"> <span class="text">'.$n->getNota().'</span><a href="#" id="'.$n->getId().'" class="fas fa-pencil-alt edit" style="display: none;"></span></td>';
                  }
                  echo '<td id="NP'.$e->getId().'" class="text-center">'. ((count($notas)>0)?($i/(count($notas))):"N/A") .'</td>';
                  echo '</tr>';
                }
              ?>      
          </tbody>
        </table>
          
    </div>
  </div>
</div>



<script>  
    //tenkius
    //https://stackoverflow.com/questions/12304697/edit-table-data-cell-using-a-edit-icon-shown-over-hover
  $("table td").hover(function() {
      $(this).children(".edit").show();
  }, function() {
      $(this).children(".edit").hide();
  });

  $(".edit").click(function() {
      if ($(this).siblings(".text").is(":hidden")) {
          //$(this).siblings(".text").text($(this).siblings("input").val());
          var valor = ($(this).siblings("input").val());
          var notaid = ($(this).attr('id'));
          var currentRow=$(this).closest("tr"); 
          var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value

          <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&idNota=\"+notaid+\"&valor=\"+valor ;\n"; ?>
          $("#NP"+col1).load(ruta);
          $(this).siblings(".text").text($(this).siblings("input").val());
          $(this).siblings("input").remove();
          $(this).siblings(".text").show();
      }
      else {
          var text = $(this).siblings(".text").text();
          $(this).before("<input type=\"text\" value=\"" + text + "\" style='width: 100px'>");
          $(this).siblings(".text").hide();
      }
  });
</script>
<script type="text/javascript">
    $('#nuevaNota').on('click', function(event) {
      <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&idMateria=".$_GET["idMateria"]."\";\n"; ?>
      $('#tabla').load(ruta); 
      <?php echo "window.setTimeout(function() { window.location = 'index.php?pid=" . base64_encode("presentacion/profesor/gestionarNotas.php")."&idMateria=".$_GET["idMateria"]."&Success=1' }, 100);"?>
    });
</script>
<script type="text/javascript">
	$(document).ready(function() {
	// show the alert
		setTimeout(function() {
			$(".alert").alert('close');
		}, 2000);
	});
</script>   