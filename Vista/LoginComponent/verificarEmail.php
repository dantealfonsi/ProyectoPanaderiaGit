<?php 
    include "../../Modelo/conexion.php"; 

    if(isset($_GET['claveVerificacion'])){
        // Procesar verificación
        $vkey = $_GET['claveVerificacion'];

        $sql = "SELECT verificado,claveVerificacion FROM usuario WHERE verificado = 0 AND claveVerificacion = '$vkey' LIMIT 1";

        $resultado = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            // Validar correo electrónico
            $actualizar = "UPDATE usuario SET verificado = 1 WHERE claveVerificacion = '$vkey' LIMIT 1";

            $resultadoSet = mysqli_query($conn, $actualizar);
            
            if($resultadoSet)
            {
                define('Acceso', TRUE);
                include "paginaCuentaVerificada.php";
            } else {
                echo $conn->error;
            }

        } else {

            $sql = "SELECT verificado,claveVerificacion FROM usuario WHERE verificado = 1 AND claveVerificacion = '$vkey' LIMIT 1";

            $resultado = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) === 1){
                define('Acceso', TRUE);
                include "paginaCuentaVerificada.php";
            } else {
                define('Acceso', TRUE);
                setcookie("cookieCorreoVerificado", "correoInvalido", time()+(3600*24*2));
                include "paginaCuentaInvalida.php";
            }
            
        }

    } else {
        die("¡Algo salió mal!");
    }
?>