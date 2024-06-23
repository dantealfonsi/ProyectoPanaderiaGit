<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
?>

<!DOCTYPE html>
<html lang="en-MU">
<head>
    <meta charset="utf-8">
    <title>Panaderia | Productos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--========== PHP CONNECTION TO DATABASE ==========-->
    <?php 
    include_once '../../Modelo/conexion.php';
    include_once '../CarritoComponent/numElementosEnCarrito.php';
    ?>

    <!--========== CSS FILE ==========-->
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Sanjana.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Account.css">
    <link rel='stylesheet' type='text/css' href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/icons.css' />

    <!--========== BOOTSTRAP ==========-->
    <link href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
 
    <!-- Animate CSS -->

    <link rel="stylesheet"href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>    

     <!--========== BOXICONS ==========-->
     <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>

</head>

<!--___________________________________________________________________________-->

<body>

    <!--========== PHP QUERIES ==========-->
    <?php 
        
        // $Q_fetch_featured = "SELECT * FROM productos WHERE IDtipo = 2 ; ";//selecciona productos destacados
        // $Q_fetch_new =  "SELECT * FROM productos WHERE IDtipo = 1 ; ";//selecciona nuevos productos
        // $Q_fetch_categories = "SELECT * FROM categoria_producto"; //selecciona todas las categorías

          
        $Q_obtener_destacados = "SELECT * FROM productos INNER JOIN tipos ON productos.idtipo = tipos.idtipo WHERE tipos.nombre_tipo = 'destacado' AND productos.habilitado=1;"; //selecciona un producto ya establecido
        $Q_obtener_nuevos = "SELECT * FROM productos INNER JOIN tipos ON productos.idtipo = tipos.idtipo WHERE tipos.nombre_tipo = 'nuevo' AND productos.habilitado=1;"; //selecciona un producto nuevo
        $Q_obtener_categorias = "SELECT * FROM categorias"; //selecciona todas las categorías
    
    
    ?>


<!--========== ENCABEZADO ==========-->    

    <?php $page = 'productos'?>
          <!--Iniciar Barra de Navegación-->
          <?php include '../Includes/BarraNavegacionMovil.php';?>
        <!--FIN Barra de Navegación-->


        <!--Iniciar Barra de Navegación @media 1200px-->
        <?php include '../Includes/BarraNavegacionPC.php';?>
        <!--FIN Barra de Navegación @media 1200px-->


    <!--Imagen en forma de onda-->
    <!-- <div class="wave-image-group hide-wave">
        <div class="wave-image footer-wave">
            <img src="Assets/images/1.index/NavBar_WavePink.png">
        </div>
    </div> -->
    <!--Fin de Imagen en forma de onda-->
    <!--___________________________________________________________________________-->

    
    
    <main class="1-main">

        <!--========== Oferta Numero 1 ==========-->

        <!-- <section class="offer section offer__top mt-2">
            <div class="offer__bg2 offer__1bg">
                <div class="offer__data ">
                    <h2 class="offer__title">50% de descuento en PAN</h2>
                    <p class="offer__description">NO SE HASTA CUANDO DURE<br />MALDITOS SEAN TODOS!!!</p>

                    <a href="products.php" class="button button__round">Compre AHORA</a>
                </div>
            </div>
        </section> -->

        <!-- <div class="">
            <div class="">
                <img src="Assets/images/1.index/NavBar_WavePinkFlip.png">
            </div>
        </div> -->
        <!--Aqui se Acaba la imagen en forma de onda-->

<!--========== INTENTO DE CONSULTAR PRODUCTOS DESTACADOS ==========-->

<section class="featured section" id="featured">
   
    <!--========== BANNER DE TÍTULO ==========-->
    <?php 
        //OBTENER PRODUCTO POR CATEGORÍA
        $resultado_cat = mysqli_query($conn, $Q_obtener_categorias);

    ?>
    <div class="row category-title">
        <div class="col">
            <h2 class="category" id="small_title"></h2>
            <h2 class="category-name " id="big_title"></h2>
        </div>

        <!--========== BOTÓN DE ORDENAR POR ==========-->
        <div>
        <div class="dropdown col-auto">
            <button class="dropbtn button" id="cat-but">Ordenar por &nbsp<i class='bx--bxs-down-arrow'></i></button>
            <div class="dropdown-content">
                <a href="#" onclick="ordenar_productos(1)">precio bajo a alto</a>
                <a href="#" onclick="ordenar_productos(2)">precio alto a bajo</a>
            </div>
        </div>

        <!--========== BOTÓN DE CATEGORÍAS ==========-->
        <div class="dropdown col-auto">
            <button class="dropbtn button" id="cat-but">Categorías &nbsp<i class='bx--bxs-down-arrow'></i></button>
            <div class="dropdown-content">
                <?php
                while($row_categorias = mysqli_fetch_assoc($resultado_cat)){
                    $IDcategoria = $row_categorias['idcategoria'];
                    $nombreCategoria = $row_categorias['nombre_categoria'];
                    ?>
                    <a href="#" onclick="mostrar_productos_por_id_cat(<?php echo $IDcategoria; ?>, '<?php echo $nombreCategoria; ?>'); " ><?php echo $nombreCategoria; ?></a>
                    <!-- <input type="submit" onclick="mostrar_productos_por_id_cat(<?php echo $IDcategoria; ?>)" value="<?php echo $row_categorias['nombre_categoria']; ?>"> -->
                    
                    <?php 
                }
                
                ?>
            </div>
        </div>
    </div>
