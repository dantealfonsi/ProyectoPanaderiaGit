<?php
    //include_once "../Vista/Includes/paths.php";
    //include "iniciarSesion.php";

/*Creacion de la Clase del Modulo */ 
class Modulo{

public $servidor = "localhost";   /*Nombre del servidor*/

public $database = "tiendapanaderia"; /*Nombre de la base de datos*/

public $user =  "root"; /*Nombre del Usuario*/
 
public $password = ""; /*Contraseña de la base de datos*/


/*Funcion de Encriptado de contraseña*/

public function encrypt($string, $key) {
  $result = '';
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)+ord($keychar));
    $result.=$char;
  }
  return base64_encode($result);   /*Codificado del resultado*/
}


/*************CREACION DE TABLAS*************/

/*Conexion a la base de datos*/

public function mysqlconnect(){
  $conexion = mysqli_connect($this->servidor,$this->user,$this->password,$this->database) or die ("Error de Conaxion: ". mysqli_connect_error());
  return $conexion;
}


/*Creacion de Tablas*/

public function crear(){
  date_default_timezone_set('America/Caracas');
  $conexion = mysqli_connect($this->servidor,$this->user,$this->password,$this->database) or die ("Error de Conexion: ". mysqli_connect_error());
  //$consulta = "CREATE DATABASE IF NOT EXISTS tiendapanaderia";
 // $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion de la base de Datos");
  $consulta = "CREATE TABLE IF NOT EXISTS INSUMOS (CODIGO VARCHAR(15) NOT NULL PRIMARY KEY, NOMBRE VARCHAR(34), ALMACEN INT NOT NULL DEFAULT 0,PRECIO DECIMAL(10,2) NOT NULL DEFAULT 0.00,EXISTENCIA INT NOT NULL DEFAULT 0, CATEGORIA VARCHAR(34), C_MIN INT NOT NULL DEFAULT 0,C_MAX INT NOT NULL DEFAULT 0,DELETED INT NOT NULL DEFAULT 0)";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: inventario");
/*  $consulta = "CREATE TABLE IF NOT EXISTS USUARIOS (PASSWORD VARCHAR(50),NOMBRE VARCHAR(34),NIVEL INT NOT NULL DEFAULT 0, CEDULA INT(9) NOT NULL PRIMARY KEY, DELETED INT NOT NULL DEFAULT 0)";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: usuarios");*/
  $consulta = "CREATE TABLE IF NOT EXISTS PROVEEDOR (RIF VARCHAR(50) NOT NULL PRIMARY KEY,NOMBRE VARCHAR(34) NOT NULL,TELEFONO VARCHAR(15),DIRECCION VARCHAR(50), DELETED INT NOT NULL DEFAULT 0)";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: usuarios");
  $consulta = "CREATE TABLE IF NOT EXISTS ENTRADA (FECHA TIMESTAMP DEFAULT CURRENT_TIMESTAMP, RESPONSABLE INT(9), NUM_ENTRADA INT NOT NULL DEFAULT 0 PRIMARY KEY,PROVEEDOR VARCHAR(34), DEVUELTO TINYINT DEFAULT 0)";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: inventario");
  $consulta = "CREATE TABLE IF NOT EXISTS SALIDA (FECHA TIMESTAMP DEFAULT CURRENT_TIMESTAMP, RESPONSABLE INT(9), NUM_SALIDA INT NOT NULL DEFAULT 0 PRIMARY KEY,MOTIVO TEXT, CEDULA_CLIENTE INT(9),SUBTOTAL DECIMAL(13,2) DEFAULT 0.00, IVA DECIMAL(13,2) DEFAULT 0.00, TOTAL DECIMAL(13,2) DEFAULT 0.00, DEVUELTO TINYINT DEFAULT 0)";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: inventario");
  $consulta = "CREATE TABLE IF NOT EXISTS CATEGORIA_INSUMOS (ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,NOMBRE VARCHAR(34))";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: usuarios");


  $consulta = "CREATE TABLE IF NOT EXISTS DEVOLUCION_ENTRADA (FECHA TIMESTAMP DEFAULT CURRENT_TIMESTAMP, RESPONSABLE INT(9), REFERENCIA INT NOT NULL DEFAULT 0 PRIMARY KEY ,MOTIVO TEXT,PROVEEDOR VARCHAR(34))";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: inventario");
  $consulta = "CREATE TABLE IF NOT EXISTS DEVOLUCION_SALIDA (FECHA TIMESTAMP DEFAULT CURRENT_TIMESTAMP, RESPONSABLE INT(9), REFERENCIA INT NOT NULL DEFAULT 0 PRIMARY KEY,MOTIVO TEXT, CEDULA_CLIENTE INT(9),SUBTOTAL DECIMAL(13,2) DEFAULT 0.00, IVA DECIMAL(13,2) DEFAULT 0.00, TOTAL DECIMAL(13,2) DEFAULT 0.00)";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: inventario");


  $consulta = "CREATE TABLE IF NOT EXISTS CARAC_DEVOLUCION_ENTRADA (ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, FECHA TIMESTAMP DEFAULT CURRENT_TIMESTAMP,CODIGO_PRODUCTO VARCHAR(15),NOMBRE_PRODUCTO VARCHAR(34),CANTIDAD INT NOT NULL DEFAULT 0, REFERENCIA INT NOT NULL DEFAULT 0, PRECIO DECIMAL(10,2))";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: inventario");
  $consulta = "CREATE TABLE IF NOT EXISTS CARAC_DEVOLUCION_SALIDA (ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, FECHA TIMESTAMP DEFAULT CURRENT_TIMESTAMP,CODIGO_PRODUCTO VARCHAR(15),NOMBRE_PRODUCTO VARCHAR(34),CANTIDAD INT NOT NULL DEFAULT 0, REFERENCIA INT NOT NULL DEFAULT 0, CEDULA_CLIENTE INT(9) ,PRECIO DECIMAL(10,2))";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: inventario");



  /*$consulta = "CREATE TABLE IF NOT EXISTS PERSONA (CEDULA VARCHAR(15) NOT NULL PRIMARY KEY, NOMBRE VARCHAR(34), APELLIDO VARCHAR(34), TELEFONO VARCHAR(15),DIRECCION VARCHAR(50),CARGO VARCHAR(34), TIPO VARCHAR(34) DEFAULT 'CLIENTE', DELETED INT NOT NULL DEFAULT 0)";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: usuarios");
*/

  $consulta = "CREATE TABLE IF NOT EXISTS CARAC_ENTRADA (ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, FECHA TIMESTAMP DEFAULT CURRENT_TIMESTAMP,CODIGO_PRODUCTO VARCHAR(15),NOMBRE_PRODUCTO VARCHAR(34),CANTIDAD INT NOT NULL DEFAULT 0, NUM_ENTRADA INT NOT NULL DEFAULT 0, PRECIO DECIMAL(10,2))";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: inventario");
  $consulta = "CREATE TABLE IF NOT EXISTS CARAC_SALIDA (ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, FECHA TIMESTAMP DEFAULT CURRENT_TIMESTAMP,CODIGO_PRODUCTO VARCHAR(15),NOMBRE_PRODUCTO VARCHAR(34),CANTIDAD INT NOT NULL DEFAULT 0, NUM_SALIDA INT NOT NULL DEFAULT 0, CEDULA_CLIENTE INT(9))";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: inventario");
  $consulta = "CREATE TABLE IF NOT EXISTS HISTORIAL (ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, FECHA TIMESTAMP DEFAULT CURRENT_TIMESTAMP, NOMBRE_USUARIO VARCHAR(34),CEDULA INT(9) NOT NULL, UBICACION VARCHAR(255) )";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la creacion a la Tabla de datos: inventario");

/*Creacion de SuperUsuario Predeterminado

  if (!$this->siUsuarioExiste('ADMINISTRADOR')){
    $password = $this->encrypt('123456',$this->llave);
    $this->init_usuario('ADMINISTRADOR',$password,0,0,'ADMINISTRADOR');  
  }*/
  mysqli_close($conexion);
}

