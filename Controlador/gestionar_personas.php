<?php

/*CREACION DE PERSONA*/


class Persona{

  public $cedula;
  public $nombre;
  public $apellido;     /*VARIABLES DE PERSONA*/
  public $telefono;
  public $direccion;
  public $cargo;


    /*FUNCION PARA CREAR UNA NUEVA PERSONA*/

    public function crearPersona($nombre,$apellido,$cedula,$telefono,$direccion,$cargo){
      $tmodulo=new Modulo;
      if($cedula==$this->readPersona($cedula)['CEDULA']){           /*Si existe una persona igual*/
        $consulta = "UPDATE PERSONA SET TIPO='EMPLEADO', CARGO='{$cargo}' WHERE CEDULA='{$cedula}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal agregando un empleado");       
        //echo "<script>alert('Este Empleado ya existe')</script>";
      }else{        
        $consulta = "INSERT INTO PERSONA(NOMBRE,APELLIDO,CEDULA,TELEFONO,DIRECCION,CARGO,TIPO) VALUES('{$nombre}','{$apellido}','{$cedula}','{$telefono}','{$direccion}','{$cargo}','EMPLEADO')";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal  Borrando la persona");       
        //echo "<script>alert('Empleado agregado con Exito!');</script>";
      }
      
    }

    /*FUNCION PARA CREAR UN NUEVO CLIENTE*/

    public function crearCliente($nombre,$apellido,$cedula,$telefono,$direccion,$cargo){
      if($cedula==@$this->readPersona($cedula)['CEDULA']){       /*Si existe un cliente igual*/
      
        //echo "<script>alert('Esta cliente ya existe')</script>";      

      }else{
        
        $tmodulo=new Modulo;
        $consulta = "INSERT INTO PERSONA(NOMBRE,APELLIDO,CEDULA,TELEFONO,DIRECCION,CARGO,TIPO) VALUES('{$nombre}','{$apellido}','{$cedula}','{$telefono}','{$direccion}','{$cargo}','CLIENTE')";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal  Borrando la persona");       
        //echo "<script>alert('Cliente agregado con Exito!');</script>";
      }
      
    }


      /*FUNCION PARA BORRAR UNA PERSONA O CLIENTE*/

      public function borrarPersona($cedula){
        $tmodulo=new Modulo;
        $consulta = "UPDATE PERSONA SET DELETED=1 WHERE CEDULA='{$cedula}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal borrando la persona");        
        //echo "<script>alert('Desabilitado con Exito!');</script>";
      }
      

      /*FUNCION PARA EDITAR UNA PERSONA*/

      public function editarPersona($nombre,$apellido,$cedula,$telefono,$direccion,$cargo){
        $tmodulo=new Modulo;   
        if($rif==@$this->readPersona($cedula)['CEDULA']){
      
          die("<script>alert('Esta persona ya existe')</script>");
  
        }else{     
        $consulta = "UPDATE PERSONA SET CEDULA='{$cedula}',NOMBRE='{$nombre}',APELLIDO='{$apellido}',TELEFONO='{$telefono}',DIRECCION='{$direccion}',CARGO='{$cargo}' WHERE CEDULA='{$cedula}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Proveedor");        
      }
    }

    /*FUNCION PARA EDITAR UN CLIENTE*/

    public function editarCliente($nombre,$apellido,$cedula,$telefono,$direccion){
      $tmodulo=new Modulo;   
      if($rif==@$this->readPersona($cedula)['CEDULA']){
    
        die("<script>alert('Esta persona ya existe')</script>");

      }else{     
      $consulta = "UPDATE PERSONA SET CEDULA='{$cedula}',NOMBRE='{$nombre}',APELLIDO='{$apellido}',TELEFONO='{$telefono}',DIRECCION='{$direccion}',CARGO='{$cargo}' WHERE CEDULA='{$cedula}'";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Proveedor");        
      //echo "<script>alert('Cliente editado con Exito!');</script>";
    }
  }


      /*LEER UNA PERSONA O CLIENTE POR CEDULA*/

      public function readPersona($cedula){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM PERSONA WHERE CEDULA='".$cedula."'";
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);
        $row = mysqli_fetch_array($resultado);
        return $row;  
      }

    }
