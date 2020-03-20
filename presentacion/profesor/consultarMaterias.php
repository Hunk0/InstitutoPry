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
        <div class="col-md-auto">
			<div class="row h-100">
			<div id="col" class="col-md-12 my-auto">
				<img class="foto" src="https://www.matematica.pt/en/images/resumos/bar-graph.png"  style="height : 250px "/>
			</div>
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
                                echo "<tr>";
                                echo "<td><a href='index.php?pid=".base64_encode($redireccion)."&idMateria=".$m->getId()."' >" .  $m->getNombre() . "</a></td>";
								echo "<td> </td>";
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