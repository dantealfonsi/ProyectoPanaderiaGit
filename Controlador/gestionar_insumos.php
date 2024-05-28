<?php 

/*CREACION DE CLASE PRODUCTO*/

class Producto{

    public $codigo;
    public $nombre;
    public $precio;
    public $almacen;
    public $existencia;     /*VARIABLES DE CLASE PRODUCTO*/
    public $categoria;
    public $c_min;
    public $c_max;

    /*VERIFICAR SI UNA CATEGORIA EXISTE*/

    public function ifCategoriaExist($categoria) {
      $tmodulo=new Modulo;
      if($tmodulo->row_sqlconector("select COUNT(*) AS TOTAL from CATEGORIA_INSUMOS where NOMBRE='{$categoria}'")['TOTAL']==1 )
      return TRUE;
      return FALSE;
    }
    

    /*VERIFICAR SI UN CODIGO EXISTE*/

    public function ifCodigoExist($codigo) {
      $tmodulo=new Modulo;
      if($tmodulo->row_sqlconector("select COUNT(*) AS TOTAL from insumos where CODIGO='{$codigo}'")['TOTAL']==1 )
      return TRUE;
      return FALSE;
    }    


    /*FUNCION PARA CREAR UN PRODUCTO*/

    public function crearProductos($codigo,$nombre,$precio,$almacen,$categoria,$c_min,$c_max){
      $tmodulo=new Modulo;
      if($this->ifCodigoExist($codigo)){                          /*VER SI EL CODIGO EXISTE*/
        echo "<script>alert('Este Producto ya existe')</script>";
      }else{
        if($this->ifCategoriaExist($categoria)){                /*VER SI LA CATEGORIA EXISTE*/
          $consulta = "INSERT INTO insumos(CODIGO,NOMBRE,PRECIO,ALMACEN,CATEGORIA,C_MIN,C_MAX) VALUES('".$codigo."','".$nombre."',".$precio.",".$almacen.",'{$categoria}','{$c_min}','{$c_max}')";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en insertar el Producto");
          echo "<script>alert('Producto Agregado con Exito!');</script>";
        }
        else{
          echo "<script>alert('Esta Categoria No Existe')</script>";
        }
      }
      }


      /*FUNCION PARA BORRAR UN PRODUCTO*/

