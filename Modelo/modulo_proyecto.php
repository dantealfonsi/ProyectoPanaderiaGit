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


/*Creacion de Base de Datos y Tablas primarias en caso de emergencia o fallos en MariaDB*/

public function crear(){
  date_default_timezone_set('America/Caracas');
  $conexion = mysqli_connect($this->servidor,$this->user,$this->password,$this->database);
  
  $consulta = "CREATE DATABASE IF NOT EXISTS tiendapanaderia";
  $resultado = mysqli_query( $conexion, $consulta );

  $consulta = "CREATE TABLE IF NOT EXISTS insumos (
    codigo VARCHAR(15) NOT NULL PRIMARY KEY, 
    nombre VARCHAR(34), almacen INT NOT NULL DEFAULT 0,
    precio DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    existencia INT NOT NULL DEFAULT 0, 
    categoria VARCHAR(34), 
    c_min INT NOT NULL DEFAULT 0,
    c_max INT NOT NULL DEFAULT 0,
    deleted INT NOT NULL DEFAULT 0)";
  $resultado = mysqli_query( $conexion, $consulta );

  $consulta = "CREATE TABLE IF NOT EXISTS proveedor (
    rif VARCHAR(50) NOT NULL PRIMARY KEY,
    nombre VARCHAR(34) NOT NULL,
    telefono VARCHAR(15),
    direccion VARCHAR(50), 
    deleted INT NOT NULL DEFAULT 0)";
  $resultado = mysqli_query( $conexion, $consulta );

  $consulta = "CREATE TABLE IF NOT EXISTS entrada (
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    responsable INT(9), 
    num_entrada INT NOT NULL DEFAULT 0 PRIMARY KEY,
    proveedor VARCHAR(34), 
    devuelto TINYINT DEFAULT 0)";
  $resultado = mysqli_query( $conexion, $consulta );

  $consulta = "CREATE TABLE IF NOT EXISTS salida (
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    responsable INT(9), 
    num_salida INT NOT NULL DEFAULT 0 PRIMARY KEY,
    motivo TEXT, 
    cedula_cliente INT(9),
    subtotal DECIMAL(13,2) DEFAULT 0.00, 
    iva DECIMAL(13,2) DEFAULT 0.00, 
    total DECIMAL(13,2) DEFAULT 0.00, 
    devuelto TINYINT DEFAULT 0)";
  $resultado = mysqli_query( $conexion, $consulta );

  $consulta = "CREATE TABLE IF NOT EXISTS categoria_insumos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(34))";
  $resultado = mysqli_query( $conexion, $consulta );


  $consulta = "CREATE TABLE IF NOT EXISTS devolucion_entrada (
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    responsable INT(9), 
    referencia INT NOT NULL DEFAULT 0 PRIMARY KEY,
    motivo TEXT,
    proveedor VARCHAR(34))";
  $resultado = mysqli_query( $conexion, $consulta );

  $consulta = "CREATE TABLE IF NOT EXISTS devolucion_salida (
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    responsable INT(9), 
    referencia INT NOT NULL DEFAULT 0 PRIMARY KEY,
    motivo TEXT, cedula_cliente INT(9),
    subtotal DECIMAL(13,2) DEFAULT 0.00, 
    iva DECIMAL(13,2) DEFAULT 0.00, 
    total DECIMAL(13,2) DEFAULT 0.00)";
  $resultado = mysqli_query( $conexion, $consulta );


  $consulta = "CREATE TABLE IF NOT EXISTS carac_devolucion_entrada (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    codigo_producto VARCHAR(15),
    nombre_producto VARCHAR(34),
    cantidad INT NOT NULL DEFAULT 0,
    referencia INT NOT NULL DEFAULT 0,
    precio DECIMAL(10,2)
  )";
  $resultado = mysqli_query($conexion, $consulta);
  
  $consulta = "CREATE TABLE IF NOT EXISTS carac_devolucion_salida (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    codigo_producto VARCHAR(15),
    nombre_producto VARCHAR(34),
    cantidad INT NOT NULL DEFAULT 0,
    referencia INT NOT NULL DEFAULT 0,
    cedula_cliente INT(9),
    precio DECIMAL(10,2)
  )";
  $resultado = mysqli_query($conexion, $consulta);
  
  $consulta = "CREATE TABLE IF NOT EXISTS carac_entrada (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    codigo_producto VARCHAR(15),
    nombre_producto VARCHAR(34),
    cantidad INT NOT NULL DEFAULT 0,
    num_entrada INT NOT NULL DEFAULT 0,
    precio DECIMAL(10,2)
  )";
  $resultado = mysqli_query($conexion, $consulta);
  
  $consulta = "CREATE TABLE IF NOT EXISTS carac_salida (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    codigo_producto VARCHAR(15),
    nombre_producto VARCHAR(34),
    cantidad INT NOT NULL DEFAULT 0,
    num_salida INT NOT NULL DEFAULT 0,
    cedula_cliente INT(9)
  )";
  $resultado = mysqli_query($conexion, $consulta);
  
  $consulta = "CREATE TABLE IF NOT EXISTS historial (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    nombre_usuario VARCHAR(34),
    cedula INT(9) NOT NULL,
    ubicacion VARCHAR(255)
  )";
  $resultado = mysqli_query($conexion, $consulta);
  
  mysqli_close($conexion);
}

