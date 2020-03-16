<?php
include 'presentacion/administrador/mnuAdministrador.php';

$modalidad = new Modalidad();
$modalidades = $modalidad->consultarTodos();

$profesor = new Profesor();
$profesores = $profesor->consultarTodos();

$error="";

if (isset($_POST["registrar"])) { 
    $nombre = $_POST["nombre"];
    $descripccion = nl2br(htmlentities($_POST["descripccion"], ENT_QUOTES, 'UTF-8'));
    $fechacierre = $_POST["fecha"];
    $director = $_POST["director"];

    //echo "Llego: ".$nombre." / ".$descripccion." / ".$fechacierre." / ".$director."<br/>";

    $variante;
    $i=0;
    foreach($modalidades as $m){
        if(isset($_POST["modalidad".$m->getId()])){
            if($_POST["modalidad".$m->getId()]){
                $i++;
                //echo $_POST["costo".$m->getId()];
                $costo = $_POST["costo".$m->getId()];
                //$variante = new Variante("", $id, $m->getId(), $costo);
                //$variante -> registrar();
                //echo $_POST["modalidad".$m->getId()]." / ".$costo."<br/>";
            }
        }        
    }

    $sedes;
    if($i!=0){
        if(isset($_POST["sedes"])){
            $options = implode(',', $_POST['sedes']);
            $sedes = explode(",", $options);
        }
    }else{
        $error="No se ha seleccionado ninguna modalidad!";
    }

    if($error==""){
        $curso=new Curso("", $nombre, $descripccion, $fechacierre, $director);
        $curso -> registrar();
        $curso -> ultimoId();
        $id = $curso->getId();
        $variante = new Variante();
        foreach($modalidades as $m){
            if(isset($_POST["modalidad".$m->getId()])){
                if($_POST["modalidad".$m->getId()]){
                    $costo = $_POST["costo".$m->getId()];
                    $variante = new Variante("", $id, $m->getId(), $costo);
                    $variante -> registrar();
                    $variante -> ultimoId();
                    $vid = $variante -> getId();
                    $variante = new Variante($vid);
                    $variante -> consultar();

                    foreach($sedes as $s){
                        $variante -> InsertarSede($s);
                    }

                }
            }        
        }
        print "<script>window.setTimeout(function() { window.location = 'index.php?pid=" . base64_encode("presentacion/consultarCurso.php")."&Success=1' }, 200);</script>";
    }
}

?>
<br/><br/><br/><br/><br/><h1 class="d-flex justify-content-center">Agregar Curso</h1><br/>
<div class="container d-flex justify-content-center">    
    <div  style="width: 25rem;"> 
        <hr><br/>
        <form class="needs-validation" novalidate action=<?php echo "index.php?pid=" . base64_encode("presentacion/registrarCurso.php") ?> method="post">
            
            <div class="accordion" id="registro">
                <div class="card">
                    <div class="card-header text-white bg-primary" id="InfoBasica">
                        <h6 class="mb-0">
                            1.Informacion Basica
                        </h6>
                    </div>
                    <div id="curso" class="collapse show" aria-labelledby="InfoBasica" data-parent="#registro">
                        <div class="card-body">
                            
                                <div class="form-group">
                                    <label for="desc">Nombre:</label>
                                    <input type="text" name="nombre" class="form-control" required="required">
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
                                        foreach($profesores as $p){
                                            //echo "<option data-tokens='".$p->getNombres()." ".$p->getApellidos()."'>".$p->getNombres()." ".$p->getApellidos()."</option>";
                                            echo "<option value='".$p->getId()."'>".$p->getNombres()." ".$p->getApellidos()."</option>"; 
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="container text-right">
                                    <br/>
                                    <button type="button" class="btn btn-primary"  onclick="Next('modalidades', '#modalidad')">Siguiente</button>
                                </div>                                 
                            
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="modalidades">
                    <h6 class="mb-0">
                        2.Modalidades y sedes
                    </h6>
                    </div>
                    <div id="modalidad" class="collapse" aria-labelledby="modalidades" data-parent="#registro">
                    <div class="card-body">
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

                        <div id="sedes">
                            
                        </div>

                        <div class="container text-right">
                            <br/>
                            <button type="button" class="btn btn-secondary" onclick="Next('InfoBasica', '#curso')">Atras</button>
                            <button type="button" class="btn btn-primary" onclick="Next('fin', '#imagenes')" >Siguiente</button>
                        </div>
                    </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header" id="fin">
                    <h6 class="mb-0">
                        3.Finalizar
                    </h6>
                    </div>
                    <div id="imagenes" class="collapse" aria-labelledby="fin" data-parent="#registro">
                    <div class="card-body">
                        <div id="err">
                            
                        </div>
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        <div class="form-group">                            
                        </div>
                        <div class="container text-right">
                            <br/>
                            <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#modalidad" aria-expanded="false" aria-controls="modalidad" >Atras</button>
                            <button type="submit" name="registrar" class="btn btn-success" >Registrar Curso</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        
        </form>
    </div>
</div>

<script type="text/javascript">
    function Next(cabeza, contenido){
        $(contenido).collapse('show');  
        $(contenido).on('shown.bs.collapse', function () {
            document.getElementById('InfoBasica').className = "card-header"; 
            document.getElementById('modalidades').className = "card-header"; 
            document.getElementById('fin').className = "card-header"; 
            if(cabeza=='fin'){
                document.getElementById(cabeza).className = "card-header text-white bg-success"; 
            }else{
                document.getElementById(cabeza).className = "card-header text-white bg-primary"; 
            }            
        })              
    }
</script>

<script>
(function() {
    'use strict';
    window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
    if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
        document.getElementById('err').innerHTML = '<div id="alert" class="alert alert-danger alert-dismissible fade show" role ="alert">'
							                        +'Woops, parece que hay datos invalidos!'
							                        +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
							                        +'<span aria-hidden="true">&times;</span>'
							                        +'</button>'
						                            +'</div>';
    }
    form.classList.add('was-validated');
    }, false);
    });
    }, false);
    })();
</script>

<script type="text/javascript">  
    <?php foreach($modalidades as $m){ ?>
     $('#modalidad<?php echo $m->getId()?>').on('change.bootstrapSwitch', function (e, state) {
        console.log(e.target.checked); 
        if (e.target.checked == true) {
            document.getElementById("costo<?php echo $m->getId()?>").innerHTML = '<input required="required" type="text" name="costo<?php echo $m->getId()?>" class="form-control" placeholder="Costo"><br/>';
            if(<?php echo $m->getPrivilegio()?>=='0'){
                console.log("ss");
                var sedes=1;
                <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&sedes=\"+sedes ;\n"; ?>
                $('#sedes').load(ruta);
            }
        }else{
            document.getElementById("costo<?php echo $m->getId()?>").innerHTML = "";
            if(<?php echo $m->getPrivilegio()?>=='0'){
                document.getElementById("sedes").innerHTML = "";
            }
        }
    });
    <?php }?>
</script>
