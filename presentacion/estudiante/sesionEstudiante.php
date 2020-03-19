<?php
    include 'presentacion/estudiante/mnuEstudiante.php';
    $matriculas = $estudiante->consultarMatriculas();
?>
<br/><br/><br/><br/>
<div class="container">
    <h1 class="display-1 text-center">Bienvenido</h1>
    <?php
        if(isset($_GET["new"])){
            echo '<p class="col-8 mx-auto  text-center">Esta es tu plataforma virtual, puedes empezar subiendo una foto para que los demas puedan reconocerte.</p>';
        }
    ?>
    <p class="col-8 mx-auto  text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
    <br id="Cursos"/><br/>
    <hr>
    <h1>Mis Cursos</h1>
    <br/>

    <div class="row row-cols-1 row-cols-md-3 ">
    <?php 
        foreach ($matriculas as $m){
            $v = $m->getVariante();
            $c = $v->consultarCurso();
            
            if ($m->getEstadoId() == 1){
                echo   '<div class="col mb-4 ">
                            <a  href="index.php?pid='.base64_encode("presentacion/estudiante/misMaterias.php").'&idCurso='.$c->getId().'" class="list-group-item-action">
                                <div class="card h-100 mx-auto border-success list-group-item-action" style="width: 18rem;">                                        
                                        <img src="https://s03.s3c.es/imag/_v0/770x420/a/0/9/Pila-de-libros.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">'.$c->getNombre().'</h5>
                                            <p class="card-text">'.$c->getDescripccion().'</p>
                                        </div>                                        
                                        <p class="card-text text-center"><small class="text-success">Pago Aceptado</small></p>
                                </div>
                            </a>
                        </div>';
            }else if ($m->getEstadoId() == 0){
                echo   '<div class="col mb-4 ">
                            <a  href="index.php?pid='.base64_encode("presentacion/estudiante/misMaterias.php").'&idCurso='.$c->getId().'" class="list-group-item-action">
                                <div class="card h-100 mx-auto border-secondary list-group-item-action" style="width: 18rem;">                                        
                                        <img src="https://concepto.de/wp-content/uploads/2013/08/geometria-e1551991013554.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">'.$c->getNombre().'</h5>
                                            <p class="card-text">'.$c->getDescripccion().'</p>
                                        </div>                                        
                                        <p class="card-text text-center"><small class="text-secondary">Esperando pago</small></p>
                                </div>
                            </a>
                        </div>';
            }											
        }
    ?>
    </div>

</div>