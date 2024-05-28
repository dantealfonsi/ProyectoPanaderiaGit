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
		$Q_consulta = "INSERT INTO notificaciones (IDusuario,NOTICIA,UBICACION) VALUES(".$IDusuario.",'".$noticia."','{$ubicacion}')";
		$resultado= mysqli_query($GLOBALS['conn'], $Q_consulta);
	}

	if (isset($_POST['cerrarchat'])){
		if (strlen($_POST['tickedchat'])>0){
			cerrarChat($_POST['tickedchat']);
		}
	}

	if(isset($_POST['cambiarEstado'])){
		if(strlen($_POST['estado']) !="null"){
			$consulta = "UPDATE transaccion SET estado='{$_POST['estado']}' WHERE IDpedido=".$_POST['tickedchat']."";
			$consulta2 = "UPDATE pedido_usuario SET estado='{$_POST['estado']}' WHERE IDpedido=".$_POST['tickedchat']."";
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
			insertChat($_SESSION['IDusuario'],$_POST['tickedchat'],$_POST['envia'],$recibe,$_POST['mensaje']);
			insertNotif($recibe,"Pedido #".$_POST['pedido']." Tiene un Nuevo Mensaje ",$GLOBALS['ROOT_PATH']."/Vista/Admin/chat.php?idpedido=".$_POST['pedido']);
		}

		//if (($_SESSION['esAdmin']) > 0) updateColor($_POST['tickedchat'],readVendedor($_SESSION['user'])['CORREO'],"#BABAEE","#000000");

		//dibujaChatApp($_POST['tickedchat']);
	}

  function makeChat($ticked){
	  $consulta = "select * from CHAT where IDpedido='".$ticked."' order by fecha asc";
	  $resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
	  $cadena="<table style='width: 100%; padding: 13px 0;'>";
	  while($row = mysqli_fetch_array($resultado)){
			$cadena=$cadena . "<tr><td style='font-size:11px;'>".$row['FECHA']." - ".$row['ENVIA']."</td></tr>
				<tr><td style='background-color:".$row['BG']."; color=".$row['FG'].";'>".$row['MENSAJE']."</td></tr>";
	  }
	  $cadena = $cadena."</table>";
	  //mysqli_close($conexion);
	  return $cadena;
  }

  function ifChatActivo($correo){
	$p=0;
	$consulta = "select ACTIVO from CHAT where AMO='".$correo."'";
	$resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
	$row = mysqli_fetch_array($resultado);
	if(!empty($row['ACTIVO']))$p=$row['ACTIVO'];
	if($p==0) return FALSE;
	else return TRUE;
  }

  function ifAmoExist($correo){
	$consulta = "select * from CHAT where AMO='".$correo."'";
	$resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
	$row = mysqli_fetch_array($resultado);
	if($row['AMO']=="$correo") return TRUE;
	return FALSE;
  }

  function ifChatCerrado($ticked){
	$consulta = "select * from CHAT where IDpedido='".$ticked."'";
	$resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");	
	$row = mysqli_fetch_array($resultado);
	if($row['CERRADO']==1) return TRUE;
	return FALSE;
  }

  function chatSinLeer($ticked,$recibe){
	$consulta = "select LEIDO, COUNT(*) AS TOTAL from CHAT where IDpedido='".$ticked."' AND LEIDO=0 AND RECIBE='".$recibe."'";
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
	$consulta = "UPDATE CHAT SET CERRADO=1 WHERE IDpedido='".$ticked."'";
	$row = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
  }

  function activarChat($correo,$estatus){
	$consulta = "UPDATE CHAT SET ACTIVO=".$estatus." WHERE AMO='".$correo."'";
	$row = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");	
  }


  function chatLeido($ticked,$IDusuario){
	$consulta = "UPDATE CHAT SET LEIDO=1 WHERE IDpedido='".$ticked."' AND RECIBE=".$IDusuario;
	$row = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
  }

  function insertChat($amo,$ticked,$envia,$recibe,$mensaje){
	$consulta = "INSERT INTO CHAT(AMO,IDpedido,ENVIA,RECIBE,MENSAJE,BG) VALUES('".$amo."','".$ticked."','".$envia."','".$recibe."','".$mensaje."','".bgChatColor()."')";
	$row = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
  }

  function createAmo($correo,$tk){
	  if(ifAmoExist($correo)==FALSE){
		$consulta = "INSERT INTO CHAT(AMO,IDpedido) VALUES('".$correo."','".$tk."')";
		$row = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
			return 1;
	  }
	  else{
		  return 0;
	  }
  }

 function updateColor($ticked,$envia,$bg,$fg){
	$consulta = "UPDATE CHAT SET BG='".$bg."',FG='".$fg."' WHERE IDpedido='".$ticked."' AND ENVIA='".$envia."'";
	$row = mysqli_query($GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");	
  }

  function latinFecha($fecha){
	$date=date_create($fecha);
	return date_format($date,"d/M/y h:ia");
}

function readCliente($IDusuario){
	$consulta = "select * from usuario where IDusuario='".$IDusuario."'";
	$resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");	
	$row = mysqli_fetch_array($resultado);
	return $row;
} 
  function dibujaChatApp($ticket) {
	  $consulta = "select * from CHAT where IDpedido='".$ticket."' order by FECHA asc";
	  $resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
	  $activo="";
	  $recibe="";
	  $amo="";
	  while($row = mysqli_fetch_array($resultado)){
	  		$icono="";
			$recibe=$row['RECIBE'];
			$amo=$row['AMO'];
			if($row['ENVIA']==$row['AMO']){
				$activo=$row['ENVIA'];
			}
			else $activo=$row['RECIBE'];

			if(ifChatActivo($activo)){
				$icono= "<span style='font-weight: lighter; font-size:11px;' title='Conectado'>&#9742;</span>";
			}
			else{
				$icono= "<span style='font-weight: lighter; font-size:11px;' title='Desconectado'>&#9743;</span>";
			}

			echo "
			<div style='width: fit-content; padding:10px; border-radius:8px;margin:13px; background-color:".$row['BG']."; color=".$row['FG'].";'>
			<span style='margin-top:5px;font-size:12px;'><b>".latinFecha($row['FECHA'])."</b>  ".readCliente($row['ENVIA'])['nombre']." ".$icono."</span>
			<br><span style='font-weight: bolder;font-size:1em;'>".$row['MENSAJE']."</div>
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