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
                        $("#fecha").html(datos.fechaPedido);
                        $("#metodoPago").html(datos.metodoPago);
                        $("#totalPagar").html(datos.total);
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
    $.post("<?php echo $GLOBALS['ROOT_PATH'] ?>/Modelo/serverChat.php",
  	  {
  	    cambiarEstado: "Donald",
        estado : document.getElementById("cambioEstado").value,      
  	    tickedchat: document.getElementById('ticked').value
  	  },
  	  function(data){
  		  $("#estado").html(data);  		  
  	  });    
  }

  </script>
  <style>

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

<?php $page = 'Asistencia';?>

  <?php
  $notificaciones = "0";

  if(isset($_GET['notif'])) $notificaciones= $_GET['notif'];

  echo "
  <input type='hidden' id='ticked' value='".$_GET['idpedido']."'>
  <input type='hidden' id='envia' value='".$_SESSION['IDusuario']."'>
  <input type='hidden' id='recibe' value=''>
  <input type='hidden' id='notif' value='{$notificaciones}'>";
   ?>
<!-- partial:index.partial.html -->

<div class='chatOuterContainer'> 
<section class='dataSec'>
<div class='data'>
  <h3 >SOPORTE PANADERIA</h3>
    <div>
      Soporte para el Pedido: <?php echo $_GET['idpedido']; ?>      
      <br>
      Fecha: <span id=fecha></span><br>
    </div>

</div>


<div>
Total a Pagar: <b><span class='pay' id=totalPagar></span></b> <span style='font-size:2rem;'>Bs</span><br>
Metodo de Pago: <b><span id=metodoPago></span></b><br>

</div>

<div class='estadoContainer'>
    <p>

      Envio: <span id=estado></span>
      <?php 
        if($_SESSION['esAdmin']==1){
          ?>
        <select id="cambioEstado" name="estado" onchange="cambiarEstado()">
        <option value="null"></option>
          <option value="EXITOSO">Exitoso</option>
          <option value="EN PROCESO">En Proceso</option>
          <option value="FALLIDO">Fallido</option>
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
</body>
</html>
