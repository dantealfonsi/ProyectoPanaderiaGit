<?php

include_once "paths.php";

?>

<style>
        @font-face {
        font-family: button;
        src: url(../../css/button.ttf) format('truetype');
        }

        @font-face {
        font-family: candy;
        src: url(../../css/candy.ttf) format('truetype');
        }
        


</style>



<footer class="footer-group" style='text-align:initial;'>
    <div class="footer">
        <div class="footer-container">
          
                
        <div class="logo" style='display: flex;flex-direction: column;align-items: center;'>
            <img src="<?php echo $GLOBALS['ROOT_PATH']?>/css/logo.png" alt="" style='width:9rem;'>
            <span class="logo-name" style="font-size: 3rem;font-family: 'candy';color: #D22E6B;">PANADERIA DULCE AMOR</span>
        </div>
        
 
        <section style='display: flex;text-align: start;justify-content: space-around;align-items: baseline;flex-wrap: wrap;'> 

        
        <div class="contact-links">
          <span style="font-size: 2rem;font-weight: bold;border-bottom: dashed #D22E6B;letter-spacing: 0px;">Contacto:</span> 
          <span style='font-size:1rem;font-weight:bold;'>Telf 0412-858-1138</span>
            <span class="privacy-policy"><b><a href="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/AcercaDeComponent/acercaDe.php" style='color: black;text-decoration: none;font-size: 1rem;'>Acerca de nosotros</a></b></span>
        </div>

        <div class="legal-links"  style='font-size: .9rem;display: flex;justify-content: center;align-items: center;width: 15rem;'>
        <div class="address">
            <span style="font-size: 2rem;font-weight: bold;border-bottom: dashed #D22E6B;padding-bottom: .5rem;letter-spacing: 0px;">Direccion:</span>
            <span style='font-weight: bold;font-size: 1rem;'>Avenida Bolívar N#36, San José.Estado Sucre</span></div>
        </div>

           
        <div class="social-media" style='display: flex;flex-direction: column;'>
        
            <span style="font-size: 2rem;font-weight: bold;border-bottom: dashed #D22E6B;letter-spacing: 0px;">Redes</span> 

            <div style='display:flex;flex-direction:column;gap: .5rem;margin-top: .5rem;'>

                <div class="facebook" style='display: flex;align-items: center;'>
                    <a style='align-items: center;justify-content: space-between;width: 100%;display: flex;'><span style='font-size: 1.1rem;letter-spacing: 1px;font-weight: 800;margin-right: 1rem;'>Facebook</span><img style='width:2rem;' src="<?php echo $GLOBALS['ROOT_PATH'] ?>/Assets/images/1.index/facebook.png"></a>
                </div>
                <div class="twitter" style='display: flex;align-items: center;'>
                    <a href=# style='align-items: center;justify-content: space-between;width: 100%;display: flex;'><span style='font-size: 1.1rem;letter-spacing: 1px;font-weight: 800;margin-right: 1rem;'>Instagram</span><img style='width:2rem;' src="<?php echo $GLOBALS['ROOT_PATH'] ?>/Assets/images/1.index/instagram.png"></a>
                </div>
                <div class="instagram" style='display: flex;align-items: center;'>
                    <a href=# style='align-items: center;justify-content: space-between;width: 100%;display: flex;'><span style='font-size: 1.1rem;letter-spacing: 1px;font-weight: 800;margin-right: 1rem;'>Whatsapp</span><img style='width:2rem;' src="<?php echo $GLOBALS['ROOT_PATH'] ?>/Assets/images/1.index/whatsapp.png"></a>
                </div>

            </div>

            </div>
        </div>



</section>
<div class="copyright">
            <span class="copyright-text" style='color: #D22E6B;font-weight: bold;'>&#169; <?php echo date("Y"); ?> Diseño por U.P.T.P Luis Mariano Rivera</span>
        </div>  
</div>   
</footer>