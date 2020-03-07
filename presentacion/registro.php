<?php 
// require 'logica/Persona.php';
// require 'logica/Paciente.php';
include 'presentacion/mnuVisitante.php';

$error = -1;
$nombre = "";
$apellido = "";
$correo = "";
$clave = "";
$cedula = "";
$telefono = "";
$direccion = "";

if(isset($_POST["registrar"])){
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
	$cedula = $_POST["cedula"]; 
	$telefono = $_POST["telefono"];
	$direccion = $_POST["direccion"]; 

    $estudiante = new Estudiante("", $nombre, $apellido ,$correo, $clave, $cedula, $telefono, $direccion, "");
    if(!$estudiante -> existeCorreo()){
        $estudiante -> registrar();
        $error = 0;
    }else{
        $error = 1;
	}
}
?>
	<br/><br/><br/>
	<div class="container col-8">
		<h1>Registro</h1>
		<hr>
		<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/registro.php") ?> method="post">
			<div class="form-row">

				<div class="col-md-4 mb-3">
					<label for="validationCustom01">Nombre(*)</label>
					<input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>" required>
					<div class="valid-feedback">
						Suena bien!
					</div>
				</div>
				<div class="col-md-4 mb-3">
					<label for="validationCustom01">Apellido(*)</label>
					<input type="text" class="form-control" name="apellido" value="<?php echo $apellido; ?>" required>
					<div class="valid-feedback">
						Suena bien!
					</div>
				</div>
				<div class="col-md-4 mb-3">
					<label for="validationCustom01">Numero de identificacion(*)</label>
					<input type="text"  class="form-control" name="cedula" value="<?php echo $cedula; ?>"  onkeypress="return isNumberKey(event)" required>
					<div class="valid-feedback">
						Suena bien!
					</div>					
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputEmail4">Correo(*)</label>
					<input type="email" class="form-control" name="correo" value="<?php echo $correo; ?>" required>
					<?php if($error==1){ ?>
						<div class="invalid-feedback d-block">
							Este correo ya ha sido registrado!
						</div>
					<?php } ?>
				</div>
				<div class="form-group col-md-6">
					<label for="inputPassword4">Contraseña(*)</label>
					<input type="password" class="form-control" name="clave" required>
				</div>
			</div>

			<div class="form-group">
				<label for="inputAddress">Direccion</label>
				<input type="text" class="form-control" name="direccion" placeholder="Calle 123." value="<?php echo $direccion; ?>">
			</div>
			<div class="form-group">
				<label for="inputAddress2">Telefono</label>
				<input type="text" class="form-control" name="telefono" placeholder="310XXXXXXX" onkeypress="return isNumberKey(event)" value="<?php echo $telefono; ?>">
			</div>
			
			<div class="form-group">
				<div class="form-check">
				<input class="form-check-input" type="checkbox" id="gridCheck" required>
				<label class="form-check-label" for="gridCheck">
					Acepto <a href="#" >terminos y condiciones</a>
				</label>
				</div>
			</div>
			<button type="submit" name="registrar" class="btn btn-primary">Registrarse</button>
		</form>
	</div>

	<script>
		function isNumberKey(evt)
			{
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode != 47 && charCode > 31 
				&& (charCode < 48 || charCode > 57))
				return false;
				return true;
			}  
	</script>