</div>
    <div id="result" class="featured__container bd-grid mt-4">
        <!-- PRODUCTOS POR CATEGORÍA  -->
        <!-- PRODUCTOS ORDENADOS  -->
        
    </div>


</section>


<!--========== OFERTA 2 

<section class="offer section">
    <div class="offer__bg">
        <div class="offer__data">
            <h2 class="offer__title">Oferta Especial</h2>
            <p class="offer__description">¡Ventas extremas de Navidad solo este mes!</p>

            <a href="#" class="button button__round">COMPRAR AHORA</a>
        </div>
    </div>
</section>

==========-->

<!--========== INTENTO DE CONSULTAR NUEVOS PRODUCTOS ==========-->
<!--==========<section class="new section" id="new">
<div class="row category-title">
        <div class="col">
            <h2 class="category" id="small_title2"></h2>
            <h2 class="category-name " id="big_title2"></h2>
        </div>
</div>

    <div class="new__container bd-grid" id="result2">
       
    </div>
</section>==========-->

<!--Inicio de Footer -->
<?php include '../Includes/Footer.php';?>
<!--Final del Footer-->


        <!-- Inicio del nav de abajo -->
        <?php include '../Includes/NavDeAbajo.php';?>
        <!-- Final del nav de abajo -->

    <!--___________________________________________________________________________-->



<!--========== JAVASCRIPT ==========-->
  
<!-- IMPLEMENTANDO AJAX CON JAVASCRIPT -->
<script>

    //FUNCIÓN DE CATEGORÍAS - MUESTRA SIN CARGA
    function mostrar_productos_por_id_cat(id_cat, nombre_cat){
        
        var xhttp;
       
        //AJAX
        console.log('entro ajax');
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log('listo');
                document.getElementById("result").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "buscar_categoria.php?id_cat="+id_cat, true);
        xhttp.send();   
        console.log('enviado');

        //CAMBIA EL TÍTULO
        document.getElementById('small_title').innerHTML = 'CATEGORÍA';
        document.getElementById('big_title').innerHTML = nombre_cat;
        
    }

    //FUNCIÓN DE ORDENAR POR - MUESTRA SIN CARGA DONDE ID = RESULTADO
    function ordenar_productos(num_orden){
        var xhttp;
          //AJAX
        console.log('entró ajax ordenar');
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log('listo ordenar');
                document.getElementById("result").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "sortear_busqueda.php?sortby="+num_orden, true);
        xhttp.send();   
        console.log('enviado ordenar');

        //CAMBIA EL TÍTULO
        document.getElementById('small_title').innerHTML = 'ORDENAR POR PRECIO';

        if(num_orden == 1){
            document.getElementById('big_title').innerHTML = 'bajo a alto';
        }
        else if(num_orden ==2){
            document.getElementById('big_title').innerHTML = 'alto a bajo';
        }
        
    }


    //FUNCIÓN DE TIPO DE PRODUCTOS - MUESTRA SIN CARGA
    function mostrar_productos_por_tipo(tipo_p){
        var xhttp;
       
        //AJAX
        console.log('entró ajax');
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log('listo');
                document.getElementById("result").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "productos_por_tipo_busqueda.php?tipo_p="+tipo_p, true);
        xhttp.send();   
        console.log('enviado');

        //CAMBIA EL TÍTULO

        if(tipo_p==1){
            document.getElementById('small_title').innerHTML = 'nuevo';
        }
        else  if(tipo_p==2){
            document.getElementById('small_title').innerHTML = 'Destacados';
        }
        else  if(tipo_p==3){
            document.getElementById('small_title').innerHTML = 'ventas';
        }
        else  if(tipo_p==4){
            document.getElementById('small_title').innerHTML = 'más vendido';
        }

        //TÍTULO GRANDE
        document.getElementById('big_title').innerHTML = '¡Compra tu torta ya!';
        
    }

    
        //FUNCIONES DE LOS TIPOS DE PRODUCTOS
        function mostrar_productos_por_tipo_segundo(tipo_p){
        var xhttp;
                    
        //AJAX
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log('listo');
                document.getElementById("result2").innerHTML = this.responseText;
            }
        };
        
        xhttp.open("GET", "productos_por_tipo_busqueda.php?tipo_p="+tipo_p, true);
        xhttp.send();   
        console.log('enviado');

        //CAMBIA EL TÍTULO

        if(tipo_p==1){
            document.getElementById('small_title2').innerHTML = 'nuevo';
        }
        else  if(tipo_p==2){
            document.getElementById('small_title2').innerHTML = 'Destacados';
        }
        else  if(tipo_p==3){
            document.getElementById('small_title2').innerHTML = 'ventas';
        }
        else  if(tipo_p==4){
            document.getElementById('small_title2').innerHTML = 'más vendido';
        }

        //TÍTULO GRANDE
        document.getElementById('big_title2').innerHTML = '¡Compra tu torta ya!';
        
    }


    //LANZANDO FUNCIÓN DE PRODUCTOS DESTACADOS
    mostrar_productos_por_tipo(2); // 2 --> destacado

    //LANZANDO FUNCIÓN DE NUEVOS PRODUCTOS
   // mostrar_productos_por_tipo_segundo(2); // 1 --> nuevo
    </script>






</body>
</html>