<?php
include 'presentacion/estudiante/mnuEstudiante.php';
$acceso=0;
if(isset($_GET["idMatricula"])){
	$estudiante = new Estudiante($_SESSION["id"]);
	$estudiante -> consultar();

	$matricula = new Matricula($_GET["idMatricula"]);
	$matricula->consultar();

	$acceso=$matricula->getEstadoId();
}

if($acceso==1){
	$variante=new Variante($matricula->getVarianteId());
	$variante->consultar();

	$curso=new Curso($variante->getCurso());
	$curso->consultar();

	$materias = $curso -> consultarMaterias();

	$modalidad = new Modalidad($variante->getModalidadId());
	$modalidad -> consultar();

	$profesor = new Profesor($curso->getDirector());
	$profesor -> consultar();

	$maxn=0;
	foreach ($materias as $m){
		$notas = $estudiante->consultarNotas($m->getId());
		if(count($notas)>$maxn){
			$maxn=count($notas);
		}
	}
	echo $maxn;

?>
<br/><br/><br/><br/>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">				
				<div class="card-body">
					<div class="row">
						<div class="col-md-auto">
							<h1 class="display-4"><?php echo $curso->getNombre()?></h1>
							<?php echo "<tr><td colspan='9'>".count($materias)." materias registradas</td></tr>" ?>
						</div>
							<div class="col">
								<?php
									if(isset($_GET["Success"])){
										echo '<div class="align-items-center" style="height:100px; display: grid;">
												<div id="alert" class="alert alert-success alert-dismissible fade show" role ="alert" >
													Se ha añadido una nueva columna de notas!
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
				<div class="card-footer ">
					<div class="row">
						<div class="col-3">
							<span class="align-middle">Director: <?php echo $profesor->getNombres()." ".$profesor->getApellidos()?></span>		
						</div>
						<div class="col">
						<span class="align-middle">Modalidad: <?php echo $modalidad->getNombre()?></span>
						</div>
						<div class="col-md-auto">
							<span class="align-middle"><a href="index.php?pid=<?php echo base64_encode("presentacion/estudiante/certificadoPdf.php")?>&idVariante=<?php echo $variante->getId()?>" type="button" class="btn btn-outline-info">Generar Certificado de estudio</a></span>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<br/><br/><br/>
	
	<hr>
	<h1>Mis Notas</h1>
	<div id="tabla" class="table-responsive">
        <table class="table table-bordered table-hover">    
		  <thead>
            <tr class="text-center">
              <th>Nombre</th>
              <th colspan="<?php echo $maxn?>">Notas</th>
              <th>Nota promedio</th>
            </tr>
          </thead>  
          <tbody>
			  <?php
			  	$analisis[]=array();
                foreach ($materias as $m){
                  echo '<tr>';
                  echo '<td>'.$m->getNombre().'</td>';
				  $notas = $estudiante->consultarNotas($m->getId());
				  $i=0;
				  foreach($notas as $n){
					$i+=$n->getNota();
                    echo '<td class="text-center"> <span class="text">'.$n->getNota().'</span><a href="#" id="'.$n->getId().'" class="fas fa-pencil-alt edit" style="display: none;"></span></td>';
				  }
				  echo ($maxn!=count($notas))?'<td class="text-center " colspan="'.($maxn-count($notas)).'"> N/A </td>':'';
				  echo ($maxn==0)?'<td class="text-center"> N/A </td>':'';
				  echo '<td  id="NP'.$m->getId().'" class="text-center">'. ((count($notas)>0)?($i/(count($notas))):"N/A") .'</td>';              
				  
				  $analisis += array($m->getNombre() => ((count($notas)>0)?($i/(count($notas))):0));
				  
				  
				  /*
				  for($i=0;$i<$maxn;$i++){
					if($i<count($notas)){
						echo '<td  class="text-center"> <span class="text">'.$notas[$i]->getNota().'</span><a href="#" id="'.$notas[$i]->getId().'" class="fas fa-pencil-alt edit" style="display: none;"></span></td>';
					}else{
						echo '<th  class="text-center "> <span class="text"></span><a href="#"  class="fas fa-pencil-alt edit" style="display: none;"></span></th>';
					}						 
				  }
				  
				  echo '<td  id="NP'.$m->getId().'" class="text-center">'. ((count($notas)>0)?($i/(count($notas))):"N/A") .'</td>'; 
				   */            
                  echo '</tr>';
				}
				
              ?>      
          </tbody>
		</table>
	</div>
	<br/>	
	<h1>Analisis de rendimiento</h1>
	<div id="rendimiento" style="height: 300px;"></div>
	<script>new Chartkick.LineChart("rendimiento", <?php unset($analisis[0]); echo json_encode($analisis); ?>)</script>
		<?php if($modalidad->getPrivilegio()>0){?>	
			<hr>
			<h1>Plataforma</h1>
			<br/>
			<div class="container" style="width: 90%">
				<div class="row row-cols-1 row-cols-md-3">
				<?php
				foreach ($materias as $m){
					$profesor = new Profesor($m->getProfesorId());
					$profesor -> consultar();
					echo '	<div class="col mb-4">	
								<div class="card h-100 mx-auto border-dark mb-3" style="width: 13rem;">
									<div class="card-body text-dark ">
										<h5 class="card-title align-middle"><a href="index.php?pid='.base64_encode("presentacion/consultarPublicaciones.php").'&idMateria='.$m->getId().'" style="text-decorations:none; color:inherit;">'.$m->getNombre().'</a></h5>
										<p class="card-text align-middle">Docente:<br/>'.$profesor->getNombres().' '.$profesor->getApellidos().'</p>
									</div>
								</div>
							</div>';
				}
				?>	
				</div>
				
			</div>	
		<?php }?>
</div>
<?php }else{ ?>
	<br/><br/><br/><br/><br/><h1 class="d-flex justify-content-center">Esperando Pago</h1><br/>
	<div class="container d-flex justify-content-center">    
		<div class="text-center" style="width: 25rem;"> 
		<p>Para obtener acceso completo haga un deposito en la cuenta bancaria XXXXXXXXXX con su nombre y numero de identificacion, especificando el curso al que desea acceder.</p>
		<p>Tambien puede realizar el pago mediante tarjeta de credito haciendo click <a href="#">aqui</a></p>
		</div>
	</div>
<?php } ?>
<script type="text/javascript">
	$(document).ready(function() {
	// show the alert
		setTimeout(function() {
			$(".alert").alert('close');
		}, 2000);
	});
</script>   