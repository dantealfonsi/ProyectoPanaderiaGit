<?php
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
    
    if(isset($_SESSION['carrito_compras']))
    {
        $_SESSION['cantidad_articulos'] = 0;
        foreach($_SESSION['carrito_compras'] as $key => $item){
            $_SESSION['cantidad_articulos'] = $_SESSION['cantidad_articulos'] + $item['cantidad'];
        }
    }
?>
