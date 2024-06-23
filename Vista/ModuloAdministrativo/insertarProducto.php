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
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion_producto = $_POST['descripcion_producto'];
    $precio_producto = $_POST['precio_producto'];
    $categoria_producto = $_POST['categoria_producto'];
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
    $archivo = $directorio.$codigorifa.$ext;
    $archivoSubido = addslashes($archivo);

    if($_POST['personalizable']=="1"){
        $iscustom = $_POST['personalizable'];
        $peso =$_POST['peso'];
        $pisos =$_POST['pisos'];
        $modelo =$_POST['modelo'];
        if(isset($_POST['bizcocho'])){
            $bizcocho =$_POST['bizcocho'];
        }
        else{
            $bizcocho =0;
        }
        
        $relleno =$_POST['relleno'];
        $cubierta =$_POST['cubierta'];
        $persona =$_POST['persona'];

        $sql = "INSERT INTO productos (
        nombre_producto,
        descripcion_producto,
        imagen_producto,
        precio_producto,
        categoria_producto,
        peso,
        pisos,
        modelos,
        bizcocho,
        relleno,
        cubierta,
        persona,
        iscustom
        )
        VALUES (
        '$nombre_producto',
        '$descripcion_producto',
        '$archivoSubido',
        $precio_producto,
        $categoria_producto,
        $peso,
        $pisos,
        '$modelo',
        $bizcocho,
        '$relleno',
        '$cubierta',
        '$persona',
        $iscustom
        )";
        mysqli_query($conn, $sql) or die ("Error de Conaxion: ". mysqli_connect_error());
    }else{
        $sql = "INSERT INTO productos (
        nombre_producto,
        descripcion_producto,
        imagen_producto,
        precio_producto,
        categoria_producto
        )
        VALUES (
        '$nombre_producto',
        '$descripcion_producto', 
        '$archivoSubido',
        $precio_producto,
        $categoria_producto
        )";
        mysqli_query($conn, $sql);        
    }

    header('location: graciasInsertarProducto.php');
}
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

       .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
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

          <h1 class='Fieldset-title'> AGREGAR NUEVO PRODUCTO</h1>
          
            <a href='productos.php' class='close-btn close-btnTitleOnly'> ⌦ </a> 
          
        </section>

        <div class="login-page">
            <div class="form">    

            <form actions="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                <section class='form-section'>

              <div class='first-line'> 
                <div class='flex-inside'>  
                    Nombre del producto<br>
                <input type="text" id="nombre_producto" name="nombre_producto" required>
                </div>
            </div>

            
            <div class='second-line'>
             <div class='flex-inside'>
                Descripción del producto:<br>
                <textarea style='color:black;' id="descripcion_producto" name="descripcion_producto" required></textarea>
             </div>
            </div>

            <div class='third-line'>
             <div class='flex-inside'>
            Precio del producto:<br>
                <input style='color:black;' type="number" step="0.01" id="precio_producto" value="0" name="precio_producto" required>
                </div>
            <div class='flex-inside'>
                Imagen del producto:<br>
                <input type="file" id="imagen_producto" name="imagen_producto" required>
                </div>
            </div>
            
              
            <br>
                <div class='flex-inside' style='width: 22%;margin: 1rem;'>
                Categoria del producto:<br>
              <select name="categoria_producto" id="categoria_producto">
              </div>
              <?php 
              
                  $consulta  = "SELECT * from categorias";
                  $resultado_cat = mysqli_query($conn, $consulta);
                  while($row = mysqli_fetch_array($resultado_cat)) {
                    echo "<option value='".$row['idcategoria']."'>" . $row['nombre_categoria'] . "</option>";
                  }

              ?>

              </select><br><br>
              Tipo de Producto:<br>
                    <select name="tipo" id="tipo" ">  
                        <option value="">Seleccione</option>
                <?php 
                
                    $consulta  = "SELECT * from tipos";
                    $resultado_cat = mysqli_query($conn, $consulta);
                    while($row = mysqli_fetch_array($resultado_cat)) {
                        echo "<option value='".$row['idtipo']."'>" . $row['nombre_tipo'] . "</option>";
                    }

                ?>
                    </select>
                    <br>
                    <label>
        <input type="checkbox" value="1" id="personalizable" name="personalizable"> Producto Personalizable
    </label>

    <div id="dialog" class="modal">
        <div class="modal-content">
            <h2>Opciones de Personalización</h2>
            <!-- Aquí puedes agregar más inputs para personalización -->             
            Peso Kg
            <input type="number" name="peso" id="peso"  step="1" value="1" min=1 max=20> <br>
            Pisos
            <input type="number" name="pisos" id="pisos" step="1" value="1" min=1 max=3><br>
            Modelo
            <select id="modelo" name="modelo" >
                <option value=''>Seleciione</option>
                <option value='redonda'>Redonda</option>
                <option value='cuadrada'>Cuadrada</option>
            </select><br>
            <input type="checkbox"  value="1" name="bizcocho" id="bizcocho"> Bizcocho<br>
            Relleno
            <select id="relleno" name="relleno" >
                <option value=''>Seleciione</option>
                <option value='vainilla'>Vainilla</option>
                <option value='chocolate'>Chocolate</option>
                <option value='fresa'>Fresa</option>
            </select><br>
            Cubierta
            <select id="cubierta" name="cubierta" >
                <option value=''>Seleciione</option>
                <option value='blanco'>Blanco</option>
                <option value='azul'>Azul</option>
                <option value='chocolate'>Chocolate</option>
                <option value='rosado'>Rosado</option>
            </select><br>
            <input type="radio" name="persona" id="persona" value="niño"> Niño            
            <input type="radio" name="persona" id="persona" value="niña"> Niña <br>          
            <input type="radio" name="persona" id="persona" value="hombre"> Hombre            
            <input type="radio" name="persona" id="persona" value="mujer"> Mujer            
            <!-- Botón para finalizar -->
             <br><br>
            <button type="button" onclick="cerrarDialog()">Aceptar</button> 
            <button type="button" onclick="cancelDialog()">Cancelar</button>
        </div>
    </div>          
            </div>
        </div>
        <br>
        <button class='submitBtn'>Insertar Producto</button>
        </form>
    </body>
</html>

<script>
const checkbox = document.getElementById('personalizable');
const dialog = document.getElementById('dialog');

checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
        dialog.style.display = 'block';
    } else {
        dialog.style.display = 'none';
    }
});

function cerrarDialog() {

    const modeloInput = document.getElementById('modelo');
    const rellenoInput = document.getElementById('relleno'); 
    const cubiertaInput = document.getElementById('cubierta');
    const personaRadio = document.querySelectorAll('input[type="radio"][name="persona"]');
    
    const modeloValor = modeloInput.value.trim();
    const rellenoValor = rellenoInput.value.trim();
    const cubiertaValor = cubiertaInput.value.trim();

    let seleccionado = false;
    personaRadio.forEach((radio) => {
    if (radio.checked) {
        seleccionado = true;
    }
    });

    if (modeloValor === '' && rellenoValor === '' && cubiertaValor === '' && !seleccionado) {
        alert('Por favor, ingresa Datos válidos.'); 
    }
    else{
        dialog.style.display = 'none';
    }
    
    // Aquí puedes procesar los datos ingresados antes de finalizar
} 

function cancelDialog(){
    checkbox.checked = false;
    dialog.style.display = 'none';
}

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