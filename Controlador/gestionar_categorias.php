<?php

/*INCLUDE DE MODULO PARA CONEXION CON BASE DE DATOS*/

/*CREACION DE CLASE CATEGORIA_INSUMOS*/

class categoria{    

    public $idCategoria; /*VARIABLES DE CATEGORIA_INSUMOS*/
    public $nombre;

/*INICIO DE FUNCIONES*/

/*FUNCION DE CREAR NUEVA CATEGORIA_INSUMOS*/

    public function crearCategoria($nombre){
    if(strlen($nombre)>0)
      if($nombre==@$this->readCategoria($nombre)['nombre']){  /*POR SI EL NOMBRE YA EXISTE*/
      
        echo "<script>alert('Esta Categoria ya existe')</script>";

      }else{

        $tmodulo=new Modulo;
        $consulta = "INSERT INTO categoria_insumos(nombre) VALUES('".$nombre."')";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en insertar el Producto");
        echo '

        <script type="text/javascript">
        
          swal({
            position: "top-end",
            type: "success",
            title: "Your work has been saved",
            showConfirmButton: false,
          })
        });
        
        </script>';     
      }
      }

      
 /*FUNCION DE BORRAR UNA CATEGORIA_INSUMOS*/
     
      public function borrarCategoria($idCategoria){
        $tmodulo=new Modulo;
        $consulta = "DELETE FROM categoria_insumos WHERE id='{$idCategoria}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Producto");
      }


/*FUNCION DE EDITAR UNA CATEGORIA_INSUMOS*/
    
      public function editarCategoria($idCategoria, $nombre){
        $tmodulo=new Modulo;
        if (empty($this->readCategoria($nombre)['nombre'])){          /*POR SI ES EL MISMO NOMBRE O ESTA VACIO*/
          $consulta = "UPDATE categoria_insumos SET nombre='".$nombre."' WHERE id='{$idCategoria}'";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en ACTUALIZAR el Producto");          

        }
        else{

        }
    }


/*LEER LOS DATOS UNA CATEGORIA_INSUMOS*/
    
      public function readCategoria($nombre){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM categoria_insumos WHERE nombre='".$nombre."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }

      
/*LEER LOS DATOS UNA CATEGORIA_INSUMOS POR ID*/

      public function readCategoriaId($idCategoria){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM categoria_insumos WHERE id='".$idCategoria."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }

}
