<?php
session_start();
require 'logica/Persona.php';
require 'logica/Administrador.php';
require 'logica/Profesor.php';
require 'logica/Estudiante.php';

require 'logica/Curso.php';
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
    <script type="text/javascript">
    /*
        $(document).ready(function() {
        // show the alert
            setTimeout(function() {
                $(".alert").alert('close');
            }, 2000);
        });
        */
    </script>   
</head>

<body>
    <?php
        if(isset($_GET["pid"])){
            include base64_decode($_GET["pid"]);
        }else{
            if(isset($_GET["salir"])){
                $_SESSION["id"]=null;
                $_SESSION["rol"]=null;
                header('Location: index.php');
            }
            include 'presentacion/inicio.php';
        }    
    ?>
</body>

<footer class="container">
    <br/><br/><br/><br/>
    <hr>
  <small class="float-right" >   
    <p class="float-right"><a href="checklist.php" style="color: #82888e;  text-decoration: none;">Estado del Sito</a><br/><a href="#" style="color: #82888e;  text-decoration: none;">Volver Arriba</a></p>
  </small>
</footer>