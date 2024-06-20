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
      $consulta = "INSERT INTO salida (responsable,num_salida,motivo,cedula_cliente,subtotal,iva,total) VALUES ({$responsable},{$num_salida},'{$motivo}',{$cedula_cliente},{$subtotal},{$iva},{$total})";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
  }


  /*FUNCION DE INSERTAR CLIENTE DESDE NUEVA SALIDA*/

  public function insert_cliente($cedula,$nombre,$apellido,$direccion,$telefono)
  {
      $tmodulo=new Modulo;
      $consulta = "INSERT INTO persona (cedula,nombre,apellido,direccion,telefono) VALUES ('{$cedula}','{$nombre}','{$apellido}','{$direccion}','{$telefono}')";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
  }

  /*FUNCION DE SUMAR PRODUCTO CUANDO SE HACE UNA SALIDA*/

    public function sumar_salida($codigo_producto,$cantidad){
        $producto = new producto; 
        $tmodulo=new Modulo;
        $existencia=$producto->readProducto($codigo_producto)['existencia'];
        $consulta = "UPDATE insumos SET existencia=".strval($existencia + $cantidad)." WHERE codigo='".$codigo_producto."'";
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
      }
      
    /*FUNCION DE RESTAR PRODUCTO CUANDO SE HACE UNA SALIDA*/

      public function restar_salida($codigo_producto,$cantidad){
        $producto = new producto; 
        $tmodulo=new Modulo;
        $existencia=$producto->readProducto($codigo_producto)['existencia'];
        $consulta = "UPDATE insumos SET existencia=".strval($existencia - $cantidad)." WHERE codigo='".$codigo_producto."'";
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
      }


      /*LEER CARACTERISTICAS DE SALIDAS POR ID*/

      public function read_salida($id_salida){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM carac_salida WHERE id='".$id_salida."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        $row = mysqli_fetch_array($resultado);
        return $row;  
      }


      /*LISTAR INSUMOS*/

      public function list_productos(){ 
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT * from productos where habilitado=1";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
            while($row = mysqli_fetch_array($resultado)){
              $cadena=$cadena."<option value='{$row['idproducto']}' label='{$row['nombre_producto']}'>";
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
              $cadena=$cadena."<option value='{$row['cedula']}'>";
            }
        $cadena=$cadena."";
        echo $cadena;
      }

      /*VER SI CLIENTE EXISTE*/

      public function if_cliente_exist($cedula){

        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM persona WHERE cedula={$cedula}";  
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en insertar el usuario");
        $row = mysqli_fetch_array($resultado);
        if (isset($row['cedula']))
        if ($row['cedula']==$cedula) return TRUE;
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
          $consulta = "INSERT INTO s{$_COOKIE['cedula']} (codigo_producto,cantidad) VALUES ('{$codigo_producto}',{$cantidad})";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
      }


      /*INSERTAR EN CARACTERISTICAS DE SALIDA*/

      public function insert_detalle_salida($codigo_producto,$num_salida,$cantidad,$cedula_cliente)
      {
          $tmodulo=new Modulo;
          $consulta = "INSERT INTO carac_salida (codigo_producto,nombre_producto,num_salida,cantidad,cedula_cliente) VALUES ('{$codigo_producto}','".$this->readProducto($codigo_producto)['nombre']."',{$num_salida},{$cantidad},{$cedula_cliente})";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la salida");      
          $this->restar_salida($codigo_producto,$cantidad);
      }     


      /*LEER TODO DE INSUMOS POR CODIGO*/

      public function readProducto($codigo){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM insumos WHERE codigo='".$codigo."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }

      public function readProductoReceta($codigo){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM productos WHERE idproducto=".$codigo;
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }      

      /*OBTENER EL USUARIO POR CEDULA*/

      public function getUsuario($cedula){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM usuario WHERE idusuario=".$cedula;
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        $row = mysqli_fetch_array($resultado);
        return $row;
      }

      /*OBTENER QUE PERSONA POR CEDULA*/

      public function getPersona($cedula){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM usuario WHERE idusuario=".$cedula."";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        $row = mysqli_fetch_array($resultado);
        return $row;
      } 

      
      /*LEER LAS SALIDAS*/

      public function readSalida($num_salida){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM salida WHERE num_salida=".$num_salida;
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }

      public function getSalida($id){
        $row;
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM salida WHERE num_salida='{$id}'";
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