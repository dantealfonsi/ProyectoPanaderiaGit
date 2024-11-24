<?php 
    define('Acceso', TRUE);
    include_once "../Vista/Includes/paths.php";
    include "iniciarSesion.php";
        
    
    //Conexion a la base de datos 
    include "conexion.php"; 
    
?>

<?php

if(isset($_GET['consultaexistencias'])){

    function compruebaExistencia($codigoinsumo,$cantidad){
        $Q_select_insumos="select * from insumos where codigo='$codigoinsumo'";
        $Q_result_insumos= mysqli_query($GLOBALS['conn'], $Q_select_insumos);
        $Q_fila_insumo = mysqli_fetch_assoc($Q_result_insumos);

        // Verifica si la existencia después de restar la cantidad es menor que el mínimo permitido
        if($Q_fila_insumo['existencia'] < $cantidad){
            if(($Q_fila_insumo['existencia'] - $cantidad) < $Q_fila_insumo['c_min']){
                return 0; // Indica que la existencia es menor que el mínimo permitido
            }
            else{
                return 1; // Indica que la existencia es suficiente
            }
        }
        else{
            return 1; // Indica que la existencia es suficiente
        }
    }

    function datosinsumo($codigoinsumo){
        $Q_select_insumos="select * from insumos where codigo='$codigoinsumo'";
        $Q_result_insumos= mysqli_query($GLOBALS['conn'], $Q_select_insumos);
        return $Q_fila_insumo = mysqli_fetch_assoc($Q_result_insumos);
    }

    $faltante = 0;
    $faltainsumo = false;
    $valido = false;
    $list = array();

    $obj = array('valido' => $valido, 'lista' => null );
    $idproducto = $_GET['codigo'];
    $cantidad = $_GET['cantidad'];

    $Q_select_IDreceta = "SELECT idreceta FROM productos WHERE idproducto = '$idproducto'";
    $Q_result_IDreceta = mysqli_query($GLOBALS['conn'], $Q_select_IDreceta);

    if ($Q_result_IDreceta) {
        $Q_IDreceta = mysqli_fetch_assoc($Q_result_IDreceta);
    } else {
        // Manejo de errores, por ejemplo:
        die('Error en la consulta: ' . mysqli_error($GLOBALS['conn']));
    }

    $idreceta = $Q_IDreceta['idreceta'];

    $consulta = "SELECT * FROM itemrecetas WHERE idreceta='$idreceta'";

    if($resultado = mysqli_query( $GLOBALS['conn'], $consulta )){
     while($row = mysqli_fetch_assoc($resultado)){
        if(compruebaExistencia($row['codigoinsumo'],$cantidad*$row['cantidad']) == 0){
            $faltante++;
            $faltainsumo = true;
        }
        else{
            $valido = true;
        }
        $list[] = array('falta' =>$faltainsumo, 'cantidad' => $row['cantidad'], 'unidad' => $row['uni'], 'insumo' => datosinsumo($row['codigoinsumo'])['nombre']);
        $faltainsumo = false;
     }

     if($faltante > 0){
        $valido = false;
     }else{
        $valido = true;
     }

     $obj = array(
        'valido' => $valido, 
        'lista' => $list);
    }

    echo json_encode($obj);
}

	/*****************************************************************************************************************
	NOTIFICACIONES*/
    function countNotif($IDusuario){
        $Q_consulta = "select COUNT(*) AS TOTAL from notificaciones WHERE idusuario=".$IDusuario." AND visto=0";
        $resultado= mysqli_query($GLOBALS['conn'], $Q_consulta);
        $row = mysqli_fetch_array($resultado);
        return $row['TOTAL'];
    }
   
    function notif($IDusuario){
        $cadena="";   
       $consulta = "DELETE FROM notificaciones WHERE idusuario=".$IDusuario." AND visto=1";
           $resultado = mysqli_query( $GLOBALS['conn'], $consulta );
   
       $consulta = "SELECT * FROM notificaciones WHERE idusuario=".$IDusuario." AND visto=0";
           if($resultado = mysqli_query( $GLOBALS['conn'], $consulta )){
            $obj=array();
            while($row = mysqli_fetch_array($resultado)){
                $obj[] = "<a href='{$row['ubicacion']}&notif={$row['id']}'>".$row['noticia']."</a>";
            }
           }
       return $obj;
     }
   
     if(isset($_POST['insertNotif'])){
        $Q_consulta = "INSERT INTO notificaciones(idusuario,noticia,ubicacion) VALUES(".$_POST['IDusuario'].",'".$_POST['noticia']."','{$_POST['ubicacion']}')";
        $resultado= mysqli_query($GLOBALS['conn'], $Q_consulta);
     }     
   
     if(isset($_GET['marcarNotif'])){
        $Q_consulta = "UPDATE notificaciones SET visto=1 WHERE id=".$_GET['idnotif'];
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

    function historiFecha($fecha){ 
        $date=date_create($fecha);
        return date_format($date,"d/m/Y");
    }

    /*
        SELECT productos.IDproducto, productos.nombre_producto, itempedido.cantidad, productos.precio_producto FROM itempedido INNER JOIN productos on itempedido.IDproducto = productos.IDproducto where itempedido.IDpedido = 10;
        SELECT pedido_usuario.fechaCreacion, pedido_usuario.telefono,pedido_usuario.direccion,transaccion.metodoPago, transaccion.estado FROM transaccion INNER JOIN pedido_usuario on pedido_usuario.IDpedido = transaccion.IDpedido where transaccion.IDpedido = 10;
        SELECT usuario.nombre, usuario.apellido,usuario.nombreUsuario, usuario.telefono,transaccion.IDusuario  FROM usuario INNER JOIN transaccion on transaccion.IDusuario = usuario.IDusuario WHERE transaccion.IDpedido=10;
    */
    $idPedido= $_GET['idpedido'];
    $Q_selecciona_tiket = "SELECT productos.idproducto, productos.nombre_producto, itempedido.iscustom,itempedido.motivo, itempedido.cantidad, productos.precio_producto FROM itempedido INNER JOIN productos on itempedido.idproducto = productos.idproducto where itempedido.idpedido =".$idPedido;
    $Q_selecciona_info_pedido =  "SELECT pedido_usuario.idusuario, pedido_usuario.fechacreacion,pedido_usuario.fechapedido, pedido_usuario.telefono,pedido_usuario.direccion,pedido_usuario.total,transaccion.metodopago, transaccion.estado FROM transaccion INNER JOIN pedido_usuario on pedido_usuario.idpedido = transaccion.idpedido where transaccion.idpedido =".$idPedido;    
    
    $resultado= mysqli_query($conn, $Q_selecciona_info_pedido);

    if(mysqli_num_rows($resultado) === 1){
        $infoPedido = mysqli_fetch_assoc($resultado);
    }

    $fechaPedido = $infoPedido['fechacreacion'];
    $fechaEntrega = historiFecha($infoPedido['fechapedido']);
    $telefono = $infoPedido['telefono'];
    $direccion = $infoPedido['direccion'];
    $total = $infoPedido['total'];
    $metodoPago = $infoPedido['metodopago'];
    $estado = $infoPedido['estado'];

    $Q_selecciona_info_usuario = "SELECT * from usuario where idusuario=".$infoPedido['idusuario'];
    
    $resultado2= mysqli_query($conn, $Q_selecciona_info_usuario);

    if(mysqli_num_rows($resultado2) === 1){
        $infoUsuario = mysqli_fetch_assoc($resultado2);
    }

    $nombre = $infoUsuario['nombre'];
    $apellido = $infoUsuario['apellido'];
    $usuario = $infoUsuario['nombreusuario'];
    $IDusuario = $infoUsuario['idusuario'];

    $resultado3 = mysqli_query($conn, $Q_selecciona_tiket);
    $tiket=" <table class='table table-bordered'>
    <thead>
        <tr style='background: linear-gradient(-11deg, #E994B3, #FAD2DD);color: #000000;'>
            <th style='padding:1rem;'>Producto</th>
            <th style='padding:1rem;'>Cantidad</th>
            <th style='padding:1rem;'>Precio</th>
        </tr>
    </thead>
    <tbody>";
    while($fila = mysqli_fetch_assoc($resultado3)):
        $motivo="";
        if($fila['iscustom']==1){
            $motivo=" /Motivo: <b>". $fila['motivo']."</b>";
        }
        $tiket = $tiket . "<tr><td style='text-transform:capitalize;'>".$fila['nombre_producto']. $motivo."</td><td>".$fila['cantidad']."</td><td>".$fila['precio_producto']."</td></tr>";
    endwhile;
        $tiket = $tiket . "</tbody></table><br><span style='font-size: 2rem;font-weight: 700;text-decoration: underline;font-family: 'roboto';'>Total a Pagar:
        </span><span style='font-size: 2rem;color: white;background: linear-gradient(45deg, #D12B69, #ffa5a5);padding: 0.5rem;margin-left: 1rem;font-weight: 700;border-radius: 1rem;'>".$total."</span>";
  
    $obj = array('fechaEntrega' => $fechaEntrega, 'fechaPedido' => $fechaPedido,'telefono' => $telefono, 'direccion' => $direccion,
    'total' => $total, 'metodoPago' => $metodoPago, 'estado' => $estado, 'tiket' => $tiket, 'numPedido' => $idPedido,
    'nombre' => $nombre,'apellido' => $apellido,'usuario' => $usuario,'IDusuario' => $IDusuario);
  
    echo json_encode($obj);  

    }

    if(isset($_GET['aceptarPedido'])){
        $idpedido= $_GET['idpedido'];
        $consulta = "update pedido_usuario set estado = 'ACEPTADO' where idpedido=$idpedido";
        $resultado= mysqli_query($conn, $consulta);
    }

    if(isset($_GET['rechazarPedido'])){
        $idpedido= $_GET['idpedido'];
        $consulta = "update pedido_usuario set estado = 'RECHAZADO' where idpedido=$idpedido";
        $resultado= mysqli_query($conn, $consulta);
    }    

?>