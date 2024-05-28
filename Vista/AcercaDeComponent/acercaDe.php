<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
?>

<!DOCTYPE html>
<html lang="en-MU">
    <head>
        <meta charset="utf-8">
        <title>PANADERIA | ACERCA DE</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Atish.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet"href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>
    </head>

    <body>
        <?php $page = 'about';?>

        <!--Iniciar Barra de Navegación-->
        <?php include '../Includes/BarraNavegacionMovil.php';?>
        <!--FIN Barra de Navegación-->


        <!--Iniciar Barra de Navegación @media 1200px-->
        <?php include '../Includes/BarraNavegacionPC.php';?>
        <!--FIN Barra de Navegación @media 1200px-->


        <!--Inicio del Header-->
        <div class="about-us-header">
            <div class="banner-group">
                <div class="banner"></div>
            </div>
            
            <div class="about-us-subtitle">
                <span>Acerca de Nosotros</span>
            </div>
        </div>
        <!--Fin del Header-->


        <!--Informacion de la gente de la panaderia-->
        <div class="baker-info-group">
            <div class="baker-info-container">
                <div class="baker-info-text">
                    <div class="baker-info-title">
                        <span>Nuestro panadero</span>
                    </div>
        
                    <div class="baker-name">
                        <span>Señor Desconocido1</span>
                    </div>
        
                    <div class="baker-description">
                        <p>“ASDASDJASDJASJJASDJASDJJASD”</p>
                    </div>
        
                    <div class="baker-signature">
                        <div class="signature-photo"></div>
                    </div>
        
                    <div class="baker-position">
                        <span>DUEÑO - PANADERIA</span>
                    </div>
                </div>
                
                <div class="baker-photo-group">
                    <div class="baker-photo"></div>
                </div>
            </div>
        </div>
        <!--FIN INFO DE LA GENTE DE LA PANADERIA-->


        <!--Start Awards 
        <div class="award-section">
            <div class="award-title">
                <span>PRODUCTO MAS VENDIDO</span>
            </div>

            <div class="subtitle">
                <h2>PRODUCTOS</h2>
            </div>

            <div class="award-badge-container">
                <div class="award-badge-group">
                    <div class="badge badge1">
                        <div class="badge-photo-group">
                            <div class="badge-photo"></div>
                        </div>
                        
                        <div class="badge-info">
                            <span class="badge-title">DEL MES</span>
                            <span class="badge-date">2018-2020</span>
                            <p class="badge-description">AAAAAA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       End Awards-->


        <!--Informacion de los programadores-->
        <div class="team-section">
            <div class="team-title">
                <span>Programadores</span>
            </div>

            <div class="subtitle">
                <h2>NUESTRO EQUIPO</h2>
            </div>

            
            <div class="all-helper-info">
                <div class="helper-individual">
                    <div class="helper-group helper1">
                        <div class="helper-pic-group">
                            <div class="helper-pic"></div>
                        </div>

                        <div class = "helper-more-about">
                            <p class="name"><b>JUAN</b></p>
                            <p class="hierarchy">PROGRAMADOR</p>
                            <p class="description">.</p>
                        </div>
        
                        <div class="helper-social-media">
                            <div class="social-media">
                             
                                <span class="github">
                                    <a href=#><i class="/"></i></a>
                                </span>
                            </div>
                        </div> 
                    </div>
                </div>
                
                <div class="helper-individual">
                    <div class="helper-group helper2">
                        <div class="helper-pic-group">
                            <div class="helper-pic"></div>
                        </div>

                        <div class = "helper-more-about">
                            <p class="name"><b>Carlos</b></p>
                            <p class="hierarchy">Diseñador</p>
                            <p class="description">asdasd</p>
                        </div>
        
                        <div class="helper-social-media">
                            <div class="social-media">
                                <span class="github">
                                    <a href=#><i class="/"></i></a>
                                </span>
    
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <!--End Team Info-->


        <!--Start Footer-->
        <?php include '../Includes/Footer.php';?>
        <!--End Footer-->

        
        <!-- Start Bottom Nav -->
        <?php include '../Includes/navDeAbajo.php';?>
        <!-- End Bottom Nav -->
    </body>
</html>