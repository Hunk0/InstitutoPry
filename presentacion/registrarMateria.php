<?php
include 'presentacion/administrador/mnuAdministrador.php';

if(isset($_GET["idCurso"])){

    $id="";
    $nombre="";
    $cursoid="";
    $profesorid="";

    if (isset($_POST["registrar"])) { 
        $nombre = $_POST["nombre"];
        $cursoid = $_GET["idCurso"];
        $profesorid = $_POST["profesor"];
        
        $materia = new Materia("", $nombre, $cursoid, $profesorid);
        $materia -> registrar();

        print "<script>window.setTimeout(function() { window.location = 'index.php?pid=" . base64_encode("presentacion/consultarMateria.php")."&idCurso=".$_GET["idCurso"]."&Success=1' }, 200);</script>";
    }
?>
<br/><br/><br/><br/><br/><h1 class="d-flex justify-content-center">Agregar Materia</h1><br/>

<div class="container d-flex justify-content-center">    
    <div  style="width: 25rem;">  
    <hr><br/>
            <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/registrarMateria.php")."&idCurso=".$_GET["idCurso"] ?> method="post">
                <div class="form-group">
                    <label for="desc">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required="required" value="<?php echo $nombre; ?>">
                </div>
                
                <div class="form-group">
                    <label for="slcDirector">Instructor:</label>
                    <select class="custom-select selectpicker form-control" name="profesor" required="required" data-live-search="true" id="slcDirector">
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
                <br/>
                <button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
            </form>
    </div>    
</div>

<?php 
}else{
?>
<br/><br/>
<h1 class="display-4" id="countdown" ></h1>
<script>
    var timeleft = 3;
    var downloadTimer = setInterval(function(){
    if(timeleft <= 0){
        clearInterval(downloadTimer);
        document.getElementById("countdown").innerHTML = "";
    } else {
        document.getElementById("countdown").innerHTML ="Se encontro un problema, regresando al sitio en " + timeleft + " segundos";
    }
    timeleft -= 1;
    }, 1000);
</script>
<?php    
    print "<script>window.setTimeout(function() { window.location = 'index.php?pid=" . base64_encode("presentacion/consultarCurso.php")."' }, 4000);</script>";
}?>
