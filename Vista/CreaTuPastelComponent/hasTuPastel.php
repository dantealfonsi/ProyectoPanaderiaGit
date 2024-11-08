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

<style>

.progress-container {
    width: 100%;
    background-color: #f1f1f1;
    overflow: hidden; /* Para evitar que los elementos floten fuera del contenedor */
}

.progress-bar {
    float: left; /* La barra de progreso flota a la izquierda */
    height: 20px;
    background-color: orange;
    width: 0;
}

#searchButton {
    float: right; /* El botón de búsqueda flota a la derecha */
    margin-left: 10px;
}

.disabled-div {
    background-color: #f1f1f1;
    opacity: 0.6;
    display: none !important; /* Oculta el contenido */
    /* Otros estilos según tus preferencias */
}

.disabled-conten-div {
    background-color: #f1f1f1;
    opacity: 0.6;
    /* Otros estilos según tus preferencias */
}
button:disabled{
    background:red !important;
}


#filtrosLista li{
    background: #ff7380;
    text-decoration: none;
    color: white;
    font-weight: 600;
    padding: .8rem;
    border: 1px solid black;
}
</style>

<body>

    <!--========== PHP QUERIES ==========-->
    <?php 
        
          
        $Q_obtener_destacados = "SELECT * FROM productos INNER JOIN tipos ON productos.idtipo = tipos.idtipo WHERE tipos.nombre_tipo = 'destacado' AND productos.habilitado=1;"; //selecciona un producto ya establecido
        $Q_obtener_nuevos = "SELECT * FROM productos INNER JOIN tipos ON productos.idtipo = tipos.idtipo WHERE tipos.nombre_tipo = 'nuevo' AND productos.habilitado=1;"; //selecciona un producto nuevo
        $Q_obtener_categorias = "SELECT * FROM categorias"; //selecciona todas las categorías
    
    
    ?>

<!--========== ENCABEZADO ==========-->    

    <?php $page = 'productos'?>

        <?php include '../Includes/BarraNavegacionMovil.php';?>
        <?php include '../Includes/BarraNavegacionPC.php';?>
    
    <main class="1-main">

<!--========== INTENTO DE CONSULTAR PRODUCTOS DESTACADOS ==========-->

<section class="featured section" id="featured">
   
    <!--========== BANNER DE TÍTULO ==========-->
    <?php 
        //OBTENER PRODUCTO POR CATEGORÍA
        $resultado_cat = mysqli_query($conn, $Q_obtener_categorias);

    ?>
    <div class="row category-title" style='display: flex;
    flex-direction: column;
    align-content: space-between;
    align-items: flex-start;
    gap: 1rem;'>
        <div class="col">
            <h2 class="category" id="small_title"></h2>
            <h2 class="category-name " id="big_title"></h2>
        </div>

        <!--========== BOTÓN DE ORDENAR POR ==========-->
        <div style='display: flex;align-items: center;justify-content: center;flex-wrap: wrap;gap:.4rem;'>

        <div id="conten-peso" class="dropdown col-auto ">
            <button class="dropbtn button" id="cat-but" >Peso &nbsp<i class='bx--bxs-down-arrow'></i></button>
            <div class="dropdown-content" id="divpeso" >
                <a href="#" onclick="stringPeso('1')">1 kilo</a>
                <a href="#" onclick="stringPeso('2')">2 kilos</a>
                <a href="#" onclick="stringPeso('3')">3 kilos</a>
            </div>
        </div>       

        <span style='color:black;font-size:4rem;'>➪</span>

        <div id="conten-pisos" class="dropdown col-auto disabled-conten-div">
            <button class="dropbtn button" id="cat-but">Pisos &nbsp<i class='bx--bxs-down-arrow'></i></button>
            <div class="dropdown-content disabled-div" id="divpisos">
                <a href="#" onclick="stringPisos('1')">1 Piso</a>
                <a href="#" onclick="stringPisos('2')">2 Pisos</a>
                <a href="#" onclick="stringPisos('3')">3 Pisos</a>
            </div>
        </div>       

        <span style='color:black;font-size:4rem;'>➪</span>


        <div id="conten-modelo" class="dropdown col-auto disabled-conten-div">
            <button class="dropbtn button" id="cat-but">Modelo &nbsp<i class='bx--bxs-down-arrow'></i></button>
            <div class="dropdown-content disabled-div" id="divmodelo">
                <a href="#" onclick="stringModelo('redonda')">Redonda</a>
                <a href="#" onclick="stringModelo('cuadrada')">Cuadrada</a>
            </div>
        </div>

        <span style='color:black;font-size:4rem;'>➪</span>


        <div id="conten-bizcocho" class="dropdown col-auto disabled-conten-div">
            <button class="dropbtn button" id="cat-but">Es Bizcocho &nbsp<i class='bx--bxs-down-arrow'></i></button>
            <div class="dropdown-content disabled-div" id="divbizcocho">
                <a href="#" onclick="stringBizcocho('1')">Si</a>
                <a href="#" onclick="stringBizcocho('0')">No</a>
            </div>
        </div>

        <span style='color:black;font-size:4rem;'>➪</span>

        <div id="conten-relleno" class="dropdown col-auto disabled-conten-div">
            <button class="dropbtn button" id="cat-but">Relleno &nbsp<i class='bx--bxs-down-arrow'></i></button>
            <div class="dropdown-content disabled-div" id="divrelleno">
                <a href="#" onclick="stringRelleno('vainilla')">Vainilla</a>
                <a href="#" onclick="stringRelleno('chocolate')">Chocolate</a>
                <a href="#" onclick="stringRelleno('fresa')">Fresa</a>
            </div>
        </div>

        <span style='color:black;font-size:4rem;'>➪</span>


        <div id="conten-cubierta" class="dropdown col-auto disabled-conten-div">
            <button class="dropbtn button" id="cat-but">Cubierta &nbsp<i class='bx--bxs-down-arrow'></i></button>
            <div class="dropdown-content disabled-div" id="divcubierta">
                <a href="#" onclick="stringCubierta('blanco')">Blanco</a>
                <a href="#" onclick="stringCubierta('chocolate')">Chocolate</a>
                <a href="#" onclick="stringCubierta('azul')">Azul</a>
                <a href="#" onclick="stringCubierta('rosado')">Rosada</a>
            </div>
        </div>       
        
        <span style='color:black;font-size:4rem;'>➪</span>


        <div id="conten-persona" class="dropdown col-auto disabled-conten-div">
            <button class="dropbtn button" id="cat-but">Para Quien es &nbsp<i class='bx--bxs-down-arrow'></i></button>
            <div class="dropdown-content disabled-div" id="divpersona">
                <a href="#" onclick="stringPersona('niña')">Una Niña</a>
                <a href="#" onclick="stringPersona('niño')">Un Niño</a>
                <a href="#" onclick="stringPersona('hombre')">Hombre</a>
                <a href="#" onclick="stringPersona('mujer')">Mujer</a>
            </div>
        </div> 
        </div> 
        <div class="progress-container" style="width:50%;position:relative;left: 25%;background:url('../../Assets/images/charge.png');">
            <div class="progress-bar" id="myProgressBar"></div>
            <span style='color:white;position: absolute;left: 45%;'>Progreso</span>
            <!--<button id="searchButton" disabled>Buscar</button>-->
        </div>   
    </div>
