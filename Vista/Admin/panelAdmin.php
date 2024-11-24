<?php
include "../../Modelo/iniciarSesion.php";
include "../../Modelo/verificarAcceso.php";
include_once "../Includes/paths.php";

$nombreUsuario = $_SESSION['nombreUsuario'];

include "../../Modelo/conexion.php";

$src= "../Admin/frame.php";

if (isset($_GET['chat'])) { 
    $src= "../Admin/frame.php?chat=&idpedido=".$_GET['idpedido']."&notif=".$_GET['notif'];
}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>PANADERIA | PANEL DE ADMINISTRADOR</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Archivo CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Account.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='./checkout/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/bootstrap/css/bootstrap.css">
        <!-- Bootstrap CDN -->
        <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="../../Controlador/modulo.js"></script>
        <!-- include summernote css/js -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    
    <style>

    iframe{
    width: -webkit-fill-available;
    top:6rem;
    height: calc(100% - 1.6rem);
    position: absolute;
    margin-left: 80px;
    border: none;
    }

    </style>    
    
    </head>

    <body>
        <?php $page = 'verificarCuenta';?>

        <!--Inicio de Barra de Navegación-->
        <?php include '../Includes/BarraNavegacionMovil.php';?>
        <!--Fin de Barra de Navegación-->


        <!--Inicio de Barra de Navegación @media 1200px-->
        <?php include '../Includes/BarraNavegacionPC.php';?>
        <!--Fin de Barra de Navegación 1200px-->

        
        <?php if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin']=='1'){
        ?>
        <!--Inicio de Barra de Navegación-->
        <?php include '../Includes/NavBarResponsive/ResponsiveNavBar.php';?>
        <!--Fin de Barra de Navegación-->
        <!-- Inicio del Header-->
        <?php
        }
        ?>
   
        <iframe id='iframe' src=<?php echo $src; ?> frameborder="0">


        </iframe>
        <!-- Fin de la pestaña -->
    </body>
</html>