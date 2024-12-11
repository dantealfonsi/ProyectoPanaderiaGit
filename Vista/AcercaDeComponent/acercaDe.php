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

        <style>

            @media screen and (max-width: 950px){
            
                .google-map{
                width: 90% !important;
                }

            }

           
        </style>

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

            
        <div style="display: flex;flex-direction: column;align-items: center;margin-top:5rem;">
                <h2 style="color: #D22E6B;margin-bottom: 0;top: 1.9rem;position: relative;font-size: 1.4rem;font-weight: 700;">Nuestra Historia</h2>
                <h1 class="my-4" style="font-size: 4rem;font-family: 'candy';border-bottom: 3px dashed #D22E6B;text-align: center;">Acerca De Nosotros
        </div>


  
        <!--Fin del Header-->

        <!--Iniciar HacerComponent-->
        <?php include '../hacerComponent/hacer-left.html';?>
        <!--FIN Barra de Navegación @media 1200px-->





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
        <div style="display: flex;flex-direction: column;align-items: center;">
                <h2 style="color: #D22E6B;margin-bottom: 0;top: 1.9rem;position: relative;font-size: 1.4rem;font-weight: 700;">Nuestro Equipo</h2>
                <h1 class="my-4" style="font-size: 4rem;font-family: 'candy';border-bottom: 3px dashed #D22E6B;text-align: center;">Horneadores
        </div>

            
            <div class="all-helper-info" style='width: 90%;'>
                <div class="helper-individual">
                    <div class="helper-group helper1">
                        <div class="helper-pic-group">
                            <div class="helper-pic"></div>
                        </div>

                        <div class = "helper-more-about">
                            <p class="name"><b>ROBERTO</b></p>
                            <p class="hierarchy">HORNEADOR</p>
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
                    <div class="helper-group helper1">
                        <div class="helper-pic-group">
                            <div class="helper-pic"></div>
                        </div>

                        <div class = "helper-more-about">
                            <p class="name"><b>CRISAIDA</b></p>
                            <p class="hierarchy">HORNEADORA</p>
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
                    <div class="helper-group helper1">
                        <div class="helper-pic-group">
                            <div class="helper-pic"></div>
                        </div>

                        <div class = "helper-more-about">
                            <p class="name"><b>ALBERTO</b></p>
                            <p class="hierarchy">MASAJEADOR</p>
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
            </div>

        </div>

                <!--Informacion de la gente de la panaderia-->
        <div style="display: flex;flex-direction: column;align-items: center;">
            <h2 style="color: #D22E6B;margin-bottom: 0;top: 1.9rem;position: relative;font-size: 1.4rem;font-weight: 700;">Donde Encontrarnos</h2>
            <h1 class="my-4" style="font-size: 4rem;font-family: 'candy';border-bottom: 3px dashed #D22E6B;text-align: center;">Ubicacion
        </div>


        <!-- GOOGLE MAPS DESABILITADO POR AHORA-->
            <?php include '../GoogleMapComponent/GoogleMap.php';?>
        <!-- GOOGLE MAPS-->

        <!--End Team Info-->


        <!--Start Footer-->
        <?php include '../Includes/Footer.php';?>
        <!--End Footer-->

        
        <!-- Start Bottom Nav -->
        <?php include '../Includes/navDeAbajo.php';?>
        <!-- End Bottom Nav -->
    </body>
</html>