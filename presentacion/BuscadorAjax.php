<?php
if(isset($_GET['filtro'])){
    if($_GET['filtro']!=""){
        $curso = new Curso();
        $cursos = $curso->Buscar($_GET['filtro']);
    
        echo '<p>'.count($cursos).' registro encontrados</p>';
    
        foreach ($cursos as $c){
               echo '<br/>
                    <a href="index.php?pid='.base64_encode("presentacion/detallesCurso.php").'&idCur='.$c->getId().'" class="list-group-item-action">
                        <div class="row no-gutters list-group-item-action">
                            <div class="col-md-4">
                                <img src="https://concepto.de/wp-content/uploads/2013/08/geometria-e1551991013554.jpg" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">'.$c->getNombre().'</h5>
                                    <p class="card-text">'.$c->getDescripccion().'</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                        </div>
                    </a>';
        }
    }else{
        echo '<p>Para empezar realiza una busqueda</p>';
    }    
}
?>