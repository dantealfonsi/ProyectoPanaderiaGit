<?php
//<!--========== PHP CONEXION A LA BASE DE DATOS ==========-->
    $host = "localhost";
    $username = "root";
    // $pass = "LuisEsGay123";
    $pass = "";

    $dbname = "tiendaPanaderia";
    //Lo que crea la conexion 
    $conn = mysqli_connect($host, $username, $pass, $dbname);
    //Lo que ve si esta buena
    if(!$conn){
        die("La homosexualidad de Luis mato el programa: " . mysqli_connect_error());
    }

?>