      public function borrarProductos($codigo){
        $tmodulo=new Modulo;
        $consulta = "UPDATE insumos SET DELETED=1  WHERE CODIGO='{$codigo}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Producto");
      }


      /*REHABILITAR UN PRODUCTO DESABILITADO*/

      public function RehabilitarProductos($codigo){
        $tmodulo=new Modulo;
        $consulta = "UPDATE insumos SET DELETED=0  WHERE CODIGO='{$codigo}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Producto");
      }
      
      /*FUNCION PARA EDITAR UN PRODUCTO*/
      
      public function editarProductos($id,$codigo,$nombre,$precio,$almacen,$existencia,$categoria,$c_min,$c_max){
        $tmodulo=new Modulo;
        if($this->ifCategoriaExist($categoria)){ /*Ver si categoria existe en la edicion*/
          $consulta = "UPDATE insumos SET CATEGORIA='{$categoria}',CODIGO='".$codigo."',NOMBRE='".$nombre."',PRECIO=".$precio.",ALMACEN=".$almacen.",EXISTENCIA=".$existencia.",C_MIN=".$c_min.",C_MAX=".$c_max." WHERE CODIGO='{$id}'";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en ACTUALIZAR el Producto");
        }
        else{
          echo "<script>alert('Esta Categoria No Existe')</script>";
        }
      }


      /*FUNCION PARA LEER UN PRODUCTO POR EL CODIGO*/

      public function readProducto($codigo){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM insumos WHERE CODIGO='".$codigo."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }


      /*FUNCION PARA REGRESAR TOTAL DE insumos POR ENTRADA*/

      public function returnSumEntrada($codigo,$desde,$hasta){
        $tmodulo=new Modulo;
        $consulta = "SELECT SUM(CANTIDAD) AS TOTAL, CODIGO_PRODUCTO FROM CARAC_ENTRADA WHERE CODIGO_PRODUCTO = '{$codigo}'";
      if(strlen($desde)>0){
        $consulta = "SELECT SUM(CANTIDAD) AS TOTAL, CODIGO_PRODUCTO FROM CARAC_ENTRADA WHERE FECHA BETWEEN '{$desde} 00:00' AND '{$hasta} 23:59' AND CODIGO_PRODUCTO = '{$codigo}'";
      }
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row['TOTAL'];  
      }


      /*FUNCION PARA REGRESAR TOTAL DE insumos POR SALIDA*/

      public function returnSumSalida($codigo,$desde,$hasta){
        $tmodulo=new Modulo;
        $consulta = "SELECT SUM(CANTIDAD) AS TOTAL, CODIGO_PRODUCTO FROM CARAC_SALIDA WHERE CODIGO_PRODUCTO = '{$codigo}'";
        if(strlen($desde)>0){
          $consulta = "SELECT SUM(CANTIDAD) AS TOTAL, CODIGO_PRODUCTO FROM CARAC_SALIDA WHERE FECHA BETWEEN '{$desde} 00:00' AND '{$hasta} 23:59' AND CODIGO_PRODUCTO = '{$codigo}'";
        }
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row['TOTAL'];  
      }


      /*VER LISTA DE insumos*/

      public function list_productos(){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT * from PRODUCTOS WHERE DELETED=0";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
            while($row = mysqli_fetch_array($resultado)){
              $cadena=$cadena."<option value='{$row['CODIGO']}' label='{$row['NOMBRE']}'>";
            }
        $cadena=$cadena."";
        echo $cadena;
      }


      /*FUNCION PARA LEER UNA ENTRADA DONDE NUM ENTRADA*/    

      public function readEntrada($num_entrada){
        $row;
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM ENTRADA WHERE NUM_ENTRADA=".$num_entrada;
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }


      /*FUNCION PARA LEER UNA SALIDA DONDE NUM SALIDA*/

      public function readSalida($num_salida){
        $row;
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM SALIDA WHERE NUM_SALIDA=".$num_salida;
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }


      /*FUNCION PARA LEER UN USUARIO POR CEDULA*/

      public function readUsuario($cedula){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM USUARIOS WHERE CEDULA='".$cedula."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        $row = mysqli_fetch_array($resultado);
        return $row;
      }


      /*LISTA DE PROVEEDORES*/

      public function list_proveedores(){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT * from PROVEEDOR";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
            while($row = mysqli_fetch_array($resultado)){
              $cadena=$cadena."<option value='{$row['NOMBRE']}' label='{$row['RIF']}'>";
            }
        $cadena=$cadena."";
        echo $cadena;
      }


      /**********INSERTAR ENTRADA RAPIDA**************/
      
      public function insert_entrada($codigo_producto,$cantidad,$precio,$responsable,$num_entrada,$proveedor)
      {
          $tmodulo=new Modulo;
          $consulta = "INSERT INTO ENTRADA (RESPONSABLE,NUM_ENTRADA,PROVEEDOR) VALUES ('{$responsable}',{$num_entrada},'{$proveedor}')";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrar la compra");      
          $consulta = "INSERT INTO CARAC_ENTRADA (CODIGO_PRODUCTO,NOMBRE_PRODUCTO,CANTIDAD,PRECIO,NUM_ENTRADA) VALUES ('{$codigo_producto}','".$this->readProducto($codigo_producto)['NOMBRE']."',{$cantidad},{$precio},{$num_entrada})";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrar la compra");      
          $existencia=$this->readProducto($codigo_producto)['EXISTENCIA'];
          $consulta = "UPDATE PRODUCTOS SET EXISTENCIA=".strval($existencia + $cantidad)." WHERE CODIGO='".$codigo_producto."'";
          $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
        }


        /*LISTA DE CATEGORIAS*/
        public function list_categoria(){
          $tmodulo = new Modulo;
          $cadena = "";
          $consulta = "SELECT * from categoria_insumos";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
              while($row = mysqli_fetch_array($resultado)){
                $cadena=$cadena."<option value='{$row['NOMBRE']}'>";
              }
          $cadena=$cadena."";
          echo $cadena;
        }

        /*FUNCION PARA CAMBIAR DE COLOR CON MINIMO Y MAXIMO*/

        public function returnColor($c_min,$c_max,$existencia){
          $color = 'transparent';
          if($existencia<=$c_min){
            $color = "#f39f9f";   /*Si es menorque el minimo*/
          }
          if($existencia>=($c_max/2) && $existencia<=$c_max){  /*Si es mayor a 50% y menor que el maximo*/
            $color = "#bbdfca";
          }
          if($existencia>$c_max){   /*Si es mayor que el maximo*/
            $color = "#bbdfca";
          }
          if($existencia>$c_min && $existencia<($c_max/2)){    /*Si es menor a 50% y mayor que el minimo*/
            $color = "#f7d7a5";
          }    

          return $color;

        }

        /*FUNCION PARA LEER UNA CATEGORIA*/

        public function readCategoria($nombre){
          $tmodulo=new Modulo;
          $consulta = "SELECT * FROM CATEGORIA_INSUMOS WHERE NOMBRE='".$nombre."'";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
          
          if($row = mysqli_fetch_array($resultado)){
            return $row['NOMBRE'];
          }
          return 'NULL';
            
        }


}
