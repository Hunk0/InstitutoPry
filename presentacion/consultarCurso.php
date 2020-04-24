<?php
include 'presentacion/administrador/mnuAdministrador.php';

$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();

$curso = new Curso();
$cursos = $curso->consultarCursos();

?>
<br/><br/><br/>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">				
				<div class="card-body">
					<div class="row">
						<div class="col-md-auto">
							<h1 class="display-4">Registro de Cursos</h1>
							<?php echo "<tr><td colspan='9'>" . count($cursos) . " registros encontrados</td></tr>" ?>
						</div>
						<div class="col">
						<?php
							if(isset($_GET["Success"])){
								echo '<div class="align-items-center" style="height:100px; display: grid;">
										<div id="alert" class="alert alert-success alert-dismissible fade show" role ="alert" >
											Nueva curso añadido!
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
	<div class="row">
		<div class="col-12">
			<div class="card">
				
				<div class="card-body table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">Id.</th>
								<th scope="col">Nombre</th>
								<th scope="col">Fecha de cierre</th>
                                <th scope="col">Director</th>
								<th scope="col">Numero de estudiantes</th>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($cursos as $c) {
                                echo "<tr>";
								echo "<td>" . $c->getId() . "</td>";
								echo "<td><a href='index.php?pid=".base64_encode("presentacion/consultarMateria.php")."&idCurso=".$c->getId()."' >" . $c->getNombre() . "</a></td>";
								echo "<td>" . $c->getFecha() . "</td>";
								echo "<td>" . $c->getDirector() . "</td>";
								echo "<td>" . count($c->consultarMatriculas()) . "</td>";//.
								echo "<td> </td>";//servicios
								/*							
								echo "<td>" . "
											  <a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/pelicula/editarPelicula.php") . "&idPelicula=" . $p->getId() . "' data-toggle='tooltip' data-placement='left' title='Editar Informacion'> </a>
											  <a href='modalPelicula.php?idPelicula=" . $p->getId() . "' data-toggle='modal' data-target='#modalPaciente' ><span class='fas fa-eye' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Ver Detalles' ></span> </a>
                                    </td>";
                                */
								echo "</tr>";
							
							}							
						?>
						<td colspan="7" style="text-align: center;"> 
							<a class="navbar-brand"  href='index.php?pid=<?php echo base64_encode("presentacion/registrarCurso.php")?>'>
								<i class="fas fa-plus-circle"></i>
								<br>
								<small>Agregar Curso</small>								
							</a>
						</td>
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
