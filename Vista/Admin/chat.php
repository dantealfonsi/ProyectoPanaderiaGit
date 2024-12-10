<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
        
    //Conexion a la base de datos 
    include "../../Modelo/conexion.php"; 
?>

<!DOCTYPE html>
<html lang="es" >
<head>
  <meta charset="UTF-8">
  <title>Asistencia</title>
  <!--<link rel="stylesheet" href="./style2.css">-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">    
    <meta charset="utf-8">
        <title>Panaderia | Chat</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Account.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/icons.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css">
        <script src="../Javascript/SweetAlert/sweetalert2.all.min.js"></script>
  <script>
  function inicio(){
    readTicket();
  	myVar = setInterval(myTimer, 2000);
  } 

  function readTicket(){
    let id = document.getElementById('ticked').value;
    $.get("../../Modelo/server.php?tiketPedido=&idpedido="+id,
                    function(data){                        
                        var datos= JSON.parse(data);
                        $("#usuario").html(datos.usuario);
                        document.getElementById('recibe').value=datos.IDusuario;
                        $("#fecha").html(datos.fechaEntrega);
                        $("#metodoPago").html(datos.metodoPago);
                        $("#totalPagar").html(Math.round(datos.resta * 100) / 100);
                        document.getElementById('sumaTotal').value=datos.total;
                        $("#estado").html(datos.estado);
                    });
    if(document.getElementById('notif').value != "0"){
      $.get("../../Modelo/server.php?marcarNotif=&idnotif="+document.getElementById('notif').value,
      function(data){});      
    }
  }

  function myTimer() {
  	try {
  			$.post("<?php echo $GLOBALS['ROOT_PATH'] ?>/Modelo/serverChat.php",{
  				verChatApp: document.getElementById('ticked').value,
          IDusuario: document.getElementById('envia').value
  			},function(data) {
  				$("#chat").html(data);
          $('#chat').scrollTop($('#chat').prop('scrollHeight'));
  			});
  	}catch (err) {

  	}
  }

  function chat(){
  	  $.post("<?php echo $GLOBALS['ROOT_PATH'] ?>/Modelo/serverChat.php",
  	  {
  	    insertchat: "Donald",
  	    tickedchat: document.getElementById('ticked').value,
  	    envia: document.getElementById('envia').value,
        recibe: document.getElementById('recibe').value,
        pedido: document.getElementById('ticked').value,
  	    mensaje: document.getElementById('mensaje').value
  	  },
  	  function(data){
  		  document.getElementById("mensaje").value="";
  		  document.getElementById("mensaje").focus();
  	  });
  }

  function myFunction(event){
  	var x = event.key;
  	if (x == "Enter" || x == "Intro"){
  		chat();}
  }

  function cambiarEstado() {
    let estado = document.getElementById("cambioEstado").value;
    let abono = '0';
    if(estado === "ABONADO"){
      Swal.fire({
                    title: 'Abono a Pedido',
                    input: 'number',
                    inputLabel: 'Cantidad Abonada:  ',
                    inputPlaceholder: '',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                      abono = String(result.value);
                      $.post("<?php echo $GLOBALS['ROOT_PATH'] ?>/Modelo/serverChat.php",
                      {
                        cambiarEstado: "Donald",
                        estado : document.getElementById("cambioEstado").value,      
                        tickedchat: document.getElementById('ticked').value,
                        abono: abono,
                        recibe: document.getElementById('recibe').value,
                        sumatotal: document.getElementById("sumaTotal").value
                      },
                      function(data){
                        $("#estado").html(data);
                        readTicket();
                        verDetalles(<?php echo $_GET['idpedido']; ?>);		  
                      });                          
                    }
                });
    }
    else{
      Swal.fire({
        title: 'Cambiar Estado del Pedido',
        text: "¿Estás seguro? Cambiaras el estado del pedido.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Cambiar',
        cancelButtonText: 'No, mantener'
    }).then((result) => {
        if (result.isConfirmed) {
          $.post("<?php echo $GLOBALS['ROOT_PATH'] ?>/Modelo/serverChat.php",
          {
            cambiarEstado: "Donald",
            estado : document.getElementById("cambioEstado").value,      
            tickedchat: document.getElementById('ticked').value,
            abono: abono,
            recibe: document.getElementById('recibe').value,
            sumatotal: document.getElementById("sumaTotal").value
          },
          function(data){
            $("#estado").html(data);
            readTicket();
            verDetalles(<?php echo $_GET['idpedido']; ?>);
          });        
        }
      });
    }
  }

  function verDetalles(id) {
            // Aquí iría el código para cargar los datos del pedido en el diálogo de edición
            $.get("<?php echo $GLOBALS['ROOT_PATH'] ?>/Modelo/server.php?tiketPedido=&idpedido="+id,
                    function(data){                        
                        var datos= JSON.parse(data);
                        $("#tiket").html(datos.tiket);
                        //document.getElementById('numPedido').value=datos.numPedido;
                    });

            //var dialogo = document.getElementById('dialogoEditar');
            //dialogo.showModal();
            // ...
    }
    

  verDetalles(<?php echo $_GET['idpedido']; ?>);

  </script>
  <style>