/*init_Usuario*/

public function init_usuario($nombre,$password,$nivel,$cedula){ 
  $consulta = "INSERT INTO USUARIOS(NOMBRE,PASSWORD,NIVEL,CEDULA) VALUES('".$nombre."','".$password."',".$nivel.",'{$cedula}')";
  $resultado = mysqli_query( $this->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en insertar el usuario");
}

/*CREACION DE FUNCION PARA INSERTAR EN TABLA HISTORIAL*/

public function historial($nombre,$cedula,$ubicacion){ 
  $this->sql_consulta("INSERT INTO HISTORIAL(NOMBRE_USUARIO,CEDULA,UBICACION) VALUES ('{$nombre}',{$cedula},'{$ubicacion}')");
}

/*FUNCIONES PARA VOLVER DINAMICO CON JQUERY ENTRADAS Y SALIDAS*/


/*CONEXION A LA BASE DE DATOS*/

public function sql_consulta($consulta){
  $conexion = mysqli_connect($this->servidor,$this->user,$this->password,$this->database) or die ("Error de Conaxion: ". mysqli_connect_error());
  $resultado = mysqli_query( $conexion, $consulta );
}

/*CONEXION A LA BASE DE DATOS*/

public function row_sqlconector($consulta) {
	$row=0;
	$conexion = @mysqli_connect($this->servidor,$this->user,$this->password,$this->database);
  if (!$conexion) {
    echo "Refresh page, Failed to connect to Data: " . mysqli_connect_error();
    exit();
  }else{
    if($resultado = mysqli_query( $conexion, $consulta )){
  		$row = mysqli_fetch_array($resultado);
  	}
  	mysqli_close($conexion);
  }
	return $row;
}

/*VERIFICACION SI EL USUARIO EXISTE*/

public function siUsuarioExiste($nombre){
  $conexion = mysqli_connect($this->servidor,$this->user,$this->password,$this->database) or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM USUARIOS WHERE NOMBRE='".$nombre."'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
  if ($row = mysqli_fetch_array($resultado))
    if(strlen($row['NOMBRE'])>0) 
      return TRUE;
  return FALSE;
  mysqli_close($conexion);
}

}


