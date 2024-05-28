<?php
    include "./AdditionalPHP/iniciarSesion.php";
    
    if(isset($_COOKIE['resetearContrasena'])){
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
        <title>PANADERIA | Mira tu Email</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="Common.css">
        <link rel="stylesheet" type="text/css" href="Account.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='./checkout/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet" href="./checkout/animate.min.css"/>
    </head>

    <body>
        <?php $page = 'graciasRegistro';?>

        <!--Iniciar Barra de Navegación-->
        <?php include './Includes/BarraNavegacionMovil.php';?>
        <!--FIN Barra de Navegación-->


        <!--Iniciar Barra de Navegación @media 1200px-->
        <?php include './Includes/BarraNavegacionPC.php';?>
        <!--FIN Barra de Navegación @media 1200px-->



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