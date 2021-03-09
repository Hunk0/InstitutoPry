<?php
    include 'presentacion/administrador/mnuAdministrador.php';
    $matricula=new Matricula();
    $matriculas=$matricula->consultarPendientes();
?>
<br/><br/><br/><br/>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <br/><br/><br/>
            <div>
                <h1 class="display-4">Hola!</h1>
                <p class="lead">Hoy es <?php echo date("d M Y"); ?></p>
                <hr class="my-4">
                <p>Para comenzar puedes explorar las opcciones disponibles en la barra superior</p>
            </div> 
            <br/><br/><br/>           
        </div>
        <div class="col-md-auto">
            <div class="card bg-light mb-3" style="min-width: auto; width: 100%; height: 60vh;">
            <div class="card-header text-white" style="background-color: #31569d !important;">Tareas pendientes</div>
            <div class="card-body" style="overflow-y: scroll;">

            <div class="list-group">
            <?php
                foreach($matriculas as $m){
                    $v = $m->getVariante();
                    $c = $v->consultarCurso();
                    $estudiante = new Estudiante($m->getEstudianteId());
                    $estudiante->consultar();
                    $modalidad = $v->getModalidad();
                    echo "<a id='M" . $m->getId() . "' href='modalCurso.php?idMatr=".$m->getId()."' data-toggle='modal' data-target='#modal' class='list-group-item-action'>";
                    echo '<div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"> Inscripccion en '.$c->getNombre().' </h5>
                            <small id="n" class="text-muted" style="color: #d51e1e !important; min-width: max-content;"> Esperando revision</small>
                            </div>
                            <p class="mb-1"> '.$modalidad->getNombre().' </p>
                            <div class="row">
                                <div class="col">
                                    <small class="text-muted">Valor: $'.$v->getCosto().'</small>
                                </div>
                                <div class="col">
                                    <small class="text-muted">Estudiante: '.$estudiante->getNombres().' '.$estudiante->getApellidos().'</small>
                                </div>
                            </div>
                            </div>                                
                        </a>
                    ';
                }
                /*
                for($i=0; $i<11; $i++){
                    echo '
                        <a href="#" data-toggle="modal" data-target="#modal" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"> Titulo </h5>
                            <small class="text-muted" style="color: #1f790c !important;"> Pendiente de pago</small>
                            </div>
                            <p class="mb-1"> Descripccion </p>
                            <div class="row">
                                <div class="col">
                                    <small class="text-muted">Curso: un curso</small>
                                </div>
                                <div class="col">
                                    <small class="text-muted">Estudiante: un estudiante</small>
                                </div>
                            </div>                                
                        </a>
                    ';
                }*/
            ?>
            </div>
            <br/>
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
        $('#M'+id).load(ruta);
		$('#eliminarModal').modal('hide');
    });
</script>