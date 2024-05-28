<?php 
    define('Acceso', TRUE);

    //Iniciar Sesion
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php"; 

    //BASE DE DATOS
    include "../../Modelo/conexion.php"; 

?>

<?php
//Boton para quitar producto dle carrito
//el boton de quitar cargas de la misma paginas pero carga informacion adicional en el url con GET
//carrito.php?action=borrar&product_id=<?php echo ...
//Chequea si el URL tiene la accion de borra
if(filter_input(INPUT_GET, 'action') == 'borrar'){
    //loope todos los productos en el carrito hasta que la ID matche el URL
    foreach($_SESSION['carrito_compras'] as $key => $producto){ 

        //Cheque si id_producto en el url matchea con los de la seccion del carro de compras 
        if($producto['id'] == filter_input(INPUT_GET, 'id_producto')){
            //remueve el producto del array de carrito 
            unset($_SESSION['carrito_compras'][$key]);
        }//end if
    }//end foreach

    //Resetea la sesion
    $_SESSION['carrito_compras'] = array_values($_SESSION['carrito_compras']);

    //borrar ROW DEL CARRITO
    $Q_borrar_itemcarrito = 'DELETE FROM itemcarrito WHERE IDproducto = '.filter_input(INPUT_GET, 'id_producto');
    $run_borrar_itemcarrito = mysqli_query($conn, $Q_borrar_itemcarrito);

}//end if
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title>PANADERIA | DETALLES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--========== CONEXION A LA BASE DE DATOS==========-->
    <?php 
        
        include_once 'numElementosEnCarrito.php';
    ?>

    <!--========== CSS  ==========-->
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Sanjana.css">

    <!--<link href="jquery.nice-number.css" rel="stylesheet">-->
    <!--========== JQUERY CDN ==========-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    <!--<script src="jquery.nice-number.js"> </script>-->
    <script type="text/javascript"> 
    $(function(){
        $('input[type="number"]').niceNumber();
    });
    </script>


    <!--========== BOOTSTRAP ==========-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

     <!-- Bootstrap Core CSS -->
     <!-- <link rel="stylesheet" href="./bootstrap/css/bootstrap.css"> -->

    <!-- <link rel='stylesheet' type='text/css' href='style.php' /> -->

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo  $GLOBALS['ROOT_PATH']; ?>/css/animate.min.css" />

    <!--========== BOXICONS ==========-->
    <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>
    <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/icons.css' rel='stylesheet'>
    </head>

    <body>
          <!--========== PHP QUERIES ==========-->
        <?php 
            
            $Q_buscar_seleccioandos = "SELECT * FROM productos"; //Selecciona los productos seleccionados
            $Q_buscar_nuevo = "SELECT * FROM productos"; //selecciona los nuevos productos
            $Q_buscar_detalle_producto = "SELECT * FROM productos"; //selecciona los producots donde id=1
            $Q_buscar__todos_productos = "SELECT * FROM productos";
        
        ?>


        <!--========== HEADER ==========-->
        <?php $page = 'carrito'?>
        
        <!--Inicio de barra de navegacion-->
        <?php include '../Includes/BarraNavegacionMovil.php';?>
        <!--Final de barra de navegacion-->


        <!--Inicio de Barra  @media 1200px-->
        <?php include '../Includes/BarraNavegacionPC.php';?>
        <!--Final de la barra @media 1200px-->
          

        <!--========== ESTRUCTURA DEL CARRITO ==========-->
        <div class="row mx-auto">
            <!-- carrito items -->
            <div class="col-lg">

                <!-- Titulo -->
                <div class="row-md  title-cart">
                  
                    <h1 text-center>Carrito &nbsp</h1>
                    <i class='bx bxs-cart-download bx-tada-hover'></i>
                </div>
                <!-- Detalles de la orden -->
                <div class="cart_title_bar mx-1 ">
                    <div class="cart-title-1">
                        <h2 class="section-title hide-wave"> </h2>
                    </div>
                    <div class="cart-title-2">
                        <h4 class="section-all my-0 py-0 hide-wave"></h4>
                    </div>
                    <div class="cart-title-3">
                        <h4 class="section-all my-0 py-0 hide-wave">Cantidad</h4>
                    </div>
                   
                    <div class="cart-title-4">
                        <h4 class="section-all my-0 py-0 hide-wave">Precio Total</h4>
                    </div>
                    <div class="cart-title-5">
                        <h4 class="section-all my-0 py-0 hide-wave">Borrar</h4>
                    </div>
                    
                </div>
                <!-- Loopear a traves de las sesioens del carito -->
                <?php
                //Si el carrito de compras no esta vacio
                if(!empty($_SESSION['carrito_compras'])){
                    //create total variable 
                    $total = 0;
                    $_SESSION['cantidad_total'] = 0;
                    //loop through each item in shopping cart
                    foreach($_SESSION['carrito_compras'] as $key => $producto){ 
                
                ?>

                <!-- Receipt item card -->
                <div class="receipt-card mt-2 mb-3 mx-1 py-3">

                    <!-- product image -->
                    <?php
                    
                    $resultado_producto = mysqli_query($conn, $Q_buscar__todos_productos);
                    $check = mysqli_num_rows($resultado_producto);

                    if($check>0){ //checks if $result empty in database
                          //loops through all items in products table in database
                        while($row_producto = mysqli_fetch_assoc($resultado_producto)){

                              //compare if id in database in current loop is equal to  
                              //id in current session shopping cart foreach loop
                            if($row_producto['IDproducto'] == $producto['id']){
                                ?>
                                <!-- prints image from database of corresponding id -->
                                <div class="cart_img">
                                    <img src="<?php  echo $row_producto['imagen_producto']; ?>" class="img-fluid">
                                </div>

                                <?php
                            }//Fin del IF
                        }//Fin de While
                    }//Fin del if CHECK
                    ?>

                    <!-- <div class="cart_img">
                        <img src="Assets\images\products\Cake_2.jpg" class="img-fluid">
                    </div> -->

                    <!-- Detalles del producto -->
                    <div class="">
                        <!-- Nombre del producto -->
                        <div class="product-name">
                            <div class="product-name-det">
                                <h6><?php echo $producto['nombre'];?></h6>
                                <h6>Bs <?php echo number_format($producto['precio'], 2);?> / unidad</h6>
                            </div>
                        </div>
                    </div>

                        <!-- Cantidad -->
                        <div class="quantity-value">
                             <h6><?php echo $producto['cantidad'];?></h6>
                        </div>


                    <!-- Precio Total del Producto -->
                    <div class="tot-price-per-item ">
                        <h6>Bs <?php echo number_format($producto['cantidad'] * $producto['precio'], 2); ?></h6>
                    </div>

                      <!-- Borrar -->
                    <div class="remove-button">
                        <!-- Producto['id'] esta buscando la id del la sesion del array del carrito  -->
                        <a href="carrito.php?action=borrar&id_producto=<?php echo $producto['id'];?>"> 
                        <button type="button" class="btn btn-primary btn-lg my-4 button rem-but"><i class='bx--x' style='color:#ffffff; font-size: 1.3rem ;'></i></button>
                        </a>
                    </div>
                </div>

                <?php

                    //Calculo del prec
                    $total = $total + ($producto['cantidad'] * $producto['precio']);

                    //Crear sesion para el precio total
                    $_SESSION['precio_total'] = $total;

                }//Fin del foreach
                ?>
            </div>

            <!-- Receta -->
            <div class="col-md container receipt-area mx-auto">
                <!-- Summary -->
                <div class="row summary-area">
                    <h1 class="subtitle">LISTA</h1>
                </div>
                <div class="row container receipt-data mx-auto pt-3">
                    <!-- subtotal -->
                    <div class="row container subtotal-area my-1">
                        <div class="col">
                            <h4 class="subtitle title-checkout">SUBTOTAL: </h4>
                        </div>
                        
                        <div class="col">
                            <h4 class="subtitle">Bs <?php echo number_format($total, 2); ?></h4>
                        </div>
                    </div>
                    <!-- Entrega a -->
                    <div class="row container delivery-area my-1">
                        <div class="col">
                            <h4 class="subtitle title-checkout">ENTREGA: </h4>
                        </div>
                        
                        <div class="col">
                            <h4 class="subtitle">Bs 0.00</h4>
                        </div>
                    </div>
                    <!-- total -->
                    <div class="row container total-area my-1 pt-2">
                        <div class="col">
                            <h4 class="subtitle title-checkout">TOTAL: </h4>
                        </div>
                        
                        <div class="col">
                           <h4 class="subtitle">Bs <?php echo number_format($total, 2); ?></h4>
                        </div>
                    </div>
                    
                    
                    <!-- checkout -->
                    <!-- Muestra el checkout si el array del carrito no esta vacio-->
                    <?php
                    //chequea si el carrito no esta vacio
                    if(isset($_SESSION['carrito_compras']));{
                        //Cheque si el carrito tiene productos
                        if(count($_SESSION['carrito_compras'])>0){
                    
                    ?>
                    <div class="row checkout-area">
                        <a href="../CheckoutComponent/checkout.php">
                            <button type="button" class="btn btn-primary btn-lg my-4 button">Pagar</button>
                        </a>
                    </div>
                    <?php
                     }//fin del if que cuenta
                     if(count($_SESSION['carrito_compras']) == 0) {
                        echo('<h1 class="subtitle">Tu carro esta vacio!</h1>');
                     }
                    }//Fin del isset
                    if(!isset($_SESSION['carrito_compras'])) {
                        echo('<h1 class="subtitle">Tu carro esta vacio!</h1>');
                     }
                    
                    ?>
                </div>
            </div>
            <?php  
                }//Fin del IF que esta al principio XD
                //Esto es lo que lanza el mensaje si esta vacio
                if(isset($_SESSION['carrito_compras'])) {
                    if(count($_SESSION['carrito_compras']) == 0) {
                        
                        echo('<h1 class="text-center my-3">Your carrito is empty!</h1>');
                        echo('<div class="text-center py-3"><img src="../../Assets/images/cart/sad.png" class="img-fluid" style="max-width:17%;"></div>');
                        echo('<div class="text-center py-3"><a href="../ProductoComponent/productos.php" class="button button__round">Compra Ahora</a></div>');
                     }// == 0
                 }//Fin del Isset
                 else { //Si el carrito de compra no esta setiado
                    echo('<h1 class="text-center my-3">Tu carrito no esta activo!</h1>');
                    echo('<div class="text-center py-3"><img src="../../Assets/images/cart/sad.png" class="img-fluid" style="max-width:17%;"></div>');
                    echo('<div class="text-center py-3"><a href="../ProductoComponent/productos.php" class="button button__round">Compra Ahora</a></div>');
                 }
                
            ?>
        </div>

           
        <!--Footer-->
        <?php include '../Includes/Footer.php';?>
        <!--Fin del Footer-->

        
        <!-- Nav de abajo -->
        <?php include '../Includes/navDeabajo.php';?>
        <!-- Fin de Nav de Abajo -->

        <!-- <script src="Javascript\main.js?
    </body>
</html>