<?php 
    define('Acceso', TRUE);

    //Inicio de Sesión
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";    
?>

<?php

include "../../Modelo/conexion.php"; 

// insertar_producto.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bytes = random_bytes(5);
    $codigorifa = bin2hex($bytes);
    $IDproducto = $_POST['IDproducto'];
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion_producto = $_POST['descripcion_producto'];
    $precio_producto = $_POST['precio_producto'];
    $categoria_producto = $_POST['categoria_producto'];
    $IDReceta = $_POST['receta_producto'];
    $id_tipo =  $_POST['id_tipo'];
    $directorio = $GLOBALS['ROOT_PATH']."/Assets/productoimagenes/";
    $ext="";
    //$tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

    // Verificar que el archivo es una imagen
    if(isset($_FILES['imagen_producto']['name'])){
        $fileImagen="";
        $archivo = $_FILES['imagen_producto']['name'];
      if (isset($archivo) && $archivo != "") {
          $tipo = $_FILES['imagen_producto']['type'];
        $tamano = $_FILES['imagen_producto']['size'];
        $temp = $_FILES['imagen_producto']['tmp_name'];
        if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "webp") || strpos($tipo, "png")) && ($tamano < 500000))) {
            die ("<br><br>Error. La extensión o el tamaño de los archivos no es correcta.<br>Actualice la Pagina y Intente de Nuevo");
        }
        else {
                if(strpos($tipo,"jpg")) $ext=".jpg";
                else if (strpos($tipo,"png")) $ext=".png";
                else if (strpos($tipo,"webp")) $ext=".webp";
                else if (strpos($tipo,"jpeg")) $ext=".jpeg";
          $fileImagen='../../Assets/productoimagenes/'.$codigorifa.$ext;
          if (move_uploaded_file($temp,$fileImagen)) {
                chmod($fileImagen, 0777);
          }
           else {
              echo '<script>alert(\"Ocurrió algún error al subir la foto de Perfil. No pudo guardarse.\")</script>';
          }
         }
       }
    }

    // insertar los datos en la base de datos
    // ...
    
    if(isset($_FILES['imagen_producto']['name'])){
        $archivo = $_FILES['imagen_producto']['name'];
        if (isset($archivo) && $archivo != "") {
            $archivo = $directorio.$codigorifa.$ext;
            $archivoSubido = addslashes($archivo);
            $sql = "UPDATE productos SET 
            nombre_producto='$nombre_producto',
            descripcion_producto='$descripcion_producto', 
            imagen_producto='$archivoSubido',
            precio_producto=$precio_producto,
            categoria_producto=$categoria_producto,
            idreceta= '$IDReceta',
            idtipo=$id_tipo  
            WHERE idproducto=".$IDproducto;
        }
        else{
            $sql = "UPDATE productos SET 
            nombre_producto='$nombre_producto',
            descripcion_producto='$descripcion_producto',
            precio_producto=$precio_producto,
            categoria_producto=$categoria_producto,
            idreceta= '$IDReceta',
            idtipo=$id_tipo 
            WHERE idproducto=".$IDproducto;    
        }        
    }

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($GLOBALS['conn']));
    }
        
    //header('location: productos.php');
}

$idtipo = $IDreceta = $IDproducto = $nombre_producto = $descripcion_producto = $imagen_producto = $precio_producto = $categoria_producto = "";

    //******* inicio obtener detalles del producto *******
        //consulta
        $Q_obtener_producto = "SELECT * FROM productos WHERE idproducto = {$_GET['id']}";
        //ejecutar consulta
        $ejecutar_obtener_producto = mysqli_query($conn, $Q_obtener_producto);
        //almacenar detalles en array
        $row_producto = mysqli_fetch_array($ejecutar_obtener_producto);
        //******* fin obtener detalles del producto *******

$IDproducto= $row_producto['idproducto'];
$nombre_producto= $row_producto['nombre_producto'];
$descripcion_producto= $row_producto['descripcion_producto'];
$imagen_producto= $row_producto['imagen_producto'];
$precio_producto= $row_producto['precio_producto'];
$categoria_producto =$row_producto['categoria_producto'];
$IDreceta = $row_producto['idreceta'];
$idtipo = $row_producto['idtipo'];

?>

<!-- Formulario HTML para la inserción de datos -->

