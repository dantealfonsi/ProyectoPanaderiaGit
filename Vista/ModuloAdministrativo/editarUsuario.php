<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
?>

<?php
    include "../../Modelo/conexion.php"; 
    $cargos = [
        '0' => 'Eventual',
        '1' => 'Gerente',
        '2' => 'Vendedor',
        '3' => 'Panadero',
        '4' => 'Obrero'
      ];

    $id = $_GET['id'];

    $sql = "SELECT * FROM usuario WHERE idusuario = '$id'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $nombreUsuario = $row['nombreusuario'];
    $nombre =  $row['nombre'];
    $apellido = $row['apellido'];
    $correo = $row['correo'];
    $cargo = $cargos[$row['esadmin']];
    
    $criterioNombre = "";
    $criterioApellido = "";
    $criterioNombreUsuario = "";
    $criterioCorreo = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombreUsuarioOK = false;
        $nombreOK = false;
        $apellidoOK = false;
        $correoOK = false;

        if(empty($_POST["nombreUsuario"])){
            $criterioNombreUsuario = "*";
        } else {
            $nombreUsuario = test_input($_POST["nombreUsuario"]);
            //le asignamoe el cargo de una vez
            $cargo = test_input($_POST["cargo"]);

            $nombreUsuarioOK = true;
        }

        if (empty($_POST["nombre"])) {
            $criterioNombre = "*";
        } else {
            $nombre = test_input($_POST["nombre"]);
            // verificar si el nombre solo contiene letras y espacios
            if (!preg_match("/^[a-zA-Z-' ]*$/",$nombre)) {
                $criterioNombre = "*";
            }
            else
            {
                $nombreOK = true;
            }
        }

        if (empty($_POST["apellido"])) {
            $criterioApellido = "*";
        } else {
            $apellido = test_input($_POST["apellido"]);
            // verificar si el apellido solo contiene letras y espacios
            if (!preg_match("/^[a-zA-Z-' ]*$/",$apellido)) {
                $criterioApellido = "*";
            }
            else
            {
                $apellidoOK = true;
            }
        }

        if (empty($_POST["correo"])) {
            $criterioCorreo = "*";
        } else {
            $correo = test_input($_POST["correo"]);
            // verificar si el correo solo contiene letras y espacios
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $criterioCorreo = "*";
            }
            else
            {
                $correoOK = true;
            }
        }

            if($nombreUsuarioOK == true && $nombreOK == true && $apellidoOK == true && $correoOK == true)
            {

                $sql = "UPDATE usuario SET 
                nombre='$nombre', 
                apellido='$apellido', 
                correo='$correo', 
                esadmin= $cargo WHERE idusuario=$id";
                
                mysqli_query($conn, $sql);
                header('location: usuario.php');
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

    </head>

    <body>

        
        <!--Inicio del Panel De logueo-->
        <div class="login-page reg-page" style='width: 100%;display: flex;justify-content: center;align-items: center;top: 15rem;'>
    <div class="form">
        <div class="login">
            <div class="login-header">
                <h3>Editar Usuario</h3>
                <p>Cuidado: Edite Los Cambios Necesarios</p>
            </div>
        </div>

        <form class="login-form" method="post" actions="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div style='display:flex;'> 
                <span class="Error-NombreUsuario"><?php echo $criterioNombreUsuario;?></span>  
                <input type="text" readonly name="nombreUsuario" placeholder="Nombre de usuario" style='margin-right: 1rem;' value="<?php echo $nombreUsuario;?>"/>
                <span class="Error-Nombre"><?php echo $criterioNombre;?></span>
                <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombre;?>"/>

            </div>
          

            <div style='display:flex;'>
                <span class="Error-Apellido"><?php echo $criterioApellido;?></span>
                <input type="text" name="apellido" style='margin-right: 1rem;' placeholder="Apellido" value="<?php echo $apellido;?>"/>
                <span class="Error-Correo"><?php echo $criterioCorreo;?></span>
                <input type="text" name="correo" placeholder="Correo" value="<?php echo $correo;?>"/>                
            </div>
            <span style="color: black;">Cargo que Ocupa: </span>
            <select name="cargo" style="width: 200px;padding:5px;border:none;">
                <?php
                $i=0;
                foreach($cargos as $index){
                    $select = "";
                    if($index == $cargo){
                        $select = "selected";
                    }
                    echo "<option {$select} value='{$i}'>{$index}</option>";
                    $i++;
                }
                ?>
            </select>
            
            <button>Guardar Cambios</button>
            <a href="usuario.php" style="display: block;margin-top:5px; text-decoration:none; text-transform: uppercase; outline: 0; background-color: transparent; color:black; width: 100%; border: 1px solid black; padding: 15px; font-size: 14px; cursor: pointer; border-radius: .6rem; font-weight: bolder; ">Cancelar</a>
        </form>
    </div>
</div>
    </body>
</html>