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
				
				<div class="card-body table-responsive">
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

								$matriculas = $e->consultarMatriculas();
								echo "<td>";
										foreach ($matriculas as $m){
											$v = $m->getVariante();
											$c = $v->consultarCurso();

											if ($m->getEstadoId() == 0){
												echo "<a id='Matricula" . $m->getId() . "' href='modalCurso.php?idMatr=".$m->getId()."' data-toggle='modal' data-target='#modal'  > 
														<span style='padding: .0.1rem 0.1rem; color : #343a40 !important;' class='fas fa-book' data-toggle='tooltip' class='tooltipLink' data-placement='top' data-original-title='".$c->getNombre()." (".$m->getEstado().")"."'></span> 
													  </a>";
											}else if ($m->getEstadoId() == 1){
												echo "<a id='Matricula" . $m->getId() . "' href='modalCurso.php?idMatr=".$m->getId()."' data-toggle='modal' data-target='#modal' > 
														<span style='padding: .0.1rem 0.1rem; color : #28a745 !important;' class='fas fa-book' data-toggle='tooltip' class='tooltipLink' data-placement='top' data-original-title='".$c->getNombre()." (".$m->getEstado().")"."'></span> 
													  </a>";
											}											
										}
								echo"</td>";

								echo '<td><a href="indexAjax.php?pid='.base64_encode("presentacion/estudiante/perfilEstudiante.php").'&idEst='.$e->getId().'" data-toggle="modal" data-target="#modal" >
											<span class="fas fa-eye" data-toggle="tooltip" class="tooltipLink" data-placement="right" data-original-title="Detalles"></span> 
										</a>
									  </td>';//servicios
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



<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
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

<div class="modal fade bd-example-modal-sm" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="modalLabel">Eliminar inscripccion</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="alert alert-danger text-center" role="alert">
				<i class="fas fa-exclamation-triangle fa-3x"></i>
				<p>Esta a punto de eliminar la inscripccion de este estudiante en esta materia, esta accion no se puede deshacer</p>
			</div>			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			<button type="button" class="btn btn-danger"><i class="fas fa-exclamation-triangle"></i> Eliminar</button>
		</div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
	$('body').on('show.bs.modal', '.modal', function (e) {
		var link = $(e.relatedTarget);
		if($(this). attr("id")=='modal'){
			$(this).find(".modal-body").load(link.attr("href"));
		}
		
	});
</script>
<script>
	$('.btn-danger').click(function(){
		console.log($(this). attr("id"));
		var id = $(this). attr("id");
		<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&deleteMatr=\"+id+\"&estado=\"+estado ;\n"; ?>
        $('#Matricula'+id).load(ruta);
		$('#eliminarModal').modal('hide');
    });
</script>

