<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";





    // <!--========== CONEXION A LA BASE DE DATOS ==========-->
    
    include_once '../../Modelo/conexion.php';
    include_once '../CarritoComponent/numElementosEnCarrito.php';





        // <!--========== AGARRAR DETALLES DEL PRODUCTOS ==========-->

        
        
        $tipo_producto= $_REQUEST['tipo_p'];
        //$Q_buscar_por_tipo= "SELECT * FROM productos INNER JOIN tipo_producto ON productos.IDproducto = tipo_producto.IDproducto WHERE tipo_producto.IDtipo = '$tipo_producto' "; //selecciona un producto por tipo
        $Q_buscar_por_tipo= "SELECT * FROM productos WHERE habilitado=1 and existencia >0 AND productos.habilitado=1 and iscustom=0"; //selecciona un producto por tipo

        $Q_buscar_nuevos = "SELECT * FROM productos INNER JOIN tipos ON productos.idtipo = tipos.idtipo WHERE tipos.nombre_tipo = 'nuevo' AND productos.habilitado=1 and productos.iscustom=0"; //Selecciona un producto nuevo



        
        $resultado = mysqli_query($conn, $Q_buscar_por_tipo);
        $check = mysqli_num_rows($resultado);

   
        if($check>0 && $tipo_producto!=1){ 
           
           while($row = mysqli_fetch_assoc($resultado)){
               $producto_id = $row['idproducto'];

               
               

            echo' <div class="featured__products" id="product__card">
                       <div class="featured__box">
                           <div class="featured__new">Nuevo</div>
                           <a href="producto.php?id_producto='.$producto_id.'">
                           <a href="producto.php?id_producto='.$producto_id.'" class=""><i class="bx bxs-cart-add bx-tada-hover featured__new_cart"></i></a>
                           <a href="producto.php?id_producto='.$producto_id.'">
                               <img src=" '.$row['imagen_producto'].' "  class="featured__img avoid__clicks" 
                               style="
                                   object-fit: cover;
                                   width:  232px;
                                   height: 232px;" 
                               />
                           </a>
                       </div>';

                       echo ' <div class="featured__data"> ';
                           $product_id = $row['idproducto'];
                          
                        echo'<a href="producto.php?id_producto='.$producto_id.'" style="text-decoration: none;">
                           <h4 class="product__name" id="product__name">'.$row['nombre_producto'].'</h4>
                           </a> ';
                           
                        echo '<span class="featured__price">BS '.$row['precio_producto'].'</span>
                           
                       </div>
                   </div> ';

               
           }
        }

        //SOLO EN CASO DE POQUITOS PRODCUTOS
        else if($tipo_producto ==1){
            $resultado_nuevo = mysqli_query($conn, $Q_buscar_nuevos);
            $check = mysqli_num_rows($resultado_nuevo);

            if($check>0){
                while($new_row = mysqli_fetch_assoc($resultado_nuevo)){
            echo '  <div class="new__box">
                        <img src=" '.$row_nuevo['imagen_producto'] .' " class="new__img" />

                        <div class="new__link">
                            <a href="producto.php?id_producto='.$row_nuevo['idproducto'] .'" class="button"> Ver Producto</a>
                        </div>
                    </div> ';
                }
            }
           
        }

   


?>

        
