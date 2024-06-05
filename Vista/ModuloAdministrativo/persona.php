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

    <script src="../Javascript/DataTables/jQuery/jquery.min.js"></script>
    <title>Personas</title>

        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/Common.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet"href="<?php echo $GLOBALS['ROOT_PATH'] ?>/css/animate.min.css"/>

    <style>
*{
  text-align: center;
}
    @font-face {
      font-family: roboto;
      src: url(../fonts/roboto.ttf) format('truetype');
    }

    @font-face {
      font-family: button;
      src: url(../fonts/button.ttf) format('truetype');
     }

     @font-face {
       font-family: logo;
       src: url(../fonts/logo.ttf) format('truetype');
      }

      @font-face {
        font-family: spartan;
        src: url(../fonts/spartan.ttf) format('truetype');
       }
    </style>

  </head>
  <body>

<?php
include "../../Controlador/gestionar_personas.php";

$persona = new Persona;
$tmodulo = new Modulo;

if(isset($_POST['agregar'])){
  $persona->crearPersona($_POST['nombre'],$_POST['apellido'],$_POST['cedula'],$_POST['telefono'],$_POST['direccion'],$_POST['cargo']);
}

if(isset($_POST['guardar'])){
  $persona->editarPersona($_POST['nombre'],$_POST['apellido'],$_POST['cedula'],$_POST['telefono'],$_POST['direccion'],$_POST['cargo']);
  $tmodulo->historial($_COOKIE['nombre'],$_COOKIE['cedula'],'EDITO UNA PERSONA');
}

