<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard | Editorial uno4cinco</title>

  <link rel="icon" href="{{asset('/img/ico/puerta.png')}}" type="image/icon type">


  <!-- Custom fonts for this template-->
  <link href="{{asset('temaGestor/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('temaGestor/css/app.css')}}" rel="stylesheet">

  @yield('importOwl')

</head>

<body id="page-top" @yield('codigoBody')>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/adminuno4cinco">
        <div class="sidebar-brand-icon" style="margin-left:auto;margin-right:auto ">
          <img src="{{asset('img/logos/blancouno4cinco.png')}}" class="imgMenuGestor" style="width: 126px;height: 38px">
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ Request::path() ==  'sgtepetate' ? 'active' : ''  }}">
        <a class="nav-link" href="/sgtepetate">
            <i class="fas fa-home"></i>
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
            <i class="fas fa-book"></i>
          <span>Libros</span>
        </a>
        <div id="collapseLibros" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="/sgtepetate/gestionBitacora">Ver Libros</a>
              <a class="collapse-item" href="/sgtepetate/gestionTareasPendientes">Ver Tareas Pendientes</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Acceso directo:</h6>
              <a class="collapse-item" href="/sgtepetate/gestionBitacora/nuevaBitacora">Registrar Bitácora</a>
            </div>
        </div>
      </li>
      

      <li class="nav-item {{ Request::path() ==  'sgtepetate/perfil' ? 'active' : ''  }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAutores" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-user-edit"></i>
          <span>Autores</span>
        </a>
        <div id="collapseAutores" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="/sgtepetate/gestionBitacora">Ver Autores</a>
              <a class="collapse-item" href="/sgtepetate/gestionTareasPendientes">Ver Tareas Pendientes</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Acceso directo:</h6>
              <a class="collapse-item" href="/sgtepetate/gestionBitacora/nuevaBitacora">Registrar Bitácora</a>
            </div>
          </div>
      </li>

      <!-- Nav Item - Bitacora Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBitacora" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-pencil-alt"></i>
          <span>Blog</span>
        </a>
        <div id="collapseBitacora" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/sgtepetate/gestionBitacora">Ver Bitácora</a>
            <a class="collapse-item" href="/sgtepetate/gestionTareasPendientes">Ver Tareas Pendientes</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Acceso directo:</h6>
            <a class="collapse-item" href="/sgtepetate/gestionBitacora/nuevaBitacora">Registrar Bitácora</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Inventario Collapse Menu -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventario" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-chart-line"></i>
          <span>Ventas</span>
        </a>
        <div id="collapseInventario" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/sgtepetate/inventario">Gestión de Inventario</a>
            <a class="collapse-item" href="/sgtepetate/inventario/todo">Ver todo el Inventario</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Categorías:</h6>
            <a class="collapse-item" href="/sgtepetate/inventario/categoria/1">Alimento</a>
            <a class="collapse-item" href="/sgtepetate/inventario/categoria/2">Medicina</a>
            <a class="collapse-item" href="/sgtepetate/inventario/categoria/3">Productos</a>
          </div>
        </div>
      </li>
      

      
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item {{ Request::path() ==  'sgtepetate' ? 'active' : ''  }}">
        <a class="nav-link" href="/sgtepetate">
            <i class="fas fa-chart-pie"></i>
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
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            

            <!-- Nav Item - Alerts -->
             
            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-counter">1</span>
                {{-- @else 
                <span class="badge badge-danger badge-counter">{{$nnoti}}</span>
                @endif --}}
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in scrollChido" aria-labelledby="alertsDropdown" style="overflow-y: auto;max-height:350px">
                <h6 class="dropdown-header">
                  Notificaciones
                </h6>
                
                <a class="dropdown-item d-flex align-items-center" href="">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-bell-slash text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"></div>
                    <span class="font-weight-bold">No tienes notificaciones!</span>
                  </div>
                </a>
                
                <a class="dropdown-item d-flex align-items-center" href="/sgtepetate/revisarpedido/">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-concierge-bell text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">13/07/2020</div>
                    <span class="font-weight-bold">Nuevo pedido registrado: <br> Orden #1</span>
                  </div>
                </a>
                
              </div>
            </li>
            

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" style="object-fit:cover;" src="{{asset('/storage/images/usuarios_img/')}}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/sgtepetate/perfil">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Perfil
                </a>
                <a class="dropdown-item" href="/sgtepetate/gestionBitacora">
                  <i class="fas fa-clipboard-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Bitacora
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
          <form action="{{route('logout')}}" method="POST">
            {{csrf_field()}}
            <button class="btn btn-primary"> Cerrar Sesión</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('temaGestor/vendor/jquery/jquery.min.js')}}"></script>
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