html,body{
  margin-top:1rem;
}

.progress-container {
    width: 100%;
    background-color: #f1f1f1;
    display: flex;
    justify-content: space-between;
    align-items: center;

    border-top: 8px solid black;
    border-bottom: 8px solid black;
    border-right: 8px solid black;
  }

  .progress-bar {
    width: 0;
    height: 30px;
    background-color: #4caf50;
    line-height: 30px;
    color: white;
  }

  .progress-label {
    flex: 1;
    text-align: center;
    font-weight: bold;
    color: white;
    font-size:13px;
  }

  /*
  #label1 { background-color: #4caf50; }
  #label2 { background-color: #2196f3; }
  #label3 { background-color: #ff9800; }
  #label4 { background-color: #f44336; }
  */

  #label1 { background-color: #878798; }
  #label2 { background-color: #878798; }
  #label3 { background-color: #878798; }
  #label4 { background-color: #878798; }

  /* width */
  ::-webkit-scrollbar {
    width: 5px;
  }

  /* Track */
  ::-webkit-scrollbar-track {
    background: #1B183E;
  }

  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #1B183E;
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #1B183E;
  }

  .mi-div-con-scroll {
    overflow-x: hidden;
    overflow-y: scroll;
    scroll-behavior: smooth;
    color: black;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    background: linear-gradient(45deg, #f1f1f1, transparent);
    width: 100%;
    height: 25rem; 
}


.chatOuterContainer{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

.chatData{
  border: solid 1px #e1e1e1;
  box-shadow: 0px 2px 5px 0px #c3c3c3;
  padding: .7rem;
  font-size: 1.4rem;
  display: flex;
  justify-content: space-between;
}

.chatContainer{
  border: 1px solid #dddddd;
}

.chatBox{
  border: 1px solid #c9c9c9;
  box-shadow: -2px 6px 11px 4px #f3f3f3;
}

.inputChatContainer{
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
  background: transparent;
  width: 100%;
  height: 70px;
  display: flex;
  align-items: center;
  padding-left: 0.3rem;
  padding-right: 0.3rem;
}

.inputChat{
    font-size: 16px;
    color: #414141;
    display: inline-block;
    border: none;
    padding: 21px;
    background: #efefef;
    padding: 0.2rem;
    border-radius: 2rem;
}

.sendButton{
  display: inline-block;
    cursor: pointer;
    font-weight: 600;
    border-radius: 5px;
    font-size: 26px;
    font-weight: bold;
    color: #fff;
    background: none;
    border: none;
    color: #ff7380;
    display: flex;
}

.sendButton:hover{
  color: #ff4f5f;
}

.chatSec{
  width:40%;
}

.data{
  display: flex;
  gap: 3rem;
  border-bottom: 1px solid #a7a7a7;
}

.dataSec{
  border-right: 1px solid #e7e7e7;
    border-bottom: 1px solid #dddddd;
    border-left: 1px solid #f1f1f1;
    padding: 1rem;
    background: linear-gradient(45deg, whitesmoke, transparent);
}

.pay{
  font-size:2rem;
  color:red;
}

.estadoContainer{
  border-top: 1px solid gray;
    margin-top: 1rem;
    padding-top: 1rem;
}
  </style>
</head>
<body style="padding:15px;" onload="inicio()">

<?php $page = 'Asistencia';
if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin']==0){
?>
<!--Iniciar Barra de Navegación-->
<?php include '../Includes/BarraNavegacionMovil.php';?>
<!--FIN Barra de Navegación-->


<!--Iniciar Barra de Navegación @media 1200px-->
<?php include '../Includes/BarraNavegacionPC.php';?>
<!--FIN Barra de Navegación @media 1200px-->


<?php
}
?>

<?php if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin']=='1'){
        ?>
        <a onClick='goToPedidos()' style='font-size: 3rem;font-weight: bolder;cursor:pointer'>⇦ Ir Atras</a></span>
      <?php
        } else {
          ?>
      <a href='../LoginComponent/historialUsuario.php' style='font-size: 3rem;font-weight: bolder;cursor:pointer'>⇦ Ir Atras</a></span>
      <?php
        }
      ?>  


  <?php
  $notificaciones = "0";

  if(isset($_GET['notif'])) $notificaciones= $_GET['notif'];

  echo "
  <input type='hidden' id='ticked' value='".$_GET['idpedido']."'>
  <input type='hidden' id='envia' value='".$_SESSION['IDusuario']."'>
  <input type='hidden' id='recibe' value=''>
  <input type='hidden' id='sumaTotal' value='0'>
  <input type='hidden' id='notif' value='{$notificaciones}'>";
   ?>
