<?php
include 'presentacion/administrador/mnuAdministrador.php';
$id="";
$nombre="";
$cursoid="";
$profesorid="";

if (isset($_POST["registrar"])) { 
    $nombre = $_POST["nombre"];
    $direccion = $_POST["dir"];
    $posx = $_POST["posx"];
    $posy = $_POST["posy"];
    
    $sede = new Sede("", $nombre, $direccion, $posx, $posy);
    $sede -> registrar();

    print "<script>window.setTimeout(function() { window.location = 'index.php?pid=" . base64_encode("presentacion/administrador/consultarSedes.php")."&idCurso=".$_GET["idCurso"]."&Success=1' }, 200);</script>";
}
?>
<br/><br/><br/><br/><br/><h1 class="d-flex justify-content-center">Agregar Sede</h1><br/>

<div class="container d-flex justify-content-center">    
    <div  style="width: 25rem;">  
    <hr><br/>
            <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/registrarSede.php")?> method="post">
                <div class="form-group">
                    <label for="desc">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required="required" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                    <label for="desc">Direccion:</label>
                    <input type="text" name="dir" class="form-control" required="required" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                    <label for="desc">Posicion en x:</label>
                    <input type="text" name="posx" class="form-control" required="required" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                    <label for="desc">Posicion en y:</label>
                    <input type="text" name="posy" class="form-control" required="required" value="<?php echo $nombre; ?>">
                </div>
                <br/>
                <button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
            </form>
    </div>    
</div>

