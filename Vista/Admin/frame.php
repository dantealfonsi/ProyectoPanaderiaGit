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
}

.content-box {
  background: linear-gradient(3deg, rgb(120 198 253) 13%, rgb(54 153 255 / 42%) 100%);
  transition: all 0.5s ease-in-out;
  padding: 60px 25px 25px 25px;
  transform-style: preserve-3d;
  border-radius: 20px;
}

.content-box .card-title {
  display: inline-block;
  color: white;
  font-size: 32px;
  font-weight: 900;
  transition: all 0.5s ease-in-out;
  transform: translate3d(0px, 0px, 50px);
  font-family: 'button';
  letter-spacing: 1.5px;
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
    
  </head>
  <body>
    <div>
  <div class='flexbox'>

  <div class="parent">
  <div class="card">
      <div class="content-box">
          <span class="card-title" id='card-title'></span>
          <span class="card-title">134</span>
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
      <div class="content-box" style='background: linear-gradient(3deg, rgb(171 219 217) 13%, rgb(84 221 235 / 42%) 100%);'>
          <span class="card-title"><?php echo $tmodulo->row_sqlconector("SELECT SUM(TOTAL) AS SUMA FROM SALIDA WHERE  DAY(FECHA)= DAY(CURRENT_TIMESTAMP()) AND MONTH(FECHA)= MONTH(CURRENT_TIMESTAMP()) AND YEAR(FECHA)= YEAR(CURRENT_TIMESTAMP())")['SUMA'] ?>BS</span>
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
      <div class="content-box" style='background: linear-gradient(3deg, rgb(253 120 120) 13%, rgb(255 168 224 / 42%) 100%);'>
          <span class="card-title"><?php echo $tmodulo->row_sqlconector("SELECT SUM(PRECIO) AS SUMA FROM CARAC_ENTRADA WHERE  DAY(FECHA)= DAY(CURRENT_TIMESTAMP()) AND MONTH(FECHA)= MONTH(CURRENT_TIMESTAMP()) AND YEAR(FECHA)= YEAR(CURRENT_TIMESTAMP())")['SUMA'] ?>BS</span>
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
      <div class="content-box" style='background: linear-gradient(3deg, rgb(253 213 120) 13%, rgb(255 156 54 / 42%) 100%);'>
          <span class="card-title"><?php echo $ganancia=($tmodulo->row_sqlconector("SELECT SUM(TOTAL) AS SUMA FROM SALIDA WHERE  DAY(FECHA)= DAY(CURRENT_TIMESTAMP()) AND MONTH(FECHA)= MONTH(CURRENT_TIMESTAMP()) AND YEAR(FECHA)= YEAR(CURRENT_TIMESTAMP())")['SUMA'] - $tmodulo->row_sqlconector("SELECT SUM(PRECIO) AS SUMA FROM CARAC_ENTRADA WHERE  DAY(FECHA)= DAY(CURRENT_TIMESTAMP()) AND MONTH(FECHA)= MONTH(CURRENT_TIMESTAMP()) AND YEAR(FECHA)= YEAR(CURRENT_TIMESTAMP())")['SUMA']) ?>BS</span>
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




  <!--  <canvas id="myChart" style="width:100%;max-width:600px"></canvas> -->

  </div>
  
     <div class='clip'> a </div>
     <div class='clip-2'> a </div>

 

    <script>
  $.get("grafico.php?S=",
        function(data){
            var datos= JSON.parse(data);
            var barColors = ["#4bc0c0", "#36a2eb","#ff6384","#ff9f40","#ffcd56"];

    const chartData = {
      
  labels: [datos[0][0], datos[0][1], datos[0][2], datos[0][3], datos[0][4]],
  data: [datos[1][0], datos[1][1],datos[1][2], datos[1][3],datos[1][4]],

};

const myChart = document.querySelector(".my-chart");
const ul = document.querySelector(".programming-stats .details ul");


new Chart(myChart, {
  type: "doughnut",
  data: {
    labels: chartData.labels,
    datasets: [
      {
        label: "- Cantidad Sacada",
        data: chartData.data,
        backgroundColor: barColors
      },
    ],
  },
  options: {
    borderWidth: 10,
    borderRadius: 2,
    hoverBorderWidth: 0,
    plugins: {
      legend: {
        display: false,
      },
    },
  },
});

const populateUl = () => {
  chartData.labels.forEach((l, i) => {
    let li = document.createElement("li");
    li.innerHTML = `${l}: <span class='percentage'>${chartData.data[i]}%</span>`;
    ul.appendChild(li);
  });
};

populateUl();

});


</script>


<script>
  $.get("grafico.php?SVE=",
        function(data){
            var datos= JSON.parse(data);
            var barColors = ["#4bc0c0", "#36a2eb","#ff6384","#ff9f40","#ffcd56"];

    const chartData = {
      
  labels: [datos[0][0], datos[0][1], datos[0][2], datos[0][3], datos[0][4],datos[0][5],datos[0][6],datos[0][7],datos[0][8]],
  data: [datos[1][0], datos[1][1],datos[1][2], datos[1][3],datos[1][4],datos[1][5],datos[1][6],datos[1][7],datos[1][8]],

};

const myChart2 = document.querySelector(".my-chart2");
const ul = document.querySelector(".programming-stats .details ul");


new Chart(myChart2, {
  type: "line",
  data: {
    labels: chartData.labels,
    datasets: [
      {
        label: "-Total Sacado",
        data: chartData.data,
        backgroundColor: barColors
      },
    ],
  },
  options: {
    scales:{
      x:{
        display:false
      }
    },
    borderWidth: 10,
    borderRadius: 2,
    hoverBorderWidth: 0,
    plugins: {
      legend: {
        display: false,
      },
    },
  },
});

const populateUl = () => {
  chartData.labels.forEach((l, i) => {
    let li = document.createElement("li");
    li.innerHTML = `${l}: <span class='percentage'>${chartData.data[i]}%</span>`;
    ul.appendChild(li);
  });
};

populateUl();

});

</script>

    </body>
</html>
