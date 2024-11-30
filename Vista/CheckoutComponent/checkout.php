<?php 
    define('Acceso', TRUE); // ACCESO PERMITIDO

    // INICIO DE SESIÓN
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php"; 

    // CONEXIÓN A LA BASE DE DATOS cakeshop
    include "../../Modelo/conexion.php"; 

    $validado = false; // validado

    // definir variables y asignar valores vacíos
    $fechaentrega = $municipio = $localidad = $nombre = $apellido = $email = $direccion = $metodoPago = "";
    $errorNombre = $errorApellido = $erroremail = $errorDireccion = $errormetodoPago = $errorLocalidad= $errorMunicipio="";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // VALIDACIÓN DEL NOMBRE
        $municipio = validar_entrada($_POST["municipio"]);
        $localidad = validar_entrada($_POST["localidad"]);
        $nombre = validar_entrada($_POST["nombre"]);
        $fechaentrega = $_POST["fechaentrega"];
        
        // verificar si el nombre solo contiene letras y espacios
        if (!preg_match("/^[a-zA-Z-' ]*$/",$nombre)) {
          $errorNombre = "Solo se permiten letras y espacios en blanco";
        }

        // VALIDACIÓN DEL APELLIDO
        $apellido = validar_entrada($_POST["apellido"]);
        // verificar si el apellido solo contiene letras y espacios
        if (!preg_match("/^[a-zA-Z-' ]*$/",$apellido)) {
          $errorApellido = "Solo se permiten letras y espacios en blanco";
        }
      
        // VALIDACIÓN DEL CORREO ELECTRÓNICO
        $email = validar_entrada($_POST["email"]);
        // verificar si la dirección de correo electrónico tiene el formato correcto
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $erroremail = "Formato de correo electrónico inválido";
        }
        
        // VALIDACIÓN DE LA DIRECCIÓN
        $direccion = validar_entrada($_POST["direccion"]);
        // verificar si la dirección contiene números al inicio, seguidos de letras, contiene espacio, guión y coma
        if (!preg_match("/^[0-9a-zA-Z\s,-]+$/",$direccion)) {
          $errorDireccion = "Dirección inválida";
        }
      
        // VALIDACIÓN DEL MÉTODO DE PAGO
        if(isset($_POST['metodoPago']))
        $metodoPago = validar_entrada($_POST["metodoPago"]);

        if (empty($metodoPago)) {
         $errormetodoPago="Debes seleccionar Un Metodo de pago";
        }

        $localidad = validar_entrada($_POST["localidad"]);

        if (empty($localidad)) {
         $errorLocalidad="Debes seleccionar Una Localidad";
        }        

        $municipio = validar_entrada($_POST["municipio"]);

        if (empty($municipio)) {
         $errorMunicipio="Debes seleccionar Una Municipio";
        }        


  if($errorMunicipio == "" && $errorLocalidad == "" && $errorNombre == "" && $errorApellido == "" && $erroremail == "" && $errorDireccion == "" &&  $errormetodoPago == ""){
    $validado = true;
  }
      
    }
    
    function validar_entrada($datos) {
      // Elimina espacios en blanco al principio y al final
      $datos = trim($datos);
      // Elimina las barras invertidas (si es necesario)
      $datos = stripslashes($datos);
      // Escapa caracteres especiales para evitar problemas de seguridad
      $datos = htmlspecialchars($datos, ENT_QUOTES, 'UTF-8');
      // Puedes agregar más validaciones aquí según tus necesidades
      return $datos;
  }
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>PANADERIA | Pago</title>

    <!-- BOOTSTRAP CSS PRINCIPAL -->
    <link href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/form-validation.css" rel="stylesheet">

    <style>

      /* Fuentes de Texto*/
      @font-face {
        font-family: roboto;
        src: url(../../css/roboto.ttf) format('truetype');
      }

      @font-face {
        font-family: candy;
        src: url(../../css/candy.ttf) format('truetype');
      }

      @font-face {
        font-family: logo;
        src: url(../../css/logo.ttf) format('truetype');
        }

        @font-face {
          font-family: spartan;
          src: url(../../css/spartan.ttf) format('truetype');
        }

        .goBack{
          padding: .8rem !important;
          padding-top: .5rem !important;
          padding-bottom: .5rem !important;
          outline: none;
          text-transform: uppercase;
          font-weight: bold !important;
          font-size: 1rem !important;
          background-color: rgba(0, 0, 0, 0) !important;
          color: var(--dark-color-light) !important;
          border: 1px solid var(--dark-color-light) !important;
          border-radius: 25px;
          transition: .3s;
          margin-top: .5rem !important;
          display: flex;
          align-items: center;
          justify-content: center;
          width: fit-content;
          position: absolute;
          right: 5rem;
          top: 2rem;
          text-decoration: none;
          font-family: 'roboto';
        }

        .goBack:hover{
          background:#c31f5c !important;
          color:white !important;
        }


    </style>  

    
  </head>

