@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
    <link rel="stylesheet" type="text/css" href="/css/L.css">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css"> 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <style>
        .results tr[visible='false'],
        .no-result{
        display:none;
        }
        .results tr[visible='true']{
        display:table-row;
        }
        .counter{
        padding:8px; 
        color:#ccc;
        }        
    </style>
@endsection

@section('menu')
     Usuarios registrados 
@endsection

@section('contenido') 

<div class="table-responsive">
    <div class="form-group pull-right">
        <input type="text" class="search form-control" placeholder="¿Qué estás buscando?">
    </div>
    <span class="counter pull-right"></span>
    <table class="table table-hover results">
    <thead>
        <tr>
        <th>Avatar</th>
        <th scope="col" >Nombre</th>
        <th scope="col" >Mail</th>
        <th scope="col" >Tipo</th>
        <th scope="col" >País</th>
        <th scope="col" >Cumpleaños</th>
        <th scope="col" >Sexo</th>
        </tr>
        <tr class="warning no-result">
        <td colspan="7"><i class="fa fa-warning"></i> No result</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th scope="row"> 
                @if ($user->avatar!=null)
                <img class="img_playlist_o" src="{{$user->avatar}}" alt=""> 
                @else
                <img class="img_playlist_o" src="{{asset('img/logos/logo.png')}}" alt=""> 
                @endif
            </th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->type}}</td>
            <td>{{$user->country}}</td>
            <td>{{$user->birth_date}}</td>
            <td>{{$user->genre}}</td>
        </tr>      
        @endforeach
        
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
		  });
});
</script>
@endsection