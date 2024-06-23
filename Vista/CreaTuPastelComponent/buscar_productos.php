<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";

    // <!--========== CONEXION A LA BASE DE DATOS ==========-->
    
    include_once '../../Modelo/conexion.php';
    include_once '../CarritoComponent/numElementosEnCarrito.php';

        // <!--========== AGARRAR DETALLES DEL PRODUCTOS ==========-->

        $tipo_producto= $_REQUEST['tipo_p'];
        $consulta = $_REQUEST['consulta'];
        $Q_buscar_por_tipo= $consulta;

        $resultado = mysqli_query($conn, $Q_buscar_por_tipo);
        $check = mysqli_num_rows($resultado);

        if($check>0 && $tipo_producto!=1){
                while($row = mysqli_fetch_assoc($resultado)){
                    $producto_id = $row['idproducto'];
     
                 echo' <div class="featured__products" id="product__card">
                            <div class="featured__box">
                                <div class="featured__new">Nuevo</div>
                                <a href="productoPerson.php?id_producto='.$producto_id.'">
                                <a href="productoPerson.php?id_producto='.$producto_id.'" class=""><i class="bx bxs-cart-add bx-tada-hover featured__new_cart"></i></a>
                                <a href="productoPerson.php?id_producto='.$producto_id.'">
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
                               
                             echo'<a href="productoPerson.php?id_producto='.$producto_id.'" style="text-decoration: none;">
                                <h4 class="product__name" id="product__name">'.$row['nombre_producto'].'</h4>
                                </a> ';
                                
                             echo '<span class="featured__price">BS '.$row['precio_producto'].'</span>
                                
                            </div>
                        </div> ';       
                }            
            }
            else {
                // No hay resultados
                echo "<h3>No se encontraron productos Disponibles.</h3>";
            }

?>

        
