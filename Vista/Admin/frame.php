<?php

include "../../Modelo/modulo_proyecto.php";

$tmodulo = new Modulo; 

if (isset($_GET['chat'])) { 
  header("location:chat.php?idpedido=".$_GET['idpedido']."&notif=".$_GET['notif']);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Frame</title>
    <style>

    @font-face {
      font-family: roboto;
      src: url(../fonts/roboto.ttf) format('truetype');
    }

    @font-face {
      font-family: button;
      src: url(../fonts/button.ttf) format('truetype');
     }

     @font-face {
       font-family: logo;
       src: url(../fonts/logo.ttf) format('truetype');
      }

      @font-face {
        font-family: spartan;
        src: url(../fonts/spartan.ttf) format('truetype');
       }

    body{
      background: #ededed;
      padding: 0;
      margin: 0;
    }

    img {
      margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 60%;
    }

   .clip{
 background: #ededed;
 clip-path: polygon(0 38%, 100% 55%, 46% 100%, 0% 100%);
 position: absolute;
 bottom: 0;
 width: 100%;
 height: 88vh;
 z-index: -10;
 right: 0;
}

  .clip-2{
  background: #dbdbdb;
  clip-path: polygon(0 31%, 117% 55%, 100% 100%, 0% 100%);
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 88vh;
  z-index: -11;
  right: 0;
}


.flexbox{
display:flex;
flex-wrap:wrap;
justify-content: space-evenly;
}

.chart-heading {
  font-family: 'button';
    color: #303031;
    text-transform: uppercase;
    font-size: 30px;
    text-align: center;
    letter-spacing: 1px;
}

.chart-container {
  width: auto;
}

.programming-stats {
  font-family: 'button';
    display: flex;
    align-items: center;
    margin: 0 auto;
    box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.3);
    border-radius: 20px;
    color: #023047;
    transition: all 400ms ease;
    flex-direction: column;
}

.programming-stats:hover {
  transform: scale(1.02);
  box-shadow: 0 4px 16px -7px rgba(0, 0, 0, 0.3);
}

.programming-stats .details ul {
  list-style: none;
  padding: 0;
}

.programming-stats .details ul li {
  font-size: 16px;
  margin: 12px 0;
  text-transform: uppercase;
}

.programming-stats .details .percentage {
  font-weight: 700;
  color: #e63946;
}


.parent {
  width: 210px;
  padding: 0.5rem;
  perspective: 1000px;
}

