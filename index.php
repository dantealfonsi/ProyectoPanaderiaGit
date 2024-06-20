<?php 
include "./Vista/Includes/paths.php";
include "./Modelo/modulo_proyecto.php";

$tmodulo=new Modulo;
$tmodulo->crear();
?>

<!DOCTYPE html>
<html>
  <head>
    <?php    
    //define('ROOT_PATH1', $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPanaderia');
        //prueba GIT DANIEL');

    header("Location:Vista/index.php");
     ?>
    <title>Inicio Sesion</title>
    <meta name="viewport" content="width=device_width, initial-scale=1.0">
      
    <body>

    </body>
  </head>
</html>
