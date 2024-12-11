<?php
     include_once "../Includes/paths.php";
     include "../../Modelo/iniciarSesion.php";
    
    if(isset($_COOKIE['resetpassword'])){
        define('Acceso', TRUE);
    }
    else {
        echo 'Acceso DENEGADO!';
    }
?>

<!DOCTYPE html>
<html lang="en-MU">
<head>
        <meta charset="utf-8">
        <title>RESETEAR CONTRASEÑA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Account.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>
        <!--reCAPTCHA-->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>

    <body>
        <?php $page = 'graciasRegistro';?>

        <!--Iniciar Barra de Navegación-->
        <?php include '../Includes/BarraNavegacionMovil.php';?>
        <!--Finalizar Barra de Navegación-->


        <!--Iniciar Barra de Navegación @media 1200px-->
        <?php include '../Includes/BarraNavegacionPc.php';?>
        <!--Finalizar Barra de Navegación @media 1200px-->



        <div class="mail-sent-group">
            <div class="mail-sent-container">
                <div class="mail-sent-image-container">
                    <div class="mail-forget-image"></div>
                </div>

                <div class="mail-sent-text">
                    <h1>Mira tu Email!</h1>
                    <span class="message">Te hemos enviado un Email con tu nueva contraseña. Cambiala tan pontro te loguees.</span>
                    <br><br>
                    <span class="tip">Tip: Si no has recibido el mail, revisa en la carpeta de SPAM o en la papelera.</span>
                </div>
            </div>
        </div>
    </body>
</html>