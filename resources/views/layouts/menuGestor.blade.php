<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Playlisthub</title>

  <link rel="icon" href="{{asset('/img/logos/ico-playlist.png')}}" type="image/icon type">


  <!-- Custom fonts for this template-->
  <link href="{{asset('temaGestor/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('temaGestor/css/app.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
   {{-- JQuery bugeado --}}
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
   {{-- Fuentes--}}
   <link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">

  @yield('importOwl')

</head>

<body id="page-top" @yield('codigoBody')>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion menu-lateral" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}" style="background-color:#8177F5">
        <div class="sidebar-brand-icon" style="margin-left:auto;margin-right:auto ">
          <img src="{{asset('img/logos/logo.png')}}" class="imgMenuGestor" > 
        </div>
      </a>
      <br>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item 
      @if (Request::path() ==  'inicioM' || Request::path() ==  'inicioC')
          active
      @endif
      " style="margin-top:25px">
        <a class="nav-link" href="{{ route('home') }}">
            <img src="{{ asset('/img/iconos/inicio.png') }}" width="18px" height="19px" >
          <span>Inicio</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
      </li>
      
      <li class="nav-item {{ Request::path() ==  'perfil' ? 'active' : ''  }} ">
        @if (auth()->user()->type == 'Administrador')
        <a class="nav-link" href="{{route('administrar-cuenta')}}">
            <img src="{{ asset('/img/iconos/perfil.png') }}" width="18px" height="19px" >
          <span>Perfil</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
        @else
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLibros" aria-expanded="true" aria-controls="collapsePages">
            <img src="{{ asset('/img/iconos/perfil.png') }}" width="18px" height="18px" >
          <span>Perfil</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
        <div id="collapseLibros" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('perfil')}}">Ver perfil</a> 
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Acceso directo:</h6>
            <a class="collapse-item" href="{{route('administrar-cuenta')}}">Administrar cuenta</a>
            </div>
        </div>
        @endif
      </li>
      
      @if (auth()->user()->type == 'Administrador')
      <li class="nav-item {{ Request::path() ==  'premium' ? 'active' : ''  }} ">
        <a class="nav-link" href="{{route('premium')}}">
            <img src="{{ asset('/img/iconos/reviews.png') }}" width="18px" height="19px" >
          <span>Premium</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
      </li>  

      <li class="nav-item {{ Request::path() ==  'admin/solicitudes' ? 'active' : ''  }} ">
        <a class="nav-link" href="{{route('solicitudes')}}">
            <img src="{{ asset('/img/iconos/ganancias.png') }}" width="18px" height="19px" >
          <span>Solicitudes</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
      </li>  

      <li class="nav-item {{ Request::path() ==  'admin/solicitudes' ? 'active' : ''  }} ">
        <a class="nav-link" href="{{route('usuarios')}}">
            <img src="{{ asset('/img/iconos/user.png') }}" width="18px" height="19px" >
          <span>Usuarios</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
      </li>  
      @endif


      @if (auth()->user()->type == 'Músico')
      <li class="nav-item {{ Request::path() ==  'campanas' ? 'active' : ''  }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAutores" aria-expanded="true" aria-controls="collapsePages">
            <img src="{{ asset('/img/iconos/campanas.png') }}" width="18px" height="18px" >
          <span>Campañas</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
        <div id="collapseAutores" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{ route('campanas') }}">Campañas</a>
            <a class="collapse-item" href="{{route('tokens')}}">Tokens</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Acceso directo:</h6>
            <a class="collapse-item" href="{{route('crearCampana1')}}">Agregar campaña</a>
            </div>
          </div>
      </li>

      <li class="nav-item {{ Request::path() ==  'favoritos' ? 'active' : ''  }}">
        <a class="nav-link" href="{{ route('favoritos') }}">           
            <img src="{{ asset('/img/iconos/fav.png') }}" width="18px" height="18px" >
          <span>Favoritos</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
      </li>

      {{-- REVIEWS --}}
      <li class="nav-item {{ Request::path() ==  'reviews' ? 'active' : ''  }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReviews" aria-expanded="true" aria-controls="collapsePages">
            <img src="{{ asset('/img/iconos/reviews.png') }}" width="18px" height="18px" >
          <span>Reviews</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
        <div id="collapseReviews" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="/reviews">Reviews</a>
              <a class="collapse-item" href="/reviews-pendientes">Reviews Pendientes</a>
              {{-- <a class="collapse-item" href="/reviews-realizar">Realizar Review</a> --}}
              <div class="collapse-divider"></div>
            </div>
          </div>
      </li>

      <li class="nav-item {{ Request::path() ==  'referencias' ? 'active' : ''  }}">
            <a class="nav-link" href="{{route('referencias')}}">
            <img src="{{ asset('/img/iconos/referencias.png') }}" width="18px" height="18px" >
          <span>Referencias</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
      </li>
      @endif

      @if (auth()->user()->type == 'Curador')
      <li class="nav-item {{ Request::path() ==  'playlists' ? 'active' : ''  }}">
        <a class="nav-link collapsed" href="{{route ('playlists')}}">             
            <img src="{{ asset('/img/iconos/playlist.png') }}" width="18px" height="18px" >
            <span>Playlists</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
      </li>

      <li class="nav-item {{ Request::path() ==  'ranking' ? 'active' : ''  }}">
        <a class="nav-link" href="{{ route('ranking') }}">           
            <img src="{{ asset('/img/iconos/ranking.png') }}" width="18px" height="18px" >
          <span>Ranking</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
      </li>
      {{-- GANANCIAS --}}
      <li class="nav-item ">
            <a class="nav-link" href="{{route('ganancias')}}">
            <img src="{{ asset('/img/iconos/ganancias.png') }}" width="18px" height="18px" >
          <span>Ganancias</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
      </li>
      {{-- REVIEWS --}}
      <li class="nav-item {{ Request::path() ==  'reviews' ? 'active' : ''  }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReviews" aria-expanded="true" aria-controls="collapsePages">
            <img src="{{ asset('/img/iconos/reviews.png') }}" width="18px" height="18px" >
          <span>Reviews</span>
        </a>
        <hr class="sidebar-divider barra-active" style="margin-top: 0; margin-bottom: 0;visibility:hidden">
        <div id="collapseReviews" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="/reviews">Reviews</a>
              <a class="collapse-item" href="/reviews-pendientes">Reviews Pendientes</a>
            </div>
          </div>
      </li>
      @endif

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline" style="margin-top: 25px">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

      <br><br><br><br><br><br>
      <li class="nav-item" style="position: relative; bottom: 0px;display:block">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <img src="{{ asset('/img/iconos/salir.png') }}" width="18px" height="18px" >
          <span style="padding-left: 10px">Cerrar Sesión</span>
        </a>
      </li>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="
        background-color: transparent;
    background-image: linear-gradient(70deg, #8177F5 12%, #8177F5 93%);
        ">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto mr-4">

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1"> 
              {{-- <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
                <img src="{{ asset('/img/iconos/whitebell.png') }}" width="20px" height="16px">
                <!-- Counter - Alerts -->
                <span class="badge badge-counter" style="color: white">1</span>
              </a> --}}
              <!-- Dropdown - Alerts -->
              {{-- <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in scrollChido" aria-labelledby="alertsDropdown" style="overflow-y: auto;max-height:350px; ">
                <h6 class="dropdown-header" style="background-color:#181A2C; border:none !important">
                  Notificaciones
                </h6>
                
                <a class="dropdown-item d-flex align-items-center" href="">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-bell-slash text-white" ></i>
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
                </a>
                
              </div> --}}
            </li>
            
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-4 d-none d-lg-inline small username" style="text-align: center; color:white !important"> {{auth()->user()->name}} <br> <strong>{{auth()->user()->type}}</strong> </span>
                <img class="img-profile rounded-circle" style="object-fit:cover;" src="{{auth()->user()->avatar}}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                {{-- <div class="dropdown-divider"></div> --}}
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" style="background-color: rgb(243, 243, 243); color:#5c5c5c">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" ></i>
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
            <span>Copyright &copy; Playlisthub 2020</span>
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
        <div class="modal-body">Selecciona "Cerrar sesión" si está listo para salir de Playlisthub.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal" style="background-color: rgb(129, 129, 129);">Cancelar</button>
          <form action="{{route('logout')}}" method="POST">
            {{csrf_field()}}
            <button class="btn btn-primary " style="background-color: #8177F5; border:none"> Cerrar Sesión</button>
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

</body>

</html>
