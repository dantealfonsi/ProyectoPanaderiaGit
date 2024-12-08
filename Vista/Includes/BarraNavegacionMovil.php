<?php

//define('ROOT_PATH', '/ProyectoPanaderia');
include_once "paths.php";
$page="";
$usuario = "";
$admin = "";

if(isset($_SESSION['nombreUsuario'])){
    $usuario = $_SESSION['nombreUsuario'];
    if($_SESSION['esAdmin'] == 1)
    {
        $admin = "Admin: ";
    }
    else{
        $admin = "Usuario: ";
    }
}

?>

<header class="main-header">
    <nav class="main-nav">



        <input type="checkbox" id="check">
        
        <label for="check" class="checkbtn">
            <i>☰</i>
        </label>



        <h1 class="business-name"><a href="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/index.php" class="animate__animated animate__backInDown">DULCE AMOR</a></h1>

        <ul>
            <li><a><?php echo $admin . $usuario; ?></a></li>
            <li><a href="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/index.php" class="<?php if($page == 'index'){echo 'active';}?>" >INICIO</a></li>
            <li><a href="<?php echo $GLOBALS['ROOT_PATH']?>/Vista/ProductoComponent/productos.php" class="<?php if($page == 'productos'){echo 'active';}?>" >PRODUCTOS</a></li>
            <li><a href="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/CreaTuPastelComponent/hasTuPastel.php" class="<?php if($page == 'hastuvaina'){echo 'active';}?>" >HAZ TU RECETA</a></li>
    
        </ul>
    </nav>
</header>