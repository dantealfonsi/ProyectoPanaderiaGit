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
    $consulta = "SELECT * from entrada WHERE devuelto=0";
    $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        while($row = mysqli_fetch_array($resultado)){
          $cadena=$cadena."<option value='{$row['num_entrada']}' label='{$row['num_entrada']}'>";
        }
    $cadena=$cadena."";
    echo $cadena;
  }



  /*HACER QUE ENTRADAS SE DEVUELVAN*/
 
    public function setDevolucionEntrada($referencia)
    {
        $tmodulo=new Modulo;
        $consulta = "UPDATE entrada SET devuelto=1 WHERE num_entrada={$referencia}";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
        $this->setDevolucionEntrada($num_entrada);
  
    }


  /*INSERTAR UNA DEVOLUCION DE ENTRADA*/ 

    public function insert_devolucion_entrada($responsable,$num_entrada,$proveedor,$motivo)
    {
        $tmodulo=new Modulo;
        $consulta = "INSERT INTO devolucion_entrada (responsable,referencia,proveedor,motivo) VALUES ('{$responsable}',{$num_entrada},'{$proveedor}','{$motivo}')";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
        $this->sumar_compra($codigo_producto,$cantidad);   /*SUMAR DEVUELTOS A PRODUCTO*/
        $consulta = "UPDATE entrada SET devuelto=1 WHERE num_entrada={$num_entrada}";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
    }


    /*FUNCION DE INSERTAR LA TABLA DE CARACTERISTICAS DE DEVOLUCION DE ENTRADA */


    public function insert_detalle_dev_entrada($codigo_producto,$cantidad,$precio,$num_entrada)
    {
        $tmodulo=new Modulo;
        $consulta = "INSERT INTO carac_devolucion_entrada (codigo_producto,nombre_producto,cantidad,precio,referencia) VALUES ('{$codigo_producto}','".$this->readProducto($codigo_producto)['NOMBRE']."',{$cantidad},{$precio},{$num_entrada})";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
        $this->restar_inventario($codigo_producto,$cantidad);
    }
  
    
      /*FUNCION LEER DEVOLUCION DE ENTRADA */
  
    public function readDevEntrada($num_entrada){
      $row;
      $tmodulo=new Modulo;
      $consulta = "SELECT * FROM devolucion_entrada WHERE referencia=".$num_entrada;
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
      
      if($row = mysqli_fetch_array($resultado))
      return $row;  
    }
  
   /*FUNCION DE SUMAR A INSUMOS*/

    public function sumar_compra($codigo_producto,$cantidad){
        $producto = new producto; 
        $tmodulo=new Modulo;
        $existencia=$producto->readProducto($codigo_producto)['EXISTENCIA'];
        $consulta = "UPDATE insumos SET existencia=".strval($existencia + $cantidad)." WHERE codigo='".$codigo_producto."'";
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
      }
    
    
  /*FUNCIONES DE RESTAR A INSUMOS*/
      
    public function restar_inventario($codigo_producto,$cantidad){
      $producto = new producto; 
      $tmodulo=new Modulo;
      $existencia=$producto->readProducto($codigo_producto)['EXISTENCIA'];
      $consulta = "UPDATE insumos SET existencia=".strval($existencia - $cantidad)." WHERE codigo='".$codigo_producto."'";
      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
    }


    /*FUNCION DE LEER CARACTERISTICAS DE PRODUCTO POR CODIGO*/

      public function readProducto($codigo){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM insumos WHERE codigo='".$codigo."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }


    /*FUNCION DE LISTAR INSUMOS POR NUMERO DE ENTRADA*/

      public function list_productos($num_entrada){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT codigo_producto,nombre_producto from carac_entrada WHERE num_entrada={$num_entrada}";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
            while($row = mysqli_fetch_array($resultado)){
              $cadena=$cadena."<option value='{$row['codigo']}' label='{$row['nombre_producto']}'>";
            }
        $cadena=$cadena."";
        echo $cadena;
      }


    /*FUNCION DE LEER CARACTERISTICAS DEL USUARIO POR CEDULA*/
  
    public function getUsuario($cedula){
      $tmodulo=new Modulo;
      $consulta = "SELECT * FROM usuario WHERE idusuario=".$cedula;
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
      $row = mysqli_fetch_array($resultado);
      return $row;
    }


}