if(isset($_GET['borrar'])){
  $persona-> borrarPersona($_GET['id']);
  $tmodulo->historial($_COOKIE['nombre'],$_COOKIE['cedula'],'DESABILITO UNA PERSONA');
}



          
echo "    
          <h1 class='titulo_caja'> EMPLEADOS </h1>
          <div class='flexbuttons'>   

          <div class='left'> 
          </div>
          
        
          </div>

          <form id='form' action='persona.php' method='POST'>";
  if (isset($_GET['agg'])){
    echo "
    <div class='EditBox'> 
  
    <fieldset>

    <section style='display: flex; justify-content: space-between;'>

      <h1 class='Fieldset-title'> AGREGAR NUEVA PERSONA</h1>
      
        <a href='persona.php' class='close-btn close-btnTitleOnly'> ⌦ </a> 
      
    </section>

    <section class='form-section'>

    <div class='first-line'>
      <div class='flex-inside'>
        Cargo: <br> 
        <input onkeypress=\"this.value=''\" onfocusout=\"valCargo()\"  minlength=2 type='text' name='cargo' id='cargo' required autocomplete='off' list='cargos' title='Elija su cargo' required>
        <datalist id='cargos'> 
        <option value='Gerente'>
        <option value='Asistente'>
        <option value='Obrero'>
        </datalist>
      </div>
    </div>

    <div class='second-line'>
      <div class='flex-inside'>
    Nombre: <br>  
    <input pattern='^([A-Z]).*' type='text' name='nombre' onfocusout=\"valNombre()\"  id='nombre' required>
      </div>
      <div class='flex-inside'>
        Apellido: <br> 
        <input pattern='^([A-Z]).*' type='text' name='apellido' onfocusout=\"valApellido()\" id='apellido' required>
      
      </div>
    </div>
    
    <div class='third-line'>
      <div class='flex-inside'>
        Cédula:  <br>
          <input autocomplete=off pattern='^[0-9]{2}-?[.]?[0-9]{3}-?[.]?[0-9]{3}' onfocusout=\"valCedula()\" type='text' name='cedula'  id='cedula' placeholder='XX-XXX-XXX' required>
      </div>
      <div class='flex-inside'>
        Teléfono: <br>
        <input pattern='^(\+58)?-?([04]\d{3})?-?(\d{3})-?(\d{4})' title='EJ: Empieza por +58 o 04XX' type='text' onfocusout=\"valTelefono()\" name='telefono'  id='telefono' required>
      </div>
    </div>

    <div class='first-line'>
      <div class='flex-inside'>
        Dirección: <br> 
          <input type='text' name='direccion'  onfocusout=\"valDireccion()\" id='direccion' required style='width:24rem;'>
      </div>
    </div>
    </section>
   <button type='button' class='submitBtn' name='agregarBtn' id='agregarBtn' style='margin-left: 2.5rem;margin-top: 2.5rem;' onclick=\"agregarPersona()\">Agregar</button>
    </div>
    ";
  }

  if (isset($_GET['edit'])) {
    $titulo=$_GET['nombre'];
    echo "
  <div class='EditBox'>
  
  <fieldset>

  <section style='display: flex; justify-content: space-between;'>

  
      <div>
      <h1 class='titulo-Subtitulo'>Editar</h1>
      <h1 class='subtitle_container'><span></span>$titulo</h1>
      </div>

      <a href='persona.php' class='close-btn'> ⌦ </a> 

  </section>

  <section class='form-section'>


  <input type='hidden' name='id' value='".$_GET['id']."'>

  <div class='first-line'>
    <div class='flex-inside'>
      Cargo: <br> 
      <input onkeypress=\"this.value=''\" onfocusout=\"valCargo()\" minlength=2 type='text' name='cargo' id='cargo' required autocomplete='off' list='cargos' value='".$_GET['cargo']."' title='Elija su cargo' required>
      <datalist id='cargos'> 
      <option value='Gerente'>
      <option value='Asistente'>
      <option value='Obrero'>
      </datalist>
    </div>
  </div>

  <div class='second-line'>
    <div class='flex-inside'>
  Nombre: <br>  
  <input pattern='^([A-Z]).*' type='text' name='nombre' id='nombre' onfocusout=\"valNombre()\" required value='".$_GET['nombre']."'>
    </div>
    <div class='flex-inside'>
      Apellido: <br> 
      <input pattern='^([A-Z]).*' type='text' name='apellido' id='apellido' onfocusout=\"valApellido()\" required value='".$_GET['apellido']."'>
    
    </div>
  </div>
  
  <div class='third-line'>
    <div class='flex-inside'>
      Cédula:  <br>
        <input readonly type='text' name='cedula' id='cedula' placeholder='XX-XXX-XXX' required value='{$_GET['cedula']}'>
    </div>
    <div class='flex-inside'>
      Teléfono: <br>
      <input pattern='^(\+58)?-?([04]\d{3})?-?(\d{3})-?(\d{4})' onfocusout=\"valTelefono()\"title='EJ: Empieza por +58 o 04XX' type='text' name='telefono' id='telefono' required value='{$_GET['telefono']}'>
    </div>
  </div>

  <div class='first-line'>
    <div class='flex-inside'>
      Dirección: <br> 
        <input type='text' name='direccion' id='direccion' onfocusout=\"valDireccion()\" required style='width:24rem;' value='{$_GET['direccion']}'>
    </div>
  </div>
  </section>
  <button type='button' class='submitBtn' name='guardarBtn' id='guardarBtn' style='margin-left: 2.5rem;margin-top: 2.5rem;' onclick=\"guardarPersona()\"> Guardar </button>
  </div>
    ";
  }






  if (isset($_GET['hist'])){

    echo "

    <div class='EditBox'>

      
      <br><br><br>
      <div class='formtop'>  </div> 
      <fieldset> <br>

      <div style='text-align:right;'> 
        <a href='persona.php' class='close-btn'> ⌦ </a> 
      </div>
      ";
      
      echo $_GET['nombre'];

    
     $consulta = "SELECT * from CARAC_ENTRADA";   /*Buscar Producto*/

     $resultado = mysqli_query($tmodulo->mysqlconnect(), $consulta );
       
     echo " <table id='myTable' class='display'>
      <thead> 
     <tr class='tr'>
       <th>FECHA</th>
       <th>PRODUCTO</th>
       <th>CANTIDAD ENTRADA</th>
     </tr>
     </thead> <tbody>";
     while($row = mysqli_fetch_array($resultado)){    /*Te muestra el resultado de busqueda*/ 
     
   if(trim($proveedor->readNombreProveedor($row['NUM_ENTRADA'])['PROVEEDOR']) == trim($_GET['nombre']) ){
       echo "            
       <tr>
           <td>".$row['FECHA']."</td>
           <td>".$row['NOMBRE_PRODUCTO']."</td>
           <td>".$row['CANTIDAD']."</td>

      </tr>           
      ";}
     }
     echo 
   "</tbody></table>
 </form>   
</div>";

    echo "
    </fieldset>
    </div>";
  }

  echo "</form></div>";
  $cadena="<div class='InventarioBox'>
            <table id='myTable' style='width: 100%; text-align:center; font-size:16;'>
            <thead>
            <tr class='tr'>
              <th>NOMBRE</th>
              <th>APELLIDO</th>
              <th>CÉDULA</th>
              <th>TELÉFONO</th>
              <th>DIRECCIÓN</th>
              <th>CARGO</th>
              <th>ACCIONES</th>
            </tr>
            </thead>
            <tbody>";
  $consulta = "SELECT * from persona WHERE deleted=0 AND tipo='EMPLEADO' ";            
  $resultado = mysqli_query( $tmodulo->mysqlconnect(), $consulta );
  while($row = mysqli_fetch_array($resultado)){
      $cadena= $cadena . "<tr>
                            <td>".$row['NOMBRE']."</td>
                            <td>".$row['APELLIDO']."</td>
                            <td>".$row['CEDULA']."</td>
                            <td>".$row['TELEFONO']."</td>
                            <td>".$row['DIRECCION']."</td>
                            <td>".$row['CARGO']."</td>
                            <td>
                          <!--  <a href='?user=&edit=0&id=&nombre={$row['NOMBRE']}&apellido={$row['APELLIDO']}&cedula={$row['CEDULA']}&telefono={$row['TELEFONO']}&direccion={$row['DIRECCION']}&cargo={$row['CARGO']}'><img id='icon-bt' src='../fonts/edit.png'></a>
                            <a title='Borrar' onclick=\"borrar({$row['CEDULA']})\"><img id='icon-bt' src='../fonts/erase.svg'> </a>
                          -->
                            </td>
                            </tr>";
  }
  $cadena = $cadena . "</body></table>
                    </fieldset>
                  </div>
                <br>";
  echo $cadena;

//fin del menu crear usuarios// fin de la $_COOKIE
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
        oLanguage: {
          "oPaginate": {
              "sNext": "→",
              "sPrevious": "←"
          },  
          "sSearch": "<img id='icon-buscar' src='../fonts/search.svg'>",
          "sInfo": "<div class='table_label'>Pagina _START_ (_TOTAL_ entradas) </div>",
          "sInfoEmpty": "No hay entradas que mostrar"
        },
        
        buttons:[
          {
                text:      '<img id="table_icon" src="../fonts/adds.svg"></a>',
                className: 'square square-green',
                titleAttr: 'Agregar nueva entrada',
                action: function ( e, dt, button, config ) {
                window.location = '?user=&agg=0&id';
                }        
            },
            {
                extend:    'collection',
                text:      '<img id="table_icon_export" src="../fonts/export.svg"></i>',
                className: 'square square-red',
                titleAttr: 'Exportar',
                buttons: [
                    {
                      extend:    'excelHtml5',
                      text:      '<img id="table_icon" style="margin: 0;" src="../fonts/excel.svg"> EXCEL</i>',
                      className: 'square square-excel',
                      titleAttr: 'Excel'
                    },
                    {
                      extend:    'pdfHtml5',
                      text:      '<img id="table_icon" src="../fonts/pdf.svg"> PDF</i>',
                      titleAttr: 'PDF',
                      className: 'square square-pdf',
                      exportOptions: {columns: [ 0,1,2,3,4,5 ]},
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
                                text: 'Inversiones HumKar',
                                fontSize: 18,
                                margin: [15,10]
                              },
                      
                              {
                                alignment: 'center',
                                fontSize: 14,
                                text: 'Empleados',
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


////////////VALIDACION///////////////

let restrictCargo = false;
let restrictEditCargo = true;

let restrictNombre = false;
let restrictEditNombre = true;


let restrictApellido = false;
let restrictEditApellido = true;


let restrictCedula = false;
let restrictEditCedula = true;


let restrictTelefono = false;
let restrictEditTelefono = true;


let restrict = false;
let restrictEdit = true;





function valCargo(){
      let pattern=/Asistente|Gerente|Obrero/;
      let campo = document.getElementById('cargo');
     
      let result = pattern.test(campo.value);
      restrictCargo = result;
      restrictEditCargo = result;
      if(result === false){
        $("#cargo").css("border-bottom","2px solid #f27474");

        Swal.fire(
                'Advertencia',
                'Este cargo no es valido',
                'warning'
              )
      }
      else{
        $("#cargo").css("border-bottom","2px solid #6acfff");
      }
  }





function valNombre(){
      let pattern=/^\w[^\n\t!"·$%&/()=?¿[}{,|@#~€¬{}´ç`+'¡*]*$/;
      let campo = document.getElementById('nombre');
     
      let result = pattern.test(campo.value);
      restrictNombre = result;
      restrictEditNombre = result;
      if(result === false){
        $("#nombre").css("border-bottom","2px solid #f27474");

        tippy('#nombre', {
          content: "No se admiten caracteres especiales!",
          trigger: 'focus',
          animation: 'fade',
        });
      }
      else{
        $("#nombre").css("border-bottom","2px solid #6acfff");
      }
  }

  function valApellido(){
      let pattern=/^\w[^\n\t!"·$%&/()=?¿[}{,|@#~€¬{}´ç`+'¡*]*$/;
      let campo = document.getElementById('apellido');
     
      let result = pattern.test(campo.value);
      restrictApellido = result;
      restrictEditApellido = result;
      if(result === false){
        $("#apellido").css("border-bottom","2px solid #f27474");

        tippy('#apellido', {
          content: "No se admiten caracteres especiales!",
          trigger: 'focus',
          animation: 'fade',
        });
      }
      else{
        $("#apellido").css("border-bottom","2px solid #6acfff");
      }
  }


  function valCedula(){
    
      let pattern=/^[0-9]{1,2}-?[.]?[0-9]{3}-?[.]?[0-9]{3}$/;
      let campo = document.getElementById('cedula');
     
      let result = pattern.test(campo.value);
      restrictCedula = result;
      if(result === false){
        $("#cedula").css("border-bottom","2px solid #f27474");

        tippy('#cedula', {
          content: "Introduzca una cedula real!",
          trigger: 'focus',
          animation: 'fade',
        });
      }
      else{
      $("#cedula").css("border-bottom","2px solid #6acfff");
      $.post("../modelo/modulo_proyecto.php",{
      siCedulaExiste: '',
      tabla: 'PERSONA',
      campo: 'CEDULA',
      dato: document.getElementById('cedula').value

    },function(data){

      datos= JSON.parse(data);

        if(datos.existe==='1'){
          restrictCedula = false;
          $("#cedula").css("border-bottom","2px solid #f27474");
         
          Swal.fire(
                'Advertencia',
                'Cedula ya existe',
                'warning'
              ).then(function(){
                campo.value='';
              });

      } 
      else {
      restrictCedula = true;
      $("#cedula").css("border-bottom","2px solid #6acfff");
    }
});
      }
  }


  function valTelefono(){
      let pattern=/^(\+58)?-?([04]\d{3})?-?(\d{3})-?(\d{4})/;
      let campo = document.getElementById('telefono');
     
      let result = pattern.test(campo.value);
      restrictTelefono = result;
      restrictEditTelefono = result;
      if(result === false){
        $("#telefono").css("border-bottom","2px solid #f27474");

        Swal.fire(
                'Introduce un telefono real',
                'Puede empezar por +58 o 04XX.',
                'warning'
            ).then(function(){
                campo.value='';
              });
      }
      else{
        $("#telefono").css("border-bottom","2px solid #6acfff");
      }
  }


  
  function valDireccion(){
    if(document.getElementById("direccion").value.length===0){

      $("#direccion").css("border-bottom","2px solid #f27474");

      tippy('#direccion', {
          content: "Introduce una dirección",
          trigger: 'focus',
          animation: 'fade',
        });

      } else {
      $("#direccion").css("border-bottom","2px solid #6acfff");
      }
}

/////////////////////////////////////////////////////////////////////

function agregarPersona() {

  
if(restrictCargo===true && restrictNombre===true && restrictApellido===true && restrictCedula===true && restrictTelefono===true){
  restrict=true;
}else{
  restrict=false;
}

if (restrict===true && document.getElementById("nombre").value.length>0 && document.getElementById("apellido").value.length>0 && document.getElementById("cedula").value.length>0 && document.getElementById("direccion").value.length>0 && document.getElementById("telefono").value.length>0  && document.getElementById("cargo").value.length>0 ){
$.post("persona.php",{
agregar: "",
cargo: document.getElementById('cargo').value,
nombre: document.getElementById('nombre').value,
apellido: document.getElementById('apellido').value,
cedula: document.getElementById('cedula').value,
telefono: document.getElementById('telefono').value,
direccion: document.getElementById('direccion').value

},function(data){

  Swal.fire(
    'Agregada!',
    'El Empleado ha sido agregado con exito.',
    'success'
  ).then(function(){
    window.location.href="persona.php";
 });
});

}else{
  Swal.fire(
    'Introduzca bien los datos',
    'No puedes agregar al Empleado.',
    'error'
  )
}

}


function guardarPersona() {

if(restrictEditCargo===true && restrictEditNombre===true && restrictEditApellido===true && restrictEditCedula===true && restrictEditTelefono===true){
  restrictEdit=true;
}else{
  restrictEdit=false; 
}

if (restrictEdit===true && document.getElementById("nombre").value.length>0 && document.getElementById("apellido").value.length>0 && document.getElementById("cedula").value.length>0 && document.getElementById("direccion").value.length>0 && document.getElementById("telefono").value.length>0 && document.getElementById("cargo").value.length>0){
$.post("persona.php",{
guardar: "",
cargo: document.getElementById('cargo').value,
nombre: document.getElementById('nombre').value,
apellido: document.getElementById('apellido').value,
cedula: document.getElementById('cedula').value,
telefono: document.getElementById('telefono').value,
direccion: document.getElementById('direccion').value,


},function(data){
  Swal.fire(
    'Editado!',
    'El Empleado ha sido editado con exito.',
    'success'
  ).then(function(){ 
    window.location.href="persona.php";
 });
});

}else{
  Swal.fire(
    'Introduzca bien los datos',
    'No puedes Editar al Empleado.',
    'error'
  )
}

}


function borrar(cedula) {

Swal.fire({
title: 'Estas seguro que desea Eliminar',
text: "Seguro que quieres eliminar este Empleado",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: "Cancelar",
confirmButtonText: 'Si!'
}).then((result) => {
if (result.isConfirmed) {
  Swal.fire(
    'Borrada!',
    'El Empleado ha sido borrado.',
    'success'
  ).then(function(){ 
    window.location.href="persona.php?user=&borrar=0&id="+ cedula;
 }
  );
}
})

}



</script>
  </body>
</html>
