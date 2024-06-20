<?php 
    define('Acceso', TRUE);

    //Inicio de Sesión
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";

    //Conexion a la base de datos 
    include_once '../../Modelo/conexion.php';
    
?>

<?php 
$ids_producto = array();
if(!isset($_SESSION['IDproducto'])){

    if($_GET['id_producto'] == "") {
        echo "NO $-GET['id_producto'] valor ";
    }
    else {
        $_SESSION['IDproducto']= $_GET['id_producto'];
    }
}
else {
    //si la sesión está definida y get no está definido
    if($_GET['id_producto'] == "") {
        //continuar con el programa.. el valor de la sesión no cambia
    }
    else { //si la sesión está definida y get no está vacío
        $_SESSION['IDproducto'] = $_GET['id_producto'];
    }
}

// CONSULTAS MYSQL BÁSICAS
if(isset($_SESSION['nombreUsuario'])){

    //establecer sesión para IDusuario
    $Q_obtener_IDusuario = 'SELECT idusuario FROM usuario WHERE nombreusuario = "'. $_SESSION['nombreUsuario'].'"';
    $ejecutar_obtener_IDusuario = mysqli_query($conn, $Q_obtener_IDusuario);
    $resultado = mysqli_fetch_array($ejecutar_obtener_IDusuario);
    $_SESSION['IDusuario'] = $resultado[0];

    //dar IDcarrito al usuario
    $Q_seleccionar_usuario_en_carrito = 'SELECT * FROM carrito WHERE idusuario = '.$_SESSION['IDusuario'];
    $ejecutar_seleccionar_usuario_en_carrito = mysqli_query($conn, $Q_seleccionar_usuario_en_carrito);
    $contar_usuario_en_carrito = mysqli_num_rows($ejecutar_seleccionar_usuario_en_carrito);
    
    //crear IDcarrito para el usuario solo una vez
    if( $contar_usuario_en_carrito==0){
        $Q_insertar_en_carrito = 'INSERT INTO carrito (idusuario) VALUES ('.$_SESSION['IDusuario'].')';
        $ejecutar_insertar_en_carrito = mysqli_query($conn, $Q_insertar_en_carrito);   
    }

    //establecer sesión para IDcarrito
    $Q_obtener_IDcarrito = 'SELECT idcarrito FROM carrito WHERE idusuario ='.$_SESSION['IDusuario'];
    $ejecutar_obtener_IDcarrito = mysqli_query($conn, $Q_obtener_IDcarrito);
    $resultado2 = mysqli_fetch_array($ejecutar_obtener_IDcarrito);
    $_SESSION['IDcarrito'] = $resultado2[0];
   

}

