<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
?>

<?php
    include "../../Modelo/conexion.php"; 




    $correo = "";
    $errCriterio = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if ((empty($_POST['email']))){
            $errCriterio = "Se requiere correo electrónico";
        } else {
            $correo = test_input($_POST["email"]);
            // verificar si el nombre solo contiene letras y espacios en blanco
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $criterioCorreo = "Formato de correo electrónico inválido";
            }
            else {
                $captcha = $_POST["g-recaptcha-response"];
                $claveSecreta = "6LdT9A0aAAAAAPb_m1z6qx8ryZzlAhr8xRTk-uP3";
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urldecode($claveSecreta).'&response='.urldecode($captcha).'';
                $respuesta = file_get_contents($url);
                $claveRespuesta = json_decode($respuesta, TRUE);

                if($claveRespuesta['success'])
                {
                    $sql = "SELECT * FROM usuario WHERE correo='$correo'";
                    $resultado= mysqli_query($conn, $sql);

                    if(mysqli_num_rows($resultado) === 1){
                        $fila = mysqli_fetch_assoc($resultado);

                        $nombreUsuario = $fila['nombreusuario'];

                        $alfabeto = range('A', 'Z');
                        $numeros = range(0,26);
                        $simbolos = array('@', '#', '$', '%');

                        $nuevaContrasena = "";
                        $longitudContrasena = rand(8,20);

                        for($i = 0; $i <= $longitudContrasena; $i++)
                        {
                            $a = $alfabeto[rand(0,25)];
                            $n = $numeros[rand(0,25)];
                            $s = $simbolos[rand(0,3)];

                            $nuevaContrasena .= $a . $n . $s;
                        }

                        $para = $fila['correo'];
                        $asunto = "Restablecer contraseña";
                        $mensaje = "Nombre de usuario: <b>$nombreUsuario</b><br>Contraseña: <b>$nuevaContrasena</b><br><br><b>Por favor, restablezca su contraseña después de iniciar sesión.</b>";
                        $header = "From: juango@gmail.com \r\n";
                        $header .= "MIME-Version: 1.0" . "\r\n";
                        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                        mail($para, $asunto, $mensaje, $header);

                        $hashtearContrasena = password_hash($nuevaContrasena, PASSWORD_BCRYPT);

                        $sql = "UPDATE usuario SET contrasena='$hashtearContrasena' WHERE nombreusuario='$nombreUsuario'";

                        if(mysqli_query($conn, $sql)){
                            setcookie("resetpassword",$para);
                            header('location: resetear_contrasena.php');
                        }
                    } else {
                        $errCriterio = "¡No se puede encontrar tu cuenta!";
                    }
                    
                } else {
                    $errCriterio = "Por favor, confirma el reCAPTCHA";
                }
            }
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
<html lang="en-MU">
    <head>
        <meta charset="utf-8">
        <title>RESETEAR CONTRASEÑA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
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
        <?php $pagina = 'olvidarContrasena';?>

              <!--Iniciar Barra de Navegación-->
              <?php include '../Includes/BarraNavegacionMovil.php';?>
        <!--Finalizar Barra de Navegación-->


        <!--Iniciar Barra de Navegación @media 1200px-->
        <?php include '../Includes/BarraNavegacionPc.php';?>
        <!--Finalizar Barra de Navegación @media 1200px-->
      



        <!--Inicio de fondo-->
        <div class="bg-image-container">
            <div class="bg-image-forget"></div>
        </div>
        <!--Final de fondo-->

        <!--Inicio del html-->
        <div class="login-page">
            <div class="form">
                <div class="login">
                    <div class="login-header">
                        <h3>Resetear Contraseña</h3>
                        <p>Resetear tu gmail abajo</p>
                    </div>
                </div>

                <form class="login-form" method="post" actions="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input type="text" name="email" placeholder="Email" value="<?php echo $correo;?>"/>
                    <span class="input-error"><?php if($errCriterio != ""){echo "$errCriterio <br><br>";}?></span>
                    <div name="g-recaptcha-response" class="g-recaptcha" data-sitekey="6LdT9A0aAAAAAPLi4Ab29xdM28aipZ0D3IyXbjXQ"></div>
                    <button>Resetear Contraseña</button>
                </form>
            </div>
        </div>
        <!--Final del HTML-->

        
    </body>
</html>