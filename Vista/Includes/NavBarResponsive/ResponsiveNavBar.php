
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nav Bar del Perfil</title>

    <!--font awesome-->
    <link href='<?php echo $GLOBALS['ROOT_PATH'] ?>/css/all.min.css' rel='stylesheet'>


    <!--css file-->
    <link rel="stylesheet" href="ResponsiveNavBar.css" />
    <script link='../../Controlador/modulo.js'></script>
  </head>
  <body>

    <style>
      /* Created by Tivotal */

/* Google fonts(Poppins) */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 260px;
  background:#d75687;
  z-index: 100;
  transition: all 0.5s ease;
}

.sidebar.close {
  width: 78px;
}

.sidebar.close:hover {
  width: 260px;
}

.sidebar .logo {
  height: 60px;
  display: flex;
  width: 100%;
  align-items: center;
}

.sidebar .logo i {
  font-size: 30px;
  color: #fff;
  height: 50px;
  min-width: 78px;
  text-align: center;
  line-height: 50px;
}

.sidebar .logo .logo-name {
  font-size: 22px;
  color: #fff;
  font-weight: 600;
  transition: all 0.3s ease;
  transition-delay: 0.1s;
}

.sidebar.close .logo .logo-name {
  opacity: 0;
  pointer-events: none;
}

.sidebar .nav-list {
  height: 100%;
  padding: 30px 0 150px 0;
  overflow: auto;
  width: 78px;
}

.sidebar.close .nav-list {
  overflow: visible;
}

.sidebar .nav-list::-webkit-scrollbar {
  display: none;
}

.sidebar .nav-list li {
  position: relative;
  list-style: none;
  transition: all 0.4s ease;
}

.sidebar.close:hover > .nav-list {
  width: auto;
}



.sidebar .nav-list li:hover {
  background-color: #a32755
}

