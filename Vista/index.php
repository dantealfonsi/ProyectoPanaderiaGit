<?php 
    define('Acceso', TRUE);
    include "../Modelo/iniciarSesion.php";
?>

<!DOCTYPE html>
<html lang="en-MU">
    <head>
        <meta charset="utf-8">
        <title>PANADERIA| INDEX</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="../css/Common.css">
        <link rel="stylesheet" type="text/css" href="../css/Atish.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='../css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet" href="../css/animate.min.css" />
        <link rel="stylesheet" href="./faqComponent/faq.css" />
        <link rel="stylesheet" href="./envioComponent/styles.css" />
        <script src="./Javascript/swapWaveImg.js"></script>

        <!-- COUNTDOWN FUNCTION JAVASCRIPT BY SANJANA -->
        <script src = "./Javascript/countdown_sales.js"></script>
    </head>

    <body>
        <?php $page = 'index'?>

        <!--Iniciar Barra de Navegacion-->
        <?php include './Includes/BarraNavegacionMovil.php';?>
        <!--FIN Barra de Navegacion-->


        <!--Iniciar Barra de Navegación @media 1200px-->
        <?php include './Includes/BarraNavegacionPC.php';?>
        <!--FIN Barra de Navegación @media 1200px-->


        
        <!--INICIO DE LA IMAGEN CON ONDAS-->
        <div class="wave-image-group">
            <div class="wave-image footer-wave">
                <img src="../Assets/images/1.index/NavBar_WavePink.png">
            </div>
        </div>
        <!--FIN DE LA IMAGEN CON ONDAS--->


<!--Iniciar Presentación de Diapositivas-->
<div class="slideshow-container">

    <!-- Imágenes de ancho completo con número y texto de subtítulo -->
    <div class="mySlides fade">
    <img src="../Assets/images/1.index/Cake_1.jpg" style="width:100%">
    <div class="text">CADA LOTE DESDE CERO</div>
    </div>

    <div class="mySlides fade">
    <img src="../Assets/images/1.index/Cake_2.jpg" style="width:100%">
    <div class="text">IMPLEMENTAMOS DULCES SUEÑOS</div>
    </div>

    <div class="mySlides fade">
    <img src="../Assets/images/1.index/Cake_3.jpg" style="width:100%">
    <div class="text">UN POCO DE FELICIDAD EN CADA BOCADO</div>
    </div>
    
</div>

<script src="./Javascript/SlideshowAuto.js"></script>
<!--Finalizar Presentación de Diapositivas-->


<!--Iniciar Imagen de Ola-->
<div class="wave-image-group">
    <div class="wave-image">
        <img src="../Assets/images/1.index/NavBar_WaveWhite.png">
    </div>
</div>
<!--Finalizar Imagen de Ola-->













<!--Iniciar Qué Puedes Hacer-->
<div style='width: 100%; background: white;z-index: 2;position: relative;top: -1rem;'>
   
<!--Iniciar HacerComponent-->
<?php include './hacerComponent/hacer.html';?>
<!--FIN Barra de Navegación @media 1200px-->


</div>



        <!-- FAQ -->
        <?php include './envioComponent/envio.html';?>
        <!-- FAQ-->
        


        <!--FIN DE QUE QUIERES HACER-->
       
        
        <!--INICIO DE OFERTA ESPECIAL-->
        <section class="offer-section" style='position: relative;margin-top: 7rem;'>
            
<!--Iniciar Imagen de Ola
    <div class="wave-image-group">
        <div class="wave-image">
            <img src="Assets/images/1.index/NavBar_WaveWhite.png" style='transform: rotate(180deg); top: 2rem;' >
        </div>
    </div>
Finalizar Imagen de Ola-->

            <div class="offer-bg" >
                <div class="offer-data">
                    <div class="subtitle">
                        <h2>OFERTA ESPECIALES</h2>
                    </div>
                    <p class="offer-description">Queda tan solo: </p>
                    <p class="offer-description" id="countdown" style="font-family: Old Standard TT; font-size: 2rem;">Hasta que termine</p>

                    <div class="subscribe-button-container">
                        <a href="productos.php"><button class="subscribe-button" name="subscribe">COMPRE AHORA</button></a>
                    </div>
                </div>
            </div>


    <!--Iniciar Imagen de Ola
    <div class="wave-image-group">
        <div class="wave-image">
            <img src="Assets/images/1.index/NavBar_WaveWhite.png" style='top: 4.5rem;' >
        </div>
    </div>
  Finalizar Imagen de Ola-->





            
        </section>
        <!--Fin de la oferta especial-->


        <!--Imagen en ola-->
        <!-- <div class="wave-image-group">
            <div class="wave-image">
                <img src="Assets/images/1.index/NavBar_WaveWhite.png">
            </div>
        </div> -->
        <!--Fin de la imagen en olita-->






