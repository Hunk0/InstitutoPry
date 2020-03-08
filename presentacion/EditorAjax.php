<?php
if(isset($_GET["idCur"]) && isset($_GET["idEst"])){
    $id=$_GET["idCur"]; 
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
        $curso= new Curso($id,  "",  "",  "", "", "",  "", $estadocod);
        $curso->actualizarEstado($estudianteid);
        $curso->consultar();

        if ($curso->getEstadoId() == 0){
            echo "<span style='padding: .0.1rem 0.1rem; color : #343a40 !important;' class='fas fa-book' data-toggle='tooltip' class='tooltipLink' data-placement='top' data-original-title='".$curso->getNombre()." (".$curso->getEstado().")"."'></span>";
        }else if ($curso->getEstadoId() == 1){
            echo "<span style='padding: .0.1rem 0.1rem; color : #28a745 !important;' class='fas fa-book' data-toggle='tooltip' class='tooltipLink' data-placement='top' data-original-title='".$curso->getNombre()." (".$curso->getEstado().")"."'></span>";
        }
    }
}
?>