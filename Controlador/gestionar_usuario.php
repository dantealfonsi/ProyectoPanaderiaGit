<?php

/*CREACION DE CLASE USUARIO*/

class Usuario {

  public $nombre;
  public $password;
  public $nivel;          /*VARIABLES DE USUARIO*/
  public $cedula;

  ////////////////////*  public $llave = '12358132134'; */////////// Llave de Enriptado (Importante)
  

  /*FUNCION PARA ENCRIPTAR CLAVE*/ 

  public function encrypt($string, $key) {
    $result = '';
    for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
    }
    return base64_encode($result);  /*AQUI REGRESA EL ENCRIPTADO CON ENCODE*/
  }

  /*FUNCION DESENCRIPTADO*/

  public function decrypt($string, $key) {
   $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;      /*RETORNA EL DESENCRIPTADO (ENCRIPTADO AL CONTRARIO)*/
  }


  /*VERIFICAR SI UN USUARIO EXISTE*/

  public function if_user_exist($cedula){

    $tmodulo=new Modulo;
    $consulta = "SELECT * FROM usuario WHERE idusuario={$cedula}";  
    $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en insertar el usuario");
    $row = mysqli_fetch_array($resultado);
    if (isset($row['idusuario']))
    if ($row['idusuario']==$cedula) return TRUE;
    return FALSE;
  }


  /*VERIFICAR SI UNA PERSONA EXISTE*/

  public function if_persona_exist($cedula){

    $tmodulo=new Modulo;
    $consulta = "SELECT * FROM persona WHERE idpersona={$cedula}";  
    $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en insertar el usuario");
    $row = mysqli_fetch_array($resultado);
    if (isset($row['idpersona']))
    if ($row['idpersona']==$cedula) return TRUE;
    return FALSE;
  }


    /*FUNCION PARA CREAR UN USUARIO

  public function crearUsuario($nombre,$password,$nivel,$cedula){
    if($this->if_user_exist($cedula)){      
    
      echo "<script>alert('Este Usuario ya existe o Tiene la misma cedula')</script>";

    }else{
      if(!$this->if_persona_exist($cedula)){      
        echo "<script>alert('Este Usuario no existe en el sistema')</script>";
      }
      else{
        $tmodulo=new Modulo;
        $newPassword= $this->encrypt($password,$tmodulo->llave);
        $consulta = "INSERT INTO USUARIOS(NOMBRE,PASSWORD,NIVEL,CEDULA) VALUES('".$nombre."','".$newPassword."',".$nivel.",'{$cedula}')";
        $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en insertar el usuario");
      }
  
     }
 
  }


*/
    
    public function borrarUsuario($cedula){
      $tmodulo=new Modulo;
      $consulta = "UPDATE usuario SET deleted=1 WHERE idusuario={$cedula}";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en Borrar el usuario");
    }


  /*


    public function editarUsuario($id,$nombre,$password,$nivel,$cedula){
      $tmodulo=new Modulo;
      $newPassword= $this->encrypt($password,$tmodulo->llave); 
      $consulta = "UPDATE USUARIOS SET NOMBRE='".$nombre."',PASSWORD='".$newPassword."',NIVEL=".$nivel. ",CEDULA='{$cedula}' WHERE CEDULA=".$id;
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta ) or die ( "Algo ha ido mal en ACTUALIZAR el usuario");
    }
    */

  /*REGRESAR UN USUARIO POR SU NOMBRE*/

  public function returnUsuario($nombre){
    $row ="";
    $tmodulo=new Modulo;
    $consulta = "SELECT * FROM usuario WHERE idusuario=".$nombre;

    if ($resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta )){
      $row = mysqli_fetch_array($resultado);
      if (!empty($row['NOMBRE'])){
			  return $row;
      }
    }    
  }


  /*REGRESAR IMAGEN DE PERFIL

  public function returnPerfil(){
    echo "<img class='img-perfil' width='180' height='150' src='../upload/".returnUsuario($_SESSION['IDusuario'])[''].".png' alt=''>";
  }
  */

  /**********USUARIO FALLIDO********/

  public function userfailed(){
    $tmodulo=new Modulo;
    }
  

    /*FUNCION PARA CAMBIAR LA CONTRASEÑA

    public function changepassword($password){
      $tmodulo=new Modulo;
      $newPassword= $this->encrypt($password,$tmodulo->llave);  
  	  $consulta = "UPDATE USUARIOS SET PASSWORD='".$newPassword."' WHERE CEDULA=".$this->returnUsuario($_COOKIE['mari'])['CEDULA'];
    	$resultado = mysqli_query($tmodulo->mysqlconnect() , $consulta ) or die ( "Algo ha ido mal en ACTUALIZAR el Inventario");
    }
*/

    /*LISTAR PERSONAS*/

    public function listPersona(){
      $tmodulo = new Modulo;
      $cadena = "";
      $consulta = "SELECT * from persona WHERE deleted=0 AND tipo='EMPLEADO' ";
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
          while($row = mysqli_fetch_array($resultado)){
            $cadena=$cadena."<option label='{$row['nombre']} {$row['apellido']}' value='{$row['idpersona']}'>";
          }
      $cadena=$cadena."";
      echo $cadena;
    }

    /*FUNCION LEER PERSONAS POR CEDULA*/
    
    public function readPersona($cedula){
      $tmodulo=new Modulo;
      $consulta = "SELECT * FROM persona WHERE idpersona='".$cedula."'";
      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);
      $row = mysqli_fetch_array($resultado);
      return $row;  
    }

}