<!-- partial:index.partial.html -->

<div class="progress-container">
    <div class="progress-label" id="label1">ACEPTADO</div>
    <div class="progress-label" id="label2">ABONADO</div>
    <div class="progress-label" id="label3">PAGADO</div>
    <div class="progress-label" id="label4">PRODUCCION</div>
    <div class="progress-bar" id="my-progress"></div>
</div>

<div class='chatOuterContainer'> 
<section class='dataSec'>
<div class='data'>
  <h3 >SOPORTE PANADERIA</h3>
    <div>
      Soporte para el Pedido: <?php echo $_GET['idpedido']; ?>      
      <br>
      Fecha Entrega: <span id=fecha></span><br>
    </div>

</div>

 
<div>
  Productos:<br>
  <div id=tiket></div>
  Total a Pagar: <b><span class='pay' id=totalPagar></span></b> <span style='font-size:2rem;'>Bs</span><br>
  Metodo de Pago: <b><span id=metodoPago></span></b><br>

</div>

<div class='estadoContainer'>
    <p>

      Cambiar Estado: <span id=estado></span>
      <?php 
        if($_SESSION['esAdmin']==1){
          ?>
        <select id="cambioEstado" name="estado" onchange="cambiarEstado()">
          <option value="null">Selecciona una..</option>
          <option value="ACEPTADO">Pedido Aceptado</option>  
          <option value="ABONADO">Pedido Abonado</option>
          <option value="PAGADO">Pedido Pagado</option>
          <option value="PRODUCCION">Pedido en Produccion</option>
          <option value="RECHAZADO">Rechazado</option>
        </select>
          <?php
        }
      ?>
      <br>
    </p>
