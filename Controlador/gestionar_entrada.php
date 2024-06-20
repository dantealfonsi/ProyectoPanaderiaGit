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
        $consulta = "INSERT INTO entrada (responsable,num_entrada,proveedor) VALUES ({$responsable},{$num_entrada},'{$proveedor}')";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
        $this->sumar_compra($codigo_producto,$cantidad);
    }

        /*FUNCION DE INSERTAR EN CARACTERISTICAS DE ENTRADA*/

  public function insert_detalle_entrada($codigo_producto,$cantidad,$precio,$num_entrada)
  {
      $tmodulo=new Modulo;
      $consulta = "INSERT INTO carac_entrada (codigo_producto,nombre_producto,cantidad,precio,num_entrada) VALUES ('{$codigo_producto}','".$this->readProducto($codigo_producto)['nombre']."',{$cantidad},{$precio},{$num_entrada})";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
      $this->sumar_compra($codigo_producto,$cantidad);
  }

    /*FUNCION PARA SUMAR COMPRA A INSUMOS*/

    public function sumar_compra($codigo_producto,$cantidad){
        $producto = new producto; 
        $tmodulo=new Modulo;
        $existencia=$producto->readProducto($codigo_producto)['existencia'];
        $consulta = "UPDATE insumos SET existencia=".strval($existencia + $cantidad)." WHERE codigo='".$codigo_producto."'";
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
      }


    /*FUNCION PARA LEER DE CARACTERISTICAS DE SALIDA*/

      public function read_compra($id_compra){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM carac_entrada WHERE id='".$id_compra."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        $row = mysqli_fetch_array($resultado);
        return $row;  
      }

      
      /*FUNCION PARA LEER PRODUCTO POR CODIGO*/

      public function readProducto($codigo){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM insumos WHERE codigo='".$codigo."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }


      /*HACER LISTA DE INSUMOS*/

      public function list_productos(){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT * from insumos WHERE deleted=0";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
            while($row = mysqli_fetch_array($resultado)){
              $cadena=$cadena."<option value='{$row['codigo']}' label='{$row['nombre']}'>";
            }
        $cadena=$cadena."";
        echo $cadena;
      }


      /*HACER LISTA DE PROVEEDORES*/

      public function list_proveedores(){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT * from proveedor WHERE deleted=0";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
            while($row = mysqli_fetch_array($resultado)){
              $cadena=$cadena."<option value='{$row['nombre']}' label='{$row['rif']}'>";
            }
        $cadena=$cadena."";
        echo $cadena;
      }


      /*AGREGAR TABLA TEMPORAL*/

      public function insert_tmp($codigo_producto,$proveedor,$cantidad,$precio)
      {
          $tmodulo=new Modulo;
          $consulta = "INSERT INTO v{$_SESSION['IDusuario']} (codigo_producto,proveedor,cantidad,precio) VALUES ('{$codigo_producto}','{$proveedor}',{$cantidad},{$precio})";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrar la compra");      
      }
     
    
    /*FUNCION PARA OBTENER DATOS DEL USUARIO POR CEDULA*/  

    public function getUsuario($cedula){
      $tmodulo=new Modulo;
      $consulta = "SELECT * FROM usuario WHERE idusuario=".$cedula;
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
    $consulta = "SELECT * FROM entrada WHERE num_entrada=".$num_entrada;
    $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
    
    if($row = mysqli_fetch_array($resultado))
    return $row;  
  }

      /*FUNCION DE OBTENER UN NUMERO DE ENTRADA*/

  public function getEntrada($id){
    $row;
    $tmodulo=new Modulo;
    $consulta = "SELECT * FROM entrada WHERE num_entrada='{$id}'";
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