<?php 
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
    include "../../Modelo/modulo_proyecto.php";

?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../Javascript/DataTables/dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="../../css/SweetAlert/sweetalert2.min.css" />
    <script src="../Javascript/chart.js"></script>
    <script src="../Javascript/DataTables/jQuery/jquery.min.js"></script>
    <title>insumos</title>

        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet"href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>

    <style>

    /* Fuentes de Texto*/
    @font-face {
      font-family: roboto;
      src: url(../../css/roboto.ttf) format('truetype');
    }

    @font-face {
      font-family: button;
      src: url(../../css/button.ttf) format('truetype');
     }

     @font-face {
       font-family: logo;
       src: url(../../css/logo.ttf) format('truetype');
      }

      @font-face {
        font-family: spartan;
        src: url(../../css/spartan.ttf) format('truetype');
       }

    body,html{
      text-align: center;
      margin:0;
    }

    @media (max-width: 950px) {

      .existencia{
        display: flow-root ;
      }

    }

  .custom-select {
    position: relative;
    font-family: Arial;
    display: inline-block;
    width:50%;
  }

  label{
    margin: 2px 20px;
    font-family: 'button';
    font-size: 2rem;
    color: #2a2a2ad4;
  }

  .left{
    display:flex;
  }

  .outerTable{
    width: 100%;
    padding:2rem !important;
  }

    </style>
  </head>
<body>

  <?php
  
    include "../../Controlador/gestionar_insumos.php";

    $producto = new Producto;        /*Objetos*/
    $tmodulo = new Modulo; 

     function readCaracEntrada($num_entrada){
      $row;
      $tmodulo=new Modulo;
      $consulta = "SELECT * FROM carac_entrada WHERE num_entrada=".$num_entrada;
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
      
      if($row = mysqli_fetch_array($resultado))
      return $row;  
    }
  

    function readCaracSalida($num_salida){
      $row;
      $tmodulo=new Modulo;
      $consulta = "SELECT * FROM carac_salida WHERE num_salida=".$num_salida;
      $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
      
      if($row = mysqli_fetch_array($resultado))
      return $row;  
    }
  

    
  if(isset($_GET['rehabilitar_inv'])){

    $producto->RehabilitarProductos($_GET['id']);
    $tmodulo->historial($_COOKIE['nombre'],$_COOKIE['cedula'],'REHABILITO UN PRODUCTO');
    /*POST DE BORRAR*/
    $header = header("Location:reportes.php?productosdes");
  
  }
  
            /*Inicio Parte de formularios*/

    echo "                                                   
    <h1 class='titulo-Subtitulo' style='border:0; margin: 2rem 0 0rem 2.6rem;'>REPORTES</h1>
    <h1 class='subtitle_container'><span id=\"subtitulo\"></span></h1>
    <div class='flexbuttons'> ";
    
    if (!isset($_GET['nulo']) xor isset($_GET['inventario']) xor isset($_GET['pocaExistencia'])  xor isset($_GET['mejoresClientes'])  xor isset($_GET['productosdes'])){
    echo "
      <div class='left'> 
      <label>Desde:</label><input type='date' id='desde'> <br>
      <label>Hasta: </label><input type='date' id='hasta'> <br>
      </div>
  ";
    } else {
      echo "
      <div class='left'> 
      <label>Desde:</label><input type='date' id='desde' disabled style='background:#a9b2b3;'> <br>
      <label>Hasta: </label><input type='date' id='hasta' disabled style='background:#a9b2b3';> <br>
      </div>
  ";
    }
    echo "      
      <div class='right'> 
    <div class='custom-select'>
      <select id='reporte' onchange=\"reporte()\"> 
      <option>Seleccione</option>
      <option>Historial de Sesion</option>
      <option>Inventario Generalizado</option>
      <option>Usuarios Por Mes</option>
      <option>Producto Mas Comprado</option>
      <option>Entrada De Insumos</option>
      <option>Insumos Utilizados</option>
      <option>Ganancias Totales</option>
      <option>Ganancias Totales Por Dia</option>
      <option>Ganancias Totales Por Mes</option>
      <option>Ganancias Netas</option>
      <option>Ganancias Netas Por Dia</option>
      <option>Ganancias Netas Por Mes</option>
      <option>Gasto en Entrada</option>
      <option>Gasto en Entrada Por Dia</option>
      <option>Productos Desabilitados</option>

     </select> 
    </div> 
      </div> 
    
    </div>

   ";
   if (isset($_GET['inv1'])){

    $desde_1='';
    $hasta_1='';

    if (isset($_GET['desde'])){
         
      $desde_1= $_GET['desde'];
      $hasta_1= $_GET['hasta'];

    }  
    echo "
    <div class='flexbuttons'>   

    <div class='left-two'>    
    </div>

    </div>

     <div class='outerTable'>

    <div class='InventarioBox'>
    <form id='form' action='productos.php' method='POST'>
      <table id='myTable'>
        <thead>  
        <tr class='tr'>
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>ENTRADAS</th>
            <th>SALIDAS</th>
          </tr>
          </thead> 
          <tbody>";

        $consulta = "SELECT * from insumos ";   /*Buscar Producto*/        
        $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
        
        while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
        
         echo "
          <tr>
              <td>".$row['codigo']."</td>
              <td>".$row['nombre']."</td>
              <td>".$producto->returnSumEntrada($row['codigo'],$desde_1, $hasta_1)."</td>
              <td>".$producto->returnSumSalida($row['codigo'],$desde_1, $hasta_1)."</td>
         </tr>";
        }
        echo 
      "</tbody></table>
    </form>   
 </div>
  </div>";
}