</div>
<div id="filtrosAplicados" style="padding-left: 10rem; padding-right: 10rem; display: flex; align-items: center; flex-direction: column;">
    <ul id="filtrosLista" style="columns: 2; -webkit-columns: 2; -moz-columns: 2;">
      <!-- Las etiquetas se insertarán aquí -->
    </ul>
  </div>
    <div>
        
    </div>


    <div id="result" class="featured__container bd-grid mt-4">

</section>

<!--Inicio de Footer -->
<?php include '../Includes/Footer.php';?>
<!--Final del Footer-->

<!-- Inicio del nav de abajo -->
<?php include '../Includes/NavDeAbajo.php';?>
<!-- Final del nav de abajo -->

<!--========== JAVASCRIPT ==========-->
  
<!-- IMPLEMENTANDO AJAX CON JAVASCRIPT -->
<script>
let peso = "";
let pisos = "";
let modelo="";
let bizcocho="";
let relleno="";
let cubierta="";
let persona="";
let filtros = [];

document.getElementById('small_title').innerHTML = 'Personalizable';
document.getElementById('big_title').innerHTML = '¡Busca tu torta a tu Gusto ya!';

function stringPeso(valor){
    peso = valor;
    updateProgressBar(10);
    document.getElementById('divpeso').classList.add('disabled-div');
    document.getElementById('divpisos').classList.remove('disabled-div');

    document.getElementById('conten-pisos').classList.remove('disabled-conten-div');
    agregarFiltro('Peso: '+valor+' kg');
}

function stringPisos(valor){
    pisos = valor;
    updateProgressBar(20);
    document.getElementById('divpisos').classList.add('disabled-div');
    document.getElementById('divmodelo').classList.remove('disabled-div');    

    document.getElementById('conten-modelo').classList.remove('disabled-conten-div');
    agregarFiltro('Piso(s): '+valor+'');
}

function stringModelo(valor){
    modelo = valor;
    updateProgressBar(30);
    document.getElementById('divmodelo').classList.add('disabled-div');
    document.getElementById('divbizcocho').classList.remove('disabled-div');

    document.getElementById('conten-bizcocho').classList.remove('disabled-conten-div');
    agregarFiltro('Modelo: '+valor+'');
}

function stringBizcocho(valor){
    bizcocho = valor;
    updateProgressBar(50);
    document.getElementById('divbizcocho').classList.add('disabled-div');
    document.getElementById('divrelleno').classList.remove('disabled-div');    

    document.getElementById('conten-relleno').classList.remove('disabled-conten-div');
    if(valor*1===1){
        agregarFiltro('Bizcocho');    
    }else {
        agregarFiltro('');    
    }    
}