/*init_Usuario*/

/*public function init_usuario($nombre,$password,$nivel,$cedula){ 
  $consulta = "INSERT INTO USUARIOS(NOMBRE,PASSWORD,NIVEL,CEDULA) VALUES('".$nombre."','".$password."',".$nivel.",'{$cedula}')";
  $resultado = mysqli_query( $this->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en insertar el usuario");
}*/

/*CREACION DE FUNCION PARA INSERTAR EN TABLA HISTORIAL*/

public function historial($nombre,$cedula,$ubicacion){ 
  $this->sql_consulta("INSERT INTO historial(nombre_usuario,cedula,ubicacion) VALUES ('{$nombre}',{$cedula},'{$ubicacion}')");
}

/*FUNCIONES PARA VOLVER DINAMICO CON JQUERY ENTRADAS Y SALIDAS*/


/*CONEXION A LA BASE DE DATOS*/

public function sql_consulta($consulta){
  $conexion = mysqli_connect($this->servidor,$this->user,$this->password,$this->database);
  $resultado = mysqli_query( $conexion, $consulta );
}

/*CONEXION A LA BASE DE DATOS*/

public function row_sqlconector($consulta) {
  $row = array();
  $conexion = @mysqli_connect($this->servidor, $this->user, $this->password, $this->database);
  if (!$conexion) {
      echo "Refresh page, Failed to connect to Data: " . mysqli_connect_error();
      exit();
  } else {
      $resultado = mysqli_query($conexion, $consulta);
      if ($resultado) {
          $row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
      }
      mysqli_close($conexion);
  }
  return $row;
}


/*VERIFICACION SI EL USUARIO EXISTE*/

public function siUsuarioExiste($idusuario) {
  $conexion = mysqli_connect($this->servidor, $this->user, $this->password, $this->database);
  if (!$conexion) {
      echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
      exit;
  }

  $resultado = mysqli_query($conexion, "SELECT 1 FROM usuario WHERE idusuario = " . intval($idusuario));
  $existe = mysqli_num_rows($resultado) > 0;
  mysqli_close($conexion);

  return $existe;
}

/*********************FIN DE LA CLASE MODUL0**************************/
}
/********************* */


/*FUNCION QUE GENERA NUMERO SALIDA*/

if (isset($_GET['num_salida'])){
  echo rand(800000,160000);
}


/*FUNCION DE PARA OBTENER LA INFORMACION DEL CLIENTE*/

