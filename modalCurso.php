<?php
   require_once 'logica/Persona.php'; // <--
   require_once 'logica/Administrador.php'; // <--
   require_once 'logica/Profesor.php'; // <--
   require_once 'logica/Estudiante.php'; // <--
   
   require_once 'logica/Curso.php';
   require_once 'logica/Imagen.php';
   require_once 'logica/Matricula.php';
   require_once 'logica/Modalidad.php';
   require_once 'logica/Variante.php';
   require_once 'logica/Materia.php';
   require_once 'logica/Sede.php';
   require_once 'logica/Nota.php';

    if(isset($_GET["idMatr"])){
        $matricula = new Matricula($_GET["idMatr"]);
        $matricula -> consultar();
        $v = $matricula->getVariante();
        $curso = $v->consultarCurso();
        $curso->consultar();
            //$estudiante = new Estudiante($_GET["idEst"]); 
            //$curso = $estudiante -> ConsultarCurso($_GET["idCur"]);
    }
?>


<div class="row justify-content-md-end">
    <div class="col col-lg-4">  
        <br/><br/><br/>
        <label data-toggle='tooltip' onclick="abrir()" data-placement='top' title='Ver materias de este curso' style="cursor: pointer;">
            <img class="foto" src="https://image.flaticon.com/icons/png/512/446/446813.png"  style="width: 240px "/>
        </label> 
    </div>

    <div class="col col-lg-8">
        <h1><?php echo $curso->getNombre();?></h1>
        <hr>
        <?php
        /*
            if(isset($_GET["idEst"])){       
                echo '<small class="text-muted">Modalidad: '.$matricula->getModalidad().'</small><br/>';
                echo '<small class="text-muted">Director: '.$curso->getDirector().'</small><br/>';
                echo '<small class="text-muted">Sede: '.$matricula->getModalidad().'</small><br/>';
            }*/
        ?>
        <br/><p class="mb-0"><?php echo $curso->getDescripccion()?></p><br/>        
        <div class="card text-center">
            <div class="card-header">
                Las inscripcciones se cierran el <?php echo $curso->getFecha()?>
            </div>        
        </div><br/><hr>
        <?php
            if($matricula->getEstadoId()==0){
                echo '<div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="estadoPago">
                            <div class="float-sm-right">
                                <a href="#" id="eliminar"' . $matricula->getId() . '" >
                                    <span class="fas fa-trash-alt" data-toggle="tooltip" class="tooltipLink" data-placement="top" data-original-title="Eliminar estudiante de este curso" style="color: #cc2121;"></span> 
                                </a>
                            </div>
                            <label class="custom-control-label" id="estado" for="estadoPago" >Esperando Pago</label>
                        </div>';
              }else if($matricula->getEstadoId()==1){
                echo '<div class="custom-control custom-switch">
                            <input type="checkbox" checked class="custom-control-input" id="estadoPago">
                            <div class="float-sm-right">
                                <a href="#" id="eliminar"' . $matricula->getId() . '" >
                                </a>
                            </div>
                            <label class="custom-control-label" id="estado" for="estadoPago" >Pago Aceptado</label>
                    </div>';                  
            }
        ?>  
             
</div>
    </div>
</div>


<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script type="text/javascript">
     var estado=<?php echo $matricula->getEstadoId()?>;
     
     $('#estadoPago').on('change.bootstrapSwitch', function (e, state) {
        console.log(e.target.checked);
        //alert(<?php echo $matricula->getId() ?>); 

        if (e.target.checked == true) {
            document.getElementById("estado").innerHTML = "Pago Aceptado";
            document.getElementById("eliminar").innerHTML = "";
            estado=estado+1;

            <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&idMatr=" . $matricula->getId() . "&estado=\"+estado ;\n"; ?>
            $(<?php echo '"#Curso'.$matricula->getId().'"'?>).load(ruta);
            
        } else {            
            document.getElementById("estado").innerHTML = "Esperando Pago";
            document.getElementById("eliminar").innerHTML = '<span class="fas fa-trash-alt" data-toggle="tooltip" class="tooltipLink" data-placement="top" data-original-title="Eliminar estudiante de este curso" style="color: #cc2121;"></span>';
            estado=estado-1;

            <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&idMatr=" . $matricula->getId() . "&estado=\"+estado ;\n"; ?>
            $(<?php echo '"#Curso'.$matricula->getId().'"'?>).load(ruta);
        }
    });
</script>