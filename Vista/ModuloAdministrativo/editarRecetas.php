<?php 
    define('Acceso', TRUE);

    //Inicio de Sesión
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
?>

<?php

include "../../Modelo/conexion.php"; 

function readNombreProducto($IDproducto){
    $nombreProducto="";
    $sql ="select idproducto, nombre_producto from productos  where idproducto={$IDproducto}";
    $resultado= mysqli_query($GLOBALS['conn'], $sql);
    if($resultado){
        $row = mysqli_fetch_array($resultado);
        if(isset($row['nombre_producto']) && $row['nombre_producto'] != null){
            return $row['nombre_producto'];
        }        
    }
    return $nombreProducto;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

}

if(isset($_GET['id'])){
    //obtengo la informacion de las recetas
    $consulta = "select * from recetas where idreceta='".$_GET['id']."'";
    $resultado = mysqli_query($conn, $consulta);
    $receta = mysqli_fetch_array($resultado);

    $nombre_receta= $receta['nombre'];
    //$nombre_producto = readNombreProducto($receta['idproducto']);
    $nota = $receta['notas'];

}else{
    exit("error....");
}


?>

<!-- Formulario HTML para la inserción de datos -->

<!DOCTYPE html>
<html lang="en-MU"> 
    <head>
        <meta charset="utf-8">
        <title>Panaderia | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/main.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet"href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>
        
        <style>

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


       body{
        text-align: center;
       }
       textarea{
        color: #313131;
        background: #f3f3f3;
        border: dotted pink;
        width: -webkit-fill-available;
        height: 6rem;
        font-size: 1.4rem;
        font-family: 'Roboto';
        padding:1rem;
       }

       tr td {
        font-size: 1rem;
        padding: 0.8rem;
        font-family: roboto;
        width: 10%;
        border: 1px solid #d7d7d7;
    }
        </style>
    </head>

    <body>
        <?php $page = 'insertarReceta';?>
        <input type="hidden" id="codigo" name="codigo" value="<?php if(isset($_GET['id'])) echo $_GET['id']; ?>">

        <!--Imagen de atras-->
        <div class="bg-image-container">
            <div class="bg-image"></div>
        </div>
        <!--Fin de la imagen de atras ps-->

        
        <!--Login -->
        <section style='display: flex; justify-content: space-between;'>

          <h1 class='Fieldset-title'> EDITAR LA RECETA</h1>
          
            <a href='recetas.php' class='close-btn close-btnTitleOnly'> ⌦ </a> 
          
        </section>

        <div class="login-page">
            <div class="form">    

            <form actions="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                <section class='form-section'>

            <div class='first-line' style='padding: 2rem;gap: 2rem;'> 
                <div class='flex-inside'>  
                    <span>Nombre de la Receta:</span>
                <input type="text" readonly id="nombre_receta" name="nombre_receta" value="<?php echo $nombre_receta; ?>">
                </div>
         

                <div class='flex-inside' style="display:none;">
                    <span>Producto Relacionado</span>
                    <select disabled name="nombre_producto" id="nombre_producto" >
                    <option value="">Seleccione</option>
                        <?php 
                        
                            $consulta  = "SELECT * from productos";
                            $resultado_cat = mysqli_query($conn, $consulta);                  
                            while($row = mysqli_fetch_array($resultado_cat)) {
                                $select = "";
                                /*if($nombre_producto == $row['nombre_producto']) {
                                    $select = "selected";
                                }*/
                                echo "<option {$select} value='".$row['idproducto']."'>" . $row['nombre_producto'] . "</option>";
                            }

                        ?>
                    </select>
                </div>
            </div>
        </section>
             
        <section class='form-section'>
            <div class='first-line' style='padding: 2rem;gap: 2rem;'> 
                <div class='flex-inside'>  
                    <span>Cantidad</span>
                    <input type="number" id="cantidad" name="cantidad" steep="1" value="1">
                </div>                
                <div class='flex-inside'>
                    <span>Unidad</span>
                    <select disabled id="uni" name="uni">
                        <option selected>gramos</option>
                        <option>unidades</option>
                    </select>
                </div>
                
                <div class='flex-inside'>
                    <span>Insumo</span>
                    <div style='display:flex;flex-direction:row;gap:1rem'>
                    <select name="nombre_insumo" id="nombre_insumo"  onchange="copyUnidad()">  
                        <option value="">Seleccione</option>
                            <?php 
                            
                                $consulta  = "SELECT * from insumos";
                                $resultado_cat = mysqli_query($conn, $consulta);
                                while($row = mysqli_fetch_array($resultado_cat)) {
                                    echo "<option value='".$row['nombre']."'>" . $row['nombre'] . "</option>";
                                }

                            ?>
                    </select>
                    <a class='button-rounded-1' type="button" onclick="agregarProducto()">Agregar</a>
                    </div>
                </div>                
            </div>                  
        </div>
    </section>
    <section class='table-section' style='padding:3.5rem;'>  

    <div class='InventarioBox' style='height: 27rem;  width: auto; overflow-y: scroll;'> 
        <table style='width: 100%;'> 
            <thead>
                <tr style='background: linear-gradient(-11deg, #E994B3, #FAD2DD);color: #000000;'>
                    <th style='padding:1rem;'>Cantidad</th>
                    <th>Unidad</th>
                    <th>Insumo</th>
                    <th>Acciones</th>
                </tr>
         </thead>
    <tbody id="tabla-cuerpo">
    </tbody>
