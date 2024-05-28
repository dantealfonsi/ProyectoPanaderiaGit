<?php

/*INCLUDE DE MODULO PARA CONEXION CON BASE DE DATOS*/

include 'gestionar_insumos.php';


/*CREACION DE CLASE DEV_ENTRADA*/

class dev_entrada{

  public $responsable;
  public $detalle;
  public $num_entrada;
  public $proveedor;
  public $fecha;
  public $codigo_producto;        /*VARIABLES DE DEV_ENTRADA*/
  public $cantidad;
  public $cedula;
  public $precio;
  public $motivo;
  public $id_compra;


  /*LISTAS DE ENTRADA DONDE NO ESTEN DEVUELTAS*/

  public function list_entrada(){
    $tmodulo = new Modulo;
    $cadena = "";
    $consulta = "SELECT * from ENTRADA WHERE DEVUELTO=0";
    $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        while($row = mysqli_fetch_array($resultado)){
          $cadena=$cadena."<option value='{$row['NUM_ENTRADA']}' label='{$row['NUM_ENTRADA']}'>";
        }
    $cadena=$cadena."";
    echo $cadena;
  }



  /*HACER QUE ENTRADAS SE DEVUELVAN*/
 
    public function setDevolucionEntrada($referencia)
    {
        $tmodulo=new Modulo;
        $consulta = "UPDATE ENTRADA SET DEVUELTO=1 WHERE NUM_ENTRADA={$referencia}";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
        $this->setDevolucionEntrada($num_entrada);
  
    }


  /*INSERTAR UNA DEVOLUCION DE ENTRADA*/ 

    public function insert_devolucion_entrada($responsable,$num_entrada,$proveedor,$motivo)
    {
        $tmodulo=new Modulo;
        $consulta = "INSERT INTO DEVOLUCION_ENTRADA (RESPONSABLE,REFERENCIA,PROVEEDOR,MOTIVO) VALUES ('{$responsable}',{$num_entrada},'{$proveedor}','{$motivo}')";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
        $this->sumar_compra($codigo_producto,$cantidad);   /*SUMAR DEVUELTOS A PRODUCTO*/
        $consulta = "UPDATE ENTRADA SET DEVUELTO=1 WHERE NUM_ENTRADA={$num_entrada}";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
    }


    /*FUNCION DE INSERTAR LA TABLA DE CARACTERISTICAS DE DEVOLUCION DE ENTRADA */


    public function insert_detalle_dev_entrada($codigo_producto,$cantidad,$precio,$num_entrada)
    {
        $tmodulo=new Modulo;
        $consulta = "INSERT INTO CARAC_DEVOLUCION_ENTRADA (CODIGO_PRODUCTO,NOMBRE_PRODUCTO,CANTIDAD,PRECIO,REFERENCIA) VALUES ('{$codigo_producto}','".$this->readProducto($codigo_producto)['NOMBRE']."',{$cantidad},{$precio},{$num_entrada})";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
        $this->restar_inventario($codigo_producto,$cantidad);
    }
  
    
      /*FUNCION LEER DEVOLUCION DE ENTRADA */
  
    public function readDevEntrada($num_entrada){
      $row;
      $tmodulo=new Modulo;
      $consulta = "SELECT * FROM DEVOLUCION_ENTRADA WHERE REFERENCIA=".$num_entrada;
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
      
      if($row = mysqli_fetch_array($resultado))
      return $row;  
    }
  
   /*FUNCION DE SUMAR A INSUMOS*/

    public function sumar_compra($codigo_producto,$cantidad){
        $producto = new producto; 
        $tmodulo=new Modulo;
        $existencia=$producto->readProducto($codigo_producto)['EXISTENCIA'];
        $consulta = "UPDATE INSUMOS SET EXISTENCIA=".strval($existencia + $cantidad)." WHERE CODIGO='".$codigo_producto."'";
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
      }
    
    
  /*FUNCIONES DE RESTAR A INSUMOS*/
      
    public function restar_inventario($codigo_producto,$cantidad){
      $producto = new producto; 
      $tmodulo=new Modulo;
      $existencia=$producto->readProducto($codigo_producto)['EXISTENCIA'];
      $consulta = "UPDATE INSUMOS SET EXISTENCIA=".strval($existencia - $cantidad)." WHERE CODIGO='".$codigo_producto."'";
      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
    }


    /*FUNCION DE LEER CARACTERISTICAS DE PRODUCTO POR CODIGO*/

      public function readProducto($codigo){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM INSUMOS WHERE CODIGO='".$codigo."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }


    /*FUNCION DE LISTAR INSUMOS POR NUMERO DE ENTRADA*/

      public function list_productos($num_entrada){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT CODIGO_PRODUCTO,NOMBRE_PRODUCTO from CARAC_ENTRADA WHERE NUM_ENTRADA={$num_entrada}";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
            while($row = mysqli_fetch_array($resultado)){
              $cadena=$cadena."<option value='{$row['CODIGO']}' label='{$row['NOMBRE_PRODUCTO']}'>";
            }
        $cadena=$cadena."";
        echo $cadena;
      }


    /*FUNCION DE LEER CARACTERISTICAS DEL USUARIO POR CEDULA*/
  
    public function getUsuario($cedula){
      $tmodulo=new Modulo;
      $consulta = "SELECT * FROM usuario WHERE IDusuario=".$cedula."";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
      $row = mysqli_fetch_array($resultado);
      return $row;
    }


}
