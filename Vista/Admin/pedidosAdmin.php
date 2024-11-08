<?php 
    define('Acceso', TRUE);
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";        
    
    //Conexion a la base de datos 
    include "../../Modelo/conexion.php"; 

    //restinje el acceso sino es admin
    if($_SESSION['esAdmin']==0)
    {
        exit('Acceso Denegado!');
    }    

    function historiFecha($fecha){ 
        $date=date_create($fecha);
        return date_format($date,"d/m/Y");
    }    
?>

<?php
// Suponiendo que ya tienes una conexión a la base de datos establecida y guardada en $conexion

$query = "SELECT * FROM pedido_usuario";
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
    <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/bootstrap.min.css">    
    <meta charset="utf-8">
        <title>Panaderia | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/main.css">
        <link rel="stylesheet" type="text/css" href="../Javascript/DataTables/dataTables.min.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/> 
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

       dialog{
        border: none;
        border-radius: 26px;
       }
        </style>
</head>
<body>
<?php $page = 'historialCompras';?>

  
<h1 class='titulo_caja'> Historial de Ventas </h1>

<div class='outerTable'>

    <div class='InventarioBox'>

        <table id='myTable' class='display'>
            
        <thead >
                <tr class='tr'>
                    <th>IDpedido</th>
                    <th>Telefono</th>
                    <th>Fecha Entrega</th>
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
                    <td><?php echo historifecha($fila['fechapedido']); ?></td>
                    <td style="background-color:<?php echo checkColor($fila['estado'])?>"><?php echo $fila['estado']; ?></td>
                    <td><?php echo $fila['direccion']; ?></td>
                    <td><?php echo $fila['total']; ?></td>
                    <td>
                        <?php 
                        if($fila['estado'] == "SOLICITUD"){
                            ?>
                                <button class="btn btn-primary btn-sm" style="background:green;" onclick="aceptarPedido(<?php echo $fila['idpedido']; ?>)">Aceptar</button>
                                <button class="btn btn-primary btn-sm" style="background:red;" onclick="rechazarPedido(<?php echo $fila['idpedido']; ?>)">Rechazar</button>
                            <?php
                        }
                        if($fila['estado'] == "ACEPTADO" || $fila['estado'] == "ABONADO" || $fila['estado'] == "PAGADO" || $fila['estado'] == "PRODUCCION"){
                            ?>
                        <button class="btn btn-primary btn-sm" onclick="verDetalles(<?php echo $fila['idpedido']; ?>)">Detalles</button>
                            <?php
                        }
                        ?>
                        
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Dialogo para editar -->
    <dialog id="dialogoEditar" class="modal-dialog" style='width: 70% !important;'>
        <form method="post" class="modal-content">
            <!-- Contenido del diálogo -->
            <div class="modal-header">
                <h5 class="modal-title">Detalles Pedido <input style='color:black' type=text id=numPedido readonly ></h1></h5>
                <a type="button" class='close-btn close-btnTitleOnly' onclick="cerrarDialogo()">⌦</a>
            </div>
            <div class="modal-body">
                <!-- Campos para Mostrar -->    

                <div id=tiket></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="cerrarDialogo()">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="irChat(document.getElementById('numPedido').value)">Chat Asistencia</button>
            </div>
        </form>
    </dialog>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="../Javascript/Tooltip/tooltip.min.js"></script>
  
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
           
        ]
    } );
} );
</script>

    <script>
        // Funciones para manejar los eventos de los botones

        function aceptarPedido(id){
            $.get("../../Modelo/server.php?aceptarPedido=&idpedido="+id,
                    function(data){
                        location.reload();
                    });
        }

        function rechazarPedido(id){
            $.get("../../Modelo/server.php?rechazarPedido=&idpedido="+id,
                    function(data){
                        location.reload();
                    });
        }

        function verDetalles(id) {
            // Aquí iría el código para cargar los datos del pedido en el diálogo de edición
            $.get("../../Modelo/server.php?tiketPedido=&idpedido="+id,
                    function(data){                        
                        var datos= JSON.parse(data);
                        $("#tiket").html(datos.tiket);
                        document.getElementById('numPedido').value=datos.numPedido;
                    });

            var dialogo = document.getElementById('dialogoEditar');
            dialogo.showModal();
            // ...
        }

        function cerrarDialogo() {
            var dialogo = document.getElementById('dialogoEditar');
            dialogo.close();
        }

        function irChat(id){
           window.location.href="chat.php?idpedido="+id;
        }
    </script>
</body>
</html>