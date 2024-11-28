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

        <style>

            
        @font-face {
        font-family: button;
        src: url(../css/button.ttf) format('truetype');
        }

        @font-face {
        font-family: candy;
        src: url(../css/candy.ttf) format('truetype');
        }
        

        .slideshow-container{
            height: 46rem !important;
            background: linear-gradient(45deg, #FAD2DD, #EA93B3) !important;
            display: block !important;
        }

        .slideshow-container-inside{
            display: flex;
            align-items: center;
            padding: 6rem;
            padding-top: 8rem;
            gap: 8rem;
        }

        .font-container{
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .image-container{
            width: 60%;
        }

        .image-container img{
            width: 100%;
        }

        .submitBtn{
            background: #D12B69;
            color: white;
            padding: 1rem 0;
            margin: 0rem;
            cursor: grabbing;
            width: 60%;
            border: rgb(252, 132, 132);
            text-align: center;
            font-size: 1rem;
            border-radius: 1rem;
            font-weight: bold;
            }


            .submitBtn:hover {
            background-color: #ff68a0;
            transform: scale(1.080);
            transition: ease 0.4s;
            }
            
            .play-button{
                color: #D12B69;
                padding: .2rem .4rem;
                display: flex;
                align-items: center;
                border: 3px solid #D12B69;
                border-radius: 2rem;
                justify-content: center;
                font-size: 1rem;
            }

            .about-us-title{
                display: flex;
                gap: 1rem;
                align-items: center;
                cursor:pointer;
            }

            .about-us-title:hover{
                text-decoration:underline;
            }


        </style>

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
    <div class='slideshow-container-inside'>

    <div class='font-container'>
        <a style='color: black;text-decoration: none;' href="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/AcercaDeComponent/acercaDe.php"><h5 class='about-us-title'><span class='play-button'>▶</span>Conocenos Ahora</h5></a>
        <h1 style="font-family:candy;font-size: 4rem;letter-spacing: -1px;">Tortas rellenas con Amor</h1>
        <span style='color:#f56399;'>Has tus dias especiales, aun mas especiales! Con nuestras tortas rellenas</span>
        <button class='submitBtn' style='margin-top:2rem;'>Ordena Ahora!</button>
    </div>

    <div class='image-container'>
        <img src="../Assets/images/1.index/Cake_1.png">
    </div>


   <!--
    <div class="mySlides fade">
    <img src="../Assets/images/1.index/Cake_2.jpg" style="width:100%">
    <div class="text">IMPLEMENTAMOS DULCES SUEÑOS</div>
    </div>

    <div class="mySlides fade">
    <img src="../Assets/images/1.index/Cake_3.jpg" style="width:100%">
    <div class="text">UN POCO DE FELICIDAD EN CADA BOCADO</div>
    </div>
-->
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

      <div style="display: flex;flex-direction: column;align-items: center;margin-top:10rem;">
                <h2 style="color: #D22E6B;margin-bottom: 0;top: 1.9rem;position: relative;font-size: 1.4rem;font-weight: 700;">Escucha</h2>
                <h1 class="my-4" style="font-size: 4rem;font-family: 'candy';border-bottom: 3px dashed #D22E6B;text-align: center;">Los rugidos de tu estomago
              </div>

            
        <section style='display: flex;justify-content: center;margin-bottom:10rem;'>
            <div style='width: 70%;background: linear-gradient(45deg, #f9f9f9, #ffffff);border: 1px solid #dddddd;border-radius: 2rem;padding: 4rem;display: flex;flex-direction: column;box-shadow: 1px 5px 8px 2px #0000005c;'>
                <div style='display: flex;flex-direction: column;align-items: center;'>
                    <h4 style='font-weight: bolder;color: #D22E6B;margin-bottom: 0;'>Judith B. Jones</h4>             
                    <h5 style='font-weight: 700;color: #80808087;'>Cocinera</h5>
                </div>
            
                <div>
  
                    <p style='display: flex;align-items: center;flex-direction: row;font-weight: 800;gap: 1rem;'>                  
                    <span style="font-size: 6rem;font-weight: bolder;font-family: 'candy';color: #ffb6ae;">
                     "
                    </span>
                    Cocinar exige atención, paciencia y sobre todo respeto por los dones de la tierra. Es una forma de adoración, una forma de dar gracias.
                    </p>
                </div>
                
            </div>
            
        </section>



        <!-- GOOGLE MAPS DESABILITADO POR AHORA-->
        <?php //include './GoogleMapComponent/GoogleMap.php';?>
        <!-- GOOGLE MAPS-->

        


        <!--INICIO DEL Footer-->
        <?php include './Includes/Footer.php';?>
        <!--FIN Footer-->

        
        <!--  INICIO DEL NAV DE ABAJO -->
        <?php include './Includes/NavDeAbajo.php';?>
        <!-- FIN DEL  Nav DE ABAJO -->

    </body>
</html>