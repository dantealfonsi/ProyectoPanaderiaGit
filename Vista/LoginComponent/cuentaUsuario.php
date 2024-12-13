<?php
    include "../../Modelo/iniciarSesion.php";
    include "../../Modelo/verificarAcceso.php"; 
    include_once "../Includes/paths.php";

    $nombreUsuario = $_SESSION['nombreUsuario'];
    
    include "../../Modelo/conexion.php";

    $sql = "SELECT * FROM usuario WHERE nombreusuario='$nombreUsuario'";
    $resultado= mysqli_query($conn, $sql);

    if(mysqli_num_rows($resultado) === 1){
        $row = mysqli_fetch_assoc($resultado);
    }

    $nombreUsuario = $row['nombreusuario'];
    $contrasena = $row['contrasena'];
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $correo = $row['correo'];
    $direccion = $row['direccion'];
    $telefono = $row['telefono'];
    $descripcion = $row['descripcion'];

    $nombreTitulo = strtoupper($nombre);

    include "../../Modelo/actualizarPerfil.php";
?>

<!DOCTYPE html>
<html lang="es-MU">
    <head>
        <meta charset="utf-8">
        <title>PANADERIA | MI CUENTA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- include summernote css/js -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/bootstrap/css/bootstrap.css">
        <!--Archivo CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Account.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet"href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>

        <style>

            .btn-danger {
                color: #ffffff;
                background-color: #c31f5c;
                border-color: #d43f3a;
                border-radius: 2rem;
                font-weight: bolder;
            }
        </style>    
    </head>

    <body>
        <?php $page = 'verificarCuenta';?>
        
        <!--Iniciar Barra de Navegación-->
        <?php include '../Includes/BarraNavegacionMovil.php';?>
        <!--FIN Barra de Navegación-->


        <!--Iniciar Barra de Navegación @media 1200px-->
        <?php include '../Includes/BarraNavegacionPC.php';?>
        <!--FIN Barra de Navegación @media 1200px-->


        <!-- Iniciar Encabezado -->
        <div id="resolucionPantalla" class="col-md-15">
            <div class="contenedorNombreFormulario" style='display: flex;align-items: center;margin-bottom: 2rem;flex-direction: row;justify-content: space-between;padding: 0 2rem;'>
                <div class="subtituloAdmin">
                    <span><i class="fas fa-user-cog"></i></span>
                        <span>Bienvenido <b><?php echo $nombreTitulo;?>!</b></span>
                    </div>
                    <span class="user-logout"><a href="../cerrarSesion.php"><button type="button" title="Cerrar sesión" class="btn btn-danger">Cerrar Sesion <span class="glyphicon glyphicon-log-in"></span></button></a></span>

            </div>
        </div>
        <!-- Finalizar Encabezado -->




  <!-- Inicio de la pestaña -->
  <div class="container">
            <ul class="nav nav-tabs" style='display: flex;justify-content: space-between;'>
                <li class="active"><a data-toggle="pill" href="#home">Editar mi perfil</a></li>
                <li><a data-toggle="pill" href="#menu">Mis Compras</a></li>
            </ul>
            
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="tab-title">
                        <h3 style="text-align: center;font-family: 'button';">Editar mi perfil</h3>
                    </div>
                    <!--Inicio del Perfil -->
                    <?php include '../Includes/perfilUsuario.php'; ?>
                    <!-- Final del PErfil -->
                </div>
                
                <div id="menu" class="tab-pane fade in active">
                    <div class="tab-title">
                        <h3 style="text-align: center;font-family: 'button';">MIS COMPRAS</h3>
                    </div>
                    <!--Inicio del Perfil -->
                    <?php include '../Includes/menuUsuario.php'; ?>
                    <!-- Final del PErfil -->
                </div>
            </div>
        </div>
        <!-- Fin de la pestaña -->
    </body>
</html>
