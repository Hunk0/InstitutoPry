<?php
    if(isset($_GET["idPublicacion"])){
        $publicacion = new Publicacion($_GET["idPublicacion"]);
        $publicacion -> consultar();
    }
    $mensaje="";
    if($_SESSION['rol']=="estudiante"){
        include 'presentacion/estudiante/mnuEstudiante.php';
        if(isset($_POST["publicar"])){
            $nombrearchivo = round(microtime(true) * 1000); 
            $path = $_FILES['material']['name'];   
            $tipoarchivo = $_FILES['material']['type'];
            $tamarchivo = $_FILES['material']['size'];   
            $ext = pathinfo($path, PATHINFO_EXTENSION);   
            if ($tamarchivo <= 300000) {    
                if (strlen($nombrearchivo) <= 45) {
                    // ruta de la carpeta destino en el servidor
                    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/InstitutoPry/archivos/';
                    // movemos la imagen de la carpeta temporal al directorio escogido
                    
                    move_uploaded_file($_FILES['material']['tmp_name'], $carpeta_destino . $nombrearchivo.".".$ext); 
                    $entrega = new Entrega("", $nombrearchivo.".".$ext, $_SESSION["id"], $_GET["idPublicacion"]);
                    $entrega -> registrar();
                    
      
                    //$pelicula = new Pelicula("", $titulo, $sinopsis,  $nombrearchivo, (int)$_POST["director"], (int)$_POST["genero"]);
                    //$pelicula->registrar();    
                    //header('location: index.php?pid='.base64_encode("presentacion/pelicula/consultarPelicula.php"));              
                } else {
                    $mensaje = "El nombre de de la
                    foto es muy largo.";
                }
            } else {
                $mensaje = "El tamano de el archivo es muy grande.";
            }
        }
    }      
    if($_SESSION['rol']=="profesor"){
        include 'presentacion/profesor/mnuProfesor.php';
    }
    $entregas = $publicacion -> consultarEntregas();
?>
<br/><br/><br/>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">				
				<div class="card-body">
					<div class="row">
						<div class="col-md-auto">
							<h1 class="display-4">Detalles de entrega...</h1>
							<?php echo "<tr><td colspan='9'> </td></tr>" ?>
						</div>
						<div class="col">
                        <?php
                            /*
							if(isset($_POST["publicar"]) && $mensaje==""){
								echo '<div class="align-items-center" style="height:100px; display: grid;">
										<div id="alert" class="alert alert-success alert-dismissible fade show" role ="alert" >
											Se ha publicado una nueva actividad!
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										</div>';
							}*/
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
    <div class="col">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $publicacion->getNombre()?></h5>
                <p class="card-text"><?php echo $publicacion->getDescripccion()?></p>
                <?php
                    if($publicacion->getArchivo()!=""){
                        echo '<a href="archivos/'.$publicacion->getArchivo().'" class="btn btn-primary">Abrir documento anexo</a>';
                    }
                ?>                
            </div>
        </div>
    </div>
    <div class="col">
      <?php        if($_SESSION["rol"]=="estudiante" && $publicacion->getEntrega()==1 ){      ?>
        <div class="card">
            <div class="card-header text-right">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Hacer entrega
                </button>
            </div>
                <div class="collapse" id="collapseExample">
                    <br/>
                    <div class="card mx-auto" style="width: 80%">
                    <div class="card card-body">
                        <?php 
                            $verificar=0;
                            foreach($entregas as $e){
                                if(($_SESSION["id"])==$e->getEstudianteId()){
                                    $verificar=1;
                                }
                            }
                            if($verificar==0){
                        ?>
                        <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/detallesEntrega.php")."&idPublicacion=".$_GET["idPublicacion"]?> method="post" enctype="multipart/form-data">   
                            <h1>Subir trabajo:</h1> 
                            <p class="mx-auto  text-center">Tenga en cuenta que solo podra realizar una entrega de este trabajo</p>
                            <div class="form-group">
                            <div class="custom-file">
                                <label for="desc">Material:</label>
                                <input type="file" name="material" required="true" class="custom-file-input" id="customFileLang" lang="es">
                                <label class="custom-file-label" for="customFileLang" data-browse="Elegir">Seleccionar Archivo</label>
                            </div>
                            </div>
                            <div class="form-group text-center">
                                <br/>
                                <button type="submit" name="publicar" class="btn btn-primary">Publicar</button>
                            </div>
                            
                            
                        </form>
                        <?php }else{
                            echo '<h1>Subir trabajo:</h1> 
                                <p class="mx-auto  text-center">Usted ya ha realizado la entrega de este trabajo</p>';
                        } ?>                        
                    </div>
                    </div>
                </div>
                <br/>
            </div>        
      <?php } ?>
      <?php  if($_SESSION["rol"]=="profesor" && $publicacion->getEntrega()==1){ ?>
        <div class="card">
            <div class="card card-body">
            <h1>Entregas recibidas:</h1> 
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Estudiante</th>
                    <th scope="col">Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($entregas as $e){
                            echo '<tr>';
                            $estudiante = new Estudiante($e->getEstudianteId());
                            $estudiante -> consultar();
                            echo '<td>'.$estudiante->getNombres().' '.$estudiante->getApellidos().'</td>';
                            echo '<td><a href="archivos/'.$e->getArchivo().'">Ver Archivo</a></td>';
                            echo '</tr>';
                        }
                        $materia = new Materia($publicacion->getMateriaId());
                        $materia -> consultar();

                        $curso = new Curso($materia->getCursoId());
                        $curso -> consultar();

                        $variantes = $curso->consultarVariantes();
                        $cantidad = 0;
                        foreach($variantes as $v){
                            $modalidad = new Modalidad($v->getModalidadId());
                            $modalidad -> consultar();
                            if($modalidad->getPrivilegio()>0){
                                $matriculas = $v -> consultarMatriculas();
                                $cantidad += count($matriculas);
                            } 
                        }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
        <br/>
        <div class="card">
            <div class="card card-body">
                <h1>Analisis de entregas</h1>
                <div id="analisis">

                </div>
                <script>new Chartkick.PieChart("analisis", [["Recibidas", <?php echo count($entregas)?>], ["Faltantes", <?php echo ($cantidad-count($entregas))?>]], {donut: true})</script>
            </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<script type="application/javascript">
    $(document).on('change', '.custom-file-input', function (event) {
        $(this).next('.custom-file-label').html(event.target.files[0].name);
    })
</script>