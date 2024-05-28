<?php

/*INCLUDE DE MODULO PARA CONEXION CON BASE DE DATOS*/

include 'gestionar_insumos.php';


/*CREACION DE CLASE ENTRADA*/

class Entrada{

  public $responsable;
  public $num_entrada;
  public $proveedor;
  public $fecha;
  public $codigo_producto;   /*VARIABLES DE ENTRADA*/
  public $cantidad;
  public $cedula;
  public $precio;
  public $motivo;
  public $id_compra;

    /*FUNCION PARA INSERTAR NUEVA ENTRADA*/

    public function insert_entrada($responsable,$num_entrada,$proveedor)
    {
        $tmodulo=new Modulo;
        $consulta = "INSERT INTO ENTRADA (RESPONSABLE,NUM_ENTRADA,PROVEEDOR) VALUES ({$responsable},{$num_entrada},'{$proveedor}')";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
        $this->sumar_compra($codigo_producto,$cantidad);
    }

        /*FUNCION DE INSERTAR EN CARACTERISTICAS DE ENTRADA*/

  public function insert_detalle_entrada($codigo_producto,$cantidad,$precio,$num_entrada)
  {
      $tmodulo=new Modulo;
      $consulta = "INSERT INTO CARAC_ENTRADA (CODIGO_PRODUCTO,NOMBRE_PRODUCTO,CANTIDAD,PRECIO,NUM_ENTRADA) VALUES ('{$codigo_producto}','".$this->readProducto($codigo_producto)['NOMBRE']."',{$cantidad},{$precio},{$num_entrada})";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
      $this->sumar_compra($codigo_producto,$cantidad);
  }

    /*FUNCION PARA SUMAR COMPRA A INSUMOS*/

    public function sumar_compra($codigo_producto,$cantidad){
        $producto = new producto; 
        $tmodulo=new Modulo;
        $existencia=$producto->readProducto($codigo_producto)['EXISTENCIA'];
        $consulta = "UPDATE INSUMOS SET EXISTENCIA=".strval($existencia + $cantidad)." WHERE CODIGO='".$codigo_producto."'";
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
      }


    /*FUNCION PARA LEER DE CARACTERISTICAS DE SALIDA*/

      public function read_compra($id_compra){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM CARAC_ENTRADA WHERE ID='".$id_compra."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        $row = mysqli_fetch_array($resultado);
        return $row;  
      }

      
      /*FUNCION PARA LEER PRODUCTO POR CODIGO*/

      public function readProducto($codigo){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM INSUMOS WHERE CODIGO='".$codigo."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }


      /*HACER LISTA DE INSUMOS*/

      public function list_productos(){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT * from INSUMOS WHERE DELETED=0";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
            while($row = mysqli_fetch_array($resultado)){
              $cadena=$cadena."<option value='{$row['CODIGO']}' label='{$row['NOMBRE']}'>";
            }
        $cadena=$cadena."";
        echo $cadena;
      }


      /*HACER LISTA DE PROVEEDORES*/

      public function list_proveedores(){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT * from PROVEEDOR WHERE DELETED=0";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
            while($row = mysqli_fetch_array($resultado)){
              $cadena=$cadena."<option value='{$row['NOMBRE']}' label='{$row['RIF']}'>";
            }
        $cadena=$cadena."";
        echo $cadena;
      }


      /*AGREGAR TABLA TEMPORAL*/

      public function insert_tmp($codigo_producto,$proveedor,$cantidad,$precio)
      {
          $tmodulo=new Modulo;
          $consulta = "INSERT INTO v{$_SESSION['IDusuario']} (CODIGO_PRODUCTO,PROVEEDOR,CANTIDAD,PRECIO) VALUES ('{$codigo_producto}','{$proveedor}',{$cantidad},{$precio})";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
      }
     
    
    /*FUNCION PARA OBTENER DATOS DEL USUARIO POR CEDULA*/  

    public function getUsuario($cedula){
      $tmodulo=new Modulo;
      $consulta = "SELECT * FROM usuario WHERE IDusuario='".$cedula."'";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
      $row = mysqli_fetch_array($resultado);
      return $row;
    }


    /*FUNCION DE NUMERO DE ENTRADA RANDOM*/

    public function num_entrada(){
      return rand(800000,160000);
  }


    /*FUNCION DE LEER UNA ENTRADA*/

  public function readEntrada($num_entrada){
    $row;
    $tmodulo=new Modulo;
    $consulta = "SELECT * FROM ENTRADA WHERE NUM_ENTRADA=".$num_entrada;
    $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
    
    if($row = mysqli_fetch_array($resultado))
    return $row;  
  }

      /*FUNCION DE OBTENER UN NUMERO DE ENTRADA*/

  public function getEntrada($id){
    $row;
    $tmodulo=new Modulo;
    $consulta = "SELECT * FROM ENTRADA WHERE NUM_ENTRADA='{$id}'";
    $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
    
    if($row = mysqli_fetch_array($resultado))
    return $row;  
  }

/****************************************************** */
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