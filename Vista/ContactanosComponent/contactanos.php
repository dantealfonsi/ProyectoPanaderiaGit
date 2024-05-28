<?php 
    define('Acceso', TRUE);
    include "./AdditionalPHP/iniciarSesion.php";
?>

<!DOCTYPE html>
<html lang="en-MU">
    <head>
        <meta charset="utf-8">
        <title>CONTACTANOS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="Common.css">
        <link rel="stylesheet" type="text/css" href="Atish.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='./checkout/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet"href="./checkout/animate.min.css"/>
    </head>

    <body>
        <?php $pagina = 'contact';?>

  
        <?php include './Includes/MobileNavBar.php';?>
    

        <?php include './Includes/PcNavBar.php';?>


        <div class="about-us-header contact-us-header">
            <div class="banner-group">
                <div class="banner"></div>
            </div>
        </div>


        <?php include './Includes/Footer.php';?>

        
        <?php include './Includes/navDeabajo.php';?>
    </body>
</html>