<!--Inicio Imagen de Ola Invertida
<div class="wave-image-group">
    <div class="wave-image-flip how-to-order-wave">
        <img src="Assets/images/1.index/NavBar_WaveWhiteFlip.png">
    </div>
</div>
Fin Imagen de Ola Invertida-->







        <!-- FAQ -->
        <?php include './faqComponent/faq.html';?>
        <!-- FAQ-->
        


<!-- Inicio Nuestros Panaderos
<div class="our-baker">

    <div class="subtitle">
        <h2>NUESTROS PANADEROS</h2>
    </div>
    
    <div class="all-helper-info-index">
        <div class="helper-individual-index">
            <div class="helper-group helper0">
                <div class="helper-pic-group">
                    <div class="helper-pic"></div>
                </div>

                <div class = "helper-more-about">
                    <p class="name"><b>JUAN VILLAROEL</b></p>
                    <p class="hierarchy">CEO - PANADERIA</p>
                    <p class="description">Cobertura de gelatina, babka, caramelos, pastel dulce, ositos de goma, toffee.</p>
                </div>

                <div class="helper-social-media">
                    <div class="social-media">
                        <span class="facebook">
                            <a href=#><i class="fab fa-facebook-square"></i></a>
                        </span>
                        <span class="twitter">
                            <a href=#><i class="fab fa-twitter-square"></i></a>
                        </span>
                        <span class="instagram">
                            <a href=#><i class="fab fa-instagram-square"></i></a>
                        </span>
                        <span class="pinterest">
                            <a href=#><i class="fab fa-pinterest-square"></i></a>
                        </span>
                    </div>
                </div> 
            </div>
        </div>
                <div class="helper-individual-index">
                    <div class="helper-group helper1">
                        <div class="helper-pic-group">
                            <div class="helper-pic"></div>
                        </div>

                        <div class = "helper-more-about">
                            <p class="name"><b>LUIS GONZALES</b></p>
                            <p class="hierarchy">CO-FUNDADOR</p>
                            <p class="description">No se que poner aqui</p>
                        </div>
        
                        <div class="helper-social-media">
                            <div class="social-media">
                                <span class="facebook">
                                    <a href=#><i class="fab fa-facebook-square"></i></a>
                                </span>
                                <span class="twitter">
                                    <a href=#><i class="fab fa-twitter-square"></i></a>
                                </span>
                                <span class="instagram">
                                    <a href=#><i class="fab fa-instagram-square"></i></a>
                                </span>
                                <span class="pinterest">
                                    <a href=#><i class="fab fa-pinterest-square"></i></a>
                                </span>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="helper-individual-index">
                    <div class="helper-group helper2">
                        <div class="helper-pic-group">
                            <div class="helper-pic"></div>
                        </div>

                        <div class = "helper-more-about">
                            <p class="name"><b>HILMARIS ARRIETA</b></p>
                            <p class="hierarchy">PANADERA</p>
                            <p class="description">Y aqui menos.</p>
                        </div>
        
                        <div class="helper-social-media">
                            <div class="social-media">
                                <span class="facebook">
                                    <a href=#><i class="fab fa-facebook-square"></i></a>
                                </span>
                                <span class="twitter">
                                    <a href=#><i class="fab fa-twitter-square"></i></a>
                                </span>
                                <span class="instagram">
                                    <a href=#><i class="fab fa-instagram-square"></i></a>
                                </span>
                                <span class="pinterest">
                                    <a href=#><i class="fab fa-pinterest-square"></i></a>
                                </span>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
      End Our Baker-->



        <!-- GOOGLE MAPS DESABILITADO POR AHORA-->
        <?php include './GoogleMapComponent/GoogleMap.php';?>
        <!-- GOOGLE MAPS-->


        <!-- FORMULARIO DE CONTACTAME -->
        <?php include './Includes/newsletter.php';?>
        <!-- FIN DE L FORMULARIO DE CONTACTAME-->
        


        <!--INICIO DEL Footer-->
        <?php include './Includes/Footer.php';?>
        <!--FIN Footer-->

        
        <!--  INICIO DEL NAV DE ABAJO -->
        <?php include './Includes/NavDeAbajo.php';?>
        <!-- FIN DEL  Nav DE ABAJO -->

    </body>
</html>