//verificar si se ha enviado el botón Agregar al carrito
if(filter_input(INPUT_POST, 'agregar-al-carrito')){ 
    if(!isset($_SESSION['nombreUsuario'])){
        header("location:../LoginComponent/login.php");
    }else{
        if(isset($_SESSION['carrito_compras'])){

            //mantener un seguimiento de cuántos productos hay en el carrito de compras
            $cuenta = count($_SESSION['carrito_compras']);
    
            //crear un array secuencial para hacer coincidir las claves del array con los ids de los productos
            $ids_producto = array_column($_SESSION['carrito_compras'], 'id');
    
                if(!in_array($_GET['id_producto'], $ids_producto)){//** */
                    $_SESSION['carrito_compras'][$cuenta] = array
                    (
                        'id' => $_GET['id_producto'], //GET se usa ya que el id se proporciona en la URL -filter_input(INPUT_GET, 'IDproducto')
                        'nombre' => filter_input(INPUT_POST, 'nombre'),
                        'precio' => filter_input(INPUT_POST, 'precio'),
                        'cantidad' => filter_input(INPUT_POST, 'cantidad_entrada')
                    ); 
    
                    //INSERTAR DETALLES DEL ARTÍCULO DEL CARRITO EN LA TABLA cartitem
                    $Q_insertar_en_cartitem = 'INSERT INTO itemcarrito (idproducto, idcarrito, precio, cantidad) 
                    VALUES ('.$_SESSION['IDproducto'].','.$_SESSION['IDcarrito'].','.filter_input(INPUT_POST, 'precio').','.filter_input(INPUT_POST, 'cantidad_entrada').' )';
                    $ejecutar_insertar_en_cartitem = mysqli_query($conn, $Q_insertar_en_cartitem);
                }
                else {//el producto ya existe, aumentar la cantidad
    
                    //hacer coincidir la clave del array con el id del producto que se está agregando al carrito
                    for($i=0; $i<count($ids_producto); $i++){
                        if($ids_producto[$i] ==  $_GET['id_producto']){
                        //filter_input(INPUT_GET, 'IDproducto')){
                            //agregar la cantidad del artículo del formulario al producto existente en el array
                            // $_SESSION['carrito_compras'][$i]['cantidad'] += filter_input(INPUT_POST, 'cantidad-entrada');
                            $_SESSION['carrito_compras'][$i]['cantidad'] += $_POST['cantidad_entrada'];
    
                            //CONSULTA DE ACTUALIZACIÓN EN LA TABLA cartitem
                            $Q_actualizar_cartitem = 'UPDATE itemcarrito SET cantidad = '.$_SESSION['carrito_compras'][$i]['cantidad'].' 
                            WHERE idproducto = '.$_GET['id_producto'];
                            $ejecutar_actualizar_cartitem = mysqli_query($conn, $Q_actualizar_cartitem);
                        }
                    }
                }
        }
        else { //si el carrito de compras no existe, crear el primer producto con la clave del array 0
            //crear un array usando los datos del formulario enviado, comenzar desde la clave 0 y llenarlo con valores
            $_SESSION['carrito_compras'][0] = array
    
            (
                'id' => $_GET['id_producto'], //GET se usa ya que el id se proporciona en la URL - filter_input(INPUT_GET, 'IDproducto')
                'nombre' => filter_input(INPUT_POST, 'nombre'),
                'precio' => filter_input(INPUT_POST, 'precio'),
                'cantidad' => filter_input(INPUT_POST, 'cantidad_entrada')
            );
    
    
            //INSERTAR DETALLES DEL ARTÍCULO DEL CARRITO EN LA TABLA itemcarrito
            $Q_insertar_en_cartitem = 'INSERT INTO itemcarrito (idproducto, idcarrito, precio, cantidad) 
            VALUES ('.$_GET['id_producto'].','.$_SESSION['IDcarrito'].','.filter_input(INPUT_POST, 'precio').','.filter_input(INPUT_POST, 'cantidad_entrada').' )';
            $ejecutar_insertar_en_cartitem = mysqli_query($conn, $Q_insertar_en_cartitem);
        }
    }
}

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title>PANADERIA | Detalles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!--========== CSS FILES ==========-->
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Sanjana.css">

    <link href="jquery.nice-number.css" rel="stylesheet">
    <!--========== JQUERY CDN ==========-->
    
    <script src="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/Javascript/jquery-3.5.1.js"></script>
    <script src="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/Javascript/jquery.nice-number.js"> </script>
    
    <script type="text/javascript"> 
    $(function(){
        $('input[type="number"]').niceNumber();
    });
    </script>


    <!--========== BOOTSTRAP ==========-->
    <link href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/bootstrap.min.css" rel="stylesheet">

    
    <?php
    //Numero de elementos por carritos
    include_once '../CarritoComponent/numElementosEnCarrito.php';
    ?>

    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css" />

    <!--========== BOXICONS ==========-->
    <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>

    </head>

    <style>

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }

    </style>

    <body>
          <!--========== PHP QUERIES ==========-->
        <?php 
                
                $Q_obtener_destacados = "SELECT * FROM productos INNER JOIN tipo_producto ON productos.idproducto = tipo_producto.idproducto WHERE tipo_producto.idtipo = 2"; //selecciona un producto ya establecido
                $Q_obtener_nuevos = "SELECT * FROM productos INNER JOIN tipo_producto ON productos.idproducto = tipo_producto.idproducto WHERE tipo_producto.idtipo = 1"; //selecciona un producto nuevo
                $Q_obtener_detalle_producto = "SELECT * FROM productos INNER JOIN tipo_producto ON productos.idproducto = tipo_producto.idproducto WHERE tipo_producto.idtipo = 2"; //selecciona producto con id =1
                $Q_obtener_categorias = "SELECT * FROM categorias"; //selecciona todas las categorías
        ?>


        <!--========== CABECERA ==========-->
        <?php $page = 'producto'?>
      
        <!--Iniciar Barra de Navegación-->
        <?php include '../Includes/BarraNavegacionMovil.php';?>
        <!--FIN Barra de Navegación-->


        <!--Iniciar Barra de Navegación @media 1200px-->
        <?php include '../Includes/BarraNavegacionPC.php';?>
        <!--FIN Barra de Navegación @media 1200px-->
        <!--========== AGARRAR DATOS DETALLES DE PRODUCTO ==========-->

