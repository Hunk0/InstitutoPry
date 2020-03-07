<?php
// require 'logica/Persona.php';
// require 'logica/Administrador.php';
include 'presentacion/mnuVisitante.php';
$correo = $_POST["correo"];
$clave = $_POST["clave"];
/*
$administrador = new Administrador("", "", "", $correo, $clave);
if($administrador -> autenticar()){
    $_SESSION['id'] = $administrador -> getId();    
    header("Location: index.php?pid=" . base64_encode("presentacion/sesionAdministrador.php"));
}*/
$error=0;
$administrador = new Administrador("", "", "", $correo, $clave);
  //$profesor = new Profesor("", "" , $corro, $clave);
  $estudiante = new Estudiante("", "", "" ,$correo, $clave, "", "", "", "");
    if($administrador -> autenticar()){
        $_SESSION['id'] = $administrador -> getId();
        $_SESSION['rol'] = "admin";
        $pid= base64_encode("presentacion/administrador/sesionAdministrador.php");
        header('Location: index.php?pid=' . $pid);
    }
   /* else if( $profesor -> autenticar()){    
        $_SESSION['id'] = $profesor -> getId();
        $pid= base64_encode("presentacion/profesor/sesionProfesor.php");
        header('Location: index.php?pid=' . $pid);
    }*/
    else if($estudiante -> autenticar()){
        $_SESSION['id'] = $estudiante -> getId();
        $_SESSION['rol'] = "estudiante";
        $pid= base64_encode("presentacion/estudiante/sesionEstudiante.php");
        header('Location: index.php?pid=' . $pid);
    }else{      
        $error=1;
    }

?>
<br/><br/><br/><br/>
<div class="container">
    <div class="row mx-md-n5">
        <div class="col-3 container">
            <img class="foto" src="https://pngimage.net/wp-content/uploads/2018/06/imagenes-de-libros-png-6.png"  style="width: 300px "/>
        </div>
        <div class="col-5 container">
            <?php
                if($error==1){
                    echo '<div class="alert alert-danger" role="alert">
                            Correo o contraseña invalidos, intenta de nuevo!
                        </div>';
                }
            ?>
            <br/>
            <h1>Iniciar Sesion</h1>
            
            <form method="post" action="index.php?pid=<?php echo base64_encode("presentacion/autenticar.php") ?>">
                <div class="modal-body mx-auto">
                        <div class="form-group">
                        <input type="email" name="correo" class="form-control" placeholder="Correo*" required="required">
                        </div>
                        <div class="form-group">
                        <input type="password" name="clave" class="form-control" placeholder="Clave*" required="required">
                        </div>

                        <button name="autenticar" type="submit" class="btn btn-primary  btn-block" >Autenticar</button>
                        
                </div>        
            </form>

            <div class="container" style="text-align: center;">
            <a href="#">Olvidaste tu contraseña?</a>
            <br/>
            <br/>
            <h>No tienes una cuenta? </h><a href=<?php echo "index.php?pid=" . base64_encode("presentacion/registro.php")?> >Registrate</a>
            </div>
        </div>
    </div>
</div>