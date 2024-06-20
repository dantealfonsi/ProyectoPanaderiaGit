<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title>Panaderia | Ordenar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--========== PHP CONNECTION TO DATABASE ==========-->
    <?php 
     include_once '../../Modelo/conexion.php';
     include_once '../CarritoComponent/numElementosEnCarrito.php';
 
    ?>

    <!--========== CSS FILES ==========-->
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Account.css">

    <!--========== BOOTSTRAP ==========-->
    <link href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- <link rel='stylesheet' type='text/css' href='style.php' /> -->

    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css" />

    <!--========== BOXICONS ==========-->
    <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>

    </head>

    <body>


<!--========== CONSULTAS PHP ==========-->
<?php 
    
    $Q_obtener_destacados = "SELECT * FROM productos";//selecciona productos destacados
    $Q_obtener_nuevos =  "SELECT * FROM productos";//selecciona nuevos productos
    $Q_obtener_detalles_producto =  "SELECT * FROM productos WHERE idproducto = 1 ";//selecciona producto con id =1
    $Q_obtener_categorias = "SELECT * FROM categorias;"; //selecciona todas las categorías
    $Q_ordenar_precio_asc = "SELECT * FROM productos  WHERE habilitado=1 ORDER BY precio_producto ASC"; //ordena todos los productos por precio de bajo a alto
    $Q_ordenar_precio_desc = "SELECT * FROM productos  WHERE habilitado=1 ORDER BY precio_producto DESC"; //ordena todos los productos por precio de alto a bajo
    
?>


<!--========== ENCABEZADO ==========-->
<?php $pagina = 'productos_categoria'?>
<!--Iniciar Barra de Navegación-->
<?php include '../Includes/BarraNavegacionMovil.php';?>
<!--Finalizar Barra de Navegación-->


<!--Iniciar Barra de Navegación @media 1200px-->
<?php include '../Includes/BarraNavegacionPc.php';?>
<!--Finalizar Barra de Navegación @media 1200px-->

<!--========== BOTÓN DE CATEGORÍAS ==========-->
<?php 

//$resultado_cat = mysqli_query($conn, $Q_obtener_categorias);

?>
<!-- <div class="row category-title">
    <h2 class="category">CATEGORÍA</h2>
    <h2 class="category-name "><?php echo $row_cat['nombre_categoria']; ?></h2>
    <div class="dropdown col-auto mx-auto pt-5 pb-1">
        <button class="dropbtn button" id="cat-but" style="outline: none;">Categorías &nbsp<i class='bx bxs-down-arrow drop-arrow'></i></button>
        <div class="dropdown-content">
            <?php
            while($row_categorias = mysqli_fetch_assoc($resultado_cat)){
                $IDcategoria = $row_categorias['idcategoria'];
                ?>
                <a href="productos_categoria.php?IDcategoria=<?php echo $IDcategoria; ?>"><?php echo $row_categorias['nombre_categoria']; ?></a>
                <?php
            }
            
            ?>
        </div>
    </div>
</div> -->


<!--========== PHP OBTENER DETALLES DEL PRODUCTO ==========-->

<?php
    if(isset($_GET['IDcategoria'])){
        $id_cat = $_GET['IDcategoria'];
        $Q_obtener_producto_por_id_cat = "SELECT * FROM productos WHERE categoria_producto = {$id_cat} AND habilitado=1";
        $Q_obtener_nombre_cat_por_id_cat = "SELECT * FROM categoria_producto WHERE idcategoria = {$id_cat} ";

        $ejecutar_cat = mysqli_query($conn, $Q_obtener_nombre_cat_por_id_cat );
        $row_cat = mysqli_fetch_array($ejecutar_cat);

    }

?>



<!------------->



<section class="featured section" id="featured">

    <!--========== BANNER DE TÍTULO ==========-->
    <?php 

        $resultado_cat = mysqli_query($conn, $Q_obtener_categorias);

        if($_GET['ordenar']==1){ //1 = bajo a alto
            $resultado_ordenar =mysqli_query($conn, $Q_ordenar_precio_asc);
        }
        elseif($_GET['ordenar']==2){ //2 = alto a bajo
            $resultado_ordenar =mysqli_query($conn, $Q_ordenar_precio_desc);
        }
        
    ?>

    <div class="row category-title">
        <div class="col">
            <h2 class="category">ORDENAR POR PRECIO</h2>
            <?php
            if($_GET['ordenar']==1){
                echo '<h2 class="category-name ">bajo a alto</h2>';
            }
            elseif($_GET['ordenar']==2){
                echo '<h2 class="category-name ">alto a bajo</h2>';
            }
            ?>
           
        </div>

        <!--========== BOTÓN DE ORDENAR POR ==========-->
        <div class="dropdown col-auto">
            <button class="dropbtn button" id="cat-but">Ordenar por &nbsp<i class='bx bxs-down-arrow drop-arrow'></i></button>
            <div class="dropdown-content">
                <a href="productos_ordenar.php?ordenar=1">precio bajo a alto</a>
                <a href="productos_ordenar.php?ordenar=2">precio alto a bajo</a>
                 
            </div>
        </div>

        <!--========== BOTÓN DE CATEGORÍAS ==========-->
        <div class="dropdown col-auto">
            <button class="dropbtn button" id="cat-but">Categorías &nbsp<i class='bx bxs-down-arrow drop-arrow'></i></button>
            <div class="dropdown-content">
                <?php
                while($row_categorias = mysqli_fetch_assoc($resultado_cat)){
                    $IDcategoria = $row_categorias['idcategoria'];
                    ?>
                    <a href="productos_categoria.php?IDcategoria=<?php echo $IDcategoria; ?>"><?php echo $row_categorias['nombre_categoria']; ?></a>
                    <?php
                }
                
                ?>
            </div>
        </div>
    </div>

     

    <div class="featured__container bd-grid mt-4">

        <?php
                 
                while($row_producto = mysqli_fetch_assoc($resultado_ordenar)){
                     $id_producto = $row_producto['idproducto'];
                    ?>

                        <div class="featured__products" id="product__card">
                            <div class="featured__box">
                                <div class="featured__new">NUEVO</div>
                                <div class=""><a href="producto.php?id_producto=<?php echo $id_producto; ?>"><i class='bx bxs-cart-add bx-tada-hover featured__new_cart'></i></a></div>
                                <a href="producto.php?id_producto=<?php echo $id_producto; ?>" >
                                    <img src="<?php echo $row_producto['imagen_producto']; ?>" alt="" class="featured__img avoid__clicks"
                                    style="
                                        object-fit: cover;
                                        width:  232px;
                                        height: 232px;" />
                                </a>
                            </div>

                            <div class="featured__data">
                                <?php $id_producto = $row_producto['idproducto']; ?>
                                <a href="producto.php?id_producto=<?php echo $id_producto; ?>" class="product__name" id="product__name"style="text-decoration: none;"><?php echo $row_producto['nombre_producto']; ?></a></br>
                                <span class="featured__price">Bs <?php echo $row_producto['precio_producto']; ?></span>
                               
                            </div>
                        </div>

                    <?php

                        }
                
                ?>
            </div>
        </section>

    </body>
</html>