<?php
include 'presentacion/administrador/mnuAdministrador.php';

$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();

$estudiante = new Estudiante();
$estudiantes = $estudiante->consultarTodos();

?>
<br/><br/><br/>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">				
				<div class="card-body">
					<?php echo "<tr><td colspan='9'>" . count($estudiantes) . " registros encontrados</td></tr>" ?>					
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
								<th scope="col">Cedula</th>
								<th scope="col">Nombre</th>								
                                <th scope="col">Correo</th>
								<th scope="col">Telefono</th>
								<th scope="col">Cursos</th>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($estudiantes as $e) {
                                echo "<tr>";
								echo "<td>" . $e->getId() . "</td>";
								echo "<td>" . $e->getCedula() . "</td>";
								echo "<td>" . $e->getNombres() . " " . $e->getApellidos() . "</td>";								
								echo "<td>" . $e->getCorreo() . "</td>";
								echo "<td>" . $e->getTel() . "</td>";

								$cursos = $e->consultarCursos();
								echo "<td>";
										foreach ($cursos as $c){
											if ($c->getEstadoId() == 0){
												echo "<a id='Curso" . $c->getId() . "' href='modalCurso.php?idCur=".$c->getId(). "&idEst=".$e->getId()."' data-toggle='modal' data-target='#modal'  > 
														<span style='padding: .0.1rem 0.1rem; color : #343a40 !important;' class='fas fa-book' data-toggle='tooltip' class='tooltipLink' data-placement='top' data-original-title='".$c->getNombre()." (".$c->getEstado().")"."'></span> 
													  </a>";
											}else if ($c->getEstadoId() == 1){
												echo "<a id='Curso" . $c->getId() . "' href='modalCurso.php?idCur=".$c->getId(). "&idEst=".$e->getId()."' data-toggle='modal' data-target='#modal' > 
														<span style='padding: .0.1rem 0.1rem; color : #28a745 !important;' class='fas fa-book' data-toggle='tooltip' class='tooltipLink' data-placement='top' data-original-title='".$c->getNombre()." (".$c->getEstado().")"."'></span> 
													  </a>";
											}											
										}
								echo"</td>";

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



<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Detalles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>

<script>
	$('body').on('show.bs.modal', '.modal', function (e) {
		var link = $(e.relatedTarget);
		$(this).find(".modal-body").load(link.attr("href"));
	});
</script>