/*********************FIN DE LA CLASE MODUL0**************************/

/*FUNCION QUE GENERA NUMERO SALIDA*/

if (isset($_GET['num_salida'])){
  echo rand(800000,160000);
}


/*FUNCION DE PARA OBTENER LA INFORMACION DEL CLIENTE*/

if (isset($_GET['infoCliente'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM usuario WHERE IDusuario='".$_GET['cedula']."'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
  if ($row = mysqli_fetch_array($resultado))
  {
              /*Creacion de un array con la informacion del cliente para pasarla a un Json encode 
              y luego obtenerla del modulo en Salida*/

 $obj = array('IDusuario' => $row['IDusuario'], 'nombre' => $row['nombre'], 'apellido' => $row['apellido'],'direccion' => $row['direccion'], 'telefono' => $row['telefono'] );
  echo json_encode($obj);  
    }
 
  mysqli_close($conexion);
}


/*OBTENER INFORMACION DE TABLA DE SALIDAS TEMPORAL*/

if (isset($_POST['infoTemp'])){
    $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
    $subtotal= 0;
    $iva=0;           /*Variables de Total, subtotal.*/
    $total=0;
  
    $tabla_temp = "  
    <table style=width:100%>
    <thead>
    <tr>  
      <th>ACCIONES</th>
      <th>CODIGO</th>
      <th>PROUCTO</th>
      <th>CANTIDAD</th>
      <th>PRECIO</th>
    </tr>
    </thead>
    <tbody>
  ";
  
  $consulta3 = "SELECT * from {$_POST['tabla']}";
    
  $resultado3 = mysqli_query( $conexion, $consulta3 );
  $cedula = '';

  while($row = mysqli_fetch_array($resultado3)){
     
    $tabla_temp = $tabla_temp."

    <tr>
      <td><a onclick=borrar_producto({$row['ID']})><img id=icon-bt src='../../Assets/images/inventory/erase.png'></a></td>
      <td>{$row['CODIGO_PRODUCTO'] }</td> 
      <td>{$row['NOMBRE_PRODUCTO']}</td>
      <td>{$row['CANTIDAD']}</td>
      <td>{$row['PRECIO']}</td>
   </tr>   
  ";
  //calcula el subtotal de los insumos utilizados al costo
      //consulta todos los item de insumos utilizados de la receta a cocinar
      $Q_insumos = "select * from itemrecetas where IDproducto=".$row['CODIGO_PRODUCTO']."";
      $query = mysqli_query($conexion, $Q_insumos );
      while($item = mysqli_fetch_array($query)){
        $cantidad = $row['CANTIDAD'] * $item['cantidad'];

        //consulto el precio del insumo
        $Q_info_insumo="select PRECIO FROM INSUMOS WHERE CODIGO='".$item['codigoInsumo']."'";
        $query_info = mysqli_query($conexion, $Q_info_insumo );
        $item_info_insumo = mysqli_fetch_array($query_info);

        $subtotal = $subtotal + ($item_info_insumo['PRECIO'] * $cantidad);
      }
  

  $cedula = $row['CEDULA_CLIENTE'];
  }

  $tabla_temp = $tabla_temp. "</tbody></table>";
  $iva= $subtotal * 16/100;
  $total= $subtotal + $iva;
  
  $nombre=''; $apellido='';$direccion='';$telefono='';

  $consulta = "SELECT * FROM usuario WHERE IDusuario='{$cedula}'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");

  if ($row = mysqli_fetch_array($resultado))
  {
    $nombre=$row['nombre'];
    $apellido=$row['apellido'];
    $direccion=$row['direccion'];
    $telefono=$row['telefono'];
  }

  mysqli_close($conexion);

  /*ENVIAR INFORMACION DE SALIDA MEIDANTE ARRAY  */

  $obj = array('tabla' => $tabla_temp, 'subtotal' => $subtotal, 'iva' => $iva,'total' => $total,'cedula' => $cedula,'nombre' => $nombre,'apellido' => $apellido,'direccion' => $direccion,'telefono' => $telefono);
  echo json_encode($obj);    
}



/*INSERTAR EN TABLA DE SALIDA TEMPORAL */

if (isset($_POST['addTemp'])){ 
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * FROM productos WHERE IDproducto=".$_POST['codigo']."";
  $resultado = mysqli_query( $conexion, $consulta );
  if ($row = mysqli_fetch_array($resultado))
  {
    $consulta2 = "INSERT INTO {$_POST['tabla']} (CODIGO_PRODUCTO, NOMBRE_PRODUCTO, CANTIDAD,PRECIO,CEDULA_CLIENTE) VALUES ('{$row['IDproducto']}','{$row['nombre_producto']}',{$_POST['cantidad']},{$row['precio_producto']},{$_POST['cedula']})";
    $resultado2 = mysqli_query( $conexion, $consulta2 ) or die("Error en la Consulta a Usuarios");
  }
  mysqli_close($conexion);
}

/*OBTENER EXISTENCIA */

if (isset($_POST['getExistencia'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM INSUMOS WHERE CODIGO='".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
  if ($row = mysqli_fetch_array($resultado))
  {
    $obj = array('nombre' => $row['NOMBRE'], 'existencia' => $row['EXISTENCIA']);
    echo json_encode($obj);  
  }
 
  mysqli_close($conexion);

}

/*INSERTAR EN TABLA DE ENTRADA TEMPORAL */

/*OBTENER INFORMACION DE TABLA DE ENTRADA TEMPORAL*/

if (isset($_POST['infoTempE'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
    $subtotal= 0;
    $iva=0;
    $total=0;
  
    $tabla_temp = "
    <table style=width:100%>
    <thead>
    <tr>  
      <th>ACCIONES</th>
      <th>CODIGO</th>
      <th>PROUCTO</th>
      <th>CANTIDAD</th>
    </tr>
    </thead>
    <tbody>
  ";
  
  $consulta3 = "SELECT * from {$_POST['tabla']}";
    
  $resultado3 = mysqli_query( $conexion, $consulta3 ) or die("Error en la Consulta a Usuarios");
  $cedula = '';
  $proveedor = '';

  while($row = mysqli_fetch_array($resultado3)){
     
    $tabla_temp = $tabla_temp."

    <tr>
      <td><a onclick=borrar_producto({$row['ID']})><img id=icon-bt src='../../Assets/images/inventory/erase.png'></a></td>
      <td>{$row['CODIGO_PRODUCTO'] }</td> 
      <td>{$row['NOMBRE_PRODUCTO']}</td>
      <td>{$row['CANTIDAD']}</td>
   </tr>   
  ";
  $subtotal = $subtotal + $row['PRECIO'];
  $proveedor = $row['PROVEEDOR'];
  }
  $tabla_temp = $tabla_temp. "</tbody></table>";
  $iva= $subtotal * 16/100;
  $total= $subtotal + $iva;
  
    mysqli_close($conexion);

                        /*ENVIAR INFORMACION DE ENTRADA MEIDANTE ARRAY  */

  $obj = array('tabla' => $tabla_temp, 'subtotal' => $subtotal, 'iva' => $iva,'total' => $total,'proveedor' => $proveedor);
  echo json_encode($obj);    
}

     /*INSERTAR INFORMACION EN TABLA TEMPORAL DE ENTRADA  */

if (isset($_POST['addTempE'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM INSUMOS WHERE CODIGO='".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
  if ($row = mysqli_fetch_array($resultado))
  {
    $consulta2 = "INSERT INTO {$_POST['tabla']} (CODIGO_PRODUCTO, NOMBRE_PRODUCTO, CANTIDAD,PRECIO,PROVEEDOR) VALUES ('{$row['CODIGO']}','{$row['NOMBRE']}',{$_POST['cantidad']},{$row['PRECIO']},'{$_POST['proveedor']}')";
    $resultado2 = mysqli_query( $conexion, $consulta2 ) or die("Error en la Consulta a Usuarios");
  }
 
  mysqli_close($conexion);

}

/*LISTAR INSUMOS EN ENTRADA  */

if (isset($_POST['list_productos'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());  
  $consulta = "SELECT * from CARAC_ENTRADA WHERE NUM_ENTRADA=".$_POST['num_entrada'];
  $cadena = "";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");  
  while($row = mysqli_fetch_array($resultado)){
    $cadena=$cadena."<option value='{$row['CODIGO_PRODUCTO']}' label='{$row['NOMBRE_PRODUCTO']}'>";
  }

                /*RELLENAR INSUMOS Y PROVEEDOR*/

  $consulta2 = "SELECT PROVEEDOR from ENTRADA WHERE NUM_ENTRADA=".$_POST['num_entrada'];
  $resultado2 = mysqli_query( $conexion, $consulta2 ) or die("Error en la Consulta a Usuarios");  

  if ($row = mysqli_fetch_array($resultado2))
  {
    $obj = array('productos' => $cadena, 'proveedor' => $row['PROVEEDOR']);
    echo json_encode($obj);  
  }
  mysqli_close($conexion);

}

/*INSERTAR EN TABLA TEMPORAL DE DEVOLUCION DE ENTRADA */

if (isset($_POST['addTempDE'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM INSUMOS WHERE CODIGO='".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
  if ($row = mysqli_fetch_array($resultado))
  {
    $consulta2 = "INSERT INTO {$_POST['tabla']} (CODIGO_PRODUCTO, NOMBRE_PRODUCTO, CANTIDAD,PRECIO,PROVEEDOR) VALUES ('{$row['CODIGO']}','{$row['NOMBRE']}',{$_POST['cantidad']},{$row['PRECIO']},'{$_POST['proveedor']}')";
    $resultado2 = mysqli_query( $conexion, $consulta2 ) or die("Error en la Consulta a Usuarios");
  }
 
  mysqli_close($conexion);

}

 /*BORRAR TABLA TEMPORAL DE DEVOLUCION DE ENTRADA  */

if (isset($_POST['delete_tempDE'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "DELETE FROM {$_POST['tabla']}";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
 
  mysqli_close($conexion);

}


 /*ALMACENAR INFORMACION DE TABLA TEMPORAL DE ENTRADA  */

if (isset($_POST['infoTempDE'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
    $subtotal= 0;
    $iva=0;
    $total=0;
  
    $tabla_temp = "
    <table style=width:100%>
    <thead>
    <tr>  
      <th>ACCIONES</th>
      <th>CODIGO</th>
      <th>PROUCTO</th>
      <th>CANTIDAD</th>
    </tr>
    </thead>
    <tbody>
  ";
  
  $consulta3 = "SELECT * from {$_POST['tabla']}";
    
  $resultado3 = mysqli_query( $conexion, $consulta3 ) or die("Error en la Consulta a Usuarios");
  $cedula = '';
  $proveedor = '';

  while($row = mysqli_fetch_array($resultado3)){
     
    $tabla_temp = $tabla_temp."

    <tr>
      <td><a onclick=borrar_producto({$row['ID']})><img id=icon-bt src='../../Assets/images/inventory/erase.png'></a></td>
      <td>{$row['CODIGO_PRODUCTO'] }</td> 
      <td>{$row['NOMBRE_PRODUCTO']}</td>
      <td>{$row['CANTIDAD']}</td>
   </tr>   
  ";
  $subtotal = $subtotal + $row['PRECIO'];
  $proveedor = $row['PROVEEDOR'];
  }
  $tabla_temp = $tabla_temp. "</tbody></table>";
  $iva= $subtotal * 16/100;
  $total= $subtotal + $iva;
  
    mysqli_close($conexion);

                /*ENVIAR INFORMACION DE ENTRADA TEMPORAL MEIDANTE ARRAY  */

  $obj = array('tabla' => $tabla_temp, 'subtotal' => $subtotal, 'iva' => $iva,'total' => $total,'proveedor' => $proveedor);
  echo json_encode($obj);    
}


 /*OBTENER EXISTENCIA DE UNA ENTRADA MAXIMA*/

if (isset($_POST['getExistenciaEntrada'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM CARAC_ENTRADA WHERE NUM_ENTRADA=".$_POST['referencia']." AND CODIGO_PRODUCTO = '".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
  if ($row = mysqli_fetch_array($resultado))
  {
    $obj = array('nombre' => $row['NOMBRE_PRODUCTO'], 'existencia' => $row['CANTIDAD']);
    echo json_encode($obj);  
  }
 
  mysqli_close($conexion);

}

/*Record Count de Tabla*/

if (isset($_GET['recordCountTemp'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM {$_GET['temp']}";
  
  
  if ($resultado = mysqli_query($conexion, $consulta)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $resultado );
    
    // Display result
    echo $rowcount ;
 }
 
  mysqli_close($conexion);

}

if (isset($_GET['recordCountTempProducto'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM {$_GET['temp']} WHERE DELETED=0";
  
  if ($resultado = mysqli_query($conexion, $consulta)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $resultado );
    
    // Display result
    echo $rowcount ;
 }
 
  mysqli_close($conexion);

}


if (isset($_GET['recordCountEntSal'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM {$_GET['temp']} WHERE WHERE FECHA BETWEEN '2023-08-10 00:00:00' AND '2023-08-10 23:59:59'";
  
  if ($resultado = mysqli_query($conexion, $consulta)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $resultado );
    
    // Display result
    echo $rowcount ;
 }
 
  mysqli_close($conexion);

}


/*INSERTAR EN TABLA TEMPORAL DE DEVOLUCION DE SALIDA */

if (isset($_POST['addTempDS'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM INSUMOS WHERE CODIGO='".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
  
  if ($row = mysqli_fetch_array($resultado))
  {
    $consulta2 = "INSERT INTO {$_POST['tabla']} (CODIGO_PRODUCTO, NOMBRE_PRODUCTO, CANTIDAD,PRECIO,CEDULA_CLIENTE) VALUES ('{$row['CODIGO']}','{$row['NOMBRE']}',{$_POST['cantidad']},{$row['PRECIO']},'{$_POST['cedula_cliente']}')";    
    $resultado2 = mysqli_query( $conexion, $consulta2 ) or die("Error en la Consulta a Usuarios");
  }
 
  mysqli_close($conexion);

}


/*BORRAR TABLA TEMPORAL DE DEVOLUCION DE SALIDA */

if (isset($_POST['delete_tempDS'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "DELETE FROM {$_POST['tabla']}";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
 
  mysqli_close($conexion);

}


/*INFORMACION DE TABLA TEMPORAL DE DEVOLUCION DE SALIDA (CREACION DE TABLA)*/

if (isset($_POST['infoTempDS'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
    $subtotal= 0;
    $iva=0;
    $total=0;
  
    $tabla_temp = "
    <table style=width:100%>
    <thead>
    <tr>  
      <th>ACCIONES</th>
      <th>CODIGO</th>
      <th>PRODUCTO</th>
      <th>CANTIDAD</th>
      <th>PRECIO</th>
    </tr>
    </thead>
    <tbody>
  ";
  
  $consulta3 = "SELECT * from {$_POST['tabla']}";
    
  $resultado3 = mysqli_query( $conexion, $consulta3 ) or die("Error en la Consulta a Usuarios");
  $cedula = '';
  $proveedor = '';

  while($row = mysqli_fetch_array($resultado3)){
     
    $tabla_temp = $tabla_temp."

    <tr>
      <td><a onclick=borrar_producto({$row['ID']})><img id=icon-bt src='../../Assets/images/inventory/erase.png'></a></td>
      <td>{$row['CODIGO_PRODUCTO'] }</td> 
      <td>{$row['NOMBRE_PRODUCTO']}</td>
      <td>{$row['CANTIDAD']}</td>
      <td>{$row['PRECIO']}</td>
   </tr>   
  ";
  $subtotal = $subtotal + $row['PRECIO'];
  $proveedor = $row['CEDULA_CLIENTE'];
  }
  $tabla_temp = $tabla_temp. "</tbody></table>";
  $iva= $subtotal * 16/100;
  $total= $subtotal + $iva;
  
    mysqli_close($conexion);

  $obj = array('tabla' => $tabla_temp, 'subtotal' => $subtotal, 'iva' => $iva,'total' => $total,'cedula_cliente' => $proveedor);
  echo json_encode($obj);    
}

if (isset($_POST['getExistenciaSalida'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM CARAC_SALIDA WHERE NUM_SALIDA=".$_POST['referencia']." AND CODIGO_PRODUCTO = '".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
  if ($row = mysqli_fetch_array($resultado))
  {
    $obj = array('nombre' => $row['NOMBRE_PRODUCTO'], 'existencia' => $row['CANTIDAD']);
    echo json_encode($obj);  
  }
 
  mysqli_close($conexion);

}


/*OBTENER QUE INSUMOS SE HICIERON EN UNA SALIDA*/

if (isset($_POST['list_productos_salida'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());  
  $consulta = "SELECT * from CARAC_SALIDA WHERE NUM_SALIDA=".$_POST['num_salida'];
  $cadena = "";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");  
  while($row = mysqli_fetch_array($resultado)){
    $cadena=$cadena."<option value='{$row['CODIGO_PRODUCTO']}' label='{$row['NOMBRE_PRODUCTO']}'>";
  }
  
  $consulta2 = "SELECT CEDULA_CLIENTE from SALIDA WHERE NUM_SALIDA=".$_POST['num_salida'];
  $resultado2 = mysqli_query( $conexion, $consulta2 ) or die("Error en la Consulta a Usuarios");  

  if ($row = mysqli_fetch_array($resultado2))
  {
    $obj = array('productos' => $cadena, 'cliente' => $row['CEDULA_CLIENTE']);
    echo json_encode($obj);  
  }
  mysqli_close($conexion);

}

if (isset($_POST['validar_entrada'])){
  $proveedor = FALSE;
  $producto = FALSE;
  $paso = FALSE;

  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM PROVEEDOR WHERE NOMBRE='".$_POST['proveedor']."'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
  if ($row = mysqli_fetch_array($resultado))
    if(strlen($row['NOMBRE'])>0) 
      $proveedor = TRUE;

  $consulta = "SELECT * FROM INSUMOS WHERE CODIGO='".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
  if ($row = mysqli_fetch_array($resultado))
    if(strlen($row['CODIGO'])>0) 
      $producto = TRUE;      
  
  if ($proveedor && $producto ) $paso = TRUE;
    
    $obj = array('proveedor' => $proveedor, 'producto' => $producto,'paso' => $paso);
    echo json_encode($obj);  
 
  mysqli_close($conexion);

}

/*******************VER SI LA CATEGORIA EXISTE******************************/

if (isset($_POST['siCampoExiste'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT * FROM {$_POST['tabla']} WHERE {$_POST['campo']}='".$_POST['dato']."'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
  if ($row = mysqli_fetch_array($resultado)){
        if(strlen($row[$_POST['campo']])>0){
      $obj = array('campo' => $row[$_POST['campo']], 'existe' => '1');
      echo json_encode($obj);  
    }
  }
  else{
      $obj = array('campo' => "0", 'existe' => '0');
      echo json_encode($obj);  
    }

  mysqli_close($conexion);

}

/////////////////VER SI CEDULA EXISTE//////////////////////////////

if (isset($_POST['siCedulaExiste'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia') or die ("Error de Conaxion: ". mysqli_connect_error());
  $consulta = "SELECT CEDULA FROM {$_POST['tabla']} WHERE {$_POST['campo']}='".$_POST['dato']."' AND TIPO='EMPLEADO'";
  $resultado = mysqli_query( $conexion, $consulta ) or die("Error en la Consulta a Usuarios");
  if ($row = mysqli_fetch_array($resultado)){
        if(strlen($row[$_POST['campo']])>0){
      $obj = array('campo' => $row[$_POST['campo']], 'existe' => '1');
      echo json_encode($obj);  
    }
  }
  else{
      $obj = array('campo' => "0", 'existe' => '0');
      echo json_encode($obj);  
    }

  mysqli_close($conexion);

}


 ?>
 