if (isset($_GET['mas'])) {
  $desde_1 = '';
  $hasta_1 = '';

  if (isset($_GET['desde'])) {
    $desde_1 = $_GET['desde'];
    $hasta_1 = $_GET['hasta'];
  }

  echo "
  <div class='flexbuttons'>
    <div class='left-two'>
    </div>
  </div>
  
  <div class='outerTable'>
    <div class='InventarioBox'>
      <form id='form' action='productos.php' method='POST'>
        <canvas id='productosMasPedidosChart' width='400' height='200'></canvas>
        <table id='myTable' style='width:100%; margin-top: 20px;'>
          <thead>  
            <tr class='tr'>
              <th>NOMBRE</th>
              <th>CANTIDAD MOVIDA</th>
            </tr>
          </thead>
          <tbody>
  ";

  if (isset($_GET['desde'])) {
    $desde = "{$_GET['desde']} 00:00:00";
    $hasta = "{$_GET['hasta']} 23:59:59";

    $consulta = "SELECT p.nombre_producto, COUNT(ip.idproducto) as cantidad_pedidos
                 FROM itempedido ip
                 JOIN productos p ON ip.idproducto = p.idproducto
                 WHERE ip.fechacreacion BETWEEN '$desde' AND '$hasta'
                 GROUP BY p.nombre_producto
                 ORDER BY cantidad_pedidos DESC
                 LIMIT 12;";
  } else {
    $consulta = "SELECT p.nombre_producto, COUNT(ip.idproducto) as cantidad_pedidos
                 FROM itempedido ip
                 JOIN productos p ON ip.idproducto = p.idproducto
                 GROUP BY p.nombre_producto
                 ORDER BY cantidad_pedidos DESC
                 LIMIT 12;";
  }

  $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);

  // Arrays para almacenar datos del gráfico
  $productos = [];
  $cantidades = [];

  while ($row = mysqli_fetch_assoc($resultado)) {
    $nombre_producto = $row['nombre_producto'];
    $cantidad_pedidos = $row['cantidad_pedidos'];

    echo "
    <tr>
      <td style='text-transform:capitalize;'>$nombre_producto</td>
      <td>$cantidad_pedidos</td>
    </tr>";

    // Añadir datos al gráfico
    $productos[] = $nombre_producto;
    $cantidades[] = $cantidad_pedidos;
  }

  echo "
          </tbody>
        </table>
      </form>   
    </div>
  </div>";

  // Datos para el gráfico
  $productos_json = json_encode($productos);
  $cantidades_json = json_encode($cantidades);

  echo "
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var ctx = document.getElementById('productosMasPedidosChart').getContext('2d');
      var productosMasPedidosChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: $productos_json,
              datasets: [{
                  label: 'Cantidad Movida',
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
}


if (isset($_GET['masentradas'])){

  
  $desde_1='';
  $hasta_1='';

  if (isset($_GET['desde'])){
       
    $desde_1= $_GET['desde'];
    $hasta_1= $_GET['hasta'];

  }  

  echo "

  <div class='flexbuttons'>   

  <div class='left-two'>    
  </div>

  </div>

   <div class='outerTable'>

  <div class='InventarioBox'>
  <form id='form' action='productos.php' method='POST'>
    <table id='myTable' style='width:100%;'>
      <thead>  
        <tr class='tr'>
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>CANTIDAD</th>
            <th>UNIDAD</th>
          </tr>
      </thead>
      <tbody>
      ";

      $consulta = 
        "SELECT ce.codigo_producto, ce.nombre_producto, SUM(ce.cantidad) AS cantidad, i.uni
        FROM carac_entrada ce
        JOIN insumos i ON ce.codigo_producto = i.codigo
        GROUP BY ce.codigo_producto, i.uni
        ORDER BY cantidad DESC;
        ";   /*Buscar Producto*/
      
      if (isset($_GET['desde'])){

        $consulta = "SELECT ce.fecha, ce.codigo_producto, ce.nombre_producto, SUM(ce.cantidad) AS cantidad, i.uni
          FROM carac_entrada ce
          JOIN insumos i ON ce.codigo_producto = i.codigo
          WHERE ce.fecha BETWEEN '{$_GET['desde']} 00:00:00' AND '{$_GET['hasta']} 23:59:59'
          GROUP BY ce.codigo_producto, ce.fecha, i.uni
          ORDER BY cantidad DESC;
        ";

      }

      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>
            <td>".$row['codigo_producto']."</td>
            <td style='text-transform:capitalize;'>".$row['nombre_producto']."</td>
            <td>".$row['cantidad']."</td>
            <td style='text-transform:capitalize;'>".$row['uni']."</td>

       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";
}

if (isset($_GET['massalidas'])){

 
  $desde_1='';
  $hasta_1='';

  if (isset($_GET['desde'])){
       
    $desde_1= $_GET['desde'];
    $hasta_1= $_GET['hasta'];

  }  

  echo "
      
  <div class='flexbuttons'>   

  <div class='left-two'>    
  </div>

  </div>

 <div class='outerTable'>
  <div class='InventarioBox'>
  <form id='form' action='productos.php' method='POST'>
    <table id='myTable'  style='width:100%;'>
      <thead>  
        <tr class='tr'>
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>CANTIDAD</th>
            <th>UNIDAD</th>
          </tr>
      </thead>
      <tbody>
      ";

      $consulta = "SELECT cs.codigo_producto, cs.nombre_producto, SUM(cs.cantidad) AS cantidad, i.uni
      FROM carac_salida cs
      JOIN insumos i ON cs.codigo_producto = i.codigo
      GROUP BY cs.codigo_producto, i.uni
      ORDER BY cantidad ASC;
      ";
            
            if (isset($_GET['desde'])) {
              $consulta = "SELECT cs.fecha, cs.codigo_producto, cs.nombre_producto, SUM(cs.cantidad) AS cantidad, i.uni
              FROM carac_salida cs
              JOIN insumos i ON cs.codigo_producto = i.codigo
              WHERE cs.fecha BETWEEN '{$_GET['desde']} 00:00:00' AND '{$_GET['hasta']} 23:59:59'
              GROUP BY cs.codigo_producto, cs.fecha, i.uni
              ORDER BY cantidad ASC;
              ";
          }
          

      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>
            <td>".$row['codigo_producto']."</td>
            <td style='text-transform:capitalize;'>".$row['nombre_producto']."</td>
            <td>".$row['cantidad']."</td>
            <td style='text-transform:capitalize;'>".$row['uni']."</td>

       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";
}

if (isset($_GET['gananciasTotales'])){
   
  $desde_1='';
  $hasta_1='';

  if (isset($_GET['desde'])){
       
    $desde_1= $_GET['desde'];
    $hasta_1= $_GET['hasta'];

  }  

  echo "

  <div class='flexbuttons'>   

      <div class='outerTable'>

  <div class='InventarioBox'>
  <form id='form' action='productos.php' method='POST'>
    <table id='myTable'  style='width:100%;'>
      <thead>  
        <tr class='tr'>
            <th>FECHA</th>
            <th>GANANCIA TOTAL</th>
          </tr>
      </thead>
      <tbody>
      ";
    

      $consulta = "SELECT SUM(total) AS total FROM salida WHERE DAY(fecha) BETWEEN DAY('2023-08-09 23:22:07') AND DAY(NOW());";   /*Buscar Producto*/
      
      if (isset($_GET['desde'])){
        $consulta = "SELECT SUM(total) AS total FROM salida WHERE DAY(fecha) BETWEEN DAY('{$_GET['desde']} 00:00') AND DAY('{$_GET['hasta']}');";   /*Buscar Producto*/
      }

      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>";
        if (isset($_GET['desde'])){
          echo "<td>{$_GET['desde']} Hasta {$_GET['hasta']}</td>";
        }else{
          echo "<td>Inicio-Ahora</td> ";
        }echo"
            <td>".$row['total']." <b>BS</b></td>
       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";
}

if (isset($_GET['gananciasTotalesPorDia'])){

   
  $desde_1='';
  $hasta_1='';

  if (isset($_GET['desde'])){
       
    $desde_1= $_GET['desde'];
    $hasta_1= $_GET['hasta'];

  }  

  echo "

      
  <div class='flexbuttons'>   

      <div class='outerTable'>

  <div class='InventarioBox'>
  <form id='form' action='productos.php' method='POST'>
    <table id='myTable'  style='width:100%;'>
      <thead>  
        <tr class='tr'>
            <th>FECHA</th>
            <th>GANANCIA TOTAL</th>
          </tr>
      </thead>
      <tbody>
      ";
    

      $consulta = "SELECT DATE(fechapedido) as Fecha, ROUND(SUM(total),2) as Ganancia_Diaria FROM pedido_usuario WHERE estado IN ('PRODUCCION', 'PAGADO') GROUP BY DATE(fechapedido) ORDER BY Fecha;";   /*Buscar Producto*/
      
      if (isset($_GET['desde'])){
        $consulta = "SELECT DATE(fechapedido) as Fecha, ROUND(SUM(total), 2) as Ganancia_Diaria
        FROM pedido_usuario
        WHERE estado IN ('PRODUCCION', 'PAGADO')
        AND fechapedido BETWEEN '{$_GET['desde']} 00:00:00' AND '{$_GET['hasta']} 23:59:59'
        GROUP BY DATE(fechapedido)
        ORDER BY Fecha;";   /*Buscar Producto*/
      }

      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>
          <td>".$row['Fecha']."</td>
          <td>".$row['Ganancia_Diaria']." <b>BS</b></td>
       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";
}



if (isset($_GET['gananciasTotalesPorMes'])){

   
  $desde_1='';
  $hasta_1='';

  if (isset($_GET['desde'])){
       
    $desde_1= $_GET['desde'];
    $hasta_1= $_GET['hasta'];

  }  

  echo "

      
  <div class='flexbuttons'>   

      <div class='outerTable'>

  <div class='InventarioBox'>
  <form id='form' action='productos.php' method='POST'>
    <table id='myTable'  style='width:100%;'>
      <thead>  
        <tr class='tr'>
            <th>FECHA</th>
            <th>GANANCIA TOTAL</th>
          </tr>
      </thead>
      <tbody>
      ";
    

      $consulta = "SELECT DATE_FORMAT(fechapedido, '%Y-%m') as Mes, ROUND(SUM(total),2) as Ganancia_Mensual FROM pedido_usuario WHERE estado IN ('PRODUCCION', 'PAGADO') GROUP BY DATE_FORMAT(fechapedido, '%Y-%m') ORDER BY Mes;";   /*Buscar Producto*/
      
      if (isset($_GET['desde'])){
        $consulta = "SELECT DATE_FORMAT(fechapedido, '%Y-%m') as Mes, ROUND(SUM(total), 2) as Ganancia_Mensual
          FROM pedido_usuario
          WHERE estado IN ('PRODUCCION', 'PAGADO')
          AND fechapedido BETWEEN '{$_GET['desde']} 00:00:00' AND '{$_GET['hasta']} 23:59:59'
          GROUP BY DATE_FORMAT(fechapedido, '%Y-%m')
          ORDER BY Mes;
          ";   /*Buscar Producto*/
      }

      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>
          <td>".$row['Mes']."</td>
          <td>".$row['Ganancia_Mensual']." <b>BS</b></td>
       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";
}



if (isset($_GET['GastoEntradaPorDia'])) {
  $desde_1 = '';
  $hasta_1 = '';

  if (isset($_GET['desde'])) {
    $desde_1 = $_GET['desde'];
    $hasta_1 = $_GET['hasta'];
  }

  echo "
  <div class='flexbuttons'>   
    <div class='outerTable'>
      <div class='InventarioBox'>
        <form id='form' action='productos.php' method='POST'>
          <canvas id='gastoEntradaPorDiaChart' width='400' height='200'></canvas>
          <table id='myTable' style='width:100%; margin-top: 20px;'>
            <thead>  
              <tr class='tr'>
                <th>FECHA</th>
                <th>INVERSION TOTAL</th>
              </tr>
            </thead>
            <tbody>
  ";

  if (isset($_GET['desde'])) {
    $desde = "{$_GET['desde']} 00:00:00";
    $hasta = "{$_GET['hasta']} 23:59:59";

    $consulta = "
      SELECT DATE(fecha) as fecha, SUM(precio) AS total 
      FROM carac_entrada 
      WHERE fecha BETWEEN '$desde' AND '$hasta' 
      GROUP BY DATE(fecha)
      ORDER BY fecha;
    ";
  } else {
    $consulta = "
      SELECT DATE(fecha) as fecha, SUM(precio) AS total 
      FROM carac_entrada 
      WHERE fecha BETWEEN '2023-08-09 23:22:07' AND NOW() 
      GROUP BY DATE(fecha)
      ORDER BY fecha;
    ";
  }

  $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);

  // Arrays para almacenar datos del gráfico
  $fechas = [];
  $totales = [];

  while ($row = mysqli_fetch_assoc($resultado)) {
    $fecha = $row['fecha'];
    $total = $row['total'];

    echo "
    <tr>";
    echo "<td>$fecha</td>";
    echo "<td>" . number_format($total, 2) . "</td>
    </tr>";

    // Añadir datos al gráfico
    $fechas[] = $fecha;
    $totales[] = $total;
  }

  echo "
            </tbody>
          </table>
        </form>   
      </div>
    </div>
  </div>";

  // Datos para el gráfico
  $fechas_json = json_encode($fechas);
  $totales_json = json_encode($totales);

  echo "
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var ctx = document.getElementById('gastoEntradaPorDiaChart').getContext('2d');
      var gastoEntradaPorDiaChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: $fechas_json,
              datasets: [{
                  label: 'Inversión Total',
                  data: $totales_json,
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
                  },
                  x: {
                      ticks: {
                          maxRotation: 90,
                          minRotation: 45
                      }
                  }
              }
          }
      });
    });
  </script>
  ";
}