.sidebar .nav-list li .icon-link {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.sidebar.close .nav-list li .icon-link {
  display: block;
  padding: .3rem 1rem;
}

.sidebar .nav-list li i {
  height: 50px;
  min-width: 78px;
  text-align: center;
  line-height: 50px;
  color: #fff;
  font-size: 20px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.sidebar .nav-list li img {
  height: 30px;
  min-width: 40px;
  text-align: center;
  line-height: 50px;
  color: #fff;
  font-size: 20px;
  cursor: pointer;
  transition: all 0.3s ease;
  filter:invert(1);
}


.sidebar.close .nav-list li i.arrow {
  display: none;
}

.sidebar .nav-list li.show i.arrow {
  transform: rotate(-180deg);
}

.sidebar .nav-list li a {
  display: flex;
  align-items: center;
  text-decoration: none;
  gap: 1rem;
}

.sidebar .nav-list li a .link-name {
  color: white;
  font-size: 18px;
  font-weight: 400;
  transition: all 0.4s ease;
  display: none;
  align-items: center;
  text-decoration: none;
}

.sidebar.close .nav-list li a .link-name {
  opacity: 0;
  pointer-events: none;
}



.sidebar .nav-list li .sub-menu {
  padding: 6px 6px 14px 80px;
  margin-top: -10px;
  background: #D12B69;
  display: none;
  transition: all 0.3s ease;
}

.sidebar .nav-list li.show .sub-menu {
  display: block;
}

.sidebar.close .nav-list li .sub-menu {
  position: absolute;
  left: 100%;
  top: -10px;
  margin-top: 0;
  padding: 10px 20px;
  border-radius: 0 6px 6px 0;
  opacity: 0;
  display: block;
  pointer-events: none;
  transition: 0s;
}

.sidebar.close .nav-list li:hover .sub-menu {
  top: 0;
  opacity: 1;
  pointer-events: auto;
  transition: all 0.4s ease;
}

.sidebar .nav-list li .sub-menu a {
  color: #fff;
  font-size: 18px;
  padding: 10px 20px;
  white-space: nowrap;
  opacity: 0.6;
  transition: all 0.3s ease;
}

.sidebar .nav-list li .sub-menu a:hover {
  opacity: 1;
}

.sidebar .nav-list li .sub-menu .link-name {
  display: none;
}

.sidebar.close .nav-list li .sub-menu .link-name {
  font-size: 18px;
  opacity: 1;
  display: block;
}

.sidebar .nav-list li .sub-menu.blank {
  padding: 3px 20px 6px 16px;
  opacity: 0;
  pointer-events: none;
}

.sidebar .nav-list li:hover .sub-menu.blank {
  top: 50%;
  transform: translateY(-50%);
}

.profile-details {
  position: fixed;
  bottom: 0;
  width: 260px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #1d1b31;
  padding: 12px 0;
  transition: all 0.5s ease;
}

.sidebar.close .profile-details {
  background-color: none;
  width: 78px;
}

.profile-details .profile-content {
  display: flex;
  align-items: center;
}

.profile-details .profile-content img {
  height: 51px;
  width: 51px;
  border-radius: 50%;
  object-fit: cover;
  margin: 0 14px 0 12px;
  background-color: #1d1b31;
  transition: all 0.5s ease;
}

.sidebar.close .profile-details .profile-content img {
  padding: 10px;
}

.profile-details .name-job .name,
.profile-details .name-job .job {
  color: #fff;
  font-size: 18px;
  white-space: nowrap;
}

.sidebar.close .profile-details i,
.sidebar.close .profile-details .name-job .name,
.sidebar.close .profile-details .name-job .job {
  opacity: 0;
  pointer-events: none;
}

.profile-details .name-job .job {
  font-size: 12px;
}

.home-section {
  position: relative;
  height: 100vh;
  width: calc(100% - 260px);
  left: 260px;
  background-color: #e4e9f7;
  transition: all 0.5s ease;
}

.sidebar.close ~ .home-section {
  left: 78px;
  width: calc(100% - 78px);
}

.home-section .home-content {
  display: flex;
  height: 60px;
  align-items: center;
}

.home-section .home-content i,
.home-section .home-content .text {
  color: #11101d;
  font-size: 35px;
}

.home-section .home-content i {
  margin: 0 15px;
  cursor: pointer;
}

.home-section .home-content .text {
  white-space: nowrap;
  font-size: 20px;
  font-weight: 600;
}

@media (max-width: 400px) {
  .sidebar.close .nav-list li .sub-menu {
    display: none;
  }

  .sidebar {
    width: 78px;
  }

  .sidebar.close {
    width: 0;
  }

  .home-section {
    left: 78px;
    width: calc(100% - 78px);
    z-index: 100;
  }

  .sidebar.close ~ .home-section {
    width: 100%;
    left: 0;
  }

}
    </style>

    <div class="sidebar close" id="navbar" onmouseover="MostrarElementosPorClase()" onmouseout="OcultarElementosPorClase()" style="opacity: 1; display: grid; ">
      
    <div class="logo">
        <!--<i class="fab fa-trade-federation"></i>-->
        <span class="logo-name">PANADERIA</span>
      </div>

      <ul class="nav-list">
        <li>
        <div class="icon-link">
        <a  onclick="main()">
        <img src="../../Assets/images/inventory/inicio.svg">
            <span class="link-name" id="link-name">Inicio</span>
          </a>
        </div>

         <!-- <ul class="sub-menu blank">
            <li><a href="#" class="link-name">Inicio2</a></li>
          </ul>
        </li>-->

        <li>
          <a href="#">
          <div class="icon-link">
          <img src="../../Assets/images/inventory/productos.png">
            <span class="link-name" id="link-name">Productos</span>
          </a>
          </div>

          <ul class="sub-menu blank">
            <li><a onclick="productos()" id="link-name">Productos a la Venta</a></li>
            <li><a onclick="recetas()"  id="link-name">Recetas</a></li>
          </ul>
        </li>
        <li>
          <div class="icon-link">
            <a onclick="insumos()">
            <img src="../../Assets/images/inventory/insumo.png">
              <span class="link-name" id="link-name">Insumos</span>
            </a>
            <i class="fas fa-caret-down arrow"></i>
          </div>
 <!-- 
          <ul class="sub-menu">
            <li><a href="#" class="link-name">Blog</a></li>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Card Design</a></li>
            <li><a href="#">Form Design</a></li>
          </ul>
        </li>
-->
        <li>
          <a href="#">
          <div class="icon-link">
          <img src="../../Assets/images/inventory/categoria.svg">
            <span class="link-name" id="link-name">Categorias</span>
          </a>
          </div>

          <ul class="sub-menu blank">
            <li><a onclick="categoriaInsumo()" id="link-name">De Insumos</a></li>
            <li><a onclick="categoriaProducto()"  id="link-name">Categoria de Productos</a></li>
          </ul>
        </li>

        <li>
        <div class="icon-link">
          <a href="#">
          <img src="../../Assets/images/inventory/movimientos.svg">
            <span class="link-name" id="link-name">Transacciones</span>
          </a>
        </div>


          <ul class="sub-menu blank">
            <li><a onclick="entrada()" >Entrada Insumos</a></li>
            <li><a onclick="salida()">Fabricar Productos</a></li>

          </ul>
        </li>

        <!--
        <li>
          <div class="icon-link">
            <a href="#">
              <img src="../../Assets/images/inventory/devolucion.svg">
              <span class="link-name" id="link-name">Devoluciones</span>
            </a>
            <i class="fas fa-caret-down arrow"></i>
          </div>

          <ul class="sub-menu">
            <li><a onclick="devolucion_entrada()">Devolver Insumos</a></li>
            <li><a onclick="devolucion_salida()">Devolver Fabricacion</a></li>

          </ul>
        </li>-->

        <li>
        <div class="icon-link">
          <a href="#">
            <img src="../../Assets/images/inventory/personas.svg">
            <span class="link-name" id="link-name">Personas</span>
          </a>
          </div>
          
          <ul class="sub-menu blank">
            <li><a onclick="proveedores()">Proveedores</a></li> 
            <!--<li><a onclick="persona()">Usuarios</a></li>-->
            <!--<li><a >Empleados</a></li>-->
            <li><a onclick="usuario()">Usuarios</a></li>
          </ul>
        </li>

        <li>
        <div class="icon-link">
          <a onclick="ventas()">
          <img src="../../Assets/images/inventory/sell.png">
            <span class="link-name" id="link-name">Ventas</span>
          </a>
          </div>
        </li>

        <li>
        <div class="icon-link">
          <a onclick="reportes()">
          <img src="../../Assets/images/inventory/reporte.svg">
            <span class="link-name" id="link-name">Reportes</span>
          </a>
        </div>

        </li>

        <li>
        <div class="icon-link">
          <a onclick="perfil()">
          <img src="../../Assets/images/inventory/personas.svg">
            <span class="link-name" id="link-name">Perfil</span>
          </a>
        </div>

        </li>


        <li>
        <div class="icon-link">
          <a href="../cerrarSesion.php">
          <img src="../../Assets/images/inventory/logout.svg">
            <span class="link-name" id="link-name">Cerrar Sesion</span>
          </a>
        </div>

        </li>
      </div>
 <!-- 
        <li>
          <div class="profile-details">
            <div class="profile-content">
              <img src="profile.jpg" alt="" />
            </div>

            <div class="name-job">
              <div class="name">Mary Karen</div>
              <div class="job">Web Developer</div>
            </div>
            <i class="fas fa-right-to-bracket"></i>
          </div>
        </li>
      </ul>
    </div>
  -->
 <!-- <div class="home-section">
      <div class="home-content">
        <i class="fas fa-bars"></i>
        <span class="text">Dropdown Sidebar Menu</span>
      </div>
    </div>-->  

    <script>

/* Created by Tivotal */

let docVar = document.getElementsByClassName("link-name");

function MostrarElementosPorClase() {
    const elementos = document.querySelectorAll('.link-name');

        elementos.forEach((elemento) => {
            elemento.style.display = 'contents';
        });
}

function OcultarElementosPorClase() {
    const elementos = document.querySelectorAll('.link-name');

        elementos.forEach((elemento) => {
            elemento.style.display = 'none';
        });
}

let btn = document.querySelector(".fa-bars");
let sidebar = document.querySelector(".sidebar");

btn.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

let arrows = document.querySelectorAll(".arrow");
for (var i = 0; i < arrows.length; i++) {
  arrows[i].addEventListener("click", (e) => {
    let arrowParent = e.target.parentElement.parentElement;

    arrowParent.classList.toggle("show");
  });
}

    </script>
  </body>
</html>
