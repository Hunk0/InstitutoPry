<?php
include 'presentacion/profesor/mnuProfesor.php';

$profesor = new Profesor($_SESSION['id']);
$profesor->consultar();

$materias = $profesor -> consultarMaterias();

//$redireccion = (isset($_GET["Notas"]))?:"";
if(isset($_GET["Notas"])){
	$redireccion = "presentacion/profesor/gestionarNotas.php";
}else if(isset($_GET["Plataforma"])){
	$redireccion = "presentacion/consultarPublicaciones.php";
}else{
	$redireccion = "presentacion/profesor/sesionProfesor.php";
}
$analisis[] = array();
foreach ($materias as $m) {
	$curso = new Curso($m->getCursoId());
	$curso -> consultar();

	$variantes = $curso->consultarVariantes();
	$cantidad = 0;
	foreach($variantes as $v){
		if(isset($_GET["Plataforma"])){
			$modalidad=$v->getModalidad();
			if($modalidad->getPrivilegio()>0){
				$matriculas = $v -> consultarMatriculas();
				$cantidad += count($matriculas);
			}
		}else{
			$matriculas = $v -> consultarMatriculas();
			$cantidad += count($matriculas);
		}		
	}
	if(isset($_GET["Plataforma"])){
		if($cantidad!=0){
			$analisis+= array($m->getNombre() => $cantidad);
		}		
	}else{
		$analisis+= array($m->getNombre() => $cantidad);
	}
}

?>
<br/><br/><br/><br/>
<div class="container">
	<div class="row">
        <div class="col-md-auto">
            <h1 class="display-4">Registro de Materias</h1>
            <?php echo "<tr><td colspan='9'>" . count($materias) . " registros encontrados</td></tr>" ?>
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
	<hr><br/>	
    <div class="row">
        <div class="col-7 mx-auto" >			
			<div class="row h-100 " style="max-height: 450px">			
			<div id="analisis" class="w-100"></div>
			<script>new Chartkick.ColumnChart("analisis", <?php unset($analisis[0]); echo json_encode($analisis); ?>)</script>
			</div>
		</div>
		<div class="col">
			<div class="card">				
				<div class="card-body">		
					<table class="table table-striped table-borderless table-hover">
						<thead>
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Estudiantes</th>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($materias as $m) {
								$curso = new Curso($m->getCursoId());
								$curso -> consultar();
							
								$variantes = $curso->consultarVariantes();
								$cantidad = 0;
								$acceso=0;
								foreach($variantes as $v){
									$matriculas = $v -> consultarMatriculas();
									if(isset($_GET["Plataforma"])){
										$modalidad = $v->getModalidad();
										if($modalidad->getPrivilegio()>$acceso){
											$acceso=$modalidad->getPrivilegio();
										}
									}									
									$cantidad += count($matriculas);
								}
								if(isset($_GET["Plataforma"])){
									if($acceso>0){
										echo "<tr>";
										echo "<td><a href='index.php?pid=".base64_encode($redireccion)."&idMateria=".$m->getId()."' >" .  $m->getNombre() . "</a></td>";
										foreach($variantes as $v){
											$modalidad=$v->getModalidad();
											if($modalidad->getPrivilegio()>0){
												$matriculas = $v -> consultarMatriculas();
												echo "<td>".count($matriculas)."</td>";
											}	
										}										
										echo "<td> </td>";//servicios
										echo "</tr>";
									}
								}else{
									echo "<tr>";
									echo "<td><a href='index.php?pid=".base64_encode($redireccion)."&idMateria=".$m->getId()."' >" .  $m->getNombre() . "</a></td>";
									echo "<td>".$cantidad."</td>";
									echo "<td> </td>";//servicios
									echo "</tr>";
								}
								
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