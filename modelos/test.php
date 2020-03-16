<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Datos de curso
                        </button>
                        onclick="Next('modalidades', '#modalidad')"

                        

                        <form>
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
                                        $profesor = new Profesor();
                                        $profesores = $profesor->consultarTodos();

                                        foreach($profesores as $p){
                                            //echo "<option data-tokens='".$p->getNombres()." ".$p->getApellidos()."'>".$p->getNombres()." ".$p->getApellidos()."</option>";
                                            echo "<option value='".$p->getId()."'>".$p->getNombres()." ".$p->getApellidos()."</option>"; 
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="container text-right">
                                    <br/>
                                    <button type="button" type="submit" name="s" class="btn btn-primary" data-toggle="collapse" data-target="#modalidad" aria-expanded="false" aria-controls="modalidad" >Siguiente</button>
                                </div> 
                            </form>




<div class="container d-flex justify-content-center">    
    <div  style="width: 25rem;">  
    <hr><br/>
            <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/registrarVariante.php") ?> method="post">
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
                <button type="submit" name="registrar" class="btn btn-primary">Continuar</button>
            </form>
    </div>    
</div>
<?php /*
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/bootstrap-select.min.js"></script>
*/?>