if (isset($_GET['GastoEntrada'])) {
  $desde_1 = '';
  $hasta_1 = '';

  if (isset($_GET['desde'])) {
    $desde_1 = $_GET['desde'];
    $hasta_1 = $_GET['hasta'];
  }

  echo "
  <div class='flexbuttons'>   
    <div class='outerTable'>
      <div class='InventarioBox'>
        <form id='form' action='productos.php' method='POST'>
          <canvas id='gastoEntradaChart' width='400' height='200'></canvas>
          <table id='myTable' style='width:100%; margin-top: 20px;'>
            <thead>  
              <tr class='tr'>
                <th>FECHA</th>
                <th>INVERSION TOTAL</th>
              </tr>
            </thead>
            <tbody>
  ";

  if (isset($_GET['desde'])) {
    $desde = "{$_GET['desde']} 00:00:00";
    $hasta = "{$_GET['hasta']} 23:59:59";

    $consulta = "
      SELECT DATE(fecha) AS fecha, SUM(precio) AS total
      FROM carac_entrada
      WHERE fecha BETWEEN '$desde' AND '$hasta'
      GROUP BY DATE(fecha)
      ORDER BY fecha;
    ";
  } else {
    $consulta = "
      SELECT DATE(fecha) AS fecha, SUM(precio) AS total
      FROM carac_entrada
      WHERE fecha BETWEEN '2023-08-09 23:22:07' AND NOW()
      GROUP BY DATE(fecha)
      ORDER BY fecha;
    ";
  }

  $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);

  // Arrays para almacenar datos del gráfico
  $fechas = [];
  $totales = [];

  while ($row = mysqli_fetch_assoc($resultado)) {
    $fecha = $row['fecha'];
    $total = $row['total'];

    echo "
    <tr>";
    if (isset($_GET['desde'])) {
      echo "<td>{$_GET['desde']} Hasta {$_GET['hasta']}</td>";
    } else {
      echo "<td>Inicio-Ahora</td>";
    }
    echo "<td>" . number_format($total, 2) . "</td>
    </tr>";

    // Añadir datos al gráfico
    $fechas[] = $fecha;
    $totales[] = $total;
  }

  echo "
            </tbody>
          </table>
        </form>   
      </div>
    </div>
  </div>";

  // Datos para el gráfico
  $fechas_json = json_encode($fechas);
  $totales_json = json_encode($totales);

  echo "
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var ctx = document.getElementById('gastoEntradaChart').getContext('2d');
      var gastoEntradaChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: $fechas_json,
              datasets: [{
                  label: 'Inversión Total',
                  data: $totales_json,
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
                  },
                  x: {
                      ticks: {
                          maxRotation: 90,
                          minRotation: 45
                      }
                  }
              }
          }
      });
    });
  </script>
  ";
}


