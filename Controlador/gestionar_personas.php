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

    public function crearPersona($nombreUsuario,$contrasena,$nombre,$apellido,$telefono,$correo,$direccion,$cargo){
      $tmodulo=new Modulo;
      //Generar VKey
      $vkey = md5(time().$nombreUsuario);
      //genera un IDpersona
      $bytes = random_bytes(5);
      $IDpersona = bin2hex($bytes);

      $hashContrasena = password_hash($contrasena, PASSWORD_BCRYPT);

      $Q_insert_persona = "INSERT INTO persona(idpersona,nombre,apellido,telefono,direccion,cargo,tipo) VALUES('$IDpersona','$nombre','$apellido','$telefono','$direccion','$cargo','EMPLEADO')";
      $Q_insert_usuario = "INSERT INTO usuario(idpersona,nombreUsuario,contrasena,nombre,apellido,correo,direccion,telefono,verificado,esAdmin,claveVerificacion) values('$IDpersona','$nombreUsuario','$hashContrasena','$nombre','$apellido','$correo','$direccion','$telefono',1,$cargo,'$vkey')";
      $result_persona = mysqli_query( $tmodulo->mysqlconnect(), $Q_insert_persona );
      $result_usuario = mysqli_query( $tmodulo->mysqlconnect(), $Q_insert_usuario );
    }

    /*FUNCION PARA CREAR UN NUEVO CLIENTE*/

    public function crearCliente($nombre,$apellido,$cedula,$telefono,$direccion,$cargo){
      if($cedula==@$this->readPersona($cedula)['cedula']){       /*Si existe un cliente igual*/
      
        //echo "<script>alert('Esta cliente ya existe')</script>";      

      }else{
        
        $tmodulo=new Modulo;
        $consulta = "INSERT INTO persona(nombre,apellido,cedula,telefono,direccion,cargo,tipo) VALUES('{$nombre}','{$apellido}','{$cedula}','{$telefono}','{$direccion}','{$cargo}','CLIENTE')";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal  Borrando la persona");       
        //echo "<script>alert('Cliente agregado con Exito!');</script>";
      }
      
    }


      /*FUNCION PARA BORRAR UNA PERSONA O CLIENTE*/

      public function borrarPersona($cedula){
        $tmodulo=new Modulo;
        $consulta = "UPDATE persona SET deleted=1 WHERE cedula='{$cedula}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal borrando la persona");        
        //echo "<script>alert('Desabilitado con Exito!');</script>";
      }
      

      /*FUNCION PARA EDITAR UNA PERSONA*/

      public function editarPersona($nombre,$apellido,$cedula,$telefono,$direccion,$cargo){
        $tmodulo=new Modulo;   
        if($rif==@$this->readPersona($cedula)['cedula']){
      
          die("<script>alert('Esta persona ya existe')</script>");
  
        }else{     
        $consulta = "UPDATE persona SET cedula='{$cedula}',nombre='{$nombre}',apellido='{$apellido}',telefono='{$telefono}',direccion='{$direccion}',cargo='{$cargo}' WHERE cedula='{$cedula}'";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Proveedor");        
      }
    }

    /*FUNCION PARA EDITAR UN CLIENTE*/

    public function editarCliente($nombre,$apellido,$cedula,$telefono,$direccion){
      $tmodulo=new Modulo;   
      if($rif==@$this->readPersona($cedula)['cedula']){
    
        die("<script>alert('Esta persona ya existe')</script>");

      }else{     
      $consulta = "UPDATE persona SET cedula='{$cedula}',nombre='{$nombre}',apellido='{$apellido}',telefono='{$telefono}',direccion='{$direccion}',cargo='{$cargo}' WHERE cedula='{$cedula}'";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrarn el Proveedor");        
      //echo "<script>alert('Cliente editado con Exito!');</script>";
    }
  }


      /*LEER UNA PERSONA O CLIENTE POR CEDULA*/

      public function readPersona($cedula){
        $tmodulo=new Modulo;
        $consulta = "SELECT * FROM persona WHERE cedula='".$cedula."'";
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);
        $row = mysqli_fetch_array($resultado);
        return $row;  
      }

    }
