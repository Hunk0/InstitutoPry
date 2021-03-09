<?php
include 'presentacion/administrador/mnuAdministrador.php';

$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();

if(isset($_GET["Del"])){
	$profesor=new Profesor($_GET["Del"]);
	$res=$profesor->eliminar();
	echo $res;
}

$profesor = new Profesor();
$profesores = $profesor->consultarTodos();

?>
<br/><br/><br/>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">				
				<div class="card-body">
					<div class="row">
						<div class="col-md-auto">
							<h1 class="display-4">Registro de Docentes</h1>
							<?php echo "<tr><td colspan='9'>" . count($profesores) . " registros encontrados</td></tr>" ?>
						</div>
						<div class="col">
						<?php
							if(isset($_GET["Success"])){
								echo '<div class="align-items-center" style="height:100px; display: grid;">
										<div id="alert" class="alert alert-success alert-dismissible fade show" role ="alert" >
											Se ha registrado un nuevo docente!
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
								<th scope="col">Apellido</th>
                                <th scope="col">Correo</th>
								<th scope="col">Cursos Asignados</th>
								<th scope="col">Materias Asignadas</th>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($profesores as $p) {
                                echo "<tr>";
								echo "<td>" . $p->getId() . "</td>";
								echo "<td>" . $p->getNombres() . "</td>";
								echo "<td>" . $p->getApellidos() . "</td>";
								echo "<td>" . $p->getCorreo() . "</td>";
                                echo "<td>". $p->cantCursos() ."</td>";//cursos
								echo "<td>". $p->cantMaterias() ."</td>";//materias
								echo "<td>
										<a href='#' class='eliminar' id='" . $p->getId() . "' style='color: #cc2121;' ><span class='fas fa-trash-alt' data-toggle='tooltip' class='tooltipLink' data-placement='top' data-original-title='Eliminar esta cuenta' ></span> </a>
									 </td>";//servicios
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
							<a class="navbar-brand"  href='index.php?pid=<?php echo base64_encode("presentacion/profesor/registrarProfesor.php")?>'>
								<i class="fas fa-user-plus"></i>
								<br>
								<small>Agregar Nuevo</small>								
							</a>
						</td>
						</tbody>
					</table>					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-sm" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="modalLabel">Eliminar cuenta</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="alert alert-danger text-center" role="alert">
				<i class="fas fa-exclamation-triangle fa-3x"></i>
				<p>Esta a punto de eliminar esta cuenta, esta accion solo se llevara a cabo si la cuenta no esta asociada a ninguna materia o curso y no se puede deshacer.</p>
			</div>			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			<a type="button" class="btn btn-danger"><i class="fas fa-exclamation-triangle"></i> Eliminar</a>
		</div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	// show the alert
		setTimeout(function() {
			$("#alert").alert('close');
		}, 2000);
	});
</script>   

<script>
    $('.eliminar').click(function(){        
		var href='index.php?pid=<?php echo base64_encode("presentacion/profesor/consultarProfesor.php")?>&Del='+$(this).attr("id");
        $('#eliminarModal').find(".btn-danger").attr('href', href);
		$('#eliminarModal').modal('show');
    });
</script>