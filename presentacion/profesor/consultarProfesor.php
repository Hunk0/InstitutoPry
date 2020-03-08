<?php
include 'presentacion/administrador/mnuAdministrador.php';

$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();

$profesor = new profesor();
$profesores = $profesor->consultarTodos();

?>
<br/><br/><br/>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">				
				<div class="card-body">
					<?php echo "<tr><td colspan='9'>" . count($profesores) . " registros encontrados</td></tr>" ?>					
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
				
				<div class="card-body">
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
                                echo "<td> </td>";//cursos
								echo "<td> </td>";//materias
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



<div class="modal fade" id="modalPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content" id="modalContent">
		</div>
	</div>
</div>
