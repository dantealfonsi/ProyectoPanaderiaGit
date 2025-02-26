<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
    
    //Conexion a la base de datos 
    include "../../Modelo/conexion.php"; 

    function historiFecha($fecha){ 
        $date=date_create($fecha);
        return date_format($date,"d/m/Y");
    }
    
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
            return "#a5dfa5";
        case 'ABONADO':
            return "#f9dd89";            
        case 'PAGADO':
            return "#ffb8ad";            
        case 'RECHAZADO':
            return "#d75e8a";        
        default:
            return '#99f1ff';
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
    <link rel="stylesheet" href="../../css/4.3.1.css">    
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
     
     
        <link rel="stylesheet" type="text/css" href='<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/Javascript/responsiveDatatables/dataTables.dataTables.css'>
        <link rel="stylesheet" type="text/css" href='<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/Javascript/responsiveDatatables/responsive.dataTables.css'>
        <link rel="stylesheet" type="text/css" href='<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/Javascript/responsiveDatatables/rowReorder.dataTables.css'>


        <script type="text/javascript" charset="utf8" src="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/Javascript/responsiveDatatables/jquery-3.7.1.js"></script>
        <script type="text/javascript" charset="utf8" src="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/Javascript/responsiveDatatables/dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/Javascript/responsiveDatatables/dataTables.responsive.js"></script>
        <script type="text/javascript" charset="utf8" src="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/Javascript/responsiveDatatables/dataTables.rowReorder.js"></script>
        <script type="text/javascript" charset="utf8" src="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/Javascript/responsiveDatatables/responsive.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="<?php echo $GLOBALS['ROOT_PATH'] ?>/Vista/Javascript/responsiveDatatables/rowReorder.dataTables.js"></script>

        <style>



    @media screen and (max-width: 950px){

        .modal-dialog {
        position: fixed;
        width: auto;
        margin: auto;
        pointer-events: none;
        height: 100vh;
        }

    }

        </style>

  
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

  <div class="login" style='padding: 0 5rem;'>
          <div class="login-header">
              <h3 style='text-decoration:underline;'>Historial de Compras</h3>
          </div>
      </div>
      <div class="container mt-5" style='margin-bottom: 20vh;'>
    <table id="example" class="table table-bordered">
        <thead style='background:#ffabca;'>
            <tr>

                <th>Fecha Entrega</th>
                <th>Dias</th>
                <th>Estado</th>
                <th>Direccion</th>
                <th>Total(Bs)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultado)): 
                $dias = calcularDiasEntreFechas(date('Y-m-d'), $fila['fechapedido']);
                $colorExpira ="transparent";
                $msgExpira="Por Expirar";
                if($dias < 2){
                    $colorExpira ="#d75e8a";
                    $msgExpira="Dias (Expirado)";
                }                    
            ?>
            <tr>

                <td><?php echo historifecha($fila['fechapedido']); ?></td>
                <td style="background: <?php echo $colorExpira;?>;text-align: center;color: white;font-weight: bolder;"><?php echo $dias ." ". $msgExpira; ?></td>
                <td style="background-color:<?php echo checkColor($fila['estado'])?>;text-align: center;color: white;font-weight: bolder;"><?php echo $fila['estado']; ?></td>
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
    <dialog id="dialogoEditar" class="modal-dialog" style='box-shadow: 11px 8px 20px 2px #595353;border: none;'>
        <form method="post" class="modal-content">
            <!-- Contenido del diálogo -->
            <div class="modal-header">
                <h5 class="modal-title" style='display: flex;align-items: center;gap: 1rem;'><b>Detalles Pedido<b> <input style='color: black;width: 40%;text-align: center;background: #ffd0d0;font-weight: 800;border: none;' type=text id=numPedido readonly ></h1></h5>
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
    <script src="../Javascript/jquery-3.5.1.js"></script>
    <script src="../Javascript/popper.min.js"></script>

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
                //botonAsistencia.disabled = true; 
                botonAsistencia.style.display = 'none';               
            }
            else{
                //botonAsistencia.disabled = false;
                botonAsistencia.style.display = 'inline-block';                
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

<script>
    new DataTable('#example', {
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando página _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            search: "Buscar:",
            paginate: {
                first: "<<",
                last: ">>",
                next: ">",
                previous: "<"
            }
        }
    });
</script>







</body>
</html>