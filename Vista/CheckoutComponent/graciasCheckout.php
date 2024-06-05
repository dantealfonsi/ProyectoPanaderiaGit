<?php 
    define('Acceso', TRUE);

    //INICIAR SESIÓN 
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php"; 

    //CONEXIÓN A LA BASE DE DATOS : tiendadepasteles
    include "../../Modelo/conexion.php";     

    //EL USUARIO COMPLETÓ EL PAGO
    //CREAR ID DE PEDIDO PARA EL USUARIO

    //PRIMERO -- ENCONTRAR NÚMERO DE TELÉFONO
    $Q_seleccionar_telefono_usuario = 'SELECT telefono FROM usuario WHERE IDusuario = '.$_SESSION['IDusuario'];
    $ejecutar_seleccionar_telefono_usuario = mysqli_query($conn,  $Q_seleccionar_telefono_usuario);

    //SI EL USUARIO NO TIENE NÚMERO DE TELÉFONO --> ESTABLECER SESIÓN A NULL
    if(mysqli_num_rows($ejecutar_seleccionar_telefono_usuario)==0){
        $_SESSION['telefono'] = null;
    }
    //DE LO CONTRARIO, ESTABLECER SESIÓN AL NÚMERO DE TELÉFONO ACTUAL
    else{
        $resultado_telefono = mysqli_fetch_array($ejecutar_seleccionar_telefono_usuario);
        $_SESSION['telefono'] = $resultado_telefono[0];
    }


    //AGREGAR DATOS A pedido_usuario
    $Q_insertar_pedido_usuario ='INSERT INTO pedido_usuario (IDusuario, total, direccion, telefono, estado) 
    VALUES ('.$_SESSION['IDusuario'].','.$_SESSION['precio_total'].',"'.$_POST['direccion'].'","'.$_SESSION['telefono'].'", "EN PROCESO")';
    $ejecutar_insertar_pedido_usuario = mysqli_query($conn, $Q_insertar_pedido_usuario);

    //INSERTAR EN itempedido

    //SELECCIONAR PRIMERO LOS DATOS NECESARIOS
    $Q_seleccionar_todos_itemcarrito = 'SELECT * FROM itemcarrito WHERE IDcarrito ='.$_SESSION['IDcarrito'];
    $ejecutar_seleccionar_todos_itemcarrito = mysqli_query($conn, $Q_seleccionar_todos_itemcarrito);

    $Q_seleccionar_orderID = 'SELECT IDpedido FROM pedido_usuario WHERE IDusuario ='. $_SESSION['IDusuario'].' ORDER BY IDpedido DESC LIMIT 1';
    $ejecutar_seleccionar_orderID = mysqli_query($conn, $Q_seleccionar_orderID);
    $resultado3 = mysqli_fetch_array($ejecutar_seleccionar_orderID, MYSQLI_NUM);

    $_SESSION['IDpedido'] = $resultado3[0];

    //RECORRER CADA ARTÍCULO DEL CARRITO
    while($row = mysqli_fetch_assoc($ejecutar_seleccionar_todos_itemcarrito)){

        //INSERTAR CADA ARTÍCULO DEL CARRITO COMO ARTÍCULO DE PEDIDO EN LA TABLA itempedido
        $Q_insertar_itempedido = 'INSERT INTO itempedido (IDproducto, IDpedido, precio, cantidad) 
        VALUES ('.$row['IDproducto'].', '.$_SESSION['IDpedido'].','.$row['precio'].','.$row['cantidad'].')';
        $ejecutar_insertar_itempedido = mysqli_query($conn,  $Q_insertar_itempedido);
    }
    

    //INSERTAR EN transaccion 
    $Q_insertar_en_transaccion = 'INSERT INTO transaccion (IDusuario, IDpedido, metodoPago, estado)
    VALUES ( '.$_SESSION['IDusuario'].', '.$_SESSION['IDpedido'].',"'.$_POST['metodoPago'] .'","EN PROCESO" )';
    $ejecutar_insertar_en_transaccion = mysqli_query($conn, $Q_insertar_en_transaccion);
    

    //DESPUÉS DE INSERTAR DATOS EN LAS TABLAS, TENEMOS QUE ELIMINAR LA SESIÓN DEL CARRITO DE COMPRAS
    foreach($_SESSION['carrito_compras'] as $key => $producto){
        unset($_SESSION['carrito_compras'][$key]);

    }//Terminar foreach


    //ELIMINAR VALORES DE itemcarrito DESPUÉS DEL PAGO
    $Q_eliminar_itemcarrito = 'DELETE FROM itemcarrito WHERE IDcarrito ='.$_SESSION['IDcarrito'];
    $ejecutar_eliminar_itemcarrito = mysqli_query($conn, $Q_eliminar_itemcarrito);


?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>PANADERIA | ¡Gracias!</title>
        <!-- BOOTSTRAP CORE CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/form-validation.css">

        <!-- ANIMATE.CSS  -->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css">
    </head>

    <body >

        <!-- TÍTULO -->
        <div class="py-5 text-center">
            <h1 class="business-name">PANADERIA</h1>
            
            <img class="thankYouImageHead my-5" src="../../Assets/images/cart/circleHead.png" />
            <img class="thankYouImage  my-5 rotate" src="../../Assets/images/cart/sun.png" />
        
            <h1 style="font-size:3vw;">¡Gracias por comprar con nosotros! Comunicate en el Chat para completar tu pedido...</h1>
            <a href="../Admin/chat.php?idpedido=<?php echo $_SESSION['IDpedido'] ?>" class=" btn btn-primary btn-lg button" style="font-size:1.5vw;">Ir al Chat</a>
        </div>
    
         <!-- PIE DE PÁGINA  -->
        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2024 PANADERIA</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacidad</a></li>
                <li class="list-inline-item"><a href="#">Términos</a></li>
                <li class="list-inline-item"><a href="#">Soporte</a></li>
            </ul>
        </footer>
      
    </body>
</html>