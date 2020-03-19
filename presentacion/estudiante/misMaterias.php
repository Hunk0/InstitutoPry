<?php
include 'presentacion/estudiante/mnuEstudiante.php';

if(isset($_GET["idCurso"])){
    $curso = new Curso($_GET["idCurso"]);
	$curso -> consultar();
	$variantes = $curso ->consultarVariantes(); 
    $materias = $curso -> consultarMaterias();
}else{
    header('Location: index.php');
}
?>
<br/><br/><br/><br/>
<div class="container">
	<div class="row">
		<div class="col-md-auto">
			<h1 class="display-4"><?php echo $curso->getNombre()?></h1>
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
		<div class="col-md-auto">
			<div class="row h-100">
			<div id="col" class="col-md-12 my-auto">
				<img class="foto" src="https://www.matematica.pt/en/images/resumos/bar-graph.png"  style="height : 250px "/>
			</div>
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
				
				<div class="card-body">	
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
								echo "<td> </td>";//servicios
								echo "</tr>";
							
							}							
						?>
						</tbody>
					</table>					
				</div>
			</div>
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