<?php 
    define('Acceso', TRUE);

    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php"; 
?>

<?php
    include "../../Modelo/conexion.php"; 

    $tuNombre = "";
    $contrasena= "";
    $errCriterio = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if ((empty($_POST['tuNombre'])) || (empty($_POST['contrasena']))){
            $errCriterio = "Nombre o contraseña incorrectas!";
        } else {
            $tuNombre = test_input($_POST['tuNombre']);
            $contrasena = test_input($_POST['contrasena']);

            // selecciona el row
            $sql = "SELECT * FROM usuario WHERE nombreusuario='$tuNombre'";
            $result= mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);

                // Chequea si has verificado tu email
                if($row['verificado'] == 1)
                {
                    setcookie("graciasCookie", "verificationEmailSent", time() - 3600);
                    setcookie("verifiedEmailCookie", "emailInvalid", time() - 3600);
                    setcookie("resetPassword","resetMailSent", time() - 3600);                    
                    // check if hashed passwords match
                    if(password_verify($contrasena, $row['contrasena']))
                    {
                        include "../../Modelo/iniciarSesion.php";

                        // store the user data in this session
                        $_SESSION['nombreUsuario'] = $row['nombreusuario'];
                        $_SESSION['esAdmin'] = $row['esadmin'];
                        $_SESSION['IDusuario'] = $row['idusuario']; 

                        header('location: verificarCuenta.php');
                    } else {
                        $errCriterio = "Nombre incorrecto o contraseña!";
                    }
                }
                else if(isset($_COOKIE['verifiedEmailCookie']))
                {
                    if(password_verify($contrasena, $row['contrasena'])){

                        include "../../Modelo/iniciarSesion.php";

                        $claveVerificacion = md5(time().$tuNombre);

                        $sql = "UPDATE usuario SET claveVerificacion = '$claveVerificacion' WHERE nombreusuario = '$tuNombre'";

                        if(mysqli_query($conn, $sql)){

                            $to = $row['email'];
                            $subject = "Email Verification";
                            $message = "<a href='http://localhost/MyFiles/CakeShop/verificarEmail.php?vkey=$claveVerificacion'>Registrar Cuenta</a>";
                            $headers = "From: tiendajuan@gmail.com \r\n";
                            $headers .= "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
                            mail($to, $subject, $message, $headers);

                            setcookie("graciasCookie", "emailVerificacionEnviado");
                            setcookie("emailVerificacionEnviado", "emailInvalido", time() - 3600);
                            header('location: graciasRegistro.php');

                        }
                    } 
                    else {
                        $errCriterio = "Contraseña o nombre incorrectos!";
                    }
                }
                else
                {
                    $errCriterio = "Por favor, verifica tu cuenta antes de entrar";
                }
            } else {
                $errCriterio = "Contraseña o nombre incorrectos!";
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
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Panaderia | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Account.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    </head>

    <body>
        <?php $page = 'login';?>

          <!--Iniciar Barra de Navegación-->
          <?php include '../Includes/BarraNavegacionMovil.php';?>
        <!--FIN Barra de Navegación-->


        <!--Iniciar Barra de Navegación @media 1200px-->
        <?php include '../Includes/BarraNavegacionPC.php';?>
        <!--FIN Barra de Navegación @media 1200px-->



        <!--Imagen de atras-->
        <div class="bg-image-container">
            <div class="bg-image"></div>
        </div>
        <!--Fin de la imagen de atras ps-->

        
        <!--Login -->
        <div class="login-page">
            <div class="form">
                <div class="login">
                    <div class="login-header">
                        <h3>INICIO DE SESIÓN</h3>
                        <p>Ingresa tus datos</p>
                    </div>
                </div>

                <form class="login-form" method="post" actions="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input type="text" name="tuNombre" placeholder="Usuario" value="<?php echo $tuNombre;?>"/>
                    <input type="password" name="contrasena" placeholder="Contraseña"/>
                    <span class="Password-Error"><?php if($errCriterio != ""){echo "$errCriterio <br><br>";}?></span>
                    
                    <button>login</button>
                    <p class="message">No te has registrado? <a href="../RegistroComponent/registro.php">Crear Cuenta</a></p>
                    <br><span class="forget-text"><a href="olvidarContrasena.php">Olvide Contraseña</a></span>
                    <!-- <p class="or-message"><b>OR</b></p> -->
                </form>

          
            </div>
        </div>

    </body>
</html>