if (isset($_GET['productosPorDia'])){

  $desde_1='';
  $hasta_1='';

  if (isset($_GET['desde'])){
       
    $desde_1= $_GET['desde'];
    $hasta_1= $_GET['hasta'];

  }  

  echo "
  
  <div class='flexbuttons'>   

      <div class='outerTable'>

  <div class='InventarioBox'>
  <form id='form' action='productos.php' method='POST'>
    <table id='myTable'  style='width:100%;'>
      <thead>  
        <tr class='tr'>
            <th>FECHA</th>
            <th>TOTAL SACADO</th>
          </tr>
      </thead>
      <tbody>
      ";
      $consulta = "SELECT DATE(fecha) as fecha, SUM(total) AS total FROM salida WHERE fecha BETWEEN '2023-08-09 23:22:07' AND NOW() GROUP BY DATE(fecha);";   /*Buscar Producto*/
      
      if (isset($_GET['desde'])){
        $consulta = "SELECT DATE(fecha) as fecha, SUM(total) AS total FROM salida WHERE fecha BETWEEN '{$_GET['desde']} 00:00' AND '{$_GET['hasta']}' GROUP BY DATE(fecha);";   /*Buscar Producto*/
      }

      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>
         <td>".$row['fecha']."</td> 
          <td>".$row['total']."</td>
       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";
}
if (isset($_GET['GananciaNeta'])) {
  $desde_1 = '';
  $hasta_1 = '';

  if (isset($_GET['desde'])) {
    $desde_1 = $_GET['desde'];
    $hasta_1 = $_GET['hasta'];
  }  

  echo "
  <div class='flexbuttons'> 
    <div class='outerTable'>
      <div class='InventarioBox'>
        <form id='form' action='productos.php' method='POST'>
          <table id='myTable'  style='width:100%;'>
            <thead>  
              <tr class='tr'>
                <th>FECHA</th>
                <th>GANANCIA NETA</th>
              </tr>
            </thead>
            <tbody>
  ";

  if (isset($_GET['desde'])) {
    $desde = "{$_GET['desde']} 00:00:00";
    $hasta = "{$_GET['hasta']} 23:59:59";

    $consulta = "SELECT (ganancias_totales - gastos_entrada) AS ganancia_neta
    FROM (
      SELECT
        (SELECT SUM(total) FROM pedido_usuario WHERE estado IN ('PRODUCCION', 'PAGADO') AND fechapedido BETWEEN '$desde' AND '$hasta') AS ganancias_totales,
        (SELECT SUM(precio) FROM carac_entrada WHERE fecha BETWEEN '$desde' AND '$hasta') AS gastos_entrada
    ) AS totales;";
  } else {
    $consulta = "SELECT (ganancias_totales - gastos_entrada) AS ganancia_neta
    FROM (
      SELECT
        (SELECT SUM(total) FROM pedido_usuario WHERE estado IN ('PRODUCCION', 'PAGADO') AND fechapedido BETWEEN '2023-08-09 23:22:07' AND NOW()) AS ganancias_totales,
        (SELECT SUM(precio) FROM carac_entrada WHERE fecha BETWEEN '2023-08-09 23:22:07' AND NOW()) AS gastos_entrada
    ) AS totales;";
  }

  $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);

  $ganancia_neta = 0;
  if ($row = mysqli_fetch_assoc($resultado)) {
    $ganancia_neta = $row['ganancia_neta'];
  }

  echo "
  <tr>";
  if (isset($_GET['desde'])) {
    echo "<td>{$_GET['desde']} Hasta {$_GET['hasta']}</td>";
  } else {
    echo "<td>Inicio-Ahora</td>";
  }
  echo "<td>" . number_format($ganancia_neta, 2) . "</td>
  </tr>";

  echo "
            </tbody>
          </table>
        </form>   
      </div>
    </div>
  </div>";
}


if (isset($_GET['gananciaNetaPorDia'])) {
  $desde_1 = '';
  $hasta_1 = '';

  if (isset($_GET['desde'])) {
    $desde_1 = $_GET['desde'];
    $hasta_1 = $_GET['hasta'];
  }

  echo "
  <div class='flexbuttons'>
    <div class='outerTable'>
      <div class='InventarioBox'>
        <form id='form' action='productos.php' method='POST'>
          <canvas id='gananciaNetaPorDiaChart' width='400' height='200'></canvas>
          <table id='myTable' style='width:100%; margin-top: 20px;'>
            <thead>  
              <tr class='tr'>
                <th>FECHA</th>
                <th>GANANCIA NETA</th>
              </tr>
            </thead>
            <tbody>
  ";

  if (isset($_GET['desde'])) {
    $desde = "{$_GET['desde']} 00:00:00";
    $hasta = "{$_GET['hasta']} 23:59:59";

    $consulta = "
      SELECT DATE(ip.fechapedido) AS fecha, 
             ROUND((SUM(ip.total) - 
             (SELECT SUM(ce.precio) FROM carac_entrada ce 
              WHERE ce.fecha BETWEEN '$desde' AND '$hasta' 
              AND DATE(ce.fecha) = DATE(ip.fechapedido))), 2) AS ganancia_neta
      FROM pedido_usuario ip
      WHERE ip.estado IN ('PRODUCCION', 'PAGADO')
      AND ip.fechapedido BETWEEN '$desde' AND '$hasta'
      GROUP BY DATE(ip.fechapedido)
      ORDER BY fecha;
    ";
  } else {
    $consulta = "
      SELECT DATE(ip.fechapedido) AS fecha, 
             ROUND((SUM(ip.total) - 
             (SELECT SUM(ce.precio) FROM carac_entrada ce 
              WHERE DATE(ce.fecha) = DATE(ip.fechapedido))), 2) AS ganancia_neta
      FROM pedido_usuario ip
      WHERE ip.estado IN ('PRODUCCION', 'PAGADO')
      GROUP BY DATE(ip.fechapedido)
      ORDER BY fecha;
    ";
  }

  $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);

  // Arrays para almacenar datos del gráfico
  $fechas = [];
  $ganancias = [];

  while ($row = mysqli_fetch_assoc($resultado)) {
    $fecha = $row['fecha'];
    $ganancia_neta = $row['ganancia_neta'];

    echo "
    <tr>";
    echo "<td>$fecha</td>";
    echo "<td>" . number_format($ganancia_neta, 2) . "</td>
    </tr>";

    // Añadir datos al gráfico
    $fechas[] = $fecha;
    $ganancias[] = $ganancia_neta;
  }

  echo "
            </tbody>
          </table>
        </form>   
      </div>
    </div>
  </div>";

  // Datos para el gráfico
  $fechas_json = json_encode($fechas);
  $ganancias_json = json_encode($ganancias);

  echo "
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var ctx = document.getElementById('gananciaNetaPorDiaChart').getContext('2d');
      var gananciaNetaPorDiaChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: $fechas_json,
              datasets: [{
                  label: 'Ganancia Neta',
                  data: $ganancias_json,
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
                  },
                  x: {
                      ticks: {
                          maxRotation: 90,
                          minRotation: 45
                      }
                  }
              }
          }
      });
    });
  </script>
  ";
}


