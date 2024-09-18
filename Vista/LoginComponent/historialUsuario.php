<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
    
    //Conexion a la base de datos 
    include "../../Modelo/conexion.php"; 

    
?>

<?php
// Suponiendo que ya tienes una conexión a la base de datos establecida y guardada en $conexion.
//establecer sesión para IDusuario.
$Q_obtener_IDusuario = 'SELECT idusuario FROM usuario WHERE nombreusuario = "'. $_SESSION['nombreUsuario'].'"';
$ejecutar_obtener_IDusuario = mysqli_query($conn, $Q_obtener_IDusuario);
$resultado = mysqli_fetch_array($ejecutar_obtener_IDusuario);
$_SESSION['IDusuario'] = $resultado[0];

$query = "SELECT * FROM pedido_usuario where idusuario=".$_SESSION['IDusuario'];
$resultado = mysqli_query($conn, $query);

function checkColor($estado){
    switch ($estado) {
        case 'ACEPTADO':
            return "green";
        case 'ABONADO':
            return "yellow";            
        case 'PAGADO':
            return "orange";            
        case 'RECHAZADO':
            return "red";        
        default:
            # code...
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Pedidos</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">    
    <meta charset="utf-8">
        <title>Panaderia | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Account.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet"href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>    
</head>
<body>
<?php $page = 'historialCompras';?>

<!--Iniciar Barra de Navegación-->
<?php include '../Includes/BarraNavegacionMovil.php';?>
<!--FIN Barra de Navegación-->


<!--Iniciar Barra de Navegación @media 1200px-->
<?php include '../Includes/BarraNavegacionPC.php';?>
<!--FIN Barra de Navegación @media 1200px-->



<!--Login -->
<div>
  <div >    

  <div class="login">
          <div class="login-header">
              <h3>Historial de Compras</h3>
              <p>Mi Historial</p>
          </div>
      </div>
    <div class="container mt-5">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>IDpedido</th>
                    <th>Telefono</th>
                    <th>FechaCreacion</th>
                    <th>Estado</th>
                    <th>Direccion</th>
                    <th>Total Bs</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($fila = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo $fila['idpedido']; ?></td>
                    <td><?php echo $fila['telefono']; ?></td>
                    <td><?php echo $fila['fechacreacion']; ?></td>
                    <td style="background-color:<?php echo checkColor($fila['estado'])?>"><?php echo $fila['estado']; ?></td>
                    <td><?php echo $fila['direccion']; ?></td>
                    <td><?php echo $fila['total']; ?></td>
                    <td>
                        <input type="hidden" id="estado<?php echo $fila['idpedido']?>" value="<?php echo $fila['estado']?>">
                        <button class="btn btn-primary btn-sm" onclick="verDetalles(<?php echo $fila['idpedido']; ?>)">Detalles</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
 
    <!-- Dialogo para editar -->
    <dialog id="dialogoEditar" class="modal-dialog">
        <form method="post" class="modal-content">
            <!-- Contenido del diálogo -->
            <div class="modal-header">
                <h5 class="modal-title">Detalles Pedido <input style='color:black' type=text id=numPedido readonly ></h1></h5>
                <button type="button" class="close" onclick="cerrarDialogo()">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Campos para Mostrar -->    

                <div id=tiket></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="cerrarDialogo()">Cerrar</button>
                <button id="btnAsistencia" type="button" class="btn btn-primary" onclick="irChat(document.getElementById('numPedido').value)">Chat Asistencia</button>
            </div>
        </form>
    </dialog>
    <?php include '../Includes/Footer.php';?>
<!--Final del Footer-->


        <!-- Inicio del nav de abajo -->
        <?php include '../Includes/NavDeAbajo.php';?>
    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        // Funciones para manejar los eventos de los botones

        function verDetalles(id) {
            const pedidoEstado = "estado"+id;
            const botonAsistencia = document.getElementById('btnAsistencia');
            asistencia = document.getElementById(pedidoEstado).value;
            // Aquí iría el código para cargar los datos del pedido en el diálogo de edición
            $.get("../../Modelo/server.php?tiketPedido=&idpedido="+id,
                    function(data){                        
                        var datos= JSON.parse(data);
                        $("#tiket").html(datos.tiket);
                        document.getElementById('numPedido').value=datos.numPedido;
                    });

            var dialogo = document.getElementById('dialogoEditar');
            if(asistencia == "SOLICITUD" || asistencia == "RECHAZADO"){
                botonAsistencia.disabled = true;
            }
            else{
                botonAsistencia.disabled = false;
            }
            dialogo.showModal();
            // ...
        }

        function cerrarDialogo() {
            var dialogo = document.getElementById('dialogoEditar');
            dialogo.close();
        }

        function irChat(id){ 
           window.location.href="../Admin/chat.php?idpedido="+id;
        }
    </script>
</body>
</html>