
<?php 
    if(!isset($_SESSION))
    {
        session_start();
    }
    include_once "paths.php";
    
    $nombreUsuario = "Cuenta";
    $icono = "fas fa-user bottom-nav-icon";

    if(isset($_SESSION['nombreUsuario'])){
        $href =  $GLOBALS['ROOT_PATH'].'/Vista/LoginComponent/verificarCuenta.php';
        $nombreUsuario = $_SESSION['nombreUsuario'];
        $icono = "fas fa-user-check";
    } else {
        $href = $GLOBALS['ROOT_PATH'].'/Vista/LoginComponent/login.php'; 
    }
?>

<div class="bottom-nav-group">
    <nav class="bottom-nav">
        <a href="<?php echo $href;?>" class="bottom-nav-link">
            <i class="<?php echo $icono;?>" ></i>
            <span class="bottom-nav-text"><?php echo $nombreUsuario;?></span>
        </a>
        <a href="../carritoComponent/carrito.php" class="bottom-nav-link">
            <i class="fas fa-shopping-cart"></i>
            <span class="bottom-nav-text">Carrito</span>
        </a> 
    </nav>
</div>