if (isset($_GET['gananciaNetaPorMes'])) {
  $desde_1 = '';
  $hasta_1 = '';

  if (isset($_GET['desde'])) {
    $desde_1 = $_GET['desde'];
    $hasta_1 = $_GET['hasta'];
  }  

  echo "
  <div class='flexbuttons'>
    <div class='outerTable'>
      <div class='InventarioBox'>
        <form id='form' action='productos.php' method='POST'>
          <canvas id='gananciaNetaPorMesChart' width='400' height='200'></canvas>
          <table id='myTable' style='width:100%; margin-top: 20px;'>
            <thead>  
              <tr class='tr'>
                <th>MES</th>
                <th>GANANCIA NETA</th>
              </tr>
            </thead>
            <tbody>
  ";

  if (isset($_GET['desde'])) {
    $desde = "{$_GET['desde']} 00:00:00";
    $hasta = "{$_GET['hasta']} 23:59:59";

    $consulta = "SELECT DATE_FORMAT(ip.fechapedido, '%Y-%m') AS mes, 
                        ROUND((SUM(ip.total) - (SELECT SUM(ce.precio) 
                                               FROM carac_entrada ce 
                                               WHERE ce.fecha BETWEEN '$desde' AND '$hasta' 
                                               AND DATE_FORMAT(ce.fecha, '%Y-%m') = DATE_FORMAT(ip.fechapedido, '%Y-%m'))), 2) AS ganancia_neta
                 FROM pedido_usuario ip
                 WHERE ip.estado IN ('PRODUCCION', 'PAGADO')
                   AND ip.fechapedido BETWEEN '$desde' AND '$hasta'
                 GROUP BY DATE_FORMAT(ip.fechapedido, '%Y-%m')
                 ORDER BY mes
                 LIMIT 12;
    ";
  } else {
    $consulta = "SELECT DATE_FORMAT(ip.fechapedido, '%Y-%m') AS mes, 
                        ROUND((SUM(ip.total) - (SELECT SUM(ce.precio) 
                                               FROM carac_entrada ce 
                                               WHERE ce.fecha BETWEEN '2023-08-09 23:22:07' AND NOW() 
                                               AND DATE_FORMAT(ce.fecha, '%Y-%m') = DATE_FORMAT(ip.fechapedido, '%Y-%m'))), 2) AS ganancia_neta
                 FROM pedido_usuario ip
                 WHERE ip.estado IN ('PRODUCCION', 'PAGADO')
                   AND ip.fechapedido BETWEEN '2023-08-09 23:22:07' AND NOW()
                 GROUP BY DATE_FORMAT(ip.fechapedido, '%Y-%m')
                 ORDER BY mes
                 LIMIT 12;
    ";
  }

  $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);

  // Arrays para almacenar datos del gráfico
  $meses = [];
  $ganancias = [];

  while ($row = mysqli_fetch_assoc($resultado)) {
    $mes = $row['mes'];
    $ganancia_neta = $row['ganancia_neta'];

    echo "
    <tr>";
    echo "<td>$mes</td>";
    echo "<td>" . number_format($ganancia_neta, 2) . "</td>
    </tr>";

    // Añadir datos al gráfico
    $meses[] = $mes;
    $ganancias[] = $ganancia_neta;
  }

  echo "
            </tbody>
          </table>
        </form>   
      </div>
    </div>
  </div>";

  // Datos para el gráfico
  $meses_json = json_encode($meses);
  $ganancias_json = json_encode($ganancias);

  echo "
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var ctx = document.getElementById('gananciaNetaPorMesChart').getContext('2d');
      var gananciaNetaPorMesChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: $meses_json,
              datasets: [{
                  label: 'Ganancia Neta',
                  data: $ganancias_json,
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
}



if (isset($_GET['usuariosPorMes'])) {
  $desde_1 = '';
  $hasta_1 = '';

  if (isset($_GET['desde'])) {
    $desde_1 = $_GET['desde'];
    $hasta_1 = $_GET['hasta'];
  }

  echo "
  <div class='flexbuttons'>
    <div class='outerTable'>
      <div class='InventarioBox'>
        <form id='form' action='usuarios.php' method='POST'>
          <canvas id='usuariosPorMesChart' width='400' height='200'></canvas>
          <table id='myTable' style='width:100%; margin-top: 20px;'>
            <thead>  
              <tr class='tr'>
                <th>MES</th>
                <th>CANTIDAD DE USUARIOS</th>
              </tr>
            </thead>
            <tbody>
  ";

  if (isset($_GET['desde'])) {
    $desde = "{$_GET['desde']} 00:00:00";
    $hasta = "{$_GET['hasta']} 23:59:59";

    $consulta = "SELECT DATE_FORMAT(fechacreacion, '%Y-%m') AS mes, COUNT(idusuario) AS cantidad_usuarios
                 FROM usuario
                 WHERE fechacreacion BETWEEN '$desde' AND '$hasta'
                 GROUP BY DATE_FORMAT(fechacreacion, '%Y-%m')
                 ORDER BY mes DESC
                 LIMIT 12;";
  } else {
    $consulta = "SELECT DATE_FORMAT(fechacreacion, '%Y-%m') AS mes, COUNT(idusuario) AS cantidad_usuarios
                 FROM usuario
                 WHERE fechacreacion BETWEEN '2023-08-09 23:22:07' AND NOW()
                 GROUP BY DATE_FORMAT(fechacreacion, '%Y-%m')
                 ORDER BY mes DESC
                 LIMIT 12;";
  }

  $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta);

  // Arrays para almacenar datos del gráfico
  $meses = [];
  $cantidades = [];

  while ($row = mysqli_fetch_assoc($resultado)) {
    $mes = $row['mes'];
    $cantidad_usuarios = $row['cantidad_usuarios'];

    echo "
    <tr>";
    echo "<td>$mes</td>";
    echo "<td>$cantidad_usuarios</td>
    </tr>";

    // Añadir datos al gráfico
    $meses[] = $mes;
    $cantidades[] = $cantidad_usuarios;
  }

  echo "
            </tbody>
          </table>
        </form>   
      </div>
    </div>
  </div>";

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
}






