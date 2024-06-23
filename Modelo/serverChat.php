<?php 
    define('Acceso', TRUE);

    //INICIAR SESIÓN
	include_once "../Vista/Includes/paths.php";
    include "iniciarSesion.php";
    //CONEXIÓN A LA BASE DE DATOS : tiendadepasteles
    include "conexion.php"; 
?>

<?php
  //*******************************************************************************************************************
  //CHAT
$conexion = $conn;

	function insertNotif($IDusuario,$noticia,$ubicacion){
		$Q_consulta = "INSERT INTO notificaciones (idusuario,noticia,ubicacion) VALUES(".$IDusuario.",'".$noticia."','{$ubicacion}')";
		$resultado= mysqli_query($GLOBALS['conn'], $Q_consulta);
	}

	if (isset($_POST['cerrarchat'])){
		if (strlen($_POST['tickedchat'])>0){
			cerrarChat($_POST['tickedchat']);
		}
	}

	if(isset($_POST['cambiarEstado'])){
		if(strlen($_POST['estado']) !="null"){
			$consulta = "UPDATE transaccion SET estado='{$_POST['estado']}' WHERE idpedido=".$_POST['tickedchat']."";
			$consulta2 = "UPDATE pedido_usuario SET estado='{$_POST['estado']}' WHERE idpedido=".$_POST['tickedchat']."";
			$row = mysqli_query( $GLOBALS['conexion'], $consulta );
			$row2 = mysqli_query( $GLOBALS['conexion'], $consulta2 );
			echo $_POST['estado'];
		}		
	}

	if (isset($_POST['insertchat'])){
		if($_SESSION['esAdmin']==1){
			$recibe=$_POST['recibe'];			
		}
		else{
			//un usuario administrador tiene que recibir
			$recibe= "5";
		}

		if (Strlen($_POST['mensaje'])>0){
			//($amo,$ticked,$envia,$recibe,$mensaje)
			insertChat($_SESSION['idusuario'],$_POST['tickedchat'],$_POST['envia'],$recibe,$_POST['mensaje']); 
			$chat_path = $GLOBALS['ROOT_PATH']."/Vista/Admin/chat.php";
			if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] == 1){
				$chat_path = $GLOBALS['ROOT_PATH']."/Vista/Admin/panelAdmin.php";
			}
			insertNotif($recibe,"Pedido #".$_POST['pedido']." Tiene un Nuevo Mensaje ",$chat_path."?chat=&idpedido=".$_POST['pedido']);
		}

		//if (($_SESSION['esAdmin']) > 0) updateColor($_POST['tickedchat'],readVendedor($_SESSION['user'])['CORREO'],"#BABAEE","#000000");

		//dibujaChatApp($_POST['tickedchat']);
	}

  function makeChat($ticked){
	  $consulta = "select * from chat where idpedido='".$ticked."' order by fecha asc";
	  $resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
	  $cadena="<table style='width: 100%; padding: 13px 0;'>";
	  while($row = mysqli_fetch_array($resultado)){
			$cadena=$cadena . "<tr><td style='font-size:11px;'>".$row['fecha']." - ".$row['envia']."</td></tr>
				<tr><td style='background-color:".$row['bg']."; color=".$row['fg'].";'>".$row['mensaje']."</td></tr>";
	  }
	  $cadena = $cadena."</table>";
	  //mysqli_close($conexion);
	  return $cadena;
  }

  function ifChatActivo($correo) {
    $consulta = "SELECT activo FROM chat WHERE amo = '".$correo."'";
    $resultado = mysqli_query($GLOBALS['conexion'], $consulta) or die("No se pudo Consultar el Chat");
    $row = mysqli_fetch_array($resultado);
    return isset($row['activo']) && $row['activo'] == 1;
}
 
 
  /*function ifChatActivo($correo){
	$p=0;
	$consulta = "select activo from chat where amo='".$correo."'";
	$resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
	$row = mysqli_fetch_array($resultado);
	if(!empty($row['activo']))$p=$row['activo'];
	if($p==0) return FALSE;
	else return TRUE;
  }*/

  function ifAmoExist($correo){
	$consulta = "select * from chat where amo='".$correo."'";
	$resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
	$row = mysqli_fetch_array($resultado);
	if($row['amo']=="$correo") return TRUE;
	return FALSE;
  }

  function ifChatCerrado($ticked){
	$consulta = "select * from chat where idpedido='".$ticked."'";
    $resultado = mysqli_query($GLOBALS['conexion'], $consulta) or die("No se pudo Consultar el Chat");
    $row = mysqli_fetch_array($resultado);
    return isset($row['cerrado']) && $row['cerrado'] == 1;
  }

  function chatSinLeer($ticked,$recibe){
	$consulta = "select leido, COUNT(*) AS TOTAL from chat where idpedido='".$ticked."' AND leido=0 AND recibe='".$recibe."'";
	$resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
	$row = mysqli_fetch_array($resultado);
	if($row['TOTAL']>0) return $row['TOTAL'];
	else return 0;
  }

  function bgChatColor(){
	$bgAdmin =  "#ff7380";
	$bgUser = "#DADFE8";

	 if($_SESSION['esAdmin']==1) return $bgAdmin;
	 else return $bgUser;
  }

  function cerrarChat($ticked){
	$consulta = "UPDATE chat SET cerrado=1 WHERE idpedido='".$ticked."'";
	$row = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
  }

  function activarChat($correo,$estatus){
	$consulta = "UPDATE chat SET activo=".$estatus." WHERE amo='".$correo."'";
	$row = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");	
  }


  function chatLeido($ticked,$IDusuario){
	$consulta = "UPDATE chat SET leido=1 WHERE idpedido='".$ticked."' AND recibe=".$IDusuario;
	$row = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
  }

  function insertChat($amo,$ticked,$envia,$recibe,$mensaje){
	$consulta = "INSERT INTO chat(amo,idpedido,envia,recibe,mensaje,bg) VALUES('".$amo."','".$ticked."','".$envia."','".$recibe."','".$mensaje."','".bgChatColor()."')";
	$row = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
  }

  function createAmo($correo,$tk){
	  if(ifAmoExist($correo)==FALSE){
		$consulta = "INSERT INTO chat(amo,idpedido) VALUES('".$correo."','".$tk."')";
		$row = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
			return 1;
	  }
	  else{
		  return 0;
	  }
  }

 function updateColor($ticked,$envia,$bg,$fg){
	$consulta = "UPDATE chat SET bg='".$bg."',fg='".$fg."' WHERE idpedido='".$ticked."' AND envia='".$envia."'";
	$row = mysqli_query($GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");	
  }

  function latinFecha($fecha){
	$date=date_create($fecha);
	return date_format($date,"d/M/y h:ia");
}

function readCliente($IDusuario){
	$consulta = "select * from usuario where idusuario='".$IDusuario."'";
	$resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");	
	$row = mysqli_fetch_array($resultado);
	return $row;
} 
  function dibujaChatApp($ticket) {
	  $consulta = "select * from chat where idpedido='".$ticket."' order by fecha asc";
	  $resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
	  $activo="";
	  $recibe="";
	  $amo="";
	  while($row = mysqli_fetch_array($resultado)){
	  		$icono="";
			$recibe=$row['recibe'];
			$amo=$row['amo'];
			if($row['envia']==$row['amo']){
				$activo=$row['envia'];
			}
			else $activo=$row['recibe'];

			if(ifChatActivo($activo)){
				$icono= "<span style='font-weight: lighter; font-size:11px;' title='Conectado'>&#9742;</span>";
			}
			else{
				$icono= "<span style='font-weight: lighter; font-size:11px;' title='Desconectado'>&#9743;</span>";
			}

			echo "
			<div style='width: fit-content; padding:10px; border-radius:8px;margin:13px; background-color:".$row['bg']."; color=".$row['fg'].";'>
			<span style='margin-top:5px;font-size:12px;'><b>".latinFecha($row['fecha'])."</b>  ".readCliente($row['envia'])['nombre']." ".$icono."</span>
			<br><span style='font-weight: bolder;font-size:1em;'>".$row['mensaje']."</div>
			";
	  }

		if($activo==$amo){$activo=$recibe;}

      //mysqli_close($GLOBALS['conexion']);
  }

  if(isset($_POST['verChatApp'])) {
  	dibujaChatApp($_POST['verChatApp']);
	chatLeido($_POST['verChatApp'],$_POST['IDusuario']);
  }
?>