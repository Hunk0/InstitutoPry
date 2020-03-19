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

if(isset($_GET["idMateria"])){
      $materia = new Materia($_GET["idMateria"]);
      $materia -> consultar();

      $curso = new Curso($materia->getCursoId());
      $curso -> consultar();

      $variantes = $curso -> consultarVariantes();

      $matriculas = array();
      foreach($variantes as $v){
        $matriculas += $v->consultarMatriculas();
      }

      $estudiantes = array();
      for($i=0; $i<count($matriculas) ; $i++){
          $nota = new Nota("", $materia->getId(), $matriculas[$i]->getEstudianteId(), 0);
          $nota -> registrar();
          $estudiantes[$i] = new Estudiante($matriculas[$i]->getEstudianteId());
          $estudiantes[$i] -> consultar();
      }

      echo '<table class="table table-bordered table-hover">';
      echo '<thead>';
      echo  '<tr>';
      echo      '<th>#</th>';
      echo      '<th>Nombre</th>';
                if(count($estudiantes)>0){
                  $notas = $estudiantes[0]->consultarNotas($materia->getId());
                }                
                for($i=0;$i<count($notas);$i++){
                  echo '<th> Nota '.($i+1).'</th>';
                }
      echo      '<th>Nota promedio</th>';          
      echo      '</tr>';
      echo  '</thead>';          
      echo  '<tbody>';
      echo   '<tr>';
                foreach ($estudiantes as $e){
                  echo '<tr>';
                  echo '<th scope="row">'.$e->getId().'</th>';
                  echo '<th>'.$e->getNombres().' '.$e->getApellidos().'</th>';
                  $notas = $e->consultarNotas($materia->getId());
                  $i=0;
                  foreach($notas as $n){
                    $i+=$n->getNota();
                    echo '<td class="text-center"> <span class="text">'.$n->getNota().'</span><a href="#" id="'.$n->getId().'" class="fas fa-pencil-alt edit" style="display: none;"></span></td>';
                    //echo '<td>'.$n->getNota().'</td>';
                  }
                  echo '<td id="NP'.$e->getId().'" class="text-center">'. ((count($notas)>0)?($i/(count($notas))):"N/A") .'</td>';
                  echo '</tr>';
                }
      echo   '</tr>';
      echo  '</tbody>';
      echo '</table>';
}

if(isset($_GET["idNota"])){
    $nota = new Nota($_GET["idNota"], "", "", $_GET["valor"]);
    $nota -> actualizar();
    $nota -> consultar();

    $estudiante = new Estudiante($nota->getEstudianteId());
    $estudiante -> consultar();

    $materia = new Materia($nota->getMateriaId());
    $materia -> consultar();

    $notas = $estudiante->consultarNotas($materia->getId());
    $i=0;
    foreach($notas as $n){
        $i+=$n->getNota();
    }
    echo $i/(count($notas));
}
?>