if (isset($_GET['nulo'])){

  echo "

      <div class='outerTable'>

  <div class='InventarioBox'>
  <form id='form' action='productos.php' method='POST'>
    <table id='myTable'  style='width:100%;'>
      <thead>  
        <tr class='tr'>
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>CANTIDAD</th>
          </tr>
      </thead>
      <tbody>
      ";

      $consulta = "SELECT codigo, nombre, existencia from insumos WHERE existencia <= '0' GROUP BY codigo ORDER BY existencia ASC;";   /*Buscar Producto*/
    
      if (isset($_GET['desde'])){

        $consulta = "SELECT codigo, nombre, existencia from insumos WHERE existencia <= '0' WHERE fecha BETWEEN '{$_GET['desde']} 00:00' AND '{$_GET['hasta']} 23:59' GROUP BY codigo ORDER BY existencia ASC;";   /*Buscar Producto*/

      }

      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>
            <td>".$row['codigo']."</td>
            <td>".$row['nombre']."</td>
            <td>".$row['existencia']."</td>
       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";
}

if (isset($_GET['pocaExistencia'])){

  echo "

      <div class='outerTable'>


  <div class='InventarioBox'>
  <form id='form' action='productos.php' method='POST'>
    <table id='myTable'  style='width:100%;'>
      <thead>  
        <tr class='tr'>
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>CANTIDAD</th>
          </tr>
      </thead>
      <tbody>
      ";

      $consulta = "SELECT * FROM `insumos` WHERE existencia < c_min AND deleted=0 GROUP BY codigo ORDER BY existencia ASC;";   /*Buscar Producto*/
    
      if (isset($_GET['desde'])){

        $consulta = "SELECT codigo, nombre, existencia from insumos WHERE existencia <= '0' WHERE fecha BETWEEN '{$_GET['desde']} 00:00' AND '{$_GET['hasta']} 23:59' GROUP BY codigo ORDER BY existencia ASC;";   /*Buscar Producto*/

      }

      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>
            <td>".$row['codigo']."</td>
            <td>".$row['nombre']."</td>
            <td>".$row['existencia']."</td>
       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";
}

if (isset($_GET['mejoresClientes'])){

  echo "

      <div class='outerTable'>


  <div class='InventarioBox'>
  <form id='form' action='productos.php' method='POST'>
    <table id='myTable'  style='width:100%;'>
      <thead>  
        <tr class='tr'>
            <th>CEDULA</th>
            <th>TOTAL COMPRADO</th>
          </tr>
      </thead>
      <tbody>
      ";

      $consulta = "SELECT CEDULA_CLIENTE,SUM(TOTAL) AS TOTAL FROM SALIDA GROUP BY CEDULA_CLIENTE ORDER BY `TOTAL` DESC;";   /*Buscar Producto*/
    
      if (isset($_GET['desde'])){

        $consulta = "SELECT CEDULA_CLIENTE,SUM(TOTAL) AS TOTAL FROM SALIDA WHERE FECHA BETWEEN '{$_GET['desde']} 00:00' AND '{$_GET['hasta']} 23:59' GROUP BY CEDULA_CLIENTE ORDER BY `TOTAL` DESC ;";   /*Buscar Producto*/

      }

      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>
            <td>".$row['cedula_cliente']."</td>
            <td>".$row['total']."</td>
       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";
}

/*productos desabilitados*/

if (isset($_GET['productosdes'])){

  echo "

      <div class='outerTable'>


  <div class='InventarioBox'>
  <form id='form' action='reportes.php?productosdes' method='POST'>
    <table id='myTable'  style='width:100%;'>
      <thead>  
        <tr class='tr'>
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>ACCIONES</th>
          </tr>
      </thead>
      <tbody>
      ";

      $consulta = "SELECT CODIGO, NOMBRE from INSUMOS WHERE DELETED=1";   /*Buscar Producto*/
    
      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>
            <td>".$row['codigo']."</td>
            <td>".$row['nombre']."</td>
            <td>
            ";
            if ($_COOKIE['nivel']==0){
              echo "
              <a onclick=\"borrar({$row['CODIGO']})\" title='Habilitar Producto'> <img id='icon-bt' src='../fonts/rehab.png'> </a>
              ";
            }
            echo"
            </td>
       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";

}

if (isset($_GET['inventario'])){

  $cadena="
    <div class='flexbuttons'>   

    <div class='left-two'>    
    <a  class='square square-active'  title='Mostrar activos' href='?inventario&todos' id='bt'> Activos </a>   
    <a  class='square square-inactive'  title='Mostrar inactivos' href='?inventario&elimi' id='bt1'> Inactivo </a>   

    </div>
    <div class='right'>    
    </div>
     </div>

         <div class='outerTable'>

    <div class='InventarioBox'>
      <form id='form' action='inventario.php' method='POST'>
        <table id='myTable'  style='width:100%;'>
          <thead>
            <tr class='tr'>
              <td>ESTADO</td>
              <td>CODIGO</td>
              <td>NOMBRE</td>
              <td>PRECIO</td>
              <td>EXISTENCIA</td>
           </tr>
          </thead>
          <tbody>";
$conexion = mysqli_connect($tmodulo->servidor,$tmodulo->user,$tmodulo->password,$tmodulo->database);
$consulta = "select * from INSUMOS";

  if(isset($_GET["todos"])){
    $consulta = "select * from INSUMOS WHERE DELETED=0";
    $counter=1;
    }

    if(isset($_GET["elimi"])){
      $consulta = "select * from INSUMOS WHERE DELETED=1";
      $counter=2;
      }
   

$resultado = mysqli_query( $conexion, $consulta );
while($row = mysqli_fetch_array($resultado)){
   
  $disabled = "#eee;";
  $estado = "INACTIVO";
  $state="#ff959236";


  if ($row['deleted']==0){
    $estado = "ACTIVO";
    $disabled = "fff";
    $state="#e4ffe0d1";

  }
    $cadena= $cadena . "
    <tr style='background:{$disabled}'>
        <td style='background:{$state}'>$estado</td>
        <td>".$row['codigo']."</td>
        <td>".$row['nombre']."</td>
        <td>".$row['precio']."</td>
        <td>".$row['existencia']."</td>
    </tr>";
 }
    $cadena = $cadena .
  "</tbody>
    </table>
        </fieldset>
          </form>
            </div>
            </div>
      ";
mysqli_close($conexion);
echo $cadena;

}


