<?php 
    //define('ROOT_PATH', '/ProyectoPanaderia');
    include_once "paths.php";

    if(!isset($_SESSION))
    {
        session_start();
    }
    
    $page="index";
    
    if(isset($_SESSION['nombreUsuario'])){
        if($_SESSION['esAdmin'] == 1)
        {
            $href= $GLOBALS['ROOT_PATH'].'/Vista/Admin/panelAdmin.php';
        }
        else
        {
            $href= $GLOBALS['ROOT_PATH'].'/Vista/LoginComponent/cuentaUsuario.php';
        }
            $icono = 'bx--user-circle ';
            $carritoHref = $GLOBALS['ROOT_PATH'].'/Vista/CarritoComponent/carrito.php';
        } 
        else {
            $href = $GLOBALS['ROOT_PATH'].'/Vista/LoginComponent/login.php';
            $icono = 'bx--user-circle';
            $carritoHref = 'login.php'; 
        }
    ?>

<style>


        .notification-bell {
            cursor: pointer;
        }


        .notifications {
            display: none;
            color: black;
            height: 16rem;
            position: absolute;
            border: 1px solid black;
            overflow-x: hidden;
            overflow-y: auto;   
            scroll-behavior: smooth;         
            background: white;
            z-index: 2147483647;
            width: 14.5rem;
            font-size: 13px;
            right: 10%;
            /* Estilo para las notificaciones */
            /* Puedes agregar más estilos aquí */
        }    



        nav{
            width: 100%;
            height: 4rem;
            color: #fff;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            justify-content: center;
        }


        nav ul{
            display: flex;
            justify-content: center;
            align-items: center;
        }


</style>

<header class="<?php if($page == 'index' || $page == 'productos'){echo 'indexNav';}?> main-header-media1200">

<link href="<?php echo  $GLOBALS['ROOT_PATH']; ?>/css/icons.css" rel='stylesheet'>

<nav class="nav-media1200 main-nav-media1200" style='
    z-index: 100000000;
    background:linear-gradient(45deg, #FAD2DD, #EA93B3);
    height: 6rem;
    position: fixed;
    top: 0;
    box-shadow: 0px 5px 20px 6px #0000004f;'>
<input type="hidden" id="sessionValue" value="<?php if(isset($_SESSION['IDusuario'])) echo $_SESSION['IDusuario']; ?>"> 
        

        <ul class="animate__animated animate__backInDown" style='display:contents;'>
            <div>
            <img style='width:5rem' src='<?php echo  $GLOBALS['ROOT_PATH']; ?>/css/logo.png'>
            </div>

            <div style='display: flex;align-items: center;justify-content: center;'>
            <li><a href="<?php echo $GLOBALS['ROOT_PATH']; ?>/Vista/index.php" class="<?php if($page == 'index'){echo 'active';}?>">INICIO</a></li>
            <li><a href="<?php echo $GLOBALS['ROOT_PATH']; ?>/Vista/ProductoComponent/productos.php" class="<?php if($page == 'productos'){echo 'active';}?>">PRODUCTOS</a></li>
            <li><a href="<?php echo $GLOBALS['ROOT_PATH']; ?>/Vista/CreaTuPastelComponent/hasTuPastel.php" class="<?php if($page == 'hastuvaina'){echo 'active';}?>">PERSONALIZAR TORTA</a></li>
           
          <?php
            
            if(isset($_SESSION['nombreUsuario'])){ 
          
          ?> 

           <li>
                <a href="<?php echo $carritoHref;?>" class="<?php if($page == 'carrito'){echo 'active';}?>"><i class="bx--cart-alt"></i></a> 
                <div style='position: absolute; display: inline-block;'><a class="cart-number" style='color:white;display: flex;align-items: center;'><?php if(isset($_SESSION['cantidad_articulos'])) {echo $_SESSION['cantidad_articulos'];} else {echo "0";} ?></a></div>
           </li>

        <li><a class="notification-bell"><i class="oi--bell"></i></a> 
           <div  style='position: absolute; display: inline-block;'><a class="cart-number" style='color:white; display: flex;align-items: center;'><span id="numNotif"></span></a></div>
            <div class="notifications">
                        <!-- Aquí se mostrarán las notificaciones -->
            </div>
            <script src="<?php echo $GLOBALS['ROOT_PATH']; ?>/Vista/Javascript/notif.js"></script>
        </li>

        <?php } ?>
            
            <li>
                
                <a href="<?php echo $href;?>" class="<?php if($page == 'login' || $page == 'verificarCuenta'){echo 'active';}?> user-button"><i class="<?php echo $icono;?>"></i></a>
        
            </li>
            
        </div>
        </ul>
    </nav>    
</header>