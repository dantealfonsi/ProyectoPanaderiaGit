<?php 
    define('Acceso', TRUE);

    //Inicio de Sesión
    include_once "../Includes/paths.php";
    include "../../Modelo/iniciarSesion.php";
?>

<?php

include "../../Modelo/conexion.php"; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

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


        <!--Imagen de atras-->
        <div class="bg-image-container">
            <div class="bg-image"></div>
        </div>
        <!--Fin de la imagen de atras ps-->

        
        <!--Login -->
        <section style='display: flex; justify-content: space-between;'>

          <h1 class='Fieldset-title'> AGREGAR NUEVA RECETA</h1>
          
            <a href='recetas.php' class='close-btn close-btnTitleOnly'> ⌦ </a> 
          
        </section>

        <div class="login-page">
            <div class="form">    

            <form actions="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                <section class='form-section'>

              <div class='first-line' style='padding: 2rem;gap: 2rem;'> 
                <div class='flex-inside'>  
                <span>Nombre de la Receta</span>
                <input type="text" id="nombre_receta" onfocusout="valNombreReceta()" name="nombre_receta" required>
                </div>

            <div class='flex-inside' style="display:none;">
                <span>Producto Relacionado(Opcional)</span>
                <select name="nombre_producto" id="nombre_producto" onchange="valPerteneceProducto()">
                <option value="">Seleccione</option>
                <?php 
              
                  $consulta  = "SELECT idproducto, nombre_producto from productos where CHAR_LENGTH(idreceta) =0;";
                  $resultado_cat = mysqli_query($conn, $consulta);
                  while($row = mysqli_fetch_array($resultado_cat)) {
                    echo "<option value='".$row['idproducto']."'>" . $row['nombre_producto'] . "</option>";
                  }

              ?>
              </select>
            </div>
                </div>
        </div>
        </section>

        <section class='form-section'>

            <div>
                <div class='first-line' style='padding: 2rem;gap: 2rem;'> 
                    <div class='flex-inside'>  
                        
                    <span>Cantidad</span>
                    <input type="number" id="cantidad" name="cantidad" steep="1" value="1">
                    </div>                
                    <div class='flex-inside' style='display: flex;flex-direction: column;' >
                    <span>Unidad</span>
                    <select disabled id="uni" name="uni" class='first-line-select'>
                        <option selected>gramos</option>
                        <option>unidades</option>
                    </select>
                    </div>
                <div class='flex-inside'>
                <span>Insumo</span>
                  <div style='display:flex;flex-direction:row;gap:1rem'>
                  <select name="nombre_insumo" id="nombre_insumo" onchange="copyUnidad()">  
                        <option value="">Seleccione</option>
                            <?php 
                    
                                $consulta  = "SELECT * from insumos";
                                $resultado_cat = mysqli_query($conn, $consulta);
                                while($row = mysqli_fetch_array($resultado_cat)) {
                                    echo "<option value='".$row['nombre']."'>" . $row['nombre'] . "</option>";
                                }

                            ?>
                    </select>
                    <a class='button-rounded-1' style='cursor:pointer;' type="button" onclick="agregarProducto()">Agregar</a>
                  </div>
                   
            </section>
                </div>                
                </div>                  
            </div>
    
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
            </div>
        </section>

<div class='second-line'>
             <div class='flex-inside' style='width: 95%;margin: auto;'>
                <h1 style="text-align: center;font-size: 2rem;text-decoration: underline;color: #333333;font-family: 'button';">Preparacion</h1>
                <textarea style='color:black;height: 15rem;' id="nota" name="nota" required> </textarea>
             </div>
        </div>  
        <br>
        <button class='submitBtn' style='margin-bottom:1rem;' type='button' name='guardar' onclick="enviarReceta()">Guardar Receta</button>        
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
const productos = [];

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


function valNombreReceta(){
          $.post("../../Modelo/modulo_proyecto.php",{
          siDatoExiste: '',
          tabla: 'recetas',
          campo: 'nombre',
          dato: document.getElementById('nombre_receta').value

        },function(data){

          datos= JSON.parse(data);

            if(datos.existe==='1'){
              restrictUsuario = false;
              $("#nombre_receta").css("border-bottom","2px solid #f27474");
            
              Swal.fire(
                    'Advertencia',
                    'El Nombre de  la Receta ya existe',
                    'warning'
                  ).then(function(){
                    document.getElementById('nombre_receta').value='';
                    //document.getElementById('nombreUsuario').focus();
                  });

          } 
          else {
          restrictUsuario = true;
          $("#nombre_receta").css("border-bottom","2px solid #cf375b");
        }
      });
}

function valPerteneceProducto(){
          $.post("../../Modelo/modulo_proyecto.php",{
          siDatoExiste: '',
          tabla: 'recetas',
          campo: 'idproducto',
          dato: document.getElementById('nombre_producto').value

        },function(data){

          datos= JSON.parse(data);

            if(datos.existe==='1'){ 
              Swal.fire(
                    'Advertencia',
                    'Este producto ya tiene una  Receta Asignada',
                    'warning'
                  ).then(function(){
                    const selectElement = document.getElementById('nombre_producto');
                    selectElement.value = '';
                  });

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
        title: 'Cuidado?',
        text: "Seguro que quieres eliminar este item?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Si!'
        }).then((result) => {
        if (result.isConfirmed) {
        Swal.fire(
            'Borrado!',
            'El Item ha sido borrado.',
            'success'
        ).then(function(){ 
            productos.splice(index, 1); // Elimina el producto del array
            mostrarTabla();
        }
        );
        }
    })
}

function enviarReceta() {
    const nombreReceta = document.getElementById("nombre_receta").value;
    /*let nombreProducto = document.getElementById("nombre_producto").value;*/
    const preparacion = document.getElementById("nota").value;

    /*if(!nombreProducto){
        nombreProducto = "0";
    }*/

    if (nombreReceta && preparacion) {
        const receta = {
            nombre_receta: nombreReceta,            
            nota: preparacion,
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
</script>