if (isset($_GET['infoCliente'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * FROM usuario WHERE idusuario='".$_GET['cedula']."'";
  $resultado = mysqli_query( $conexion, $consulta );
  if ($row = mysqli_fetch_array($resultado))
  {
    /*Creacion de un array con la informacion del cliente para pasarla a un Json encode 
    y luego obtenerla del modulo en Salida*/
    $obj = array('IDusuario' => $row['idusuario'], 'nombre' => $row['nombre'], 'apellido' => $row['apellido'],'direccion' => $row['direccion'], 'telefono' => $row['telefono'] );
    mysqli_close($conexion);
    echo json_encode($obj);  
  }  
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
      <td><a onclick=borrar_producto({$row['id']})><img id=icon-bt src='../../Assets/images/inventory/erase.png'></a></td>
      <td>{$row['codigo_producto'] }</td> 
      <td>{$row['nombre_producto']}</td>
      <td>{$row['cantidad']}</td>
      <td>{$row['precio']}</td>
   </tr>   
  ";
  //calcula el subtotal de los insumos utilizados al costo
      //consulta todos los item de insumos utilizados de la receta a cocinar
      $Q_insumos = "select * from itemrecetas where idproducto=".$row['codigo_producto']."";
      $query = mysqli_query($conexion, $Q_insumos );
      while($item = mysqli_fetch_array($query)){
        $cantidad = $row['cantidad'] * $item['cantidad'];

        //consulto el precio del insumo
        $Q_info_insumo="select precio FROM insumos WHERE codigo='".$item['codigoinsumo']."'";
        $query_info = mysqli_query($conexion, $Q_info_insumo );
        $item_info_insumo = mysqli_fetch_array($query_info);

        $subtotal = $subtotal + ($item_info_insumo['precio'] * $cantidad);
      }
  

  $cedula = $row['cedula_cliente'];
  }

  $tabla_temp = $tabla_temp. "</tbody></table>";
  $iva= $subtotal * 16/100;
  $total= $subtotal + $iva;
  
  $nombre=''; $apellido='';$direccion='';$telefono='';

  $consulta = "SELECT * FROM usuario WHERE idusuario='{$cedula}'";
  $resultado = mysqli_query( $conexion, $consulta );

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
  $consulta = "SELECT * FROM productos WHERE idproducto=".$_POST['codigo']."";
  $resultado = mysqli_query( $conexion, $consulta );
  if ($row = mysqli_fetch_array($resultado))
  {
    $consulta2 = "INSERT INTO {$_POST['tabla']} (codigo_producto, nombre_producto, cantidad,precio,cedula_cliente)
     VALUES ('{$row['idproducto']}','{$row['nombre_producto']}',{$_POST['cantidad']},{$row['precio_producto']},{$_POST['cedula']})";
    $resultado2 = mysqli_query( $conexion, $consulta2 );
  }
  mysqli_close($conexion);
}

/*OBTENER EXISTENCIA */

if (isset($_POST['getExistencia'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * FROM insumos WHERE codigo='".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta );
  if ($row = mysqli_fetch_array($resultado))
  {
    $obj = array('nombre' => $row['nombre'], 'existencia' => $row['existencia']);
    echo json_encode($obj);  
  }
 
  mysqli_close($conexion);

}

/*INSERTAR EN TABLA DE ENTRADA TEMPORAL */

/*OBTENER INFORMACION DE TABLA DE ENTRADA TEMPORAL*/

if (isset($_POST['infoTempE'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
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
    
  $resultado3 = mysqli_query( $conexion, $consulta3 );
  $cedula = '';
  $proveedor = '';

  while($row = mysqli_fetch_array($resultado3)){
     
    $tabla_temp = $tabla_temp."

    <tr>
      <td><a onclick=borrar_producto({$row['id']})><img id=icon-bt src='../../Assets/images/inventory/erase.png'></a></td>
      <td>{$row['codigo_producto'] }</td> 
      <td>{$row['nombre_producto']}</td>
      <td>{$row['cantidad']}</td>
   </tr>   
  ";
  $subtotal = $subtotal + $row['precio'];
  $proveedor = $row['proveedor'];
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
  $consulta = "SELECT * FROM insumos WHERE codigo='".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta );
  if ($row = mysqli_fetch_array($resultado))
  {
    $consulta2 = "INSERT INTO {$_POST['tabla']} (codigo_producto, nombre_producto, cantidad,precio,proveedor)
     VALUES ('{$row['codigo']}','{$row['nombre']}',{$_POST['cantidad']},{$row['precio']},'{$_POST['proveedor']}')";
    $resultado2 = mysqli_query( $conexion, $consulta2 ) or die("Error en la Consulta a Usuarios");
  }
 
  mysqli_close($conexion);

}

/*LISTAR INSUMOS EN ENTRADA  */

if (isset($_POST['list_productos'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * from carac_entrada WHERE num_entrada=".$_POST['num_entrada'];
  $cadena = "";
  $resultado = mysqli_query( $conexion, $consulta );
  while($row = mysqli_fetch_array($resultado)){
    $cadena=$cadena."<option value='{$row['codigo_producto']}' label='{$row['nombre_producto']}'>";
  }

  /*RELLENAR INSUMOS Y PROVEEDOR*/

  $consulta2 = "SELECT proveedor from entrada WHERE num_entrada=".$_POST['num_entrada'];
  $resultado2 = mysqli_query( $conexion, $consulta2 );

  if ($row = mysqli_fetch_array($resultado2))
  {
    $obj = array('productos' => $cadena, 'proveedor' => $row['PROVEEDOR']);
    echo json_encode($obj);  
  }
  mysqli_close($conexion);

}

/*INSERTAR EN TABLA TEMPORAL DE DEVOLUCION DE ENTRADA */

if (isset($_POST['addTempDE'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * FROM insumos WHERE codigo='".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta );
  if ($row = mysqli_fetch_array($resultado))
  {
    $consulta2 = "INSERT INTO {$_POST['tabla']} (codigo_producto, nombre_producto, cantidad,precio,proveedor) 
    VALUES ('{$row['codigo']}','{$row['nombre']}',{$_POST['cantidad']},{$row['precio']},'{$_POST['proveedor']}')";
    $resultado2 = mysqli_query( $conexion, $consulta2 );
  }
 
  mysqli_close($conexion);

}

 /*BORRAR TABLA TEMPORAL DE DEVOLUCION DE ENTRADA  */

if (isset($_POST['delete_tempDE'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "DELETE FROM {$_POST['tabla']}";
  $resultado = mysqli_query( $conexion, $consulta );
 
  mysqli_close($conexion);
}


 /*MOSTRAR INFORMACION DE TABLA TEMPORAL DE ENTRADA  */

if (isset($_POST['infoTempDE'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
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
    
  $resultado3 = mysqli_query( $conexion, $consulta3 );
  $cedula = '';
  $proveedor = '';

  while($row = mysqli_fetch_array($resultado3)){
     
    $tabla_temp = $tabla_temp."

    <tr>
      <td><a onclick=borrar_producto({$row['id']})><img id=icon-bt src='../../Assets/images/inventory/erase.png'></a></td>
      <td>{$row['codigo_producto'] }</td> 
      <td>{$row['nombre_producto']}</td>
      <td>{$row['cantidad']}</td>
   </tr>   
  ";
  $subtotal = $subtotal + $row['precio'];
  $proveedor = $row['proveedor'];
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
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * FROM carac_entrada WHERE num_entrada=".$_POST['referencia']." AND codigo_producto = '".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta );
  if ($row = mysqli_fetch_array($resultado))
  {
    $obj = array('nombre' => $row['nombre_producto'], 'existencia' => $row['cantidad']);
    echo json_encode($obj);  
  }
 
  mysqli_close($conexion);
}

/*Record Count de Tabla*/

if (isset($_GET['recordCountTemp'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
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
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * FROM {$_GET['temp']} WHERE deleted=0";
  
  if ($resultado = mysqli_query($conexion, $consulta)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $resultado );
    
    // Display result
    echo $rowcount ;
 }
 
  mysqli_close($conexion);

}


if (isset($_GET['recordCountEntSal'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * FROM {$_GET['temp']} WHERE WHERE fecha BETWEEN '2023-08-10 00:00:00' AND '2023-08-10 23:59:59'";
  
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
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * FROM insumos WHERE codigo='".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta );
  
  if ($row = mysqli_fetch_array($resultado))
  {
    $consulta2 = "INSERT INTO {$_POST['tabla']} (codigo_producto, nombre_producto, cantidad,precio,cedula_cliente) 
    VALUES ('{$row['codigo']}','{$row['nombre']}',{$_POST['cantidad']},{$row['precio']},'{$_POST['cedula_cliente']}')";
    $resultado2 = mysqli_query( $conexion, $consulta2 );
  } 
  mysqli_close($conexion);

}


/*BORRAR TABLA TEMPORAL DE DEVOLUCION DE SALIDA */

if (isset($_POST['delete_tempDS'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "DELETE FROM {$_POST['tabla']}";
  $resultado = mysqli_query( $conexion, $consulta );
  mysqli_close($conexion);

}


/*INFORMACION DE TABLA TEMPORAL DE DEVOLUCION DE SALIDA (CREACION DE TABLA)*/

if (isset($_POST['infoTempDS'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
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
    
  $resultado3 = mysqli_query( $conexion, $consulta3 );
  $cedula = '';
  $proveedor = '';

  while($row = mysqli_fetch_array($resultado3)){
     
    $tabla_temp = $tabla_temp."

    <tr>
      <td><a onclick=borrar_producto({$row['ID']})><img id=icon-bt src='../../Assets/images/inventory/erase.png'></a></td>
      <td>{$row['codigo_producto'] }</td> 
      <td>{$row['nombre_producto']}</td>
      <td>{$row['cantidad']}</td>
      <td>{$row['precio']}</td>
   </tr>   
  ";
  $subtotal = $subtotal + $row['precio'];
  $proveedor = $row['cedula_cliente'];
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
  $consulta = "SELECT * FROM carac_salida WHERE num_salida=".$_POST['referencia']." AND codigo_producto = '".$_POST['codigo']."'";
  $resultado = mysqli_query( $conexion, $consulta );
  if ($row = mysqli_fetch_array($resultado))
  {
    $obj = array('nombre' => $row['nombre_producto'], 'existencia' => $row['cantidad']);
    echo json_encode($obj);  
  }
 
  mysqli_close($conexion);

}


/*OBTENER QUE INSUMOS SE HICIERON EN UNA SALIDA*/

if (isset($_POST['list_productos_salida'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');  
  $consulta = "SELECT * from carac_salida WHERE num_salida=".$_POST['num_salida'];
  $cadena = "";
  $resultado = mysqli_query($conexion, $consulta);  
  while($row = mysqli_fetch_array($resultado)){
    $cadena .= "<option value='{$row['codigo_producto']}' label='{$row['nombre_producto']}'>";
  }
  
  $consulta2 = "SELECT cedula_cliente from salida WHERE num_salida=".$_POST['num_salida'];
  $resultado2 = mysqli_query($conexion, $consulta2);  

  if ($row = mysqli_fetch_array($resultado2)){
    $obj = array('productos' => $cadena, 'cliente' => $row['cedula_cliente']);
    echo json_encode($obj);  
  }
  mysqli_close($conexion);
}

if (isset($_POST['validar_entrada'])){
  $proveedor = FALSE;
  $producto = FALSE;
  $paso = FALSE;

  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * FROM proveedor WHERE nombre='".$_POST['proveedor']."'";
  $resultado = mysqli_query($conexion, $consulta);
  if ($row = mysqli_fetch_array($resultado))
    if(strlen($row['nombre'])>0) 
      $proveedor = TRUE;

  $consulta = "SELECT * FROM insumos WHERE codigo='".$_POST['codigo']."'";
  $resultado = mysqli_query($conexion, $consulta);
  if ($row = mysqli_fetch_array($resultado))
    if(strlen($row['codigo'])>0) 
      $producto = TRUE;      
  
  if ($proveedor && $producto) $paso = TRUE;
    
  $obj = array('proveedor' => $proveedor, 'producto' => $producto, 'paso' => $paso);
  echo json_encode($obj);  
 
  mysqli_close($conexion);
}


/*******************VER SI LA CATEGORIA EXISTE******************************/

if (isset($_POST['siCampoExiste'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * FROM {$_POST['tabla']} WHERE {$_POST['campo']}='".$_POST['dato']."'";
  $resultado = mysqli_query( $conexion, $consulta );
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

if (isset($_POST['siDatoExiste'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * FROM {$_POST['tabla']} WHERE {$_POST['campo']}='".$_POST['dato']."'";
  $resultado = mysqli_query( $conexion, $consulta );
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

if (isset($_POST['readDatoString'])){
  $conexion = mysqli_connect('localhost','root','','tiendapanaderia');
  $consulta = "SELECT * FROM {$_POST['tabla']} WHERE {$_POST['campo']}='".$_POST['dato']."'";
  $resultado = mysqli_query( $conexion, $consulta );
  if ($row = mysqli_fetch_array($resultado)){
        if(strlen($row[$_POST['campo']])>0){
      $obj = array('campo' => $row[$_POST['busqueda']], 'existe' => '1');
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
 