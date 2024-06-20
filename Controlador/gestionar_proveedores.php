<?php

class Proveedor{

  public $nombre;
  public $rif;
  public $telefono;       /*Variables de PROVEEDOR*/
  public $direccion;


    /*Funcion Para insterta un nuevo PROVEEDOR*/

    public function crearProveedor($nombre,$rif,$telefono,$direccion){
      if($rif==@$this->readProveedor($rif)['rif']){  /*Por si el RIF EXISTE*/
      
        echo "<script>alert('Este Proveedor ya existe')</script>";

      }else{
        
        $tmodulo=new Modulo;
        $consulta = "INSERT INTO proveedor(nombre,rif,telefono,direccion) VALUES('{$nombre}','{$rif}','{$telefono}','{$direccion}')";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Proveedor");       
      }
      
    }


      /*FUNCION DE BORRAR PROVEEDOR*/
    
      public function borrarProveedor($rif){
        $tmodulo=new Modulo;
        $consulta = "UPDATE proveedor SET deleted=1 WHERE rif='{$rif}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Proveedor");        
      }
      

      /*FUNCION DE EDITAR UN PROVEEDOR*/

      public function editarProveedor($nombre,$rif,$telefono,$direccion){
        $tmodulo=new Modulo;   
        //if($rif==@$this->readProveedor($rif)['RIF']){
      
          //die("<script>alert('Este Proveedor ya existe')</script>");
  
       // }else{     
        $consulta = "UPDATE proveedor SET nombre='{$nombre}',rif='{$rif}',telefono='{$telefono}',direccion='{$direccion}' WHERE rif='{$rif}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Proveedor");        
      //}
    }


      /*LEER UN PROVEEDOR POR RIF*/

      public function readProveedor($rif){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM proveedor WHERE rif='".$rif."'";
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);
        $row = mysqli_fetch_array($resultado);
        return $row;  
      }

      
      /*LLEER SOLO EL NOMBRE DE UN PROVEEDOR EN ENTRADA POR NUMERO DE ENTRADA*/

      public function readNombreProveedor($num_entrada){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM entrada WHERE num_entrada='".$num_entrada."'";
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);
        $row = mysqli_fetch_array($resultado);
        return $row;  
      }
      
    }