<body>
      
  <div class="container">

  <div class="row continue-shop-div text-center">
        <a href="../CarritoComponent/carrito.php" class="goBack" id="cat-but" style='display: flex;align-items: center;justify-content: center;' >↵ Atras</a>
    </div>

    
    <main>

      <!-- TÍTULO -->
      <div class="py-5 text-center" style='display: flex;flex-direction: column;align-items: center;'>
        <h1 class="nombre-empresa" style="font-size: 4rem;font-family: 'candy';color: #c31f5c;letter-spacing: 1px;">Dulce Amor</h1>
        <h2 style='font-family: candy;border-bottom: 4px dashed #c31f5c;display: flex;width: fit-content;'>Formulario de pago</h2>
      </div>

        <!-- MI CARRITO -->
      <div class="row g-3">
        <div class="col-md-5 col-lg-4 order-md-last">

          <!-- TU CARRITO / VALOR DEL CARRITO -->
          <h4 class="d-flex justify-content-between align-items-center mi-carrito mb-3">
            <span class="text-muted">Tu carrito</span>
            <!-- //NÚMERO DE CARRITO -->
            <span class="badge numero-carrito bg-pink rounded-pill"><?php if(isset($_SESSION['cantidad_articulos'])) {echo $_SESSION['cantidad_articulos'];} else {echo "0";} ?></span>
          </h4>

          <!-- LISTA DE ARTÍCULOS DEL CARRITO + TOTAL -->
          <ul class="list-group mb-3">
            <?php
            foreach($_SESSION['carrito_compras'] as $clave => $producto){
              $Q_fetch__all_products = "SELECT * FROM productos";
              $resultado_producto = mysqli_query($conn, $Q_fetch__all_products);

              while($fila_producto = mysqli_fetch_assoc($resultado_producto)){
                if($fila_producto['idproducto'] == $producto['id']){
                  ?>

                  <!-- PRODUCTO 1  -->
              <li class="list-group-item d-flex justify-content-between lh-sm filas-lino">
                <div>
                  <h6 class="my-0" style='text-transform: capitalize;font-weight: bold;'><?php echo $fila_producto['nombre_producto']; ?></h6>
                  <small class="text-muted">x <?php echo $producto['cantidad']; ?> unidad(es)</small>
                </div>
                <span class="text-muted etiqueta-precio">Bs <?php echo number_format(($producto['cantidad']  * $fila_producto['precio_producto']),2); ?></span>
              </li>
            
            <?php
                }
              }
            
          }//fin foreach
            
            ?>

                <!-- TOTAL -->
            <li class="list-group-item d-flex justify-content-between fila-total">
              <span>Total (Bs)</span>
              <strong class="etiqueta-precio">Bs <?php echo number_format($_SESSION['precio_total'], 2); ?></strong>
            </li>
          </ul>

        </div>

        <!-- ================================================================================= -->

 <!-- DIRECCIÓN DE FACTURACIÓN  -->
<div class="col-md-7 col-lg-8">

<h4 class="mb-3 border-bottom-pink" >Dirección de facturación</h4>

<form action=
    "
    <?php
      if($validado){
        echo 'graciasCheckout.php';
        $validado = false;
      }
      else {
        echo htmlspecialchars($_SERVER["PHP_SELF"]);
      }
    
    ?>"
  class="needs-validation" method="POST">
  <div class="row g-3">

      <!-- INGRESAR NOMBRE  -->
      <div class="col-sm-6">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="" value="<?php echo $nombre; ?>" required>
        <div class="invalid-feedback">
          Se requiere un nombre válido.
        </div>
        <span class="error"><?php echo $errorNombre;?></span>
      </div>

      <!-- INGRESAR APELLIDO -->
      <div class="col-sm-6">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="" value="<?php echo $apellido; ?>" required>
        <div class="invalid-feedback">
          Se requiere un apellido válido.
        </div>
        <span class="error"><?php echo $errorApellido;?></span>
      </div>

      <!-- INGRESAR CORREO ELECTRÓNICO  -->
      <div class="col-12">
        <label for="email" class="form-label">Correo electrónico <span class="text-muted">(Opcional)</span></label>
        <input type="email" class="form-control" name="email" id="email" placeholder="tucorreo@ejemplo.com" value="<?php echo $email; ?>">
        <div class="invalid-feedback">
          Por favor, introduce una dirección de correo válida para las actualizaciones de envío.
        </div>
        <span class="error"><?php echo $erroremail;?></span>
      </div>

      <!-- INGRESAR DIRECCIÓN -->
      <div class="col-12">
        <label for="direccion" class="form-label">Dirección</label>
        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="1234 Calle Principal" value="<?php echo $direccion; ?>" required>
        <div class="invalid-feedback">
          Por favor, introduce tu dirección de envío.
        </div>
        <span class="error"><?php echo $errorDireccion;?></span>
      </div>

      <!-- ELEGIR PAÍS  -->
      <div class="col-md-5">
      <label for="municipios"  class="form-label">Selecciona un municipio:</label>
    <select class="form-select" name="municipio" id="select1" >
        <option value="<?php echo $municipio ?>"><?php if(strlen($municipio)==0)echo "Selecciona Una..";else echo $municipio;?></option>
    </select>
    <span class="error"><?php echo $errorMunicipio;?></span>
      </div>

      <!-- ELEGIR Localidad  -->
      <div class="col-md-4">
        <label for="localidad" class="form-label">Localidad</label>
        <select class="form-select" name="localidad" id="select2">  
        <option value="<?php echo $localidad ?>"><?php if(strlen($localidad)==0)echo "Selecciona Una..";else echo $localidad;?></option>
        </select> 
          <span class="error"><?php echo $errorLocalidad;?></span>
        </div>

        <label for="entrega" class="form-label">Fecha de Entrega</label>
        <input type="date" class="form-control" id="fechaentrega" name="fechaentrega" value="<?php echo $fechaentrega; ?>" required>