if (isset($_GET['devueltoE'])){

  echo "

      <div class='outerTable'>

  <div class='InventarioBox'>
  <form id='form' action='productos.php' method='POST'>
    <table id='myTable'>
      <thead>  
        <tr class='tr'>
            <th>FECHA</th>
            <th>NOMBRE</th>
            <th>CANTIDAD</th>
            <th>MOTIVO</th>
          </tr>
      </thead>
      <tbody>
      ";

      $consulta = "SELECT FECHA, NUM_ENTRADA, DEVUELTO, MOTIVO from ENTRADA WHERE DEVUELTO=1;";   /*Buscar Producto*/
    
      if (isset($_GET['desde'])){

        $consulta = "SELECT FECHA, NUM_ENTRADA, DEVUELTO, MOTIVO from ENTRADA WHERE DEVUELTO=1 AND FECHA BETWEEN '{$_GET['desde']} 00:00' AND '{$_GET['hasta']} 23:59';";   /*Buscar Producto*/

      }

      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>
             <td>".$row['fecha']."</td>
            <td>".readCaracEntrada($row['NUM_ENTRADA'])['nombre_producto']."</td>
            <td>".readCaracEntrada($row['NUM_ENTRADA'])['cantidad']."</td>
            <td>".$row['motivo']."</td>
       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";
}


if (isset($_GET['devueltoS'])){

  echo "

      <div class='outerTable'>

  <div class='InventarioBox'>
  <form id='form' action='productos.php' method='POST'>
    <table id='myTable'>
      <thead>  
        <tr class='tr'>
            <th>FECHA</th>
            <th>NOMBRE</th>
            <th>CANTIDAD</th>
            <th>MOTIVO</th>
          </tr>
      </thead>
      <tbody>
      ";

      $consulta = "SELECT FECHA, NUM_SALIDA, DEVUELTO, MOTIVO from SALIDA WHERE DEVUELTO=1;";   /*Buscar Producto*/
    
      if (isset($_GET['desde'])){

        $consulta = "SELECT FECHA, NUM_SALIDA, DEVUELTO, MOTIVO from SALIDA WHERE DEVUELTO=1 AND FECHA BETWEEN '{$_GET['desde']} 00:00' AND '{$_GET['hasta']} 23:59';";   /*Buscar Producto*/

      }

      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>
             <td>".$row['fecha']."</td>
            <td>".readCaracSalida($row['NUM_SALIDA'])['nombre_producto']."</td>
            <td>".readCaracSalida($row['NUM_SALIDA'])['cantidad']."</td>
            <td>".$row['motivo']."</td>
       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";
}


if (isset($_GET['hist'])){

  echo "

      <div class='outerTable'>

  <div class='InventarioBox'>

  <form id='form' action='productos.php' method='POST'>
    <table id=myTable>
      <thead>
      <tr class='tr'>
        <th style='text-align: center;'>HISTORIAL</th>
      </tr>
      </thead>
      </tbody>";

      $consulta = "SELECT * from historial ORDER BY historial.fecha DESC"; 

      if (isset($_GET['desde'])){

        $consulta = "SELECT * from historial WHERE fecha BETWEEN '{$_GET['desde']} 00:00' AND '{$_GET['hasta']} 23:59' ORDER BY `historial`.`fecha` DESC";   /*Buscar Producto*/

      }

      $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
      
      while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/
      
        echo "
        <tr>
            <td>".$row['fecha']." - ".$row['nombre_usuario']."  ".$row['ubicacion']."</td>
       </tr>";
      }
      echo 
    "</tbody>
    </table>
  </form>   
</div>
</div>";
}

  ?>
<script src="../Javascript/Tooltip/tooltip.min.js"></script>
  <script src="../Javascript/Tooltip/tippy.min.js"></script>
  <script src="../Javascript/SweetAlert/sweetalert2.all.min.js"></script>
  <script src="../Javascript/DataTables/jQuery/jquery.min.js"></script>
  <script src='../Javascript/DataTables/DataTables/js/jquery.dataTables.min.js'> </script>
  <script src="../Javascript/DataTables/Buttons/js/dataTables.buttons.min.js"></script>
  <script src="../Javascript/DataTables/JSZip/jszip.min.js"></script>
  <script src="../Javascript/DataTables/pdfmake/pdfmake.min.js"></script>
  <script src="../Javascript/DataTables/pdfmake/vfs_fonts.js"></script>
  <script src="../Javascript/DataTables/Buttons/js/buttons.html5.min.js"></script>
  <script src="../Javascript/DataTables/Buttons/js/buttons.print.min.js"></script>
  
  <script>
    $(document).ready(function() {
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        paging: true,
        pageLength: 5,
        lengthChange: true,
        scrollX: true,
        language: {
      "emptyTable": "No hay entradas que mostrar",
        },
        oLanguage: {
          "oPaginate": {
              "sNext": "→",
              "sPrevious": "←"
          },  
          "sSearch": "<img id='icon-buscar' src='../../Assets/images/inventory/search.png'>",
          "sInfo": "<div class='table_label'>Pagina _START_ (_TOTAL_ entradas) </div>",
          "sInfoEmpty": "No hay entradas que mostrar"
        },
        
        buttons:[
            {
                extend:    'collection',
                text:      '<img id="table_icon_export" src="../../Assets/images/inventory/download.png">',
                className: 'square square-red',
                titleAttr: 'Exportar',
                buttons: [
                    {
                      extend:    'excelHtml5',
                      text:      '<img id="table_icon" style="margin: 0;" src="../../Assets/images/inventory/excel.svg"> EXCEL</i>',
                      className: 'square square-excel',
                      titleAttr: 'Excel'
                    },
                    {
                      extend:    'pdfHtml5',
                      text:      '<img id="table_icon" src="../../Assets/images/inventory/pdf.svg"> PDF</i>',
                      titleAttr: 'PDF',
                      className: 'square square-pdf',
                      /////////////Custom PDF/////////////////////////
                      customize: function ( doc ) {
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        doc.content.splice(0,1);
                         var logo = 'data:image/png;base64,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';

                        doc.pageMargins = [20,110,20,30];
                        doc['header']=(function() {
                          return {
                            columns: [
                              {
                                image: logo,
                                width: 80
                              },
                              {
                                alignment: 'left',
                                italics: true,
                                text: 'Panaderia Carlos Espinoza',
                                fontSize: 18,
                                margin: [15,10]
                              },
                      
                              {
                                alignment: 'center',
                                fontSize: 14,
                                text: 'Reporte',
                                margin: [0,70,60,0]
                              },
                              {
                                alignment: 'right',
                                fontSize: 14,
                                text: 'RIF J-146876954',
                                margin: [0,18]
                              },
                            ],
                            margin: 20
                          }
                        });
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) { return .5; };
                        objLayout['vLineWidth'] = function(i) { return .5; };
                        objLayout['hLineColor'] = function(i) { return '#aaa'; };
                        objLayout['vLineColor'] = function(i) { return '#aaa'; };
                        objLayout['paddingLeft'] = function(i) { return 4; };
                        objLayout['paddingRight'] = function(i) { return 4; };
                        doc.content[0].layout = objLayout;
                }/////////////////END OF CUSTOM PDF//////////////////////////
                    },
                ],
            },
        ]
    } );
} );

