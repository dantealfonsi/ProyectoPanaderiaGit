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
    $Q_seleccionar_telefono_usuario = 'SELECT telefono FROM usuario WHERE idusuario = '.$_SESSION['IDusuario'];
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
    $fechaString = date('Y-m-d', strtotime($_POST['fechaentrega']));
    $Q_insertar_pedido_usuario ='INSERT INTO pedido_usuario (fechapedido, idusuario, total, direccion, telefono, municipio,localidad) 
    VALUES ("'.$fechaString.'",'.$_SESSION['IDusuario'].','.$_SESSION['precio_total'].',"'.$_POST['direccion'].'","'.$_SESSION['telefono'].'","'.$_POST['municipio'].'","'.$_POST['localidad'].'")';
    $ejecutar_insertar_pedido_usuario = mysqli_query($conn, $Q_insertar_pedido_usuario);

    //INSERTAR EN itempedido

    //SELECCIONAR PRIMERO LOS DATOS NECESARIOS
    $Q_seleccionar_todos_itemcarrito = 'SELECT * FROM itemcarrito WHERE idcarrito ='.$_SESSION['IDcarrito'];
    $ejecutar_seleccionar_todos_itemcarrito = mysqli_query($conn, $Q_seleccionar_todos_itemcarrito);

    $Q_seleccionar_orderID = 'SELECT idpedido FROM pedido_usuario WHERE idusuario ='. $_SESSION['IDusuario'].' ORDER BY idpedido DESC LIMIT 1';
    $ejecutar_seleccionar_orderID = mysqli_query($conn, $Q_seleccionar_orderID);
    $resultado3 = mysqli_fetch_array($ejecutar_seleccionar_orderID, MYSQLI_NUM);

    $_SESSION['IDpedido'] = $resultado3[0];

    //RECORRER CADA ARTÍCULO DEL CARRITO
    while($row = mysqli_fetch_assoc($ejecutar_seleccionar_todos_itemcarrito)){

        //INSERTAR CADA ARTÍCULO DEL CARRITO COMO ARTÍCULO DE PEDIDO EN LA TABLA itempedido
        $Q_insertar_itempedido = 'INSERT INTO itempedido (idproducto, idpedido, precio, cantidad,iscustom,motivo) 
        VALUES ('.$row['idproducto'].', '.$_SESSION['IDpedido'].','.$row['precio'].','.$row['cantidad'].','.$row['iscustom'].',"'.$row['motivo'].'")';
        $ejecutar_insertar_itempedido = mysqli_query($conn,  $Q_insertar_itempedido);
    }
    

    //INSERTAR EN transaccion 
    $Q_insertar_en_transaccion = 'INSERT INTO transaccion (idusuario, idpedido, metodoPago, estado)
    VALUES ( '.$_SESSION['IDusuario'].', '.$_SESSION['IDpedido'].',"'.$_POST['metodoPago'] .'","SOLICITUD" )';
    $ejecutar_insertar_en_transaccion = mysqli_query($conn, $Q_insertar_en_transaccion);
    

    //DESPUÉS DE INSERTAR DATOS EN LAS TABLAS, TENEMOS QUE ELIMINAR LA SESIÓN DEL CARRITO DE COMPRAS
    foreach($_SESSION['carrito_compras'] as $key => $producto){
        unset($_SESSION['carrito_compras'][$key]);

    }//Terminar foreach


    //ELIMINAR VALORES DE itemcarrito DESPUÉS DEL PAGO
    $Q_eliminar_itemcarrito = 'DELETE FROM itemcarrito WHERE idcarrito ='.$_SESSION['IDcarrito'];
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

    <style>
    
        @font-face {
            font-family: button;
            src: url(../../css/button.ttf) format('truetype');
            }
            
            @font-face {
            font-family: roboto;
            src: url(../../css/roboto.ttf) format('truetype');
            }

            @font-face {
            font-family: candy;
            src: url(../../css/candy.ttf) format('truetype');
            }

            .thankYouImage{
                max-width: 17%;
                background: linear-gradient(45deg, #ff9ea7, transparent);
                border-radius: 50%;
                padding: 2rem;
                box-shadow: 1px 1px 20px 3px #979797;
            }

            @media screen and (max-width: 950px){
    
                .thankYouImage{
                    max-width: 30% !important;
                    padding: .5rem !important;
                }
            
  
            }


    </style>

    <body >

        <!-- TÍTULO -->
        <div class="py-5 text-center">
        <h1 class="nombre-empresa" style="font-size: 4rem;font-family: 'candy';color: #c31f5c;letter-spacing: 1px;">Dulce Amor</h1>
            
            <img class="thankYouImage  my-5 rotate" src="../../Assets/images/cart/sun.png" />
         
            <h1 style="font-size: 3rem;font-weight: bold;">¡Gracias por comprar con nosotros!</h1>
            <h2 style='margin-bottom: 2rem;'>Tu Pedido esta en espera de ser aceptado.</h2>
            <a href="../LoginComponent/historialUsuario.php" class=" btn btn-primary btn-lg button" style="font-size:1.5rem;">Ver Mi Compra</a>
        </div>
    
         <!-- PIE DE PÁGINA  -->
        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2024 PANADERIA DULCE AMOR</p>
        </footer>
      
    </body>
</html>