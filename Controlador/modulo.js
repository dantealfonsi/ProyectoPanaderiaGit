
var n = 0;     
var pro=0;
var producto=0;
var cat=0;
var ent=0;
var sal=0;
var rep=0;
var per=0;
var UsuarioPerfil=0;
var tab=0;

/*******FUNCION PARA NAV RESPONSIVE TOGGLE**********/
/*
function toggle() {
  if (n==0) {
    document.getElementById("toggle").style.left = "0";
    n++;
  }
  else{
    document.getElementById("toggle").style.left = "-100%";
    n--;
  }
}

/*******FUNCION PARA FOOTER RESPONSIVE TOGGLE HACIA ARRIBA**********/
/*
function toggleUp() {
  if (n==0) {
    document.getElementById("toggleUp").style.top = "0";
    document.getElementById("f-bnt").style.top = "0"
    document.getElementById("toggleUp").style.position = "absolute";
    document.getElementById("table_icon_export").style.transform = "rotate(180deg)";
    n++;
  }
  else{
    document.getElementById("toggleUp").style.top = "auto";
    document.getElementById("f-bnt").style.top = "auto";
    document.getElementById("toggleUp").style.position = "fixed";
    document.getElementById("table_icon_export").style.transform = "rotate(0deg)";
    n--;
  }
}
/*
/*******FUNCION PARA CAMBIAR IFRAMES**********/

function main(){

  pro=0;
  producto=0;
  cat=0;
  ent=0;
  sal=0;
  rep=0;
  per=0;
  UsuarioPerfil=0;
  tab=1;
  document.getElementById("iframe").src="../Admin/frame.php";
  /*
  document.getElementsByClassName('main-nav')[0].style.background = "gray";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";
/*
  /**********FONT COLOR************* */
  /*
  document.getElementsByClassName('main-nav')[0].style.color = "#ffff";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
*/
}

function perfil(){
/*
  pro=0;
  producto=0;
  cat=0;
  ent=0;
  sal=0;
  rep=0;
  per=0;
  UsuarioPerfil=1;
  tab=0;
*/
  document.getElementById("iframe").src="../ModuloAdministrativo/perfil.php";
/*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "gray";
  /////////////FONT COLOR//////////////////
  document.getElementById("iframe").src="perfil.php";

  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('perfil-a')[0].style.color = "#ffff";
*/
}

function categoriaInsumo(){
/*
  producto=0;
  ent=0;
  sal=0;
  rep=0;
  cat=1;
  per=0;
  pro=0;
  tab=0;
  UsuarioPerfil=0; 
*/
  document.getElementById("iframe").src="../ModuloAdministrativo/categoriaInsumos.php";
  
/*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "#dacf95";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";
/*
  /**********FONT COLOR************* */
/*
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#ffff";
  document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
  */
}

function categoriaProducto(){
  /*
    producto=0;
    ent=0;
    sal=0;
    rep=0;
    cat=1;
    per=0;
    pro=0;
    tab=0;
    UsuarioPerfil=0;
  */
    document.getElementById("iframe").src="../ModuloAdministrativo/categoriaProductos.php";
    
  /*
    document.getElementsByClassName('main-nav')[0].style.background = "transparent";
    document.getElementsByClassName('categoria-nav')[0].style.background = "#dacf95";
    document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
    document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
    document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
    document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
    document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
    document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
    document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";
  /*
    /**********FONT COLOR************* */
  /*
    document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('categoria-nav')[0].style.color = "#ffff";
    document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
    */
  }
  
  
function ventas(){
  /*
    producto=0;
    ent=0;
    sal=0;
    rep=0;
    cat=1;
    per=0;
    pro=0;
    tab=0;
    UsuarioPerfil=0;
  */
    document.getElementById("iframe").src="../Admin/pedidosAdmin.php";
    
  /*
    document.getElementsByClassName('main-nav')[0].style.background = "transparent";
    document.getElementsByClassName('categoria-nav')[0].style.background = "#dacf95";
    document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
    document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
    document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
    document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
    document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
    document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
    document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";
  /*
    /**********FONT COLOR************* */
  /*
    document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('categoria-nav')[0].style.color = "#ffff";
    document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
    */
  }
  



