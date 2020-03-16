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
					<?php echo "<tr><td colspan='9'>" . count($cursos) . " registros encontrados</td></tr>" ?>					
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
								echo "<td> </td>";//.
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


