<?php
$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();
include 'presentacion/administrador/mnuAdministrador.php';

$nombre = "";
$apellido = "";
$cedula = "";
$correo = "";
$clave = "";
if (isset($_POST["registrar"])) { 
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $cedula = $_POST["cedula"];
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];

    $profesor = new Profesor ("", $nombre, $apellido, $correo, $clave, $cedula);
    if(!$profesor -> existeCorreo()){
        $profesor -> registrar();
        $mensaje="Docente registrado con exito";

        print "<script>window.setTimeout(function() { window.location = 'index.php?pid=" . base64_encode("presentacion/profesor/consultarProfesor.php")."&Success' }, 200);</script>";
                  
    }else{
        $mensaje="Este correo electronico ya existe!";

        echo '<div id="alert" class="fixed-top alert alert-danger alert-dismissible fade show" role ="alert" style=" position: absolute;">
                '.$mensaje.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
          </div>'; 
    }
}
?>
<br/><br/><br/><br/><br/><h1 class="d-flex justify-content-center">Agregar Docente</h1><br/>

<div class="container d-flex justify-content-center">    
    <div  style="width: 25rem;">  
    <hr><br/>
            <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/profesor/registrarProfesor.php") ?> method="post">
                <div class="form-group">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre(*)" required="required" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="apellido" class="form-control" placeholder="Apellido(*)" required="required" value="<?php echo $apellido; ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="cedula" class="form-control" placeholder="Cedula"  onkeypress="return isNumberKey(event)" value="<?php echo $cedula; ?>">
                </div>
                <div class="form-group">
                    <input type="email" name="correo" class="form-control" placeholder="Correo(*)" required="required" value="<?php echo $correo; ?>">
                </div>
                <div class="form-group">
                    <input type="password" name="clave" class="form-control" placeholder="Clave(*)" required="required" >
                </div>        
                <button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
            </form>
    </div>    
</div>

<script>
		function isNumberKey(evt)
			{
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode != 47 && charCode > 31 
				&& (charCode < 48 || charCode > 57))
				return false;
				return true;
			}  
	</script>
