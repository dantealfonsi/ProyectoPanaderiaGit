<?php 
    define('Acceso', TRUE); // ACCESO PERMITIDO

    // INICIO DE SESIÓN
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php"; 

    // CONEXIÓN A LA BASE DE DATOS cakeshop
    include "../../Modelo/conexion.php"; 

    $validado = false; // validado

    // definir variables y asignar valores vacíos
    $nombre = $apellido = $email = $direccion = $pais = $ciudad = $metodoPago = $nombreTarjeta = $numeroTarjeta = $expiracionMesTarjeta = $expiracionAnioTarjeta = $cvvTarjeta = "";
    $errorNombre = $errorApellido = $erroremail = $errorDireccion = $errorPais = $errorCiudad  = $errormetodoPago = $errorNombreTarjeta = $errorNumeroTarjeta = $errorExpiracionTarjeta = $errorCvvTarjeta = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // VALIDACIÓN DEL NOMBRE
        $nombre = validar_entrada($_POST["nombre"]);
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

        // VALIDACIÓN DEL PAÍS
        // $pais = validar_entrada($_POST["pais"]);
        // verificar si el país == mauricio
        // if ($pais != "Mauritius" || $pais != "mauritius" ) {
        //   $errorDireccion = "Lo sentimos, actualmente solo entregamos en Mauricio.";
        // }

        // VALIDACIÓN DE LA CIUDAD
    /*    $ciudad = validar_entrada($_POST["ciudad"]);
        // verificar si la ciudad == opciones
        if ($ciudad == "Port Louis" || $ciudad == "Curepipe" || $ciudad == "Vacoas" || $ciudad == "Quatre Bornes" || $ciudad == "Rose Hill" || $ciudad == "Flic En Flac" || $ciudad == "Phoenix") {
          // válido
        }
        else{
          $errorCiudad = "Ciudad inválida";
        }*/
/*
        // VALIDACIÓN DEL CÓDIGO POSTAL
        $codigoPostal = validar_entrada($_POST["codigoPostal"]);
        // verificar si el código postal contiene exactamente 5 números
        if (!preg_match("/^[0-9]{5}/",$codigoPostal)) {
          $errorCodigoPostal = "Código postal inválido";
        }*/
      
        // VALIDACIÓN DEL MÉTODO DE PAGO
        $metodoPago = validar_entrada($_POST["metodoPago"]);

        // REGEX POR TIPO DE TARJETA
        $tipoTarjeta = array(
          "visa"       => "/^4[0-9]{15}$/",
          // "mastercard" => "/^5[1-5][0-9]{14}$/"
         
        );

      /*  // VALIDACIÓN DEL NOMBRE DE LA TARJETA
        $nombreTarjeta = validar_entrada($_POST["nombreTarjeta"]);
        // verificar si el nombre de la tarjeta solo contiene letras y espacios
        if (!preg_match("/^[a-zA-Z-' ]*$/",$nombreTarjeta)) {
          $errorNombreTarjeta = "Solo se permiten letras y espacios en blanco";
        }

        // VALIDACIÓN DEL NÚMERO DE LA TARJETA
        $numeroTarjeta = validar_entrada($_POST["numeroTarjeta"]);
        // verificar si el número de la tarjeta coincide con el regex por tipos de tarjetas admitidos
        if (!preg_match($tipoTarjeta['visa'],$numeroTarjeta)) {
          $errorNumeroTarjeta = "Número de tarjeta inválido
          <br>
          ¡Lo sentimos! Nuestro sistema actualmente solo admite tarjetas VISA.";
        }*/
