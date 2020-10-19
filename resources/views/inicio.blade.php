@extends('layouts.menuGestor')

@section('importOwl')
<script language="JavaScript">
  function mueveReloj(){
  momentoActual = new Date()
  hora = momentoActual.getHours()
  minuto = momentoActual.getMinutes()
  segundo = momentoActual.getSeconds()
  if(hora<10) hora="0"+hora;
  if(minuto<10) minuto="0"+minuto;
  if(segundo<10) segundo="0"+segundo;
  horaImprimible = hora + " : " + minuto + " : " + segundo

  document.form_reloj.reloj.value = horaImprimible

  setTimeout("mueveReloj()",1000)
  }
  </script> 
@endsection

@section('codigoBody')
    onload="mueveReloj()"
@endsection

@section('menu')
    Inicio
@endsection

@section('generarReporte')
  {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a> --}}
@endsection

@section('contenido')

<div class="card shadow mb-4" style="width:80%; margin-left:auto; margin-right:auto" >
  <div class="card-header py-3 txt-bienvenido">
      <h6 style="color:#181A2C">Bienvenido de nuevo {{auth()->user()->name}}</h6>
  </div>
  <div class="card-body img-fluid body_Inicio">
    <p style="width: 100%">La fecha de hoy es: <?php echo date("d/m/Y"); ?></p>
    <form name="form_reloj" style="width: 100%">
      @csrf
      <input class="reloj" style="outline: none" type="text" name="reloj" readonly class="camposNR" > 
    </form> 
  </div>
</div>
  <div id="link_cerrar">
      <a class="dropdown-item cerrar" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Cerrar sesión
      </a>
  </div>
@endsection