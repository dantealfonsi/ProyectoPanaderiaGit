<?php
//<!--========== PHP CONNECTION TO DATABASE ==========-->
    $host = "localhost";
    $username = "root";
    // $pass = "123456";
    $pass = "";

    $dbname = "tiendapanaderia";
    //create connection
    $conn = mysqli_connect($host, $username, $pass, $dbname);
    //check connection
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    function calcularDiasEntreFechas($fechaInicial, $fechaFinal) {
        $fechaInicio = new DateTime($fechaInicial);
        $fechaFin = new DateTime($fechaFinal);
      
        $diferencia = $fechaInicio->diff($fechaFin);
      
        return $diferencia->format('%R%a');
      }

/*
    function historiFecha($fecha){ 
        $date=date_create($fecha);
        return date_format($date,"d/m/Y");
    }*/
?>