/*********************************************************************************** */
// VALIDACIÓN DE LA FECHA DE EXPIRACIÓN DE LA TARJETA DE CRÉDITO
if (empty($_POST["ccexp_m"]) || empty($_POST["ccexp_y"])) {
  $errorFechaExpiracion = "Por favor, introduzca la fecha de expiración";
} 
else {
    $mesExpiracion = validar_entrada($_POST["ccexp_m"]);
    $anioExpiracion = validar_entrada($_POST["ccexp_y"]);

    // VALIDA EL MES
    if((int)$mesExpiracion > 0 && (int)$mesExpiracion < 13){
      // VALIDA EL AÑO
      if((int)$anioExpiracion > 1900 && (int)$anioExpiracion < 4000){
        $verificacionExpiracion = \DateTime::createFromFormat('my', $mesExpiracion.$anioExpiracion);
        $mesActual = date('m');
        $anioActual = date('y');
        $ahora = new \DateTime();
        // VERIFICA SI HA EXPIRADO

        if($anioActual < (int)$anioExpiracion){
          // año válido
          
        }
        else if($anioActual == (int)$anioExpiracion){
          if($mesActual < (int)$mesExpiracion){
            // número de expiración válido
          }
          // expirado
          else{
            $errorFechaExpiracion = "Su tarjeta de crédito ha expirado.";
          }
        }
        // expirado
        else {
          $errorFechaExpiracion = "Su tarjeta de crédito ha expirado.";
        }

        // if ($verificacionExpiracion > $ahora) {
        //   $errorFechaExpiracion = "Su tarjeta de crédito ha expirado";
        // }
      }
      else {
        $errorFechaExpiracion = "Año inválido";
      }
    }
    else {
      $errorFechaExpiracion = "Fecha de expiración inválida";
    }
 }

  // VALIDACIÓN DEL CVV DE LA TARJETA DE CRÉDITO
  //$cvvTarjeta = validar_entrada($_POST["cccvv"]);
  // verifica si el CVV tiene 3 o 4 dígitos y está
  // entre 0-9 y no tiene letras ni caracteres especiales.
  if (preg_match("/^[0-9]{3,4}$/",$cvvTarjeta)) {
    // válido
  }
  else{
    $errorCvvTarjeta = "CVV inválido";
  }

  if($errorNombre == "" && $errorApellido == "" && $erroremail == "" && $errorDireccion == "" && $errorPais == ""  && $errormetodoPago == ""){
    $validado = true;
  }
      
    }
    
    function validar_entrada($datos) {
      $datos = trim($datos);
      $datos = stripslashes($datos);
      $datos = htmlspecialchars($datos);
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
  </head>

<body>
      
  <div class="container">
    
    <main>

      <!-- TÍTULO -->
      <div class="py-5 text-center">
        <h1 class="nombre-empresa">PANADERIA</h1>
        <h2>Formulario de pago</h2>
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
                if($fila_producto['IDproducto'] == $producto['id']){
                  ?>

                  <!-- PRODUCTO 1  -->
              <li class="list-group-item d-flex justify-content-between lh-sm filas-lino">
                <div>
                  <h6 class="my-0"><?php echo $fila_producto['nombre_producto']; ?></h6>
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

<h4 class="mb-3 border-bottom-pink">Dirección de facturación</h4>

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
    <select class="form-select" id="select1">
        <option>Selecciona un :</option>
    </select>
        <!-- <div class="invalid-feedback">
          Por favor, selecciona un país válido.
        </div>
        <span class="error"><?php //echo $errorPais;?></span> -->
      </div>

      <!-- ELEGIR Localidad  -->
      <div class="col-md-4">
        <label for="localidad" class="form-label">Localidad</label>
        <select class="form-select" name="localidad" id="select2" required>  </select>


                <div class="invalid-feedback">
                  Pon una ciudad valida
                </div>
                <span class="error"><?php echo $errorCiudad;?></span>
              </div>


<!-- INGRESAR CÓDIGO POSTAL 
<div class="col-md-3">
  <label for="codigoPostal" class="form-label">Código Postal</label>
  <input type="text" class="form-control" name="codigoPostal" value="" id="codigoPostal" placeholder="" required>
  <div class="invalid-feedback">
    Se requiere el código postal.
  </div>
  <span class="error"></span>
</div>
</div>
-->


<hr class="my-4 pinkLine">

<!-- CASILLA DE VERIFICACIÓN DE DIRECCIÓN
<div class="form-check">
  <input type="checkbox" class="form-check-input" name="address_check" id="same-address">
  <label class="form-check-label" for="same-address">La dirección de envío es la misma que mi dirección de facturación</label>
</div>

<hr class="my-4 pinkLine">
 -->


<!-- MÉTODO DE PAGO -->
<h4 class="mb-3">Método de Pago</h4>

<!-- TARJETA DE CRÉDITO -->
<div class="my-3">
  <div class="form-check">
    <input id="pagoMovil" name="metodoPago" type="radio" class="form-check-input" value="pagoMovil" <?php if ($metodoPago == "pagoMovil"){ echo "checked";} ?> >
    <label class="form-check-label" for="pagoMovil">Pago Movil</label>
  </div>

  <!-- MCB JUICE -->
  <div class="form-check">
    <input id="transferencia" name="metodoPago" type="radio" class="form-check-input" value="transferencia" <?php if ($metodoPago == "Transferencia"){ echo "checked";} ?> >
    <label class="form-check-label" for="transferencia">Transferencia</label>
  </div>

  <!-- PAYPAL -->
  <div class="form-check">
    <input id="efectivo" name="metodoPago" type="radio" class="form-check-input" value="efectivo" <?php if ($metodoPago == "efectivo"){ echo "checked";} ?> >
    <label class="form-check-label" for="efectivo">Efectivo</label>
  </div>

  <span class="error"><?php echo $errormetodoPago;?></span>
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
<p class="mb-1">&copy; 2024 PANADERIA</p>
<ul class="list-inline">
  <li class="list-inline-item"><a href="#">Privacidad</a></li>
  <li class="list-inline-item"><a href="#">Términos</a></li>
  <li class="list-inline-item"><a href="#">Soporte</a></li>
</ul>
</footer>
</div>
      <script src="../Javascript/bootstrap.bundle.min.js"></script>
      <script src="../Javascript/form-validation.js"></script>
      
      <script>

      let select1 = document.getElementById('select1');
      let select2 = document.getElementById('select2');

      let municipios = ["Andres eloy blanco","Andrés Mata","Arismendi","Bermúdez","Bolívar","Marigüitar","Cajigal"
      ,"Yaguaraparo","Cruz Salmerón Acosta","Libertador","Tunapuy","Mariño","Irapa"
      ,"Mejía","Montes","Ribero","Sucre","Güiria"];

      let bermudez = ["Carupano","Otra vaina"];

      let arismendi = ["Carupano","Otra vaina"];

      let ribero = ["pilar","webo"];
      
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

          
          if(select1.value == "Arismendi"){
          addToSelect2(arismendi);
         } else 
         
         if(select1.value == "Bermúdez"){
          addToSelect2(bermudez);
         }else 
         
         if(select1.value == "Ribero"){
          addToSelect2(ribero);
         }
      }
      </script>
  </body>
</html>
