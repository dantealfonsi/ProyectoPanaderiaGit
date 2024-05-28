<?php
    include "../../Modelo/iniciarSesion.php";
    
    if(isset($_SESSION['nombreUsuario'])){ 
        define('Acceso', TRUE);
        if($_SESSION['esAdmin'] == 1)
        {
            include "../Admin/panelAdmin.php";
        }
        else
        {
            include "cuentaUsuario.php"; 
        }
    }
    else {
        include "login.php";
    }
?>