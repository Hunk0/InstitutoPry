<?php
include 'presentacion/administrador/mnuAdministrador.php';

$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();

$sede = new Sede();
$sedes = $sede->consultarTodas();

$analisis[] = array();
foreach ($sedes as $s) {								
    $analisis+= array($s->getNombre() => $s->consultarMatriculas());				
}

?>
<br/><br/><br/><br/>
<div class="container">
	<div class="row">
        <div class="col-md-auto">
            <h1 class="display-4">Lista de sedes</h1>
            <?php echo "<tr><td colspan='9'> registros encontrados</td></tr>" ?>
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
								<th scope="col">Direccion</th>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php                        
							foreach ($sedes as $s) {								
                                echo "<tr>";
                                echo "<td>".$s->getNombre()."</td>";
                                echo "<td>".$s->getDireccion()."</td>";
                                echo "<td> </td>";//servicios
                                echo "</tr>";								
							}						
                        ?>
                        <td colspan="3" style="text-align: center;"> 
							<a class="navbar-brand"  href='index.php?pid=<?php echo base64_encode("presentacion/administrador/registrarSede.php")?>'>
								<i class="fas fa-plus-circle"></i>
								<br>
								<small>Agregar Sede</small>								
							</a>
						</td>
						</tbody>
					</table>					
				</div>
			</div>
		</div>
	</div>
</div>