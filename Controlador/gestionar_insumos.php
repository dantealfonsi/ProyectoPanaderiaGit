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
      if($tmodulo->row_sqlconector("select COUNT(*) AS TOTAL from categoria_insumos where nombre='{$categoria}'")['TOTAL']==1 )
      return TRUE;
      return FALSE;
    }
    

    /*VERIFICAR SI UN CODIGO EXISTE*/

    public function ifCodigoExist($codigo) {
      $tmodulo=new Modulo;
      if($tmodulo->row_sqlconector("select COUNT(*) AS TOTAL from insumos where codigo='{$codigo}'")['TOTAL']==1 )
      return TRUE;
      return FALSE;
    }    


    /*FUNCION PARA CREAR UN PRODUCTO*/

    public function crearProductos($codigo,$nombre,$precio,$almacen,$categoria,$c_min,$c_max,$uni){
      $tmodulo=new Modulo;
      if($this->ifCodigoExist($codigo)){                          /*VER SI EL CODIGO EXISTE*/
        echo "<script>alert('Este Producto ya existe')</script>";
      }else{
        if($this->ifCategoriaExist($categoria)){                /*VER SI LA CATEGORIA EXISTE*/
          $consulta = "INSERT INTO insumos(codigo,nombre,precio,almacen,categoria,c_min,c_max,uni) VALUES('".$codigo."','".$nombre."',".$precio.",".$almacen.",'{$categoria}','{$c_min}','{$c_max}','{$uni}')";
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
        $consulta = "UPDATE insumos SET deleted=1  WHERE codigo='{$codigo}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Producto");
      }


      /*REHABILITAR UN PRODUCTO DESABILITADO*/

      public function RehabilitarProductos($codigo){
        $tmodulo=new Modulo;
        $consulta = "UPDATE insumos SET deleted=0  WHERE codigo='{$codigo}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Producto");
      }
      
      /*FUNCION PARA EDITAR UN PRODUCTO*/
      
      public function editarProductos($id,$codigo,$nombre,$precio,$almacen,$existencia,$categoria,$c_min,$c_max,$uni){
        $tmodulo=new Modulo;
        if($this->ifCategoriaExist($categoria)){ /*Ver si categoria existe en la edicion*/
          $consulta = "UPDATE insumos SET categoria='{$categoria}',codigo='".$codigo."',nombre='".$nombre."',precio=".$precio.",almacen=".$almacen.",existencia=".$existencia.",c_min=".$c_min.",c_max=".$c_max.", uni='{$uni}' WHERE codigo='{$id}'";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en ACTUALIZAR el Producto");
        }
        else{
          echo "<script>alert('Esta Categoria No Existe')</script>";
        }
      }


      /*FUNCION PARA LEER UN PRODUCTO POR EL CODIGO*/

      public function readProducto($codigo){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM insumos WHERE codigo='".$codigo."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }


      /*FUNCION PARA REGRESAR TOTAL DE insumos POR ENTRADA*/

      public function returnSumEntrada($codigo,$desde,$hasta){
        $tmodulo=new Modulo;
        $consulta = "SELECT SUM(cantidad) AS total, codigo_producto FROM carac_entrada WHERE codigo_producto = '{$codigo}'";
      if(strlen($desde)>0){
        $consulta = "SELECT SUM(cantidad) AS total, codigo_producto FROM carac_entrada WHERE fecha BETWEEN '{$desde} 00:00' AND '{$hasta} 23:59' AND codigo_producto = '{$codigo}'";
      }
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row['TOTAL'];  
      }


      /*FUNCION PARA REGRESAR TOTAL DE insumos POR SALIDA*/

      public function returnSumSalida($codigo,$desde,$hasta){
        $tmodulo=new Modulo;
        $consulta = "SELECT SUM(cantidad) AS total, codigo_producto FROM carac_salida WHERE codigo_producto = '{$codigo}'";
        if(strlen($desde)>0){
          $consulta = "SELECT SUM(cantidad) AS total, codigo_producto FROM carac_salida WHERE fecha BETWEEN '{$desde} 00:00' AND '{$hasta} 23:59' AND codigo_producto = '{$codigo}'";
        }
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row['total'];  
      }


      /*VER LISTA DE insumos*/

      public function list_productos(){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT * from insumos WHERE deleted=0";
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
        $consulta = "SELECT * FROM entrada WHERE num_entrada=".$num_entrada;
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }


      /*FUNCION PARA LEER UNA SALIDA DONDE NUM SALIDA*/

      public function readSalida($num_salida){
        $row;
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM salida WHERE num_salida=".$num_salida;
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }


      /*FUNCION PARA LEER UN USUARIO POR CEDULA*/

      /*LISTA DE PROVEEDORES*/

      public function list_proveedores(){
        $tmodulo = new Modulo;
        $cadena = "";
        $consulta = "SELECT * from proveedor";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
            while($row = mysqli_fetch_array($resultado)){
              $cadena=$cadena."<option value='{$row['nombre']}' label='{$row['rif']}'>";
            }
        $cadena=$cadena."";
        echo $cadena;
      }


      /**********INSERTAR ENTRADA RAPIDA**************/
      
      public function insert_entrada($codigo_producto,$cantidad,$precio,$responsable,$num_entrada,$proveedor)
      {
          $tmodulo=new Modulo;
          $consulta = "INSERT INTO entrada (responsable,num_entrada,proveedor) VALUES ('{$responsable}',{$num_entrada},'{$proveedor}')";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrar la compra");      
          $consulta = "INSERT INTO carac_entrada (codigo_producto,nombre_producto,cantidad,precio,num_entrada) VALUES ('{$codigo_producto}','".$this->readProducto($codigo_producto)['nombre']."',{$cantidad},{$precio},{$num_entrada})";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrar la compra");      
          $existencia=$this->readProducto($codigo_producto)['existencia'];
          $consulta = "UPDATE insumos SET existencia=".strval($existencia + $cantidad)." WHERE codigo='".$codigo_producto."'";
          $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en sumarInventario");
        }


        /*LISTA DE CATEGORIAS*/
        public function list_categoria(){
          $tmodulo = new Modulo;
          $cadena = "";
          $consulta = "SELECT * from categoria_insumos";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
              while($row = mysqli_fetch_array($resultado)){
                $cadena=$cadena."<option value='{$row['nombre']}'>";
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
          $consulta = "SELECT * FROM categoria_insumos WHERE nombre='".$nombre."'";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
          
          if($row = mysqli_fetch_array($resultado)){
            return $row['nombre'];
          }
          return 'NULL';
            
        }


}
