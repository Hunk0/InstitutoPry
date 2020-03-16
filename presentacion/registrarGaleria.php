<?php
    include 'presentacion/administrador/mnuAdministrador.php';
    echo "Llego: ".$_SESSION['nombre']." / ".$_SESSION['descripccion']." / ".$_SESSION['fecha']." / ".$_SESSION['director'];
    
    if (isset($_POST["registrar"])) { 
    
        $curso = new Curso();
        $curso -> ultimoId();
        $id = $curso->getId()+1;
    
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
    }else{
        print "<script>window.setTimeout(function() { window.location = 'index.php?pid=" . base64_encode("presentacion/consultarCurso.php")."' }, 200);</script>";
    }
?>