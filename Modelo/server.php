<?php 
    define('Acceso', TRUE);
    include_once "../Vista/Includes/paths.php";
    include "iniciarSesion.php";
        
    
    //Conexion a la base de datos 
    include "conexion.php"; 
    
?>

<?php

	/*****************************************************************************************************************
	NOTIFICACIONES*/
    function countNotif($IDusuario){
        $Q_consulta = "select COUNT(*) AS TOTAL from notificaciones WHERE IDusuario=".$IDusuario." AND VISTO=0";
        $resultado= mysqli_query($GLOBALS['conn'], $Q_consulta);
        $row = mysqli_fetch_array($resultado);
        return $row['TOTAL'];
    }
   
    function notif($IDusuario){
        $cadena="";   
       $consulta = "DELETE FROM notificaciones WHERE IDusuario=".$IDusuario." AND VISTO=1";
           $resultado = mysqli_query( $GLOBALS['conn'], $consulta );
   
       $consulta = "SELECT * FROM notificaciones WHERE IDusuario=".$IDusuario." AND VISTO=0";
           if($resultado = mysqli_query( $GLOBALS['conn'], $consulta )){
            $obj=array();
            while($row = mysqli_fetch_array($resultado)){
                $obj[] = "<a href='{$row['UBICACION']}&notif={$row['ID']}'\">".$row['NOTICIA']."</a>";
            }
           }
       return $obj;
     }
   
     if(isset($_POST['insertNotif'])){
        $Q_consulta = "INSERT INTO notificaciones(IDusuario,NOTICIA,UBICACION) VALUES(".$_POST['IDusuario'].",'".$_POST['noticia']."','{$_POST['ubicacion']}')";
        $resultado= mysqli_query($GLOBALS['conn'], $Q_consulta);
     }     
   
     if(isset($_GET['marcarNotif'])){
        $Q_consulta = "UPDATE notificaciones SET VISTO=1 WHERE ID=".$_GET['idnotif'];
        $resultado= mysqli_query($GLOBALS['conn'], $Q_consulta);
     }
   
     if(isset($_GET['vernotif'])){
        $obj = array('noticias' => notif($_GET['IDusuario']),'totalNotif' => countNotif($_GET['IDusuario']));
        $json = json_encode($obj);
        echo $json;
     }
   
       /****FIN NOTIFICACIONES**************************************************************************
       */

 if(isset($_GET['tiketPedido'])){

    /*
        SELECT productos.IDproducto, productos.nombre_producto, itempedido.cantidad, productos.precio_producto FROM itempedido INNER JOIN productos on itempedido.IDproducto = productos.IDproducto where itempedido.IDpedido = 10;
        SELECT pedido_usuario.fechaCreacion, pedido_usuario.telefono,pedido_usuario.direccion,transaccion.metodoPago, transaccion.estado FROM transaccion INNER JOIN pedido_usuario on pedido_usuario.IDpedido = transaccion.IDpedido where transaccion.IDpedido = 10;
        SELECT usuario.nombre, usuario.apellido,usuario.nombreUsuario, usuario.telefono,transaccion.IDusuario  FROM usuario INNER JOIN transaccion on transaccion.IDusuario = usuario.IDusuario WHERE transaccion.IDpedido=10;
    */
    $idPedido= $_GET['idpedido'];
    $Q_selecciona_tiket = "SELECT productos.IDproducto, productos.nombre_producto, itempedido.cantidad, productos.precio_producto FROM itempedido INNER JOIN productos on itempedido.IDproducto = productos.IDproducto where itempedido.IDpedido =".$idPedido;
    $Q_selecciona_info_pedido =  "SELECT pedido_usuario.IDusuario, pedido_usuario.fechaCreacion, pedido_usuario.telefono,pedido_usuario.direccion,pedido_usuario.total,transaccion.metodoPago, transaccion.estado FROM transaccion INNER JOIN pedido_usuario on pedido_usuario.IDpedido = transaccion.IDpedido where transaccion.IDpedido =".$idPedido;    
    
    $resultado= mysqli_query($conn, $Q_selecciona_info_pedido);

    if(mysqli_num_rows($resultado) === 1){
        $infoPedido = mysqli_fetch_assoc($resultado);
    }

    $fechaPedido = $infoPedido['fechaCreacion'];
    $telefono = $infoPedido['telefono'];
    $direccion = $infoPedido['direccion'];
    $total = $infoPedido['total'];
    $metodoPago = $infoPedido['metodoPago'];
    $estado = $infoPedido['estado'];

    $Q_selecciona_info_usuario = "SELECT * from usuario where IDusuario=".$infoPedido['IDusuario'];
    
    $resultado2= mysqli_query($conn, $Q_selecciona_info_usuario);

    if(mysqli_num_rows($resultado2) === 1){
        $infoUsuario = mysqli_fetch_assoc($resultado2);
    }

    $nombre = $infoUsuario['nombre'];
    $apellido = $infoUsuario['apellido'];
    $usuario = $infoUsuario['nombreUsuario'];
    $IDusuario = $infoUsuario['IDusuario'];

    $resultado3 = mysqli_query($conn, $Q_selecciona_tiket);
    $tiket=" <table class='table table-bordered'>
    <thead class=thead-dark>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>";
    while($fila = mysqli_fetch_assoc($resultado3)):
        $tiket = $tiket . "<tr><td>".$fila['nombre_producto']."</td><td>".$fila['cantidad']."</td><td>".$fila['precio_producto']."</td></tr>";
    endwhile;
        $tiket = $tiket . "</tbody></table><br>Total a Pagar:".$total;
  
    $obj = array('fechaPedido' => $fechaPedido,'telefono' => $telefono, 'direccion' => $direccion,
    'total' => $total, 'metodoPago' => $metodoPago, 'estado' => $estado, 'tiket' => $tiket, 'numPedido' => $idPedido,
    'nombre' => $nombre,'apellido' => $apellido,'usuario' => $usuario,'IDusuario' => $IDusuario);
  
    echo json_encode($obj);  

    }

?>