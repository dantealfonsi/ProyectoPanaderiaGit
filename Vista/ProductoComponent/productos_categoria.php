<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title>Panaderia| Categoria</title>
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
    <link href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Bootstrap Core CSS -->
    <!-- <link rel="stylesheet" href="./bootstrap/css/bootstrap.css"> -->

    <!-- <link rel='stylesheet' type='text/css' href='style.php' /> -->

    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css" />

    <!--========== BOXICONS ==========-->
    <link href='../../css/boxicons.min.css' rel='stylesheet'>

    </head>

    <body>
          <!--========== PHP QUERIES ==========-->
        <?php 
            
 
            $Q_obtener_destacados = "SELECT * FROM productos WHERE IDtipo = 2";//selecciona productos destacados
            $Q_obtener_nuevos =  "SELECT * FROM productos WHERE IDtipo = 1 ";//selecciona nuevos productos
            $Q_obtener_detalles_producto =  "SELECT * FROM productos WHERE IDproducto = 1 ; AND habilitado=1";//selecciona producto con id =1
            $Q_obtener_categorias = "SELECT * FROM categoria_producto;"; //selecciona todas las categorías
            $Q_ordenar_precio_asc = "SELECT * FROM productos  WHERE habilitado=1 ORDER BY precio_producto ASC; "; //ordena todos los productos por precio de bajo a alto
            $Q_ordenar_precio_desc = "SELECT * FROM productos  WHERE habilitado=1  ORDER BY precio_producto DESC; "; //ordena todos los productos por precio de alto a bajo
            
        ?>

        <!--========== ENCABEZADO ==========-->
        <?php $pagina = 'productos_categoria'?>
        <!--Iniciar Barra de Navegación-->
        <?php include '../Includes/BarraNavegacionMovil.php';?>
        <!--Finalizar Barra de Navegación-->


        <!--Iniciar Barra de Navegación @media 1200px-->
        <?php include '../Includes/BarraNavegacionPc.php';?>
        <!--Finalizar Barra de Navegación @media 1200px-->

<!--========== PHP OBTENER DETALLES DEL PRODUCTO ==========-->

<?php
    if(isset($_GET['IDcategoria'])){
        $id_cat = $_GET['IDcategoria'];
        $Q_obtener_producto_por_id_cat = "SELECT * FROM productos WHERE categoria_producto = {$id_cat} AND habilitado=1 ";
        $Q_obtener_nombre_cat_por_id_cat = "SELECT * FROM categorias_productos WHERE IDcategoria = '$id_cat' ; ";

        $ejecutar_cat = mysqli_query($conn, $Q_obtener_nombre_cat_por_id_cat );
        $fila_cat = mysqli_fetch_array($ejecutar_cat);

    }
?>

<section class="featured section" id="featured">

   <!--========== BANNER DE TÍTULO ==========-->
<?php 

    $resultado_cat = mysqli_query($conn, $Q_obtener_categorias);

?>
<div class="row category-title">
    <div class="col">
        <h2 class="category">CATEGORÍA</h2>
        <h2 class="category-name "><?php echo $row_cat['nombre_categoria']; ?></h2>
    </div>

    <!--========== BOTÓN ORDENAR POR ==========-->
    <div class="dropdown col-auto">
        <button class="dropbtn button" id="cat-but">Ordenar por &nbsp<i class='bx bxs-down-arrow drop-arrow'></i></button>
        <div class="dropdown-content">
            <a href="productos_ordenarpor.php?ordenarpor=1">precio de menor a mayor</a>
            <a href="productos_ordenarpor.php?ordenarpor=2">precio de mayor a menor</a>
             
        </div>
    </div>

    <!--========== BOTÓN CATEGORÍAS ==========-->
    <div class="dropdown col-auto">
        <button class="dropbtn button" id="cat-but">Categorías &nbsp<i class='bx bxs-down-arrow drop-arrow'></i></button>
        <div class="dropdown-content">
            <?php
            while($row_categorias = mysqli_fetch_assoc($resultado_cat)){
                $IDcategoria = $row_categorias['IDcategoria'];
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
             $ejecutar_obtener_producto_por_id_cat = mysqli_query($conn, $Q_obtener_producto_por_id_cat); 
            while($fila_producto = mysqli_fetch_assoc($ejecutar_obtener_producto_por_id_cat)){
                 $IDproducto = $row_producto['IDproducto'];
                ?>

                    <div class="featured__products" id="product__card">
                        <div class="featured__box">
                            <div class="featured__new">NUEVO</div>
                            <div class=""><a href="producto.php?id_producto=<?php echo $IDproducto; ?>"><i class='bx bxs-cart-add bx-tada-hover featured__new_cart'></i></a></div>
                            <a href="producto.php?id_producto=<?php echo $IDproducto; ?>" >
                                <img src="<?php echo $row_producto['img_p']; ?>" alt="" class="featured__img avoid__clicks"
                                style="
                                    object-fit: cover;
                                    width:  232px;
                                    height: 232px;" />
                            </a>
                        </div>


                                    <div class="featured__data">
                                        <?php $IDproducto = $row_producto['IDproducto']; ?>
                                        <a href="producto.php?id_producto=<?php echo $IDproducto; ?>" class="product__name" id="product__name"style="text-decoration: none;"><?php echo $row_producto['nombre_producto']; ?></a></br>
                                        <span class="featured__price">Bs <?php echo $row_product['precio_producto']; ?></span>
                                       
                                    </div>
                                </div>

                            <?php
                        }
                
                ?>

            </div>
        </section>
    </body>
</html>