<?php
include('pdf/class.ezpdf.php');

if(isset($_GET["idMateria"])){
    $materia = new Materia($_GET["idMateria"]);
    $materia -> consultar();

    $curso = new Curso($materia->getCursoId());
    $curso -> consultar();
    /*
    $variantes = $curso -> consultarVariantes();
    
    $matriculas = array();
    foreach($variantes as $v){
      $matriculas += $v->consultarMatriculas();
    }*/
    $matriculas = $curso->consultarMatriculas();
    $estudiantes = array();
    for($i=0; $i<count($matriculas) ; $i++){
        $variante = $matriculas[$i]->getVariante();
        $modalidad = $variante->getModalidad();
        if($modalidad->getPrivilegio()==0){
            $estudiantes[$i] = new Estudiante($matriculas[$i]->getEstudianteId());
            $estudiantes[$i] -> consultar();
        }
    }
    //$a = array("Nombre","Identificacion","Lunes","Martes","Miercoles","Jueves","Viernes");
    $a = array();
    $i=0;
    foreach($estudiantes as $e){
        $a[$i] = array("Nombre"=>($e->getNombres()." ".$e->getApellidos()),"Identificacion"=>$e->getCedula(),"Lunes"=>"","Martes"=>"","Miercoles"=>"","Jueves"=>"","Viernes"=>"");
        $i++;
    }

    for($j=$i; $j<50; $j++){
        $a[$j] = array("Nombre"=>"test","Identificacion"=>"test","Lunes"=>"","Martes"=>"","Miercoles"=>"","Jueves"=>"","Viernes"=>"");
    }
    
    $pdf = new Cezpdf('a5','landscape'); 
    $pdf->addInfo('Title', 'Lista Presencial');
    $pdf->ezSetCmMargins("1", "1", "1", "1");
    $pdf->selectFont('pdf/fonts/Helvetica.afm');
    //$pdf->ezSetY(100);
    //$pdf->ezSetDy(230);
    //$pdfku->addJpegFromFile("icon.jpg",20,300,-1);
    $pdf->ezText("LISTA DE ASISTENCIA PARA ESTUDIANTES PRESENCIALES", 18, array("justification" => "center"));
    $pdf->ezText("Materia: ".$materia->getNombre()."", 15, array("justification" => "center"));
    $profesor = new Profesor($materia->getProfesorId());
    $profesor -> consultar();
    $pdf->ezText("Docente: ".$profesor->getNombres()." ".$profesor->getApellidos()."\n", 15, array("justification" => "center"));
    $pdf->ezTable($a, '', '', array('width' => 560));
    ob_end_clean();
    $pdf->ezStream();
/*
    $pdf->ezSetMargins(1,1,1,1);
    $pdf->selectFont('pdf/fonts/Helvetica.afm');
    
    $pdf->ezStream();*/
     
}
/*
$a = array();
//$a[0] = array("id"=>"No.", "nombre"=>"Nombre", "apellido"=>"Apellido", "cedula"=>"Cedula", "telefono"=>"Tel", "direccion"=>"Direccion");

$i=0;
foreach($pacientes as $p){
    $a[$i] = array("id"=>"'".$p->getId()."'", "nombre"=>"'".$p->getNombre()."'", "apellido"=>"'".$p->getApellido()."'", "cedula"=>"'".$p->getCedula()."'", "telefono"=>"'".$p->getTelefono()."'", "direccion"=>"'".$p->getDireccion()."'");
    //array_push($a, "'".$p->getId()."'", "'".$p->getNombre()."'", "'".$p->getApellido()."'", "'".$p->getCedula()."'", "'".$p->getTelefono()."'", "'".$p->getDireccion()."'");
    $i++;
}

$pdf = new Cezpdf(); 
$pdf->selectFont('pdf/fonts/Helvetica.afm');
$pdf->ezTable($a);
$pdf->ezStream(); 
*/
?>