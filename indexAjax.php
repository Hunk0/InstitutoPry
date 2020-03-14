<script type="text/javascript">
$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<?php
require 'logica/Persona.php';
require 'logica/Administrador.php';
require 'logica/Profesor.php';
require 'logica/Estudiante.php';

require 'logica/Curso.php';
require 'logica/Modalidad.php';
require 'logica/Matricula.php';
$pid = base64_decode($_GET["pid"]);
include $pid;
?>