</table>
</section>
        <div class='second-line'>
             <div class='flex-inside' style='width: 95%;margin: auto;'>
             <h1 style="text-align: center;font-size: 2rem;text-decoration: underline;color: #333333;font-family: 'button';">Preparacion</h1>
                <textarea style='color:black;height: 15rem;' id="nota" name="nota" required> <?php echo $nota; ?></textarea>
             </div>
        </div>        
        <br><br>
        <button class='submitBtn' style='margin-bottom:2rem;' type='button' name='guardar' onclick="enviarReceta()">Guardar</button>        
            <br>
        </form>
    </body>
</html>

<script src="../Javascript/Tooltip/tooltip.min.js"></script>
  <script src="../Javascript/Tooltip/tippy.min.js"></script>
  <script src="../Javascript/SweetAlert/sweetalert2.all.min.js"></script>
  <script src="../Javascript/DataTables/jQuery/jquery.min.js"></script>

<script>
// Array para almacenar los productos
let productos = [];

function copyUnidad(){
    $.post("../../Modelo/modulo_proyecto.php",{
          readDatoString: '',
          tabla: 'insumos',
          campo: 'nombre',
          busqueda: 'uni',
          dato: document.getElementById('nombre_insumo').value

        },function(data){

          datos= JSON.parse(data);

            if(datos.existe==='1'){

                    const selectElement = document.getElementById('uni');
                    selectElement.value = datos.campo;

          } 
          else {
        //si
        }
      });
}

function agregarProducto() {
    const cantidad = document.getElementById("cantidad").value;
    const gramos = document.getElementById("uni").value;
    const producto = document.getElementById("nombre_insumo").value;

    // Validación de campos (puedes agregar más validaciones según tus necesidades)
    if (cantidad && gramos && producto) {
        const nuevoProducto = { cantidad, gramos, producto };
        productos.push(nuevoProducto);
        mostrarTabla();
    } else {
        Swal.fire(
            'Advertencia!',
            'Complete todos los campos para continuar...',
            'warning'
        );
    }
}

function mostrarTabla() {
    const tablaCuerpo = document.getElementById("tabla-cuerpo");
    tablaCuerpo.innerHTML = "";

    productos.forEach((producto, index) => {
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td>${producto.cantidad}</td>
            <td>${producto.gramos}</td>
            <td>${producto.producto}</td>
            <td>
                <a onclick="eliminarProducto(this)"><img id=icon-bt src='../../Assets/images/inventory/erase.png'></a>
            </td>
        `;
        tablaCuerpo.appendChild(fila);
    });
}

function eliminarProducto(button) {
    const fila = button.parentNode.parentNode;
    const index = fila.rowIndex - 1; // Restamos 1 para ajustar al índice del array

    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo'
    }).then((result) => {
        if (result.isConfirmed) {
            productos.splice(index, 1); // Elimina el producto del array
            mostrarTabla();
            Swal.fire(
                '¡Eliminado!',
                'El insumo ha sido eliminado.',
                'success'
            )
        }
    })
}


function enviarReceta() {
    const nombreReceta = document.getElementById("nombre_receta").value;
    /*let nombreProducto = document.getElementById("nombre_producto").value;*/
    const preparacion = document.getElementById("nota").value;
    const codigo = document.getElementById("codigo").value;

    /*if(!nombreProducto){
        nombreProducto = "0";
    }*/


    if (nombreReceta && preparacion) {
        const receta = {
            nombre_receta: nombreReceta,            
            nota: preparacion,
            update: 'yes',
            codigo: codigo,
            productos: productos
        };

        // Convertir el objeto a JSON
        const recetaJSON = JSON.stringify(receta); 
        // Enviar el JSON al backend (puedes usar fetch o XMLHttpRequest)
        // Ejemplo con fetch:
        fetch("../../Modelo/serverReceta.php", {
            method: "POST",
            body: recetaJSON,
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            // Manejar la respuesta del backend (por ejemplo, mostrar un mensaje)            
            console.log(data);
            window.location.href="recetas.php";
        })
        .catch(error => {
            console.error("Error al enviar la receta:", error);
        });
    } else {
        Swal.fire(
            'Advertencia!',
            'Complete todos los campos para continuar...',
            'warning'
        );
    }
}

function recuperarReceta() {
fetch("../../Modelo/serverReceta.php?receta="+document.getElementById('codigo').value)
    .then(response => {
        if (!response.ok) {
            throw new Error("Error en la solicitud: " + response.status);
        }
        return response.json(); // Parsear la respuesta como JSON
    })
    .then(data => {
        productos = data;  
        
        mostrarTabla();
        // Aquí puedes procesar los datos recibidos (data)
        console.log("Datos recibidos:", data);
    })
    .catch(error => {
        console.error("Error en la solicitud:", error);
    });

}
recuperarReceta();
</script>