function stringRelleno(valor){
    relleno = valor;
    updateProgressBar(60);
    document.getElementById('divrelleno').classList.add('disabled-div');
    document.getElementById('divcubierta').classList.remove('disabled-div');

    document.getElementById('conten-cubierta').classList.remove('disabled-conten-div');
    agregarFiltro('Relleno de: '+valor+'');
}

function stringCubierta(valor){
    cubierta = valor;
    updateProgressBar(80);
    document.getElementById('divcubierta').classList.add('disabled-div');
    document.getElementById('divpersona').classList.remove('disabled-div');

    document.getElementById('conten-persona').classList.remove('disabled-conten-div');
    agregarFiltro('Cubierta Color: '+valor+'');
}

function stringPersona(valor){
    persona = valor;
    updateProgressBar(100);
    document.getElementById('divpersona').classList.add('disabled-div');
    agregarFiltro('Para: '+valor+'');
}

    //FUNCIÓN DE TIPO DE PRODUCTOS - MUESTRA SIN CARGA
    function mostrar_productos_por_tipo(tipo_p, consulta) {
    var xhttp;

    // AJAX
    console.log('entró ajax');
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                console.log('listo');
                document.getElementById("result").innerHTML = this.responseText;
            } else {
                console.log('Error en la solicitud');
                document.getElementById("result").innerHTML = "No se encontraron datos.";
            }
        }
    };
    xhttp.open("GET", "buscar_productos.php?tipo_p=" + tipo_p + "&consulta=" + consulta, true);
    xhttp.send();
    console.log('enviado');

    // CAMBIA EL TÍTULO
    if (tipo_p == 2) {
        document.getElementById('small_title').innerHTML = 'Personalizable';
    }

    // TÍTULO GRANDE
    document.getElementById('big_title').innerHTML = '¡Busca tu torta a tu Gusto ya!';
}
  
 function buscarDatos() {
    // Valida que al menos un campo esté lleno
    if (!peso && !pisos && !modelo && !bizcocho && !relleno && !cubierta && !persona) {
        alert('Debes seleccionar los filtros completos.');
        return;
    }

    // Construye la consulta MySQL
    let consulta = 'SELECT * FROM productos WHERE habilitado=1 and existencia >0 '; // 1=1 para facilitar la concatenación

    if (peso) {
        consulta += ` AND peso = ${peso}`;
    }
    if (pisos) {
        consulta += ` AND pisos = ${pisos}`;
    }
    if (modelo) {
        consulta += ` AND modelos = '${modelo}'`;
    }
    if (bizcocho) {
        consulta += ` AND bizcocho = ${bizcocho}`;
    }    
    if (relleno) {
        consulta += ` AND relleno = '${relleno}'`;
    }
    if (cubierta) {
        consulta += ` AND cubierta = '${cubierta}'`;
    }    
    if (persona) {
        consulta += ` AND persona = '${persona}'`;
    }    
    mostrar_productos_por_tipo(2, consulta)

    // Ejemplo de cómo mostrar la consulta (para depuración)
    console.log('Consulta generada:', consulta);
}

function updateProgressBar(progress) {
    const progressBar = document.getElementById('myProgressBar');
    progressBar.style.width = `${progress}%`;

    if (progress === 100) {
        buscarDatos(); // Llama a la función de búsqueda
        reset();
    }
    // Habilita o deshabilita el botón de búsqueda según el progreso
    /*const searchButton = document.getElementById('searchButton');
    searchButton.disabled = progress < 100;*/
}



function agregarFiltro(filtro) {
    filtros.push(filtro);
    actualizarEtiqueta();
}

function actualizarEtiqueta() {
    const lista = document.getElementById('filtrosLista');
    lista.innerHTML = ''; // Limpiar el contenido previo

    const tituloItem = document.createElement('li');
    tituloItem.textContent = 'Torta';
    lista.appendChild(tituloItem);

    filtros.forEach(filtro => {
        const li = document.createElement('li');
        li.textContent = filtro;
        lista.appendChild(li);
    });

    // Aplicar estilo de columnas si hay más de cuatro elementos
    if (filtros.length > 4) {
        lista.style.columns = '2';
    } else {
        lista.style.columns = '1';
    }
}


function reset(){
    peso = "";
    pisos = "";
    modelo="";
    bizcocho="";
    relleno="";
    cubierta="";
    persona="";
    filtros = ''; 
    updateProgressBar(0);
    document.getElementById('divpeso').classList.remove('disabled-div');
    document.getElementById('conten-pisos').classList.add('disabled-conten-div');
    document.getElementById('conten-modelo').classList.add('disabled-conten-div');
    document.getElementById('conten-bizcocho').classList.add('disabled-conten-div');
    document.getElementById('conten-relleno').classList.add('disabled-conten-div');
    document.getElementById('conten-cubierta').classList.add('disabled-conten-div');
    document.getElementById('conten-persona').classList.add('disabled-conten-div');
}
    </script>
</body>
</html>

