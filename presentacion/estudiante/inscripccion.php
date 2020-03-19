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
        //$matricula -> addSede($_POST["sede"]);  
        print "<script>window.setTimeout(function() { window.location = 'index.php?pid=" . base64_encode("presentacion/estudiante/sesionEstudiante.php")."&Add=1' }, 100);</script>";     
    } 
?>

<?php 
if($modalidad->getPrivilegio()==0 || $modalidad->getPrivilegio()==3){ ?>
    <br/><br/><br/><br/><br/>
    <div class="container">
        <div class="row">
            <div class="col">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7954.267231915113!2d-74.11152315523941!3d4.570001831407756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f98c1601e6d2d%3A0xe80ab4fdd4c8122f!2sRafael%20Uribe%20Uribe%2C%20Bogot%C3%A1!5e0!3m2!1ses-419!2sco!4v1584620639150!5m2!1ses-419!2sco" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="col">
                <br/><br/><br/><br/>
                <h1 class="display-4">Seleccionar sede:</h1><br/>
                <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/estudiante/inscripccion.php") ?> method="post">
                    <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <select class="custom-select" name="sede" id="slcModalidad" required>
                                <?php 
                                $sedes = $variante -> consultarSedes();
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