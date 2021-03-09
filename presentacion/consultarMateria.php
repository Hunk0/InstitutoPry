<?php
include 'presentacion/administrador/mnuAdministrador.php';

$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();

if(isset($_GET["idCurso"])){
    $curso = new Curso($_GET["idCurso"]);
	$curso -> consultar();
	$variantes = $curso ->consultarVariantes(); 
	$materias = $curso -> consultarMaterias();

	$arr = array();	
	for($i=0; $i<sizeof($variantes) ; $i++){
		$m = $variantes[$i]->getModalidad();
		$arr[$i] = $m->getNombre();
	}

	$r = array();
	for($i=0; $i<sizeof($variantes) ; $i++){
		$m = $variantes[$i]->getModalidad();
		if($arr[$i]==$m->getNombre()){
			$matriculas = $variantes[$i] -> consultarMatriculas();
			$r[$i] = array($m->getNombre() , count($matriculas));
		}
	}
	if(isset($_POST["actualizar"])){
		$curso = new Curso($_GET["idCurso"], $_POST["nombre"], $_POST["descripccion"], $_POST["fecha"], $_POST["director"]);
		$curso->actualizar();
	}
}else{
    header('Location: index.php');
}
?>
<br/><br/><br/><br/>
<div class="container">
	<div class="row">
		<div class="col-md-auto">
			<h1 class="display-4"><?php echo $curso->getNombre()?> <a href="#" data-toggle="modal" data-target="#editModal"><i class="fas fa-pencil-alt"></i></a> </h1>
		</div>
		<div class="col">
		<?php
			if(isset($_GET["Success"])){
				echo '<div class="align-items-center" style="height:100px; display: grid;">
						<div id="alert" class="alert alert-success alert-dismissible fade show" role ="alert" >
							Nueva materia añadida!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						</div>';
			}
		?>
		</div>
	</div>
	<div class="row ">
		<div class="col-5 mx-auto" >			
			<div class="row h-100 " style="max-height: 450px">			
			<div id="analisis" class="w-100"></div>
			<script>new Chartkick.PieChart("analisis", <?php echo json_encode($r) ?>)</script>
			</div>
		</div>
		<div class="col">
			<p>Detalles:<br/><?php echo $curso->getDescripccion() ?></p>
			<p>Modalidades:<br/><?php 
								for($i=0; $i<sizeof($variantes) ; $i++){
									$m = $variantes[$i]->getModalidad();
									if($i>0){
										echo ", ";
									}
									echo $m->getNombre();
								}
								?></p>
			<p>Director:<br/><?php 
							$director = $curso->consultarDirector();
							echo $director->getNombres()." ".$director->getApellidos();
							?></p>
			<p>Cierre de inscripcciones:<br/><?php echo $curso->getFecha() ?></p>
		</div>
	</div>
	<hr>	
    <div class="row">
		<div class="col-12">
			<div class="card">
				
				<div class="card-body table-responsive">	
					Materias: <?php echo count($materias) ?>			
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">Id.</th>
								<th scope="col">Nombre</th>
								<th scope="col">Profesor</th>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($materias as $m) {
                                echo "<tr>";
								echo "<td>" . $m->getId() . "</td>";
                                echo "<td>" . $m->getNombre() . "</td>";
                                $p = new Profesor($m->getProfesorId());
                                $p -> consultar();
								echo "<td>" . $p->getNombres() . "</td>";
								echo "<td>
										<a href='#' class='eliminar' id='" . $p->getId() . "' style='color: #cc2121;' ><span class='fas fa-trash-alt' data-toggle='tooltip' class='tooltipLink' data-placement='top' data-original-title='Eliminar esta curso' ></span> </a>
									 </td>";//servicios
								echo "</tr>";
							
							}							
						?>
						<td colspan="7" style="text-align: center;"> 
							<a class="navbar-brand"  href='index.php?pid=<?php echo base64_encode("presentacion/registrarMateria.php")."&idCurso=".$_GET["idCurso"]?>'>
								<i class="fas fa-plus-circle"></i>
								<br>
								<small>Agregar Materia</small>								
							</a>
						</td>
						</tbody>
					</table>					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/consultarMateria.php") . "&idCurso=" . $_GET["idCurso"] ?> method="post">
        <div class="modal-body">

        <div class="form-group">
			<label for="desc">Nombre:</label>
			<input type="text" name="nombre" class="form-control" required="required" value="<?php echo $curso->getNombre() ?>">
		</div>
		<div class="form-group">
			<label for="desc">Descripccion:</label>
			<textarea type="text" name="descripccion" class="form-control" id="desc" required="required" rows="3" ><?php echo substr(strip_tags($curso->getDescripccion()),0,110) ?></textarea>
		</div>
		<div class="form-group">
			<label for="date-input" >Fecha de cierre:</label>
			<input class="form-control" name="fecha" type="date" id="date-input" required="required" value="<?php echo $curso->getFecha() ?>">
		</div>
		<div class="form-group">
			<label for="slcDirector">Director de curso:</label>
			<select class="custom-select selectpicker form-control" name="director" required="required" data-live-search="true" id="slcDirector">
			<option selected disabled value="">Elegir</option>
			<?php
				$profesor=new Profesor();
				$profesores=$profesor->consultarTodos();
				foreach($profesores as $p){
					//echo "<option data-tokens='".$p->getNombres()." ".$p->getApellidos()."'>".$p->getNombres()." ".$p->getApellidos()."</option>";
					if($p->getId()==$curso->getDirector()){
						echo "<option selected value='".$p->getId()."'>".$p->getNombres()." ".$p->getApellidos()."</option>"; 
					}else{
						echo "<option value='".$p->getId()."'>".$p->getNombres()." ".$p->getApellidos()."</option>"; 
					}
					
				}
			?>
			</select>
		</div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="actualizar" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	// show the alert
		setTimeout(function() {
			$(".alert").alert('close');
		}, 2000);
	});
</script>   

