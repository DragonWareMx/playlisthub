<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Inicio | Editorial uno4cinco</title>

  <link rel="icon" href="{{asset('/img/ico/puerta.png')}}" type="image/icon type">


  <!-- Custom fonts for this template-->
  <link href="{{asset('temaGestor/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('temaGestor/css/app.css')}}" rel="stylesheet">

   {{-- JQuery bugeado --}}
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
   {{-- Fuentes--}}
   <link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">

  @yield('importOwl')

</head>

<body id="page-top" @yield('codigoBody')>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/adminuno4cinco" style="background-color:#c96dd8">
        <div class="sidebar-brand-icon" style="margin-left:auto;margin-right:auto ">
          <img src="{{asset('img/logos/logo.png')}}" class="imgMenuGestor" >
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ Request::path() ==  'sgtepetate' ? 'active' : ''  }}">
        <a class="nav-link" href="#">
            <i class="fas fa-home" style="color: black"></i>
          <span>Inicio</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      {{-- <div class="sidebar-heading">
        
      </div> --}}

      <!-- Nav Item - Usuarios Collapse Menu -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLibros" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-book" style="color: black"></i>
          <span>Libros</span>
        </a>
        <div id="collapseLibros" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="#">Ver todo</a> 
              <a class="collapse-item" href="#?clasificacion=Catalogo">Catálogo</a>
              <a class="collapse-item" href="#?clasificacion=145">145</a>
              <a class="collapse-item" href="#">Colecciones</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Acceso directo:</h6>
              <a class="collapse-item" href="#">Agregar libro</a>
            </div>
        </div>
      </li>
      

      <li class="nav-item {{ Request::path() ==  'sgtepetate/perfil' ? 'active' : ''  }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAutores" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-user-edit" style="color: black"></i>
          <span>Autores</span>
        </a>
        <div id="collapseAutores" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="#">uno4cinco</a>
              <a class="collapse-item" href="#">145</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Acceso directo:</h6>
              <a class="collapse-item" href="#">Agregar autor</a>
            </div>
          </div>
      </li>

      <!-- Nav Item - Bitacora Collapse blog -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBitacora" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-pencil-alt" style="color: black"></i>
          <span>Blogs</span>
        </a>
        <div id="collapseBitacora" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">Ver Blogs</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Acceso directo:</h6>
            <a class="collapse-item" href="#">Nuevo Blog</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Bitacora Collapse sliders -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#"  data-toggle="collapse" data-target="#collapseSliders" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-clone" style="color: black"></i>
          <span>Sliders</span>
        </a>
        <div id="collapseSliders" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="#">Ver Sliders</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Categorías:</h6>
            <a class="collapse-item" href="#">Agregar Banner Libro</a>
            <a class="collapse-item" href="#">Agregar Banner Autor</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Inventario Collapse ventas -->
      <li class="nav-item "">
        <a class="nav-link" href="#">
            <i class="fas fa-home" style="color: black"></i>
          <span>Ventas</span></a>
      </li>

       <!-- Nav Item - Inventario Collapse cupones -->
      
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCupones" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-percentage" style="color: black"></i>
          <span>Cupones</span>
        </a>
        <div id="collapseCupones" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">Ver Cupones</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Acceso directo:</h6>
            <a class="collapse-item" href="#">Agregar Cupón</a>
          </div>
        </div>
      </li>
      

      
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item {{ Request::path() ==  'sgtepetate' ? 'active' : ''  }}">
        <a class="nav-link" href="#">
            <i class="fas fa-chart-pie" style="color: black"></i>
          <span>Resumen</span></a>
      </li>

      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="
        background-color: transparent;
    background-image: linear-gradient(70deg, #c96dd8 12%, #3023ae 93%);
        ">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Pancho Pantera</span>
                <img class="img-profile rounded-circle" style="object-fit:cover;" src="{{asset('/img/ico/icons-user.png')}}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                <a class="dropdown-item" href="#">
                  <i class="fas fa-clipboard-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Resumen
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesión
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('menu')</h1>
            @yield('generarReporte')
          </div>

          @yield('contenido')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; uno4cinco 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere salir? </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecciona "Cerrar sesión" si está listo para salir del sistema.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <form action="#" method="POST">
            {{csrf_field()}}
            <button class="btn btn-primary "> Cerrar Sesión</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  {{-- <script src="{{asset('temaGestor/vendor/jquery/jquery.min.js')}}"></script> --}}
  <script src="{{asset('temaGestor/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('temaGestor/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('temaGestor/js/sb-admin-2.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{asset('temaGestor/vendor/chart.js/Chart.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('temaGestor/js/demo/chart-area-demo.js')}}"></script>
  <script src="{{asset('temaGestor/js/demo/chart-pie-demo.js')}}"></script>

  <!-- El de tablas de pedidos-->
  <script src="{{asset('temaGestor/js/demo/datatables-demo.js')}}"></script>
  <script src="{{asset('temaGestor/vendor/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('temaGestor/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src={{asset('temaGestor/jquery/jquery-3.4.1.min.js')}}></script>

</body>

</html>
