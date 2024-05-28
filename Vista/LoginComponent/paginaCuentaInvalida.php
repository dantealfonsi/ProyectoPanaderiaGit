<!DOCTYPE html>
<html lang="en-MU">
    <head>
        <meta charset="utf-8">
        <title>Panaderia | Cuenta Invalida</title>
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
        <?php $page = 'paginaCuentaInvalida';?>

        <!--Inicio de la Barra De Navegación-->
        <?php include './Includes/BarraNavegacionMovil.php';;?>
        <!--Final de la Barra De Navegación-->


        <!--Inicio de la Barra De Navegación @media 1200px-->
        <?php include './Includes/BarraNavegacionPc.php';?>
        <!--Final de la Barra De Navegación @media 1200px-->



        <div class="mail-sent-group">
            <div class="mail-sent-container">
                <div class="mail-sent-image-container">
                    <div class="mail-sent-image mail-invalid-image"></div>
                </div>

                <div class="mail-sent-text">
                    <h1>La verificación de tu email ha fallado.</h1>
                    <span class="message">Quiere decir que el link expiro o no lo abriste.</span>
                    <br><br>
                    <div class="resend-button-container">
                        <span><a href="login.php"><button class="resend-button" name="resendLink">Logueate para reenviar el codigo</button></a></span>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>