<?php
    if(isset($_GET['id_producto'])){ // si existe $_GET['id_producto']
        $id_producto = $_GET['id_producto'];
        
        //******* inicio obtener detalles del producto *******
        //consulta
        $Q_obtener_producto = "SELECT * FROM productos WHERE idproducto = $id_producto";
        //ejecutar consulta
        $ejecutar_obtener_producto = mysqli_query($conn, $Q_obtener_producto);
        //almacenar detalles en array
        $row_producto = mysqli_fetch_array($ejecutar_obtener_producto);
        //******* fin obtener detalles del producto *******

        //******* inicio obtener tipo de producto *******
       /* $Q_obtener_id_tipo = "SELECT * FROM tipo_producto WHERE idproducto = $id_producto";
        $ejecutar_obtener_id_tipo = mysqli_query($conn, $Q_obtener_id_tipo);
        $row_id_tipo = mysqli_fetch_array($ejecutar_obtener_id_tipo);
        //******* fin obtener tipo de producto *******

        //******* inicio obtener categoría del producto *******
        $Q_obtener_id_cat = "SELECT * FROM categoria_producto WHERE IDproducto = $id_producto";
        $ejecutar_obtener_id_cat = mysqli_query($conn, $Q_obtener_id_cat);
        $row_id_cat = mysqli_fetch_array($ejecutar_obtener_id_cat);
        //******* fin obtener categoría del producto ********/

        //declarar variables para todos los encabezados de columna
        $nombre_producto = $row_producto['nombre_producto'];
        $descripcion_producto = $row_producto['descripcion_producto'];
        $imagen_producto = $row_producto['imagen_producto'];
        $precio_producto = $row_producto['precio_producto'];
        $existencia= $row_producto['existencia'];
        //$idTipo = $row_id_tipo['IDtipo'];
        //$idCategoria = $row_id_cat['IDcategoria'];             
    }
    
    else{

    }
?>

<!--CUADRÍCULA DE DETALLES DEL PRODUCTO-->

<div class="container mx-auto mt-0 pt-0 ">
    <div class="row continue-shop-div text-center">
        <a href="productos.php" class="button continue" id="cat-but" style='display: flex;align-items: center;justify-content: center;' >Continuar</a>
    </div>
    <div class="row">
        <div class="col-md mt-4 mx-auto ">
            <img src="<?php echo $imagen_producto;?>" class="product-image" />
        </div>
        <div class="col mt-4">
            <h1><?php echo $nombre_producto;?></h1>
            <h2>Bs <?php echo $precio_producto;?></h2>
            <!-- INPUT CANTIDAD -->
            <form id="form-pd" method="POST" action="producto.php?action=add&id_producto=<?php echo $id_producto; ?>">
                <div class="box my-4">
                    <label class="subtitle" style="margin-left: 2.7rem; 
                    margin-bottom: .8rem; font-weight: 700; color: black; ">Cantidad</label><br>
                    <input type="number" style='color:black; display:inline;width: 5rem !important;' value="1" min="1" max="<?php echo $existencia; ?>" name= "cantidad_entrada" id= "input-quantity" class="input-quantity mx-2 p-3 px-4">
                    <input type="hidden" name="nombre" value="<?php echo $nombre_producto;?>" />
                    <input type="hidden" class="show_id" name="id_producto" value="<?php echo $id_producto;?>" />
                    <input type="hidden" name="precio" value="<?php echo $precio_producto;?>" /> <br>
                    <input type="submit" name="agregar-al-carrito" id="add-to-cart-btn" value="Agregar al carrito" class="btn btn-primary btn-lg my-4 button" />

                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="product-description my-3">
            <div class="description">
                <h2>Descripción</h2>
            </div>
            <div class="para_details py-2 px-4 my-3 ">
                <p>
                    <?php echo $descripcion_producto;?>
                </p>
            </div>
        </div>
    </div>

        </form>

        </div>

        <!-- <script src="Javascript\main.js?<?php //echo filemtime('Javascript\main.js'); ?>" ></script> -->
    </body>
</html>