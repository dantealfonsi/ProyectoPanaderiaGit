<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
?>

<?php
    include "../../Modelo/conexion.php"; 

    $nombreUsuario = $nombre = $apellido = $correo = $contrasena = "";
    $criterioContrasena = "";
    $criterioNombre = "";
    $criterioApellido = "";
    $criterioNombreUsuario = "";
    $criterioCorreo = "";
    $criterioConfirmarContrasena = "";
    $criterioRecaptcha = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombreUsuarioOK = false;
        $nombreOK = false;
        $apellidoOK = false;
        $correoOK = false;
        $contrasenaOK = false;
        $confirmarContrasenaOK = false;

        if(empty($_POST["nombreUsuario"])){
            $criterioNombreUsuario = "Se requiere un nombre de usuario";
        } else {
            $nombreUsuario = test_input($_POST["nombreUsuario"]);

            // verificar solo caracteres alfanuméricos
            // y alfanuméricos y de al menos 5 caracteres
            if(!preg_match('/^[a-zA-Z0-9]{5,}$/', $nombreUsuario)) { 
                $criterioNombreUsuario = "El nombre de usuario debe tener solo caracteres alfanuméricos sin espacios y debe tener al menos 5 caracteres.";
            }
            else {
                // verificar si el nombre de usuario ya está en la base de datos
                $sql = "SELECT * FROM usuario WHERE nombreUsuario = '$nombreUsuario'";

                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) === 1){
                    $criterioNombreUsuario = "El nombre de usuario ya existe";
                }
                else
                {
                    $nombreUsuarioOK = true;
                }
            }
        }

        if (empty($_POST["nombre"])) {
            $criterioNombre = "Se requiere un nombre";
        } else {
            $nombre = test_input($_POST["nombre"]);
            // verificar si el nombre solo contiene letras y espacios
            if (!preg_match("/^[a-zA-Z-' ]*$/",$nombre)) {
                $criterioNombre = "Solo se permiten letras y espacios en blanco";
            }
            else
            {
                $nombreOK = true;
            }
        }

        if (empty($_POST["apellido"])) {
            $criterioApellido = "Se requiere un apellido";
        } else {
            $apellido = test_input($_POST["apellido"]);
            // verificar si el apellido solo contiene letras y espacios
            if (!preg_match("/^[a-zA-Z-' ]*$/",$apellido)) {
                $criterioApellido = "Solo se permiten letras y espacios en blanco";
            }
            else
            {
                $apellidoOK = true;
            }
        }

        if (empty($_POST["correo"])) {
            $criterioCorreo = "Se requiere un correo electrónico";
        } else {
            $correo = test_input($_POST["correo"]);
            // verificar si el correo solo contiene letras y espacios
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $criterioCorreo = "Formato de correo electrónico inválido";
            }
            else
            {
                // verificar si el correo ya está en la base de datos
                $sql = "SELECT * FROM usuario WHERE correo='$correo'";

                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) === 1){
                    $criterioCorreo = "¡El correo electrónico ya existe!";
                }
                else
                {
                    $correoOK = true;
                }
            }
        }

        if (empty($_POST["contrasena"])) {
            $criterioContrasena = "Se requiere una contrasena";
        } else {
            $contrasena = test_input($_POST["contrasena"]);
            // la contrasena debe cumplir con los siguientes criterios:
            // tiene que contener al menos un número
            // tiene que contener al menos una letra mayúscula
            // tiene que ser un número, una letra o uno de los siguientes: !@#$%
            // tiene que haber entre 8 a 20 caracteres
            if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/', $contrasena)) {
                $criterioContrasena = 'La contrasena debe tener al menos <b>un número</b>, al menos <b>una letra mayúscula</b>, al menos uno de los siguientes <b>!@#$%</b> y debe tener entre <b>8</b> a <b>20</b> caracteres de longitud!';
            }
            else {
                $contrasenaOK = true;
            }
            
            if (empty($_POST["confirmarContrasena"])) {
                $criterioConfirmarContrasena = "Por favor confirma tu contrasena.";
            }
            else if (($_POST["confirmarContrasena"]) == $contrasena){
                $confirmarContrasenaOK = true;
            }
            else {
                $criterioConfirmarContrasena = "¡Las contrasenas no coinciden!";
            }
        }

        $captcha = $_POST["g-recaptcha-response"];
        $claveSecreta = "6Ld1nA0aAAAAAJps4LCRTs7jfshN9GNjZAghnt0f";
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urldecode($claveSecreta).'&response='.urldecode($captcha).'';
        $respuesta = file_get_contents($url);
        $respuestaClave = json_decode($respuesta, TRUE);

        if($respuestaClave['success'])
        {
            if($nombreUsuarioOK == true && $contrasenaOK == true && $nombreOK == true && $apellidoOK == true && $correoOK == true)
            {
                //Generar VKey
                $vkey = md5(time().$nombreUsuario);

                //genera un IDpersona
                $bytes = random_bytes(5);
                $IDpersona = bin2hex($bytes);

                $hashContrasena = password_hash($contrasena, PASSWORD_BCRYPT);

                $sql = "INSERT INTO usuario (idpersona,nombreusuario,contrasena, nombre, apellido,correo, claveverificacion)
                VALUES ('$IDpersona','$nombreUsuario', '$hashContrasena', '$nombre', '$apellido', '$correo', '$vkey')";

                if(mysqli_query($conn, $sql)){
                    //enviar correo
                    $para = $correo;
                    $asunto = "Verificación de correo electrónico";
                    $mensaje = "<a href='http://localhost/MyFiles/CakeShop/verifyEmail.php?vkey=$vkey'>Registrar cuenta</a>";
                    $cabeceras = "From: tiendaJuan@gmail.com \r\n";
                    $cabeceras .= "MIME-Version: 1.0" . "\r\n";
                    $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    mail($para, $asunto, $mensaje, $cabeceras);
                    setcookie("graciasCookie", "correoVerificacionEnviado");
                    header('location: graciasRegistro.php');

                    $ultimoIDusuario = mysqli_insert_id($conn);

                    $sql = "INSERT INTO cart (userid) VALUES ($ultimoIDusuario);";

                    mysqli_query($conn, $sql);
                }
            }
        }
        else {
            $criterioRecaptcha = "Por favor confirma el reCAPTCHA";
        }
        
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html lang="es-MU">
    <head>
        <meta charset="utf-8">
        <title>PANADERIA | UNIRSE</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Archivo CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Account.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>
        <!--reCAPTCHA-->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>

    <body>
        <?php $pagina = 'login';?>

        <!--Iniciar Barra de Navegación-->
        <?php include '../Includes/BarraNavegacionMovil.php';?>
        <!--Finalizar Barra de Navegación-->


        <!--Iniciar Barra de Navegación @media 1200px-->
        <?php include '../Includes/BarraNavegacionPC.php';?>
        <!--Finalizar Barra de Navegación @media 1200px-->

        <div class="bg-image-container">
            <div class="bg-image-join"></div>
        </div>
        
        <!--Inicio del Panel De logueo-->
        <div class="login-page reg-page" style='width: 100%;display: flex;justify-content: center;align-items: center;top: 30rem;'>
    <div class="form">
        <div class="login">
            <div class="login-header">
                <h3>Unirse</h3>
                <p>Por favor, ingresa los siguientes campos para unirte</p>
            </div>
        </div>

        <form class="login-form" method="post" actions="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div style='display:flex;'> 
                <span class="Error-NombreUsuario"><?php echo $criterioNombreUsuario;?></span>  
                <input type="text" name="nombreUsuario" placeholder="Nombre de usuario" style='margin-right: 1rem;' value="<?php echo $nombreUsuario;?>"/>
                <span class="Error-Nombre"><?php echo $criterioNombre;?></span>
                <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombre;?>"/>

            </div>
          

            <div style='display:flex;'>
                <span class="Error-Apellido"><?php echo $criterioApellido;?></span>
                <input type="text" name="apellido" style='margin-right: 1rem;' placeholder="Apellido" value="<?php echo $apellido;?>"/>
                <span class="Error-Correo"><?php echo $criterioCorreo;?></span>
                <input type="text" name="correo" placeholder="Correo" value="<?php echo $correo;?>"/>
            </div>
            
            <div style='display:flex;'>

                <span class="Error-Contrasena"><?php echo $criterioContrasena;?></span>
                <input type="password" name="contrasena" style='margin-right: 1rem;' placeholder="Contraseña"/>
                <span class="Error-Contrasena"><?php echo $criterioConfirmarContrasena;?></span>
                <input type="password" name="confirmarContrasena" placeholder="Confirmar contraseña"/>

            </div>

           
            <span class="Error-recaptcha"><?php echo $criterioRecaptcha;?></span>
            <div name="g-recaptcha-response" style='display: flex;align-items: center;justify-content: center;width: 110%;' class="g-recaptcha" data-sitekey="6Ld1nA0aAAAAAA7F7eJOY7CMwg7aaQAfg3WZy6P0"></div>
            <button>Unirse</button>
            <p class="message">¿Ya tienes una cuenta? <a href="../LoginComponent/login.php">Inicia sesión</a></p>
            <!-- <p class="or-message"><b>O</b></p> -->
        </form>

        <!-- <div class="social-login">
            <span class="login-text">Iniciar sesión con: </span>
            <span><a><i class="fab fa-facebook-f"></i></a></span>
            <span><a><i class="fab fa-twitter"></i></a></span>
            <span><a><i class="fab fa-google-plus-g"></i></a></span>
        </div> -->
    </div>
</div>
<!--Fin del panel de inicio de sesión-->

    </body>
</html>