</div>
</section>

    <section class='chatSec'>
      <div class='chatData'>
        <h3 ><?php if($_SESSION['esAdmin']==1) echo "Cliente: "; else echo "Usuario: ";?> <span id=usuario></span></h3>
        <a title='Ir a Whatsapp' style='cursor:pointer;' href="https://wa.me/584262521746" target="_blank"><img style='width:2rem;' src="<?php echo $GLOBALS['ROOT_PATH'] ?>/Assets/images/1.index/whatsapp.png"></a>
      </div>

      <div class='chatBox'>

        <div class="mi-div-con-scroll" id='chat'></div>

        <div class='inputChatContainer'>
        <input style='width: 100%;' autocomplete='off' id="mensaje" class='inputChat' onkeyup='myFunction(event)'>
        
        <button class='sendButton' onclick="chat()"><i class='bx--send'></i></button>
      </div>
   </section>


    <br><br>
</div>
<br><br>
<?php
if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin']==0){
?>
<?php include '../Includes/Footer.php';?>
<!--Final del Footer-->


        <!-- Inicio del nav de abajo -->
        <?php include '../Includes/NavDeAbajo.php';?>
<?php
}
?>

<script>
const progressBar = document.getElementById("my-progress");

let progressValue = 0; // Cambia este valor según el progreso real

function updateProgressBar(label) {
  switch (label) {
    case "ACEPTADO":
      document.getElementById("label1").innerText =  "ACEPTADO";
      document.getElementById("label1").style.backgroundColor = "green";
      progressValue += 20;
    break;
    case "ABONADO":
      document.getElementById("label1").innerText =  "ACEPTADO";
      document.getElementById("label2").innerText =  "ABONADO";
      document.getElementById("label1").style.backgroundColor = "green";
      document.getElementById("label2").style.backgroundColor = "green";
      progressValue += 40;
    break;
    case "PAGADO":
      document.getElementById("label1").innerText =  "ACEPTADO";
      document.getElementById("label2").innerText =  "ABONADO";
      document.getElementById("label3").innerText =  "PAGADO";
      document.getElementById("label1").style.backgroundColor = "green";
      document.getElementById("label2").style.backgroundColor = "green";
      document.getElementById("label3").style.backgroundColor = "green";
      progressValue += 60;
    break;      
    case "PRODUCCION":
      document.getElementById("label1").innerText =  "ACEPTADO";
      document.getElementById("label2").innerText =  "ABONADO";
      document.getElementById("label3").innerText =  "PAGADO";
      document.getElementById("label4").innerText =  "PRODUCCION";
      document.getElementById("label1").style.backgroundColor = "green";
      document.getElementById("label2").style.backgroundColor = "green";
      document.getElementById("label3").style.backgroundColor = "green";
      document.getElementById("label4").style.backgroundColor = "green";
      progressValue += 80;
    break;     
    case "RECHAZADO":
      document.getElementById("label1").innerText =  " ";
      document.getElementById("label2").innerText =  " ";
      document.getElementById("label3").innerText =  " ";
      document.getElementById("label4").innerText =  "RECHAZADO"; 
      document.getElementById("label1").style.backgroundColor = "red";
      document.getElementById("label2").style.backgroundColor = "red";
      document.getElementById("label3").style.backgroundColor = "red";
      document.getElementById("label4").style.backgroundColor = "red";
      progressValue += 100;
    break;       
  }
  //progressBar.style.width = `${progressValue}%`;
  
  //progressBar.innerText = labels[Math.floor(progressValue / 20)];
}

setInterval(() => {
  let id = document.getElementById('ticked').value;
    $.get("../../Modelo/server.php?tiketPedido=&idpedido="+id,
                    function(data){                        
                        var datos= JSON.parse(data);
                        updateProgressBar(datos.estado);
                    });  
  
}, 3000);



function goToPedidos() { window.location.href = './pedidosAdmin.php'; }
// Ajusta la ruta según sea necesario }
</script>
</body>
</html>
