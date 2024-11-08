<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";


    // <!--========== CONEXION A BASE DE DATOS ==========-->
    
        include_once '../../Modelo/conexion.php';
        include_once '../CarritoComponent/numElementosEnCarrito.php';



        // <!--========== PHP FETCH PRODUCT DETAILS ==========-->

        
        
        $idCategoria= $_REQUEST['id_cat']; 
        
        $Q_buscar_productos_por_categoria_id = "SELECT * FROM productos  WHERE categoria_producto = {$idCategoria} AND habilitado=1 and existencia > 0 and iscustom=0";




            $correr_obtener_producto_por_categoria_id = mysqli_query($conn, $Q_buscar_productos_por_categoria_id); 
            while($row_producto = mysqli_fetch_assoc($correr_obtener_producto_por_categoria_id)){
                $idProducto = $row_producto['idproducto'];
                

                    echo ' <div class="featured__products" id="product__card">
                                <div class="featured__box">
                                    <div class="featured__new">NUEVO</div>
                                    <div class=""><a href="producto.php?id_producto='. $idProducto.' "><i class="bx bxs-cart-add bx-tada-hover featured__new_cart"></i></a></div>
                                    <a href="producto.php?id_producto='. $idProducto.' " >
                                                <img src=" '. $row_producto['imagen_producto'].' " alt="" class="featured__img avoid__clicks"
                                                style="
                                                    object-fit: cover;
                                                    width:  232px;
                                                    height: 232px;" />
                                            </a>
                                </div>

                            <div class="featured__data">';
                    $idProducto = $row_producto['idproducto'];
                    echo '<a href="producto.php?id_producto='.$idProducto.' " class="product__name" id="product__name"style="text-decoration: none;">'. $row_producto['nombre_producto'].'</a></br>
                            <span class="featured__price">Bs '. $row_producto['precio_producto'].'</span>
                                
                            </div>
                            </div>';

                
            }

                ?>

        