</script>


<script>

var nombre_reporte;

function reporte(){ 
  
    if(document.getElementById("reporte").value=="Producto Mas Comprado"){


      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?mas=";
      }
      else{
        window.location.href="reportes.php?mas=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    } 

       if (document.getElementById("reporte").value=="Entradas y Salidas por Productos"){

          
          if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

            window.location.href="reportes.php?inv1=";  

            }

            else{

            window.location.href="reportes.php?inv1=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       

            }

    }
    
    if (document.getElementById("reporte").value=="Historial de Sesion"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?hist=";
      }
      else{
        
        window.location.href="reportes.php?hist=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      
      }
        
    }
    
    if(document.getElementById("reporte").value=="Entrada De Insumos"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?masentradas=";
      }
      else{
        window.location.href="reportes.php?masentradas=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }


    if(document.getElementById("reporte").value=="Insumos Utilizados"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?massalidas=";
      }
      else{
        window.location.href="reportes.php?massalidas=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }


   if(document.getElementById("reporte").value=="Sin Existencia"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?nulo=";
      }
      else{
        window.location.href="reportes.php?nulo=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }

       if(document.getElementById("reporte").value=="Poca Existencia"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?pocaExistencia=";
      }
      else{
        window.location.href="reportes.php?pocaExistencia=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }

      if(document.getElementById("reporte").value=="Mejores Clientes"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?mejoresClientes=";
      }
      else{
        window.location.href="reportes.php?mejoresClientes=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }


          if(document.getElementById("reporte").value=="Usuarios Por Mes"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?usuariosPorMes=";
      }
      else{
        window.location.href="reportes.php?usuariosPorMes=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }
    
    
      if(document.getElementById("reporte").value=="Salidas de Producto Por Dia"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?productosPorDia=";
      }
      else{
        window.location.href="reportes.php?productosPorDia=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }

       if(document.getElementById("reporte").value=="Ganancias Totales"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?gananciasTotales=";
      }
      else{
        window.location.href="reportes.php?gananciasTotales=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }

       if(document.getElementById("reporte").value=="Ganancias Totales Por Dia"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?gananciasTotalesPorDia=";
      }
      else{
        window.location.href="reportes.php?gananciasTotalesPorDia=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }

      if(document.getElementById("reporte").value=="Ganancias Totales Por Mes"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?gananciasTotalesPorMes=";
      }
      else{
        window.location.href="reportes.php?gananciasTotalesPorMes=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }



    

       if(document.getElementById("reporte").value=="Gasto en Entrada"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?GastoEntrada=";
      }
      else{
        window.location.href="reportes.php?GastoEntrada=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }


       if(document.getElementById("reporte").value=="Gasto en Entrada Por Dia"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?GastoEntradaPorDia=";
      }
      else{
        window.location.href="reportes.php?GastoEntradaPorDia=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }

      if(document.getElementById("reporte").value=="Ganancias Netas"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?GananciaNeta=";
      }
      else{
        window.location.href="reportes.php?GananciaNeta=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }

      if(document.getElementById("reporte").value=="Ganancias Netas Por Dia"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?gananciaNetaPorDia=";
      }
      else{
        window.location.href="reportes.php?gananciaNetaPorDia=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }

    if(document.getElementById("reporte").value=="Ganancias Netas Por Mes"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?gananciaNetaPorMes=";
      }
      else{
        window.location.href="reportes.php?gananciaNetaPorMes=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }

   if(document.getElementById("reporte").value=="Devueltos por Entrada"){

      if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

        window.location.href="reportes.php?devueltoE=";
      }
      else{
        window.location.href="reportes.php?devueltoE=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
      }
    }

        
   if(document.getElementById("reporte").value=="Devueltos por Salida"){

if (document.getElementById("desde").value.length==0 && document.getElementById("hasta").value.length==0){

  window.location.href="reportes.php?devueltoS=";
}
else{
  window.location.href="reportes.php?devueltoS=&desde="+document.getElementById("desde").value+"&hasta="+document.getElementById("hasta").value;       
}
}

    if(document.getElementById("reporte").value=="Inventario Generalizado"){

      window.location.href="reportes.php?inventario=";
  
    }

    if(document.getElementById("reporte").value=="Productos Desabilitados"){

    window.location.href="reportes.php?productosdes=";

  }

}  

if(window.location.search=="?nulo="){
  nombre_reporte = "Sin existencia";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}


if(window.location.search=="?inventario="){
  nombre_reporte1 = "Inventario General";
  document.getElementById('subtitulo').innerHTML = nombre_reporte1;
}

if(window.location.search=="?mas="){
  nombre_reporte = "Mas movidos";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

if(window.location.search=="?hist="){
  nombre_reporte = "Historial de Sesión";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

if(window.location.search=="?masentradas="){
  nombre_reporte = "Entradas por Producto";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

if(window.location.search=="?massalidas="){
  nombre_reporte = "Salidas por Producto";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

if(window.location.search=="?inv1="){
  nombre_reporte = "Entradas y Salidas por Producto";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

if(window.location.search=="?pocaExistencia="){
  nombre_reporte = "Poca Existencia";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

if(window.location.search=="?productosdes="){
  nombre_reporte = "Productos Desabilitados";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

if(window.location.search=="?gananciasTotales="){
  nombre_reporte = "Ganancias Totales";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

if(window.location.search=="?gananciasTotalesPorDia="){
  nombre_reporte = "Ganancias Totales Por Dia";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}


if(window.location.search=="?GastoEntrada="){
  nombre_reporte = "Gasto en Entradas";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

if(window.location.search=="?GastoEntradaPorDia="){
  nombre_reporte = "Gasto en Entradas Por Dia";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}


if(window.location.search=="?GananciaNeta="){
  nombre_reporte = "Ganancias Netas";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

if(window.location.search=="?gananciaNetaPorDia="){
  nombre_reporte = "Ganancias Netas Por Dia";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

if(window.location.search=="?mejoresClientes="){
  nombre_reporte = "Mejores Clientes";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

if(window.location.search=="?productosPorDia="){
  nombre_reporte = "Salida de Producto por dia";
  document.getElementById('subtitulo').innerHTML = nombre_reporte;
}

</script>
<script> 

function borrar(id) {
Swal.fire({
title: 'Estas seguro que desea rehabilitar',
text: "Seguro que quieres Rehabilitar a este producto?",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: "Cancelar",
confirmButtonText: 'Si!'
}).then((result) => {
if (result.isConfirmed) {
  Swal.fire(
    'Rehabilitado!',
    'El producto ha sido rehabilitado..',
    'success'
  ).then(function(){ 
    window.location.href="reportes.php?user=&rehabilitar_inv=0&id="+ id;
 }
  );
}
})
}
</script>
</body>
</html>
