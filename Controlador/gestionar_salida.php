<?php

/*INCLUDE DE MODULO PARA CONEXION CON BASE DE DATOS*/

include 'gestionar_insumos.php';


/*CREACION DE SALIDA*/

class salida{

  public $responsable;
  public $num_salida;
  public $codigo_producto;
  public $cantidad;
  public $cedula;       /*VARIABLES DE SALIDA*/
  public $precio;
  public $motivo;
  public $id_salida;
  public $fecha;


  /*FUNCION DE INSERTAR SALIDA*/

  public function insert_salida($responsable,$num_salida,$motivo,$cedula_cliente,$subtotal,$iva,$total)
  {
      $tmodulo=new Modulo;
      $consulta = "INSERT INTO SALIDA (RESPONSABLE,NUM_SALIDA,MOTIVO,CEDULA_CLIENTE,SUBTOTAL,IVA,TOTAL) VALUES ({$responsable},{$num_salida},'{$motivo}',{$cedula_cliente},{$subtotal},{$iva},{$total})";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
  }


  /*FUNCION DE INSERTAR CLIENTE DESDE NUEVA SALIDA*/

  public function insert_cliente($cedula,$nombre,$apellido,$direccion,$telefono)
  {
      $tmodulo=new Modulo;
      $consulta = "INSERT INTO PERSONA (CEDULA,NOMBRE,APELLIDO,DIRECCION,TELEFONO) VALUES ('{$cedula}','{$nombre}','{$apellido}','{$direccion}','{$telefono}')";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
  }

  /*FUNCION DE SUMAR PRODUCTO CUANDO SE HACE UNA SALIDA*/

    public function sumar_salida($codigo_producto,$cantidad){
        $producto = new producto; 
        $tmodulo=new Modulo;
        $existencia=$producto->readProducto($codigo_producto)['EXISTENCIA'];
        $consulta = "UPDATE INSUMOS SET EXISTENCIA=".strval($existencia + $cantidad)." WHERE CODIGO='".$codigo_producto."'";
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
      }
      
    /*FUNCION DE RESTAR PRODUCTO CUANDO SE HACE UNA SALIDA*/

      public function restar_salida($codigo_producto,$cantidad){
        $producto = new producto; 
        $tmodulo=new Modulo;
        $existencia=$producto->readProducto($codigo_producto)['EXISTENCIA'];
        $consulta = "UPDATE INSUMOS SET EXISTENCIA=".strval($existencia - $cantidad)." WHERE CODIGO='".$codigo_producto."'";
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
      }


      /*LEER CARACTERISTICAS DE SALIDAS POR ID*/

      public function read_salida($id_salida){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM CARAC_SALIDA WHERE ID='".$id_salida."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        $row = mysqli_fetch_array($resultado);
        return $row;  
      }


      /*LISTAR INSUMOS*/

      public function list_productos(){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT * from INSUMOS";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
            while($row = mysqli_fetch_array($resultado)){
              $cadena=$cadena."<option value='{$row['CODIGO']}' label='{$row['NOMBRE']}'>";
            }
        $cadena=$cadena."";
        echo $cadena;
      }


      /*LISTAR CLIENTES POR CEDULA*/

      public function list_clientes(){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT * from usuario";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
            while($row = mysqli_fetch_array($resultado)){
              $cadena=$cadena."<option value='{$row['CEDULA']}'>";
            }
        $cadena=$cadena."";
        echo $cadena;
      }

      /*VER SI CLIENTE EXISTE*/

      public function if_cliente_exist($cedula){

        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM PERSONA WHERE CEDULA={$cedula}";  
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en insertar el usuario");
        $row = mysqli_fetch_array($resultado);
        if (isset($row['CEDULA']))
        if ($row['CEDULA']==$cedula) return TRUE;
        return FALSE;
      }


      /*GENERAR NUMERO DE SALIDA RANDOM*/

      public function num_salida(){
          return rand(800000,160000);
      }


      /*INSERTAR CARACTERISTICAS EN TABLA TEMPORAL*/

      public function insert_tmp($codigo_producto,$cantidad)
      {
          $tmodulo=new Modulo;
          $consulta = "INSERT INTO s{$_COOKIE['cedula']} (CODIGO_PRODUCTO,CANTIDAD) VALUES ('{$codigo_producto}',{$cantidad})";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
      }


      /*INSERTAR EN CARACTERISTICAS DE SALIDA*/

      public function insert_detalle_salida($codigo_producto,$num_salida,$cantidad,$cedula_cliente)
      {
          $tmodulo=new Modulo;
          $consulta = "INSERT INTO CARAC_SALIDA (CODIGO_PRODUCTO,NOMBRE_PRODUCTO,NUM_SALIDA,CANTIDAD,CEDULA_CLIENTE) VALUES ('{$codigo_producto}','".$this->readProducto($codigo_producto)['NOMBRE']."',{$num_salida},{$cantidad},{$cedula_cliente})";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la salida");      
          $this->restar_salida($codigo_producto,$cantidad);
      }     


      /*LEER TODO DE INSUMOS POR CODIGO*/

      public function readProducto($codigo){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM INSUMOS WHERE CODIGO='".$codigo."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }


      /*OBTENER EL USUARIO POR CEDULA*/

      public function getUsuario($cedula){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM usuario WHERE IDusuario=".$cedula."";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        $row = mysqli_fetch_array($resultado);
        return $row;
      }

      /*OBTENER QUE PERSONA POR CEDULA*/

      public function getPersona($cedula){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM usuario WHERE IDusuario=".$cedula."";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        $row = mysqli_fetch_array($resultado);
        return $row;
      } 

      
      /*LEER LAS SALIDAS*/

      public function readSalida($num_salida){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM SALIDA WHERE NUM_SALIDA=".$num_salida;
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }

      public function getSalida($id){
        $row;
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM SALIDA WHERE NUM_SALIDA='{$id}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }
      
    /**************************************************************/
     public function encrypt($string, $key) {
      $result = '';
      for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
    }
    return base64_encode($result);
  }


}