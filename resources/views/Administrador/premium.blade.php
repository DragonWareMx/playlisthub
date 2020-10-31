@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
    <link rel="stylesheet" type="text/css" href="/css/L.css">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css"> 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

@endsection

@section('menu')
     Curadores premium 
@endsection

@section('contenido') 
@if(session('status'))
<div class="alert " style="background-color: rgb(126, 223, 126); color: black" role="alert">
    <ul>
        <li>{{session('status')}}</li>
    </ul>
</div>
@endif

<div class="div_Ajustes">
    <p class="txt-descAjustes">AGREGAR CURADOR PREMIUM</p>
    
    <form action="{{Route('addPrem')}}" style="width:100%;" method="post" enctype="multipart/form-data">
        @csrf
    <div class="div_Ajustes_itemUP">
        <div class="div_Ajustes_name">
        CORREO
        </div>  
        <input type="email" name="correo" class="input_Ajustes_valor" id="correo" placeholder="Ingresa el e-mail del usuario" required>
    </div>
    <div class="div_btnsUpdate">
        <div class="div_contbtns">
            <input class="" type="submit" value="Guardar">
        </div>
    </div>
    </form>
</div>


<div class="div_CabeceraApartado" style="margin-top:40px">
    <div class="div_tituloApartado resize_tituloApartado">
        <p><img class="img_ico_title_o" src="img/iconos/user.png" alt="">&nbsp;&nbsp;Curadores premium activos</p>
    </div>
</div>


<div class="div_90_o">
    <!--tabla curadores premium-->
    @if (sizeOf($users)>0)
    <div class="div_content_o">
        <div class="table_head_o">
            <div class="img_playlist_o_2" style="margin-bottom:0px"></div>
            <div class="txt_row_head_o">NOMBRE</div>
            <div class="txt_row_responsive">NOMBRE</div> 
            <div class="txt_row_head_o">MAIL</div>
            <div class="txt_row_responsive">MAIL</div> 
            <div class="txt_row_head_o">SALDO</div>
            <div class="txt_row_responsive">SALDO</div> 
            <div class="txt_row_head_o">PAYPAL</div>
            <div class="txt_row_responsive">PAYPAL</div> 
            {{-- <div class="txt_row_head_o">GANANCIAS</div>
            <div class="txt_row_responsive">GANANCIAS</div>  --}}
        </div>
    
    <!--estos divs se crean con un foreach-->
    
    @foreach ($users as $user)
    <hr class="hr_100_o">
        <div id="{{$user->id}}" class="table_row_o table_noBorder">
            @if ($user->avatar!=null)
            <img class="img_playlist_o" src="{{$user->avatar}}" alt=""> 
            @else
            <img class="img_playlist_o" src="{{asset('img/logos/logo.png')}}" alt=""> 
            @endif
           
            <p class="p_responsivep">NOMBRE</p>
            <a href="{{$user->avatar}}"  target="_blank" class="txt_row_play_o a_row_play_o"> {{$user->name}} </a> 
            <p class="p_responsivep">MAIL</p>
            <div class="txt_row_play_o">{{$user->email}}</div> 
            <p class="p_responsivep">SALDO</p>
            <div class="txt_row_play_o">
                $ {{$user->saldo}}
            </div>
            <p class="p_responsivep">PAYPAL</p>
            <div class="txt_row_play_o">{{$user->paypal}}</div> 
        </div>
    @endforeach
    
    </div>
    @else 
        <div class="div_error_o">
            <div class="txt_error_o">No hay curadores premium todavía</div>
        </div>
    @endif
</div>


<script>
      var click= false;
      var control;

</script>
@endsection