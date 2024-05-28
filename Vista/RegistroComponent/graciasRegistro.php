<?php
     include_once "../Includes/paths.php";
     include "../../Modelo/iniciarSesion.php";
    
    if(isset($_COOKIE['graciasCookie'])){
        define('Acceso', TRUE);
    }
    else {
        echo 'Acceso Denied!';
    }
?>

<!DOCTYPE html>
<html lang="en-MU">
    <head>
        <meta charset="utf-8">
        <title>PANADERIA | GRACIAS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Account.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet"href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>
    </head>

    <body>
        <?php $page = 'GraciasRegistro';?>

        <!--Start Navigation Bar-->
        <?php include '../Includes/BarraNavegacionMovil.php';;?>
        <!--End Navigation Bar-->


        <!--Start Navigation Bar @media 1200px-->
        <?php include '../Includes/BarraNavegacionPC.php';?>
        <!--End Navigation Bar @media 1200px-->


        <div class="mail-sent-group">
            <div class="mail-sent-container">
                <div class="mail-sent-image-container">
                    <div class="mail-sent-image"></div>
                </div>

                <div class="mail-sent-text">
                    <h1>Gracias por Unirte!</h1>
                    <span class="message">Un Email de Verificación ha sido enviado. Entra a tu correo.</span>
                    <br><br>
                    <span class="tip">Tip: Si no has recibido el email, busca en tu carpeta de SPAM o eliminados.</span>
                </div>
            </div>
        </div>
    </body>
</html>