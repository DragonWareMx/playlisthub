@extends(auth()->check()? 'layouts.menuGestor' : 'layouts.blanco')
@if (auth()->check())
    @section('importOwl')
    @endsection

    @section('menu')
        
    @endsection

    @section('generarReporte')
    {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a> --}}
    @endsection

    @section('contenido')
    <div class="text-center">
        <div style="height: 15vh"></div>
        <p style="margin: 0px auto 0px auto;color:black">ERROR</p>
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Página no encontrada</p>
        <p class="lead text-gray-800 mb-5">Lo sentimos mucho, ve por un café y vuelve a intentarlo mas tarde (aunque esta página nunca va a existir).</p>
      </div>
    @endsection
@else 
 
@endif