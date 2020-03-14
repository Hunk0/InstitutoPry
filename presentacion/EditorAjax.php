<?php
if(isset($_GET["idCur"]) && isset($_GET["idEst"])){
    $cursoid=$_GET["idCur"]; 
    $estudianteid=$_GET["idEst"];
    $titulo=""; 
    $descripccion=""; 
    $pdf=""; 
    $estado=""; 
    $estadocod="";
    $tutor_idtutor=""; 
    $jurado_idjurado="";
    if(isset($_GET["estado"])){
        $estadocod=$_GET["estado"];
        $matricula = new Matricula($estudianteid, $cursoid, "", $estadocod);
        $matricula -> actualizarEstado();
        $matricula->consultar();
        $curso = $matricula->getCurso();

        if ($matricula->getEstadoId() == 0){
            echo "<span style='padding: .0.1rem 0.1rem; color : #343a40 !important;' class='fas fa-book' data-toggle='tooltip' class='tooltipLink' data-placement='top' data-original-title='".$curso->getNombre()." (".$matricula->getEstado().")"."'></span>";
        }else if ($matricula->getEstadoId() == 1){
            echo "<span style='padding: .0.1rem 0.1rem; color : #28a745 !important;' class='fas fa-book' data-toggle='tooltip' class='tooltipLink' data-placement='top' data-original-title='".$curso->getNombre()." (".$matricula->getEstado().")"."'></span>";
        }
    }
}
?>