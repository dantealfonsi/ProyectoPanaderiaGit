<?php
    header("refresh:3;url=verificarCuenta.php");
?>

<!DOCTYPE html>
<html lang="en-MU">
    <head>
        <meta charset="utf-8">
        <title>Panaderia | Email Verificado</title>
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
        <?php $page = 'GraciasRegistro';?>

        <!--Inicio de la Barra De Navegación-->
        <?php include './Includes/BarraNavegacionMovil.php';;?>
        <!--Final de la Barra De Navegación-->


        <!--Inicio de la Barra De Navegación @media 1200px-->
        <?php include './Includes/BarraNavegacionPc.php';?>
        <!--Final de la Barra De Navegación @media 1200px-->


        <div class="mail-sent-group">
            <div class="mail-sent-container">
                <div class="mail-sent-image-container">
                    <div class="mail-sent-image mail-verified-image"></div>
                </div>

                <div class="mail-sent-text">
                    <h1>Tu email ha sido verificado.</h1>
                    <span class="message">Seras enviado a la pagina principal</span>
                    <br><br>
                    <span class="tip">Redireccionando........</span>
                </div>
            </div>
        </div>
    </body>
</html>