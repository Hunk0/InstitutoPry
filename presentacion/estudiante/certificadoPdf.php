<?php
include('pdf/class.ezpdf.php');

if(isset($_GET["idVariante"])){  
    $variante = new Variante($_GET["idVariante"]);
    $variante -> consultar();

    $curso = new Curso($variante->getCurso());
    $curso -> consultar();

    $modalidad = $variante->getModalidad();

    $estudiante = new Estudiante($_SESSION["id"]);
    $estudiante -> consultar();

    $pdf = new Cezpdf(); 
    $pdf->addInfo('Title', 'Certificado');
    $pdf->ezSetCmMargins("2.5", "2.5", "3", "3");
    $pdf->selectFont('pdf/fonts/Arial.afm');
    //$pdf->ezSetY(100);
    //$pdf->ezSetDy(230);
    //$pdfku->addJpegFromFile("icon.jpg",20,300,-1);
    $pdf->ezText("\n\n\nInstituto UD\n\n\n\n\n\n", 13, array("justification" => "center"));
    $pdf->ezText("CERTIFICA\n\n\n\n", 13, array("justification" => "center"));
    $pdf->ezText("Que el estudiante ".$estudiante->getApellidos()." ".$estudiante->getNombres()." actualmente esta cursando el curso de ".$curso->getNombre()." en modalidad ".$modalidad->getNombre().", con una intencidad horaria de 10 horas semanales.", 12, array("justification" => 'full'));
    $pdf->ezText("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a anteLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.", 12, array("justification" => 'full'));
    //$pdf->ezText("Materia: ".$materia->getNombre()."", 15, array("justification" => "center"));
    //$profesor = new Profesor($materia->getProfesorId());
    //$profesor -> consultar();
    //$pdf->ezText("Docente: ".$profesor->getNombres()." ".$profesor->getApellidos()."\n", 15, array("justification" => "center"));
    //$pdf->ezTable($a, '', '', array('width' => 560));
    $pdf->ezText("\n\n\n\n\n\nFirmado digitalmente por:\n\n\n\n\n\n\n\n\n__________________________\nEl dueño :v\nC.C. 5454455\nTel:3145678102", 12);
    ob_end_clean();
    $pdf->ezStream();
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