<hr class="my-4 pinkLine">

<!-- MÉTODO DE PAGO -->
<h4 class="mb-3" style='font-weight: 800;font-family: roboto;text-decoration: underline;'>Método de Pago</h4>

<!-- TARJETA DE CRÉDITO -->
<div class="my-3">
  <div class="form-check" style='display: flex;flex-direction: row;align-items: center;'>
    <input id="pagoMovil" name="metodoPago" type="radio" class="form-check-input" value="pagomovil" <?php if ($metodoPago == "pagomovil"){ echo "checked";} ?> >
    <label class="form-check-label" for="pagoMovil" style='font-size: 1.25rem;font-weight: bold;margin-left: 1rem;'>Pago Movil</label>
  </div>

  <!-- MCB JUICE -->
  <div class="form-check" style='display: flex;flex-direction: row;align-items: center;'>
    <input id="transferencia" name="metodoPago" type="radio" class="form-check-input" value="transferencia" <?php if ($metodoPago == "transferencia"){ echo "checked";} ?> >
    <label class="form-check-label" for="transferencia" style='font-size: 1.25rem;font-weight: bold;margin-left: 1rem;'>Transferencia</label>
  </div>

  <!-- PAYPAL -->
  <div class="form-check" style='display: flex;flex-direction: row;align-items: center;'>
    <input id="efectivo" name="metodoPago" type="radio" class="form-check-input" value="efectivo" <?php if ($metodoPago == "efectivo"){ echo "checked";} ?> >
    <label class="form-check-label" for="efectivo" style='font-size: 1.25rem;font-weight: bold;margin-left: 1rem;'>Efectivo</label>
  </div>

  <span class="error" style="color:red;"><?php echo $errormetodoPago;?></span>
</div>

<!-- BOTÓN CONTINUAR AL PAGO -->
<hr class="my-4 pinkLine" >

<button class="w-100 btn btn-primary btn-lg button" type="submit">Continuar al pago</button>

<a href="../index.php" class="w-30 btn btn-primary btn-lg button mt-3 cancel">Cancelar</a>

<!-- <button class="w-30 btn btn-primary btn-lg button mt-3 cancel">Cancelar</button> -->
</form>
</div>
</div>
</main>

<footer class="my-5 pt-5 text-muted text-center text-small">
<p class="mb-1">&copy; 2024 PANADERIA DULCE AMOR</p>
</footer>
</div>
      <script src="../Javascript/bootstrap.bundle.min.js"></script>
      <script src="../Javascript/form-validation.js"></script>
      
      <script>

      let select1 = document.getElementById('select1');
      let select2 = document.getElementById('select2');

      let municipios = ["Andrés Mata","Bermúdez"];

      let bermudez = ["Carúpano","Guayacan","El Muco","Charallave","Macarapana","Playa Grande","El Pujo","Güiria","Guaca"];

      let andresMata = ["San José","Casanay","Las Acacias"];
      
        municipios.forEach(function addMunicipio(item){
          
        let option = document.createElement("option");
        option.value = item;
        option.text = item;
        select1.appendChild(option);
      });

      function addToSelect2(arr){

        arr.forEach(function (item){

        let option = document.createElement("option");
        option.value= item;
        option.text= item;
        select2.appendChild(option);
      });
    }

      select1.onchange = function changeCiudad(){
       
          
          select2.innerHTML="<option></option>";

          
          if(select1.value == "Andrés Mata"){
          addToSelect2(andresMata);
         } else 
         
         if(select1.value == "Bermúdez"){
          addToSelect2(bermudez);
         }
      }
      </script>
  </body>
</html>
