<?php

/*INCLUDE DE MODULO PARA CONEXION CON BASE DE DATOS*/

include 'gestionar_insumos.php';


/*CREACION DE CLASE DEV_SALIDA*/

class dev_salida{ 

  public $responsable;
  public $detalle;
  public $num_salida;
  public $fecha;
  public $codigo_producto;  /*VARIABLES DE DEV_SALIDA*/
  public $cantidad;
  public $cedula;
  public $precio;
  public $motivo;
  public $id_compra;


  /*LISTAS DE SALIDAS DONDE NO ESTEN DEVUELTAS*/

  public function list_salida(){
    $tmodulo = new Modulo;
    $cadena = "";
    $consulta = "SELECT * from salida WHERE devuelto=0";
    $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        while($row = mysqli_fetch_array($resultado)){
          $cadena=$cadena."<option value='{$row['num_salida']}' label='{$row['num_salida']}'>";
        }
    $cadena=$cadena."";
    echo $cadena;
  }


    /*FUNCIONES DE SUMAR A INSUMOS*/
    
  public function sumar_inventario($codigo_producto,$cantidad){
    $producto = new producto; 
    $tmodulo=new Modulo;
    $existencia=$producto->readProducto($codigo_producto)['existencia'];
    $consulta = "UPDATE insumos SET existencia=".strval($existencia + $cantidad)." WHERE codigo='".$codigo_producto."'";
    $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
  }


    /*HACER QUE SALIDAS SE DEVUELVAN*/

    public function setDevolucionSalida($referencia)
    {
        $tmodulo=new Modulo;
        $consulta = "UPDATE salida SET devuelto=1 WHERE num_salida={$referencia}";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
        $this->setDevolucionEntrada($num_entrada);
  
    }


    /*INSERTAR UNA DEVOLUCION DE SALIDA*/

    public function insert_devolucion_salida($responsable,$num_salida,$cedula_cliente,$motivo)
    {
        $tmodulo=new Modulo;
        $consulta = "INSERT INTO devolucion_salida (responsable,referencia,cedula_cliente,motivo) VALUES ('{$responsable}',{$num_salida},'{$cedula_cliente}','{$motivo}')";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
        $this->sumar_compra($codigo,$cantidad);
        $consulta = "UPDATE salida SET devuelto=1 WHERE num_salida={$num_salida}";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
    }

    
    /*FUNCION DE INSERTAR LA TABLA DE CARACTERISTICAS DE DEVOLUCION DE SALIDA */

  public function insert_detalle_dev_salida($codigo_producto,$cantidad,$precio,$num_salida)
  {
      $tmodulo=new Modulo;
      $consulta = "INSERT INTO carac_devolucion_salida (codigo_producto,nombre_producto,cantidad,precio,referencia) VALUES ('{$codigo_producto}','".$this->readProducto($codigo_producto)['NOMBRE']."',{$cantidad},{$precio},{$num_salida})";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn la compra");      
      $this->sumar_inventario($codigo_producto,$cantidad);
  }

  
  /*FUNCION LEER DEVOLUCION DE SALIDA */

  public function readDevSalida($num_salida){
    $row;
    $tmodulo=new Modulo;
    $consulta = "SELECT * FROM devolucion_salida WHERE referencia=".$num_salida;
    $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
    
    if($row = mysqli_fetch_array($resultado))
    return $row;  
  }




    /*FUNCION DE SUMAR A INSUMOS*/

    public function sumar_compra($codigo,$cantidad){
        $producto = new producto; 
        $tmodulo=new Modulo;
        $existencia=$producto->readProducto($codigo)['existencia'];
        $consulta = "UPDATE insumos SET existencia=".strval($existencia + $cantidad)." WHERE codigo='".$codigo_producto."'";
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

    /*FUNCION DE LISTAR INSUMOS POR NUMERO DE SALIDA*/

 
      public function list_productos($num_entrada){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT codigo_producto,nombre_producto from carac_salida WHERE num_salida={$num_salida}";
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
      $consulta = "SELECT * FROM usuario WHERE idusuario=".$cedula."";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
      $row = mysqli_fetch_array($resultado);
      return $row;
    }

}