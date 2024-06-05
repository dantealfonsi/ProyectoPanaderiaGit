<?php
     include_once "../Includes/paths.php";
     include "../../Modelo/iniciarSesion.php";
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

        <div class="mail-sent-group">
            <div class="mail-sent-container">
                <div class="mail-sent-image-container">
                    <div class="mail-sent-image"></div>
                </div>

                <div class="mail-sent-text">
                    <h1>Gracias por Insertar un Producto!</h1>
                    <span class="message">Su nuevo producto aparecera en la lista en unos instantes.</span>
                    <br><br>
                    <span class="tip">Tip: Recuerde siempre utilizar imagenes nitidas y bien editadas, presentable.</span>
                </div>
            </div>
        </div>
    </body>
</html>