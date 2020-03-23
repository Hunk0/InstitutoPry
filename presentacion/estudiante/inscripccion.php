<?php
    include 'presentacion/estudiante/mnuEstudiante.php';

    echo $_SESSION["id"];

    $estudiante = new Estudiante($_SESSION["id"]);
    $estudiante -> consultar();    

    
    if (isset($_POST["registrar"])) {
        $_SESSION["temp"]=$_POST["variante"];        
    } 

    $variante = new Variante($_SESSION["temp"]);
    $variante -> consultar();
    $modalidad = $variante -> getModalidad();

    if (isset($_POST["registrarsede"])) {
        $matricula = new Matricula("", $estudiante->getId(), $variante->getId(),'0');
        $matricula -> registrar();
        $matricula->ultimoId();
        $id=$matricula->getId();
        $matricula = new Matricula($id);
        $matricula->consultar();
        $matricula -> InsertarSede($_POST["sede"]);
        //$matricula -> addSede($_POST["sede"]);  
        print "<script>window.setTimeout(function() { window.location = 'index.php?pid=" . base64_encode("presentacion/estudiante/sesionEstudiante.php")."&Add=1' }, 100);</script>";     
    } 
    $sedes = $variante -> consultarSedes();
?>

<?php 
if($modalidad->getPrivilegio()==0 || $modalidad->getPrivilegio()==3){ ?>
    <br/><br/><br/><br/><br/>
    <div class="container">
        <div class="row">
            <div class="col">
                <div id="map">
                    <iframe width="600" height="500" style="border:0;" data-toggle="tooltip" data-placement="bottom" 
                    title="Direccion: <?php echo $sedes[0]->getDireccion()?>" src="https://maps.google.com/maps?q=<?php echo $sedes[0]->getPosx(); ?>,<?php echo $sedes[0]->getPosy(); ?>&output=embed"></iframe>
                </div>                
            </div>
            <div class="col">
                <br/><br/><br/><br/>
                <h1 class="display-4">Seleccionar sede:</h1><br/>
                <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/estudiante/inscripccion.php") ?> method="post">
                    <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <select class="custom-select" name="sede" id="slcSede" required>
                                <?php                                 
                                foreach($sedes as $s){
                                echo "<option value='".$s->getId()."'>".$s->getNombre()."</option>";
                                } 
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <?php
                            if(isset($_SESSION["rol"])){
                            if($_SESSION["rol"]=="estudiante"){
                                echo '<button type="submit" name="registrarsede" class="btn btn-success" >Inscribirse</button>';
                            }
                            }else{
                            echo '<a type="button" href="#" class="btn btn-outline-success" role="button" aria-pressed="true">Inscribirse</a>';
                            }
                        ?>                  
                    </div> 
                    </div>
                </form>   
            </div>
        </div>
    </div>
<?php }else{
    $matricula = new Matricula("", $estudiante->getId(), $variante->getId(),'0');
    $matricula -> registrar();
    print "<script>window.setTimeout(function() { window.location = 'index.php?pid=" . base64_encode("presentacion/estudiante/sesionEstudiante.php")."&Add=1' }, 100);</script>";     
} ?>

<script>
   $('#slcSede').change(function () {
     console.log($(this).val());
     sede = $(this).val();
     <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&idMap=\"+sede ;\n"; ?>
     $("#map").load(ruta);
    });
</script>