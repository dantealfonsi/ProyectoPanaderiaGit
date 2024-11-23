<?php
include "../../Modelo/iniciarSesion.php";
include "../../Modelo/verificarAcceso.php";
include_once "../Includes/paths.php";

if(!isset($_SESSION['nombreUsuario'])){
    header("location:../LoginComponent/login.php");
}

$nombreUsuario = $_SESSION['nombreUsuario'];

include "../../Modelo/conexion.php";

$sql = "SELECT * FROM usuario WHERE nombreusuario='$nombreUsuario'";
$resultado= mysqli_query($conn, $sql);

if(mysqli_num_rows($resultado) === 1){
    $fila = mysqli_fetch_assoc($resultado);
}

$nombreUsuario = $fila['nombreusuario'];
$contrasena = $fila['contrasena'];
$nombre = $fila['nombre'];
$apellido = $fila['apellido'];
$correo = $fila['correo'];
$direccion = $fila['direccion'];
$telefono = $fila['telefono'];
$descripcion = $fila['descripcion'];

$nombreTitulo = strtoupper($nombreUsuario);

include "../../Modelo/actualizarPerfil.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['enviarCorreo'])){
        if(!empty($_POST['mensaje'])) {

            $mensaje = test_input($_POST['mensaje']);
            
            $sql = "SELECT correo FROM usuario WHERE estasuscrito = 1";
            $resultado = mysqli_query($conn, $sql);

            if(mysqli_num_rows($resultado) > 0)
            {
                $arrayCorreo = Array();

                while ($fila =  mysqli_fetch_assoc($resultado)) {
                    $arrayCorreo[] =  $fila['correo'];
                }

                $para = "tiendajuan@gmail.com";
                if(isset($_POST['asunto']))
                {
                    $asunto = test_input($_POST['asunto']);
                }
                $msg = $mensaje;
                $cabeceras = "From: juangop@gmail.com \r\n";
                $cabeceras .= "Bcc: " . implode(",", $arrayCorreo) . "\r\n";
                $cabeceras .= "MIME-Version: 1.0" . "\r\n";
                $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                mail($para, $asunto, $msg, $cabeceras);
                // Se utiliza para evitar que el correo se envíe cada vez que se actualiza la página
                header("location: $_SERVER[PHP_SELF]");
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>PANADERIA | PANEL DE ADMINISTRADOR</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Archivo CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Account.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='./checkout/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="../../css/main.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/bootstrap/css/bootstrap.css">
        <!-- Bootstrap CDN -->
        <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script link='../../Controlador/modulo.js'></script>

        <!-- include summernote css/js -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

        <style>

        input{
            font-size:1.4rem;
        }

        .input-group-addon{
            background: linear-gradient(45deg, #fb74a0, #ff2881);
        }

        @font-face {
            font-family: button;
            src: url(../../css/button.ttf) format('truetype');
        }
        
        </style>
        
    </head>

    <body>
        <?php $page = 'verificarCuenta';?>

        <!-- Inicio del Header-->
    <section style='width: calc(100% - 78px); margin-left: 78px;'>
        <div id="screenRes" class="col-md-15" >
            <div class="form-name-container">
                <div class="adminPanelContainer">
                    <div class="adminPanelSubtitle">
                        <h2>PANEL DE CONTROL</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Final del Header -->


        <!-- Inicio de la pestaña -->
        <div class="container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="pill" href="#home">Editar mi perfil</a></li>
                <li><a data-toggle="pill" href="#sendMail">Enviar Email</a></li>
            </ul>
            
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="tab-title">
                        <h3>Editar mi perfil</h3>
                    </div>
                    <!--Inicio del Perfil -->
                    <?php include '../Includes/perfilUsuario.php'; ?>
                    <!-- Final del PErfil -->
                </div>
                

                        
                <div id="sendMail" class="tab-pane fade">
                    <div class="tab-title">
                        <h3>Enviar Email a tus subscriptores</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                        <form method="POST" actions="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                            <div class="sendMailBtnContainer">
                                <button name="sendMail" class="btn btn-info"><span class="glyphicon glyphicon-send"></span> Enviar Email</button>
                            </div>
                            <br>
                            <label>TEMA:</label>
                            <input class="form-control input-md" name="subject" type="text" placeholder="Enter mail subject" required>
                            <br>
                            
                            <div class="textAreaContainer">
                                <textarea rows="10" id="summernote" name="message">
                                    
                                </textarea>
                            </div>
                        </form>
                    </div>
                    
                        
                    <script>
                        $(document).ready(function() {
                            $('#summernote').summernote({
                                placeholder: 'Panaderia',
                                height: 500,
                                toolbar: [
                                    // [groupName, [list of button]]
                                    ['basic', ['style', 'fontname', 'fontsize']],
                                    ['style', ['bold', 'italic', 'underline', 'clear']],
                                    ['font', ['strikethrough', 'superscript', 'subscript']],
                                    ['color', ['color']],
                                    ['media', ['link', 'table', 'hr']],
                                    ['para', ['ul', 'ol', 'paragraph']],
                                    ['height', ['height', 'codeview', 'fullscreen', 'undo', 'redo']]
                                ]
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        </section>
        <!-- Fin de la pestaña -->
    </body>
</html>