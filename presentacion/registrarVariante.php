<?php
include 'presentacion/administrador/mnuAdministrador.php';
$modalidad = new Modalidad();
$modalidades = $modalidad->consultarTodos();


if (isset($_POST["registrar"])) { 
    $_SESSION['nombre'] = $_POST["nombre"];
    $_SESSION['descripccion'] = nl2br(htmlentities($_POST["descripccion"], ENT_QUOTES, 'UTF-8'));
    $_SESSION['fecha'] = $_POST["fecha"];
    $_SESSION['director'] = $_POST["director"];

    $curso = new Curso();
    $curso -> ultimoId();
    $id = $curso->getId()+1;

    echo "Llego: ".$_SESSION['nombre']." / ".$_SESSION['descripccion']." / ".$_SESSION['fecha']." / ".$_SESSION['director'];
/*
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
    }*/
}else{
    print "<script>window.setTimeout(function() { window.location = 'index.php?pid=" . base64_encode("presentacion/consultarCurso.php")."' }, 200);</script>";
}
?>
<br/><br/><br/><br/><br/><h1 class="d-flex justify-content-center">Seleccionar Modalidades</h1><br/>
<div class="container d-flex justify-content-center">    
    <div  style="width: 25rem;">  
        <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/registrarGaleria.php") ?> method="post">
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
            <button type="submit" name="registrar" class="btn btn-primary">Continuar</button>
        </form>
    </div>
</div>



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