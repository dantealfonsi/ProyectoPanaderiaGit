<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";

    // <!--========== CONEXIÓN PHP A LA BASE DE DATOS ==========-->
    
    include_once '../../Modelo/conexion.php';
    include_once '../CarritoComponent/numElementosEnCarrito.php';

        // CONSULTAS:
        $Q_ordenar_por_precio_asc = "SELECT * FROM productos WHERE habilitado=1 and existencia > 0 and iscustom=0 ORDER BY precio_producto ASC "; // ordenar todos los productos por precio de menor a mayor
        $Q_ordenar_por_precio_desc = "SELECT * FROM productos WHERE habilitado=1 and existencia > 0 and iscustom=0 ORDER BY precio_producto DESC "; // ordenar todos los productos por precio de mayor a menor
        

        // ORDENAR POR TIPO DE PRECIO:
        if($_REQUEST['sortby']==1){ // 1 --> de menor a mayor
            $result_ordenar =mysqli_query($conn, $Q_ordenar_por_precio_asc);
        }
        elseif($_REQUEST['sortby']==2){// 2 --> de mayor a menor
            $result_ordenar =mysqli_query($conn, $Q_ordenar_por_precio_desc);
        }



        // MOSTRAR RESULTADOS ORDENADOS
        while($row_product = mysqli_fetch_assoc($result_ordenar)){
            $id_producto = $row_product['idproducto'];
           

        echo '   <div class="featured__products" id="product__card">
                   <div class="featured__box">
                       <div class="featured__new">NUEVO</div>
                       <div class=""><a href="producto.php?id_producto='.$id_producto.' "><i class="bx bxs-cart-add bx-tada-hover nuevo_carrito_destacado"></i></a></div>
                       <a href="producto.php?id_producto='.$id_producto.'" >
                           <img src="'.$row_product['imagen_producto'].'" alt="" class="img_destacada evitar_clicks"
                           style="
                               object-fit: cover;
                               width:  232px;
                               height: 232px;" />
                       </a>
                   </div>

                   <div class="featured__data">
                    
                       <a href="producto.php?id_producto='.$id_producto.'" class="product__name" id="product__name" style="text-decoration: none;"><h5>Disponible '.$row_product['existencia'].'</h5><h4>'.$row_product['nombre_producto'].'</h4></a>
                       <span class="featured__price">Bs '.$row_product['precio_producto'].'</span>
                      
                   </div>
               </div> ';

           
       }
