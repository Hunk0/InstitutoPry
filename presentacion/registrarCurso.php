<?php
$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();
include 'presentacion/administrador/mnuAdministrador.php';

//datos de curso
$id = "";
$nombre = "";
$descripccion = "";
$fechacierre = "";
$director = "";

//datos de variante
$costo = "";

$modalidad = new Modalidad();
$modalidades = $modalidad->consultarTodos();

if (isset($_POST["registrar"])) { 
    $nombre = $_POST["nombre"];
    $descripccion = nl2br(htmlentities($_POST["descripccion"], ENT_QUOTES, 'UTF-8'));
    $fechacierre = $_POST["fecha"];
    $director = $_POST["director"];

    $curso = new Curso($id,  $nombre,  $descripccion,  $fechacierre, $director );
    $curso -> registrar();
    $curso -> ultimoId();
    $curso -> consultar();
    $id = $curso->getId();

    $variante;
    foreach($modalidades as $m){
        if(isset($_POST["modalidad".$m->getId()])){
            if($_POST["modalidad".$m->getId()]){
                //echo $_POST["costo".$m->getId()];
                $costo = $_POST["costo".$m->getId()];
                $variante = new Variante($id, $m->getId(), $costo);
                $variante -> registrar();
            }
        }        
    }
}
?>
<br/><br/><br/><br/><br/><h1 class="d-flex justify-content-center">Agregar Curso</h1><br/>

<div class="container d-flex justify-content-center">    
    <div  style="width: 25rem;">  
    <hr><br/>
            <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/registrarCurso.php") ?> method="post">
                <div class="form-group">
                    <label for="desc">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required="required" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                    <label for="desc">Descripccion:</label>
                    <textarea type="text" name="descripccion" class="form-control" id="desc" required="required" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="date-input" >Fecha de cierre:</label>
                    <input class="form-control" name="fecha" type="date" id="date-input" required="required">
                </div>
                <div class="form-group">
                    <label for="slcDirector">Director de curso:</label>
                    <select class="custom-select selectpicker form-control" name="director" required="required" data-live-search="true" id="slcDirector">
                    <option selected disabled value="">Elegir</option>
                    <?php
                        $profesor = new Profesor();
                        $profesores = $profesor->consultarTodos();

                        foreach($profesores as $p){
                            //echo "<option data-tokens='".$p->getNombres()." ".$p->getApellidos()."'>".$p->getNombres()." ".$p->getApellidos()."</option>";
                            echo "<option value='".$p->getId()."'>".$p->getNombres()." ".$p->getApellidos()."</option>"; 
                        }
                    ?>
                    </select>
                </div>

                <label for="date-input" >Modalidad:</label>
                <?php
                    foreach($modalidades as $m){
                        echo '<div class="custom-control custom-switch">
                                <input type="checkbox" class="form-check-input" id="modalidad'.$m->getId().'" name="modalidad'.$m->getId().'">
                                <label id="estado" for="modalidad" >'.$m->getNombre().'</label>
                                <div class="float-sm" id="costo'.$m->getId().'">
                                                                    
                                </div>
                            </div>';
                    }
                ?>

                <br/>
                <button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
            </form>
    </div>    
</div>
<?php /*
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/bootstrap-select.min.js"></script>
*/?>

<script type="text/javascript">  
    <?php foreach($modalidades as $m){ ?>
     $('#modalidad<?php echo $m->getId()?>').on('change.bootstrapSwitch', function (e, state) {
        console.log(e.target.checked); 
        if (e.target.checked == true) {
            document.getElementById("costo<?php echo $m->getId()?>").innerHTML = '<input type="text" name="costo<?php echo $m->getId()?>" class="form-control" placeholder="Costo"><br/>';
        }else{
            document.getElementById("costo<?php echo $m->getId()?>").innerHTML = "";
        }
    });
    <?php }?>
</script>


