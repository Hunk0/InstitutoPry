<?php
if(isset($_GET["idMatr"])){
    $id=$_GET["idMatr"];
    if(isset($_GET["estado"])){
        $estadocod=$_GET["estado"];
        $matricula = new Matricula($id, "", "", $estadocod);
        //($estudianteid, $cursoid, "", $estadocod);
        $matricula -> actualizarEstado();
        $matricula->consultar();
        $v = $matricula->getVariante();
        $curso = $v->consultarCurso();

        if ($matricula->getEstadoId() == 0){
            echo "<span style='padding: .0.1rem 0.1rem; color : #343a40 !important;' class='fas fa-book' data-toggle='tooltip' class='tooltipLink' data-placement='top' data-original-title='".$curso->getNombre()." (".$matricula->getEstado().")"."'></span>";
        }else if ($matricula->getEstadoId() == 1){
            echo "<span style='padding: .0.1rem 0.1rem; color : #28a745 !important;' class='fas fa-book' data-toggle='tooltip' class='tooltipLink' data-placement='top' data-original-title='".$curso->getNombre()." (".$matricula->getEstado().")"."'></span>";
        }
    }
}

if(isset($_GET["idVariante"])){
    $variante = new Variante($_GET["idVariante"]);
    $variante -> consultar();

    echo "Precio: $".$variante->getCosto();
}

if(isset($_GET["sedes"])){
    $sede = new Sede();
    $sedes = $sede->consultarTodas();

    echo '<br/>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Sedes:</label>
            <select name="sedes[]" required="required" multiple class="form-control" id="exampleFormControlSelect2">';
    foreach($sedes as $s){
        echo '<option value="'.$s->getId().'" >'.$s->getNombre().'</option>';
    }            
    echo   '</select>
        </div>';
}
?>