.card {
  padding-top: 53px;
  border-radius: 20px;
  transform-style: preserve-3d;
  background: linear-gradient(135deg,#0000 18.75%,#f3f3f3 0 31.25%,#db0e0e00 0), repeating-linear-gradient(45deg,#f3f3f3 -6.25% 6.25%,#ffffff 0 18.75%);
  background-size: 60px 60px;
  background-position: 0 0, 0 0;
  background-color: #f0f0f0;
  width: 100%;
  box-shadow: rgba(142, 142, 142, 0.3) 0px 30px 30px -10px;
  transition: all 0.5s ease-in-out;
  font-family: 'Roboto';
}

.content-box {
  background: linear-gradient(45deg, #e3507f, #ff9bbbb0);
    transition: all 0.5s ease-in-out;
    padding: 60px 25px 25px 25px;
    transform-style: preserve-3d;
    border-radius: 20px;
    font-family: 'Roboto';
}

.content-box .card-title {
  display: inline-block;
  color: white;
  font-size: 24px;
  font-weight: 900;
  transition: all 0.5s ease-in-out;
  transform: translate3d(0px, 0px, 50px);
  letter-spacing: 1.5px;
  font-family: 'Roboto';
}

.content-box .card-title:hover {
  transform: translate3d(0px, 0px, 60px);
}

.content-box .card-content {
  margin-top: 0;
  font-size: 18px;
  font-weight: 700;
  color: #f2f2f2;
  transition: all 0.5s ease-in-out;
  transform: translate3d(0px, 0px, 30px);
  font-family: 'roboto';
}

.content-box .card-content:hover {
  transform: translate3d(0px, 0px, 60px);
}

.content-box .see-more {
  cursor: pointer;
  margin-top: 1rem;
  display: inline-block;
  font-weight: 900;
  font-size: 9px;
  text-transform: uppercase;
  color: rgb(7, 185, 255);
  /* border-radius: 5px; */
  background: white;
  padding: 0.5rem 0.7rem;
  transition: all 0.5s ease-in-out;
  transform: translate3d(0px, 0px, 20px);
}

.content-box .see-more:hover {
  transform: translate3d(0px, 0px, 60px);
}

.date-box {
  position: absolute;
  top: 30px;
  right: 30px;
  height: 60px;
  width: 60px;
  background: white;
  padding: 10px;
  transform: translate3d(0px, 0px, 80px);
  box-shadow: rgba(100, 100, 111, 0.2) 0px 17px 10px -10px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #84b4f996;
}

.date-box span {
  display: block;
  text-align: center;
}

.date-box .month {
  color: rgb(4, 193, 250);
  font-size: 9px;
  font-weight: 700;
}

.date-box .date {
  font-size: 40px;
  font-weight: 900;
  color: rgb(51 51 51 / 44%);
  font-family: 'button';
}
/***** *******************************/

.graph-flexBox{
  display: flex;
  width: -webkit-fill-available;
  height: 25rem;
  padding: 0.6rem;
  gap: 1.5rem;
  justify-content: center;
}

.graph-flexBox2{
  display: flex;
  width: -webkit-fill-available;
  height: 25rem;
  padding: 0.6rem;
  gap: 1.5rem;
  justify-content: center;
}


.round-graphBox{
  background: #ffffffad;
  width: 28rem;
  border-radius: 1.5rem;
}

.tick-graphBox{
  background: #ffffffad;
  width: 800px;
  border-radius: 1.5rem;
}

td{
  border-bottom: 1px solid #b9b9b9;
  padding: 0.5rem;
}

table{
  text-align: start;
  font-family: 'roboto';
  font-size: 1.1rem;
  text-align: left;
}


@media (max-width: 750px) {

.graph-flexBox{
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: flex-start;
}

.graph-flexBox2{
  margin-top: 28rem;
  align-items: center;
  flex-direction: column;
  justify-content: flex-start;
}

.round-graphBox{
  width:auto;
}

.tick-graphBox{
  width:auto;
}

.two{
  width: 100%;
}

}


</style>


    <script src="../chartJs/chart.min.js"></script>
    <link rel="stylesheet" type="text/css" href="..\DataTables\dataTables.min.css" />
    <script src="..\DataTables\jQuery\jquery.min.js"></script>
    <script src="../Javascript/chart.js"></script>

  </head>
  <body>



    <div>
  <div class='flexbox'>

  <div class="parent">
  <div class="card">
      <div class="content-box">
          <span class="card-title" id='card-title'></span>
          <span class="card-title"><?php echo $tmodulo->row_sqlconector("SELECT COUNT(*) AS total_entradas FROM productos;")['total_entradas']?> </span>
          </span>
          <p class="card-content">
              Productos
          </p>
      </div>
      <div class="date-box">
          <span class="date"><img id='icon' style='opacity:0.1;' src='../../Assets/images/inventory/entrada_1.svg'></span>
      </div>
  </div>
</div>



<div class="parent">
  <div class="card">
      <div class="content-box">
          <span class="card-title"><?php echo $tmodulo->row_sqlconector("SELECT SUM(total) AS total FROM salida WHERE fecha >= DATE_SUB(NOW(), INTERVAL 1 MONTH);")['total'] ?>BS</span>
          <p class="card-content">
              Ganancias Totales
          </p>
      </div>
      <div class="date-box">
          <span class="date"><img id='icon' style='opacity:0.1;' src='../../Assets/images/inventory/entrada_2.svg'></span>
      </div>
  </div>
</div>



<div class="parent">
  <div class="card">
      <div class="content-box">
          <span class="card-title"><?php if(isset($tmodulo->row_sqlconector("SELECT DATE(fecha) AS fecha, SUM(precio) AS total FROM carac_entrada WHERE fecha >= DATE_SUB(NOW(), INTERVAL 1 MONTH) GROUP BY DATE(fecha) ORDER BY fecha;")['total'])) echo $tmodulo->row_sqlconector("SELECT DATE(fecha) AS fecha, SUM(precio) AS total FROM carac_entrada WHERE fecha >= DATE_SUB(NOW(), INTERVAL 1 MONTH) GROUP BY DATE(fecha) ORDER BY fecha;")['total'] ?>BS</span>
          <p class="card-content">
             Gasto en Entradas
          </p>
      </div>
      <div class="date-box">
          <span class="date"><img id='icon' style='opacity:0.1;' src='../../Assets/images/inventory/entrada_3.svg'></span>
      </div>
  </div>
</div>



<div class="parent">
  <div class="card">
      <div class="content-box">
          <span class="card-title"><?php echo $ganancia=($tmodulo->row_sqlconector("SELECT (ganancias_totales - gastos_entrada) AS ganancia_neta FROM ( SELECT (SELECT ROUND(SUM(total),2) FROM pedido_usuario WHERE estado IN ('PRODUCCION', 'PAGADO') AND fechapedido >= DATE_SUB(NOW(), INTERVAL 1 MONTH)) AS ganancias_totales, (SELECT SUM(precio) FROM carac_entrada WHERE fecha >= DATE_SUB(NOW(), INTERVAL 1 MONTH)) AS gastos_entrada ) AS totales;")['ganancia_neta']) ?>BS</span>
          <p class="card-content">
              Ganancias Netas
          </p>
      </div>
      <div class="date-box">
          <span class="date"><img id='icon' style='opacity:0.1;' src='../../Assets/images/inventory/entrada_4.svg'></span>
      </div>
  </div>
</div>

  </div> 

  <div>


  </div>


  
  <?php
// Incluir lógica para obtener los datos de la base de datos
$desde_1 = '';
$hasta_1 = '';

if (isset($_GET['desde'])) {
  $desde_1 = $_GET['desde'];
  $hasta_1 = $_GET['hasta'];
}

echo "
<div style='display: flex;width: 100%;align-items: center;justify-content: center;margin-top:5%;'>
<div class='graphContainer' style='width:60%;background: white;border-radius: 2rem;'>
  <canvas id='usuariosPorMesChart' width='400' height='200'></canvas>
</div>
<div>
";

if (isset($_GET['desde'])) {
  $desde = "{$_GET['desde']} 00:00:00";
  $hasta = "{$_GET['hasta']} 23:59:59";

  $consulta = "
    SELECT DATE_FORMAT(fechacreacion, '%Y-%m') AS mes, COUNT(idusuario) AS cantidad_usuarios
    FROM usuario
    WHERE fechacreacion BETWEEN '$desde' AND '$hasta'
    GROUP BY DATE_FORMAT(fechacreacion, '%Y-%m')
    ORDER BY mes DESC
    LIMIT 12;
  ";
} else {
  $consulta = "
    SELECT DATE_FORMAT(fechacreacion, '%Y-%m') AS mes, COUNT(idusuario) AS cantidad_usuarios
    FROM usuario
    WHERE fechacreacion BETWEEN '2023-08-09 23:22:07' AND NOW()
    GROUP BY DATE_FORMAT(fechacreacion, '%Y-%m')
    ORDER BY mes DESC
    LIMIT 12;
  ";
}

$resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);

// Arrays para almacenar datos del gráfico
$meses = [];
$cantidades = [];

while ($row = mysqli_fetch_assoc($resultado)) {
  $mes = $row['mes'];
  $cantidad_usuarios = $row['cantidad_usuarios'];

  // Añadir datos al gráfico
  $meses[] = $mes;
  $cantidades[] = $cantidad_usuarios;
}

// Invertir los arrays para mostrar los meses en orden ascendente
$meses = array_reverse($meses);
$cantidades = array_reverse($cantidades);

// Datos para el gráfico
$meses_json = json_encode($meses);
$cantidades_json = json_encode($cantidades);

echo "
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('usuariosPorMesChart').getContext('2d');
    var usuariosPorMesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: $meses_json,
            datasets: [{
                label: 'Cantidad de Usuarios',
                data: $cantidades_json,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  });
</script>
";
?>

  <div class='graphContainer' style='width:10%;'>
  <canvas id="usuariosPorMesChart"></canvas>
</div>

  </div>
  
     <div class='clip'> a </div>
     <div class='clip-2'> a </div>
    </body>
</html>