<!DOCTYPE html>
<html lang="en-MU"> 
    <head>
        <meta charset="utf-8">
        <title>Panaderia | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/main.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet"href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>
        
        <style>

    @font-face {
        font-family: roboto;
        src: url(../../css/roboto.ttf) format('truetype');
        }

        @font-face {
      font-family: button;
      src: url(../../css/button.ttf) format('truetype');
     }

     @font-face {
       font-family: logo;
       src: url(../../css/logo.ttf) format('truetype');
      }

      @font-face {
        font-family: spartan;
        src: url(../../css/spartan.ttf) format('truetype');
       }


       body{
        text-align: center;
       }
       textarea{
        color: #313131;
        background: #f3f3f3;
        border: dotted pink;
        width: -webkit-fill-available;
        height: 6rem;
        font-size: 1.4rem;
        font-family: 'Roboto';
       }
        </style>
    </head>

    <body>
        <?php $page = 'insertarProducto';?>


        <!--Imagen de atras-->
        <div class="bg-image-container">
            <div class="bg-image"></div>
        </div>
        <!--Fin de la imagen de atras ps-->

        
        <!--Login -->
        <section style='display: flex; justify-content: space-between;'>

          <h1 class='Fieldset-title'> EDITAR PRODUCTO</h1>
          
            <a href='productos.php' class='close-btn close-btnTitleOnly'> ⌦ </a>
        </section>

        <div class="login-page">
            <div class="form">    

            <form actions="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            
            <input type=hidden name=IDproducto value="<?php echo $IDproducto?>">
                    
            <section class='form-section'>

                <div class='first-line'> 
                <div class='flex-inside'>  
                    <span>Nombre del producto</span> 
                    <input type="text" id="nombre_producto" name="nombre_producto" value="<?php echo $nombre_producto ?>" required>
                </div>

                <div class='flex-inside'>
                    <span>Precio del producto:</span>
                    <input style='color:black;' type="number" step="0.01" id="precio_producto" name="precio_producto" value=<?php echo $precio_producto ?> required>
                    <span class="currency-label" style='position: absolute;margin-top: 3.4rem;margin-left: 14rem;text-decoration: none;'>BS</span>
                </div>


                </div>

                <div class='second-line'>
                <div class='flex-inside'>
                    <span>Receta de Preparación</span>
                    <select required name="receta_producto" id="receta_producto">
                        <?php 
                            $consulta_recetas  = "SELECT * from recetas";
                            $result_recetas = mysqli_query($conn, $consulta_recetas);
                            echo "<option value=''>Seleccione...</option>";                            
                            while($row = mysqli_fetch_assoc($result_recetas)) {
                                $selected = "";
                                if($IDreceta == $row['idreceta']){
                                    $selected = "selected";
                                }
                                echo "<option $selected value='".$row['idreceta']."'>" . $row['nombre'] . "</option>";
                            }

                        ?>
                    </select>                   
                </div>

                <div class='flex-inside'>
                    <span>Categoria del producto</span>                
                    <select name="categoria_producto" id="categoria_producto">
                        <?php 
                        
                            $consulta  = "SELECT * from categorias";
                            $resultado_cat = mysqli_query($conn, $consulta);
                            while($row = mysqli_fetch_array($resultado_cat)) {
                                $selected  = "";
                                if($categoria_producto == $row['idcategoria']) $selected = "selected";
                                echo "<option {$selected} value='".$row['idcategoria']."'>" . $row['nombre_categoria'] . "</option> ";
                            }

                        ?>
                    </select>
                </div>

                <div class='flex-inside'>
                <span>Tipo de Producto</span>
                <select name="id_tipo" id="tipo">  
                    <option value="">Seleccione.</option>
                    <?php 
                        $consulta  = "SELECT * from tipos";
                        $resultado_cat = mysqli_query($conn, $consulta);
                        while($row = mysqli_fetch_array($resultado_cat)) {
                            $selected = "";
                            if($idtipo == $row['idtipo']) $selected = "selected";
                            echo "<option {$selected} value='".$row['idtipo']."'>" . $row['nombre_tipo'] . "</option>";
                        }
                    ?>
                </select>
                </div>
                </div>
                <div class='third-line'>
                <div class='flex-inside' style='display: flex;flex-direction: column;gap: .2rem;'>
                <span>Imagen del producto</span>
                <input type="file" id="imagen_producto" name="imagen_producto" style='padding: 0.4rem;'>
                <img src="<?php echo $imagen_producto;?>" style='width:18rem;border: dotted pink;' class="product-image" />
                </div>
                </div>

                <div class='third-line'>
                <div class='flex-inside'>
                    <span>Descripción del producto</span>
                    <textarea style='color:black;' id="descripcion_producto" name="descripcion_producto"  required style='text-transform:capitalize;'><?php echo $descripcion_producto ?></textarea>
                </div>
                </div>
                </div>
                </section>
                <button type="submit" class='submitBtn' style='margin-bottom: 2rem;'>Guardar Datos</button>
            </form>
    </body>
</html>

<script>
document.querySelector('form').onsubmit = function(e) {
    var nombreProducto = document.getElementById('nombre_producto').value;
    var descripcionProducto = document.getElementById('descripcion_producto').value;
    var precioProducto = document.getElementById('precio_producto').value;
    
    if(nombreProducto === '' || descripcionProducto === '' || precioProducto === '') {
        e.preventDefault(); // Detener el envío del formulario
        alert('Todos los campos son obligatorios.');
    }
};
</script>