<?php
    $id=0;
    if(isset($_SESSION["rol"])){  
        if($_SESSION["rol"]=="estudiante"){
            $id=$_SESSION["id"];
            if(isset($_POST["actualizarfoto"])){
                $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/InstitutoPry/img/';
                $nombrearchivo = round(microtime(true) * 1000); 
                $path = $_FILES['file']['name'];   
                $tipoarchivo = $_FILES['file']['type'];
                $tamarchivo = $_FILES['file']['size'];   
                $ext = pathinfo($path, PATHINFO_EXTENSION); 
                if ($tipoarchivo == "image/png" || $tipoarchivo == "image/jpeg" || $tipoarchivo == "image/jpg"){
                    // Upload file
                    $estudiante = new Estudiante($_SESSION["id"], "", "" ,"", "", "", "", "", $nombrearchivo.".".$ext);
                    $estudiante->actualizarFoto();
                    echo $estudiante->getFoto();
                    move_uploaded_file($_FILES['file']['tmp_name'],$carpeta_destino.$nombrearchivo.".".$ext); 
                    include 'presentacion/estudiante/mnuEstudiante.php';       
                }else{
                    $error="Parece que el archivo no es de tipo imagen";
                }              
            }else{
                include 'presentacion/estudiante/mnuEstudiante.php';
            }

            if(isset($_POST["actualizar"])){
                $estudiante = new Estudiante($_SESSION["id"], $_POST["nombre"], $_POST["apellido"] ,"", "", $_POST["cedula"], $_POST["telefono"], $_POST["direccion"], "");
                $estudiante->actualizar();
            }
        }
    }else{
        $id=$_GET["idEst"];
    }
    //$id=(isset($_GET["idEst"]))?$_GET["idEst"]:;
    $estudiante=new Estudiante($id);
    $estudiante->consultar();
?>
<?php if(!isset($_GET["idEst"])){ ?>
<br/><br/><br/><br/>
<?php } ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="text-center">
                <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/estudiante/perfilEstudiante.php")?> method="post" enctype="multipart/form-data">
                    <?php if(!isset($_GET["idEst"])){ ?>
                    <input type="file" name="file" class="custom-file-input" id="file" lang="es">
                    <label for="file" style="cursor: pointer;" id="uploaded_image"  data-toggle="tooltip" class="tooltipLink" data-placement="bottom" data-original-title="Actualizar foto de perfil">
                    <?php } ?>
                        <img src='<?php echo ($estudiante->getFoto()!="")?("img/".$estudiante->getFoto()):"https://www.w3schools.com/howto/img_avatar.png"?>' style="border-radius: 50%; width: 300px; height: 300px; object-fit: cover;">­
                    <?php if(!isset($_GET["idEst"])){ ?>
                    </label>
                    <?php } ?>
                </form>
            </div>            
        </div>
        <div class="col">
            <br/><br/><br/>
                    <h1><?php echo $estudiante->getNombres()." ".$estudiante->getApellidos()?> <?php if(!isset($_GET["idEst"])){ ?> <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-pencil-alt"></i></a> <?php } ?></h1>
            <p>
                Cedula: <?php echo $estudiante->getCedula()?><br/>
                Telefono: <?php echo $estudiante->getTel()?><br/>
                Direccion: <?php echo $estudiante->getDir()?><br/>
            </p>
        </div>
    </div>
</div>

<?php if(!isset($_GET["idEst"])){ ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/estudiante/perfilEstudiante.php") ?> method="post">
        <div class="modal-body">
        <div class="form-group">
            <label for="nombre">Nombres</label>
            <input type="text" class="form-control" id="nombre" name="nombre"  value="<?php echo $estudiante->getNombres()?>">
        </div>
        <div class="form-group">
            <label for="apellido">Apellidos</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $estudiante->getApellidos()?>">
        </div>
        <div class="form-group">
            <label for="cedula">Numero de identificacion</label>
            <input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo $estudiante->getCedula()?>">
        </div>
        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $estudiante->getTel()?>">
        </div>
        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $estudiante->getDir()?>">
        </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="actualizar" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php }?>


<script>
$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
   alert("Tipo de archivo invalido");
  }else{
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("file").files[0]);
    var f = document.getElementById("file").files[0];
    var fsize = f.size||f.fileSize;
    if(fsize > 2000000)
    {
    alert("La imagen es demaciado grande");
    }
    else
    {
    form_data.append("file", document.getElementById('file').files[0]);
    $.ajax({
        url:<?php echo "\"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") ."\""; ?>,
        method:"POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend:function(){
        $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
        },   
        success:function(data)
        {
        $('#uploaded_image').html(data);
        $('.tooltip').not(this).hide();
        }
    });
    }
  }  
 });
});
</script>