function productos(){
  /*
  producto=1;
  cat=0;
  ent=0;
  sal=0;
  rep=0;
  per=0;
  pro=0;
  tab=0;
  UsuarioPerfil=0;
*/
  document.getElementById("iframe").src="../ModuloAdministrativo/productos.php";
/*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "#28a4fb";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";
  
  //////////FONT COLOR//////////////
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#ffff";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
*/
}

function recetas(){
  /*
  producto=1;
  cat=0;
  ent=0;
  sal=0;
  rep=0;
  per=0;
  pro=0;
  tab=0;
  UsuarioPerfil=0;
*/
  document.getElementById("iframe").src="../ModuloAdministrativo/recetas.php";
/*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "#28a4fb";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";
  
  //////////FONT COLOR//////////////
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#ffff";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
*/
}

function insumos(){
  /*
  producto=1;
  cat=0;
  ent=0;
  sal=0;
  rep=0;
  per=0;
  pro=0;
  tab=0;
  UsuarioPerfil=0;
*/
  document.getElementById("iframe").src="../ModuloAdministrativo/insumos.php";
/*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "#28a4fb";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";
  
  //////////FONT COLOR//////////////
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#ffff";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
*/
}


function entrada(){
/*
  producto=0;
  cat=0;
  ent=1;
  sal=0;
  rep=0;
  per=0;
  pro=0;
  tab=0;
  UsuarioPerfil=0;
*/
  document.getElementById("iframe").src="../ModuloAdministrativo/entrada.php";
/*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "#8adab0";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";

  ///////////FONT COLOR////////////////////////
  
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#ffff";
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
  */
}



function salida(){
  /*
  producto=0;
  cat=0;
  ent=1;
  sal=0;
  rep=0;
  per=0;
  pro=0;
  tab=0;
  UsuarioPerfil=0;
*/
  document.getElementById("iframe").src="../ModuloAdministrativo/salida.php";
/*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "#8adab0";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";

    ///////////FONT COLOR////////////////////////
    document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('entrada-nav')[0].style.color = "#ffff";
    document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
*/
}


function perfil(){
  /*
  producto=0;
  cat=0;
  ent=1;
  sal=0;
  rep=0;
  per=0;
  pro=0;
  tab=0;
  UsuarioPerfil=0;
*/
  document.getElementById("iframe").src="../Admin/perfil.php";
/*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "#8adab0";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";

    ///////////FONT COLOR////////////////////////
    document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('entrada-nav')[0].style.color = "#ffff";
    document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
    document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
*/
}



function usuario(){
/*
  producto=0;
  cat=0;
  ent=0;
  sal=0;
  rep=0;
  per=1;
  pro=0;
  tab=0;
  UsuarioPerfil=0;
*/
  document.getElementById("iframe").src="../ModuloAdministrativo/usuario.php";
/*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "#c9a7db";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";
    ////////////FONT COLOR////////////////////
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#ffff";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
*/
}


function persona(){
/*
  producto=0;
  cat=0;
  ent=0;
  sal=0;
  rep=0;
  per=1;
  pro=0;
  tab=0;
  UsuarioPerfil=0;
*/
  document.getElementById("iframe").src="../ModuloAdministrativo/persona.php";
/*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "#c9a7db";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";
    ////////////FONT COLOR////////////////////
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#ffff";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";

*/  
}


function proveedores(){
  /*
  pro=1;
  producto=0;
  cat=0;
  ent=0;
  sal=0;
  rep=0;
  per=0;
  tab=0;
  UsuarioPerfil=0;
*/
  document.getElementById("iframe").src="../ModuloAdministrativo/proveedores.php";

  /*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "#f3a276";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";

  ///////FONT COLOR//////////
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#fff";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
*/
}

function reportes(){
/*
  producto=0;
  cat=0;
  ent=0;
  sal=0;
  rep=1;
  per=0;
  pro=0;
  tab=0;
  UsuarioPerfil=0;

  document.getElementById("iframe").src="reportes.php";
  
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "#dacf95";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";

  /////////////////FONT COLOR/////////////////////
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#ffff";
  document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
*/
}

function ayuda(){
  document.getElementById("iframe").src="ayuda.php";
}



function cliente(){
/*
  producto=0;
  cat=0;
  ent=0;
  sal=0;
  rep=0;
  per=1;
  pro=0;
  tab=0;
  UsuarioPerfil=0;
*/
  document.getElementById("iframe").src="cliente.php";

  /*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "transparent";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "#c9a7db";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";
  ////////////FONT COLOR////////////////////
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#ffff";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
  */
}




function devolucion_entrada(){
/*
  producto=0;
  cat=0;
  ent=0;
  sal=1;
  rep=0;
  per=0;
  pro=0;
  tab=0;
  UsuarioPerfil=0;
*/
  document.getElementById("iframe").src="../ModuloAdministrativo/devolucion_entrada.php";
/*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "#f39f9f";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";
  
  ///////FONT COLOR///////////
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#ffff";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
*/
}



function devolucion_salida(){
/*
  producto=0;
  cat=0;
  ent=0;
  sal=1;
  rep=0;
  per=0;
  pro=0;
  tab=0;
  UsuarioPerfil=0;
*/
  document.getElementById("iframe").src="../ModuloAdministrativo/devolucion_salida.php";
/*
  document.getElementsByClassName('main-nav')[0].style.background = "transparent";
  document.getElementsByClassName('categoria-nav')[0].style.background = "transparent";
  document.getElementsByClassName('producto-nav')[0].style.background = "transparent";
  document.getElementsByClassName('entrada-nav')[0].style.background = "transparent";
  document.getElementsByClassName('salida-nav')[0].style.background = "#f39f9f";
  document.getElementsByClassName('proveedores-nav')[0].style.background = "transparent";
  document.getElementsByClassName('reporte-nav')[0].style.background = "transparent";
  document.getElementsByClassName('persona-nav')[0].style.background = "transparent";
  document.getElementsByClassName('perfil-nav')[0].style.background = "transparent";

    ///////FONT COLOR///////////
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('salida-nav')[0].style.color = "#ffff";
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
  */
}


/*

function mouseOverProducto() {
  document.getElementsByClassName('producto-nav')[0].style.color = "#ffff";
}

function mouseOutProducto() {

  if(producto===0){
    document.getElementsByClassName('producto-nav')[0].style.color = "#8f94a1";
  }
}


function mouseOverCategoria() {
  document.getElementsByClassName('categoria-nav')[0].style.color = "#ffff";
}

function mouseOutCategoria() {
  if (cat===0){
  document.getElementsByClassName('categoria-nav')[0].style.color = "#8f94a1";
  }
}


function mouseOverMovimiento() {
  document.getElementsByClassName('entrada-nav')[0].style.color = "#ffff";
}

function mouseOutMovimiento() {
  if (ent===0){
  document.getElementsByClassName('entrada-nav')[0].style.color = "#8f94a1";
  }
}

function mouseOverDevolucion() {
  document.getElementsByClassName('salida-nav')[0].style.color = "#ffff";
}

function mouseOutDevolucion() {
  if (sal===0){
  document.getElementsByClassName('salida-nav')[0].style.color = "#8f94a1";
  }
}

function mouseOverReporte() {
  document.getElementsByClassName('reporte-nav')[0].style.color = "#ffff";
}

function mouseOutReporte() {
  if (rep===0){
  document.getElementsByClassName('reporte-nav')[0].style.color = "#8f94a1";
  }
}


function mouseOverPersona() {
  document.getElementsByClassName('persona-nav')[0].style.color = "#ffff";
}

function mouseOutPersona() {
  if (per===0){
  document.getElementsByClassName('persona-nav')[0].style.color = "#8f94a1";
  }
}


function mouseOverProveedores() {
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#ffff";
}

function mouseOutProveedores() {
  if (pro===0){
  document.getElementsByClassName('proveedores-nav')[0].style.color = "#8f94a1";
  }
}



function mouseOverPerfil() {
  document.getElementsByClassName('perfil-a')[0].style.color = "#ffff";
}

function mouseOutPerfil() {
  if (UsuarioPerfil===0){
  document.getElementsByClassName('perfil-a')[0].style.color = "#8f94a1";
  }
}


function mouseOverMain() {
  document.getElementsByClassName('main-nav')[0].style.color = "#ffff";
}

function mouseOutMain() {
  if (tab===0){
  document.getElementsByClassName('main-nav')[0].style.color = "#8f94a1";
  }
}
*/