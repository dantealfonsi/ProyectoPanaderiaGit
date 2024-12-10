<?php

/*INCLUDE DE MODULO PARA CONEXION CON BASE DE DATOS*/

/*CREACION DE CLASE CATEGORIA_INSUMOS*/ 

class categoriaProductos{    

    public $idCategoria; /*VARIABLES DE CATEGORIA_INSUMOS*/
    public $nombre;

/*INICIO DE FUNCIONES*/

/*FUNCION DE CREAR NUEVA CATEGORIA_INSUMOS*/

    public function crearCategoria($nombre){
    if(strlen($nombre)>0)
      if($nombre==@$this->readCategoria($nombre)['nombre_categoria']){  /*POR SI EL NOMBRE YA EXISTE*/
      
        echo "<script>alert('Esta Categoria ya existe')</script>";

      }else{

        $tmodulo=new Modulo;
        $consulta = "INSERT INTO categorias (nombre_categoria) VALUES('".$nombre."')";
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
        $consulta = "DELETE FROM categorias WHERE id='{$idCategoria}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Producto");
      }


/*FUNCION DE EDITAR UNA CATEGORIA_INSUMOS*/
    
      public function editarCategoria($idCategoria, $nombre){
        $tmodulo=new Modulo;
        if (empty($this->readCategoria($nombre)['nombre_categoria'])){          /*POR SI ES EL MISMO NOMBRE O ESTA VACIO*/
          $consulta = "UPDATE categorias SET nombre='".$nombre."' WHERE id='{$idCategoria}'";
          $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en ACTUALIZAR el Producto");          

        }
        else{

        }
    }


/*LEER LOS DATOS UNA CATEGORIA_INSUMOS*/
    
      public function readCategoria($nombre){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM categorias WHERE nombre_categoria='".$nombre."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }

      
/*LEER LOS DATOS UNA CATEGORIA_INSUMOS POR ID*/

      public function readCategoriaId($idCategoria){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM categorias WHERE idcategoria='".$idCategoria."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }

      public function readNombreCategoriaId($idCategoria){
        $tmodulo=new Modulo;
        $consulta = "SELECT nombre_categoria FROM categorias WHERE idcategoria='".$idCategoria."'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
        
        if($row = mysqli_fetch_array($resultado))
        return $row;  
      }

}
