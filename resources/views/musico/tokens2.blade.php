@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
@endsection

@section('menu')
    Tokensqwerasfdasdcas
@endsection

@section('contenido')
@if(session('status'))
<div class="alert alert-danger" role="alert">
    <ul>
        <li>{{session('status')}}</li>
    </ul>
</div>
@endif
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="div_CabeceraApartado" style="margin-top:40px">
    <div class="div_tituloApartado resize_tituloApartado">
        <p><img class="img_ico_title_o" src="img/iconos/tokens.png" alt="">&nbsp;&nbsp;Tus tokens</p>
    </div>
</div>
<div class="div_90_o">
        
    <div class="ico_title_o">
        <img class="img_ico_title_o" src="img/iconos/buy.png" alt="">
        <div class="p_title_o">&nbsp;&nbsp;Paquetes de tokens disponibles para compra</div>
    </div>
    <hr class="hr_100_o">
    <div class="div_100_o">
        <div class="item_comprar_token">
            <div class="item_token_encabezado">10 TOKENS</div>
            <div class="item_txt_black">$100.00 USD</div>
            <div class="item_txt_black" style="visibility: hidden">Ahorras $0 USD</div>
            <div class="item_txt_gray">Promoción válida hasta la fecha 31-12-2020</div>
            <button  data-pack="0" data-quantity="10" data-total="100" type="button" class="btn_comprar_token" >Comprar</button>
        </div>
        <div class="item_comprar_token">
            <div class="item_token_encabezado">20 TOKENS</div>
            <div class="item_txt_black">$180.00 USD</div>
            <div class="item_txt_black">Ahorras $20.00 USD</div>
            <div class="item_txt_gray">Promoción válida hasta la fecha 31-12-2020</div>
            <button data-pack="1" data-quantity="20" data-total="180"  type="button" class="btn_comprar_token" >Comprar</button>
        </div>
        <div class="item_comprar_token">
            <div class="item_token_encabezado">30 TOKENS</div>
            <div class="item_txt_black">$255.00 USD</div>
            <div class="item_txt_black">Ahorras $45.00 USD</div>
            <div class="item_txt_gray">Promoción válida hasta la fecha 31-12-2020</div>
            <button data-pack="2" data-quantity="30" data-total="270" type="button" class="btn_comprar_token" >Comprar</button>
        </div>
        <div class="item_comprar_token">
            <a href="{{ route('viledruid') }}">ASDIJASOIDHASLKDASJDL</a>
        </div>  
    </div>
</div>


  
<!-- Modal -->
<div id="tvesModal" class="modalContainer">
    <form action="{{ route('payment') }}" method="post" class="modal-content">
        @csrf
        <div class="modal_title_tokens" >Comprar tokens</div>
        <hr class="hr_modal_o">
        <div class="sel_cantidad_tokens">
            <div class="txt_cantidad_modal">Cantidad:</div>
            <input class="modal_token_input" type="number" name="cantidad" value="1" min="1" max="30" id="cantidad" readonly>
        </div> 
        <input type="hidden" id="packID" name="packID"> 
        <div class="txt_modal_izquierda">Seleccionar método de pago:</div>
        <div class="modal_metodos_pago">
            <label>
            <input type="radio" name="paytype" value="stripe" required>
            <img class="modal_img_pago" src="img/iconos/stripe.png">
            </label>
            
            <label>
            <input type="radio" name="paytype" value="paypal">
            <img class="modal_img_pago2" src="img/iconos/paypal.png">
            </label>
        </div>
        <div class="modal_txt_mensaje">
            Mensaje de seguridad de compra o tiempo en lo que tarda en reflejarse, etc lorem ipsum dolor sit amet consectetur adipiscing 
            elit lorem ipsum dolor sit amet consectetur adipiscing elit lorem ipsum dolor sit amet consectetur adipiscing elit lorem ipsum 
            dolor sit amet consectetur adipiscing elit.
        </div>
        <div class="modal_tokens_total" id="precio">Total: $10.00 USD</div>
        <div class="div_tokens_botones">
            <a class="a_cancelarTokens close" style="color: #8177F5 !important;">Cancelar</a>
            <button class="a_comprarTokens" type="submit">Comprar</button>
            
        </div>
    </form>
    
</div>  

<script>
    if(document.getElementsByClassName("btn_comprar_token")){
			var modal = document.getElementById("tvesModal");
			var btn = document.getElementsByClassName("btn_comprar_token");
			var span = document.getElementsByClassName("close")[0];
			var body = document.getElementsByTagName("body")[0];

			span.onclick = function() {
				modal.style.display = "none";

				body.style.position = "inherit";
				body.style.height = "auto";
				body.style.overflow = "visible";
			}

			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";

					body.style.position = "inherit";
					body.style.height = "auto";
					body.style.overflow = "visible";
				}
			}
	}
</script>

<script>
    $(document).ready(function(){
        $('.btn_comprar_token').on('click',function(){
            $('#tvesModal').css({
                "display":"block",
                "height":"100%",
                "overflow":"hidden"
            });
            var boton=$(this);
            var packID=boton.attr('data-pack');
            var quantity=boton.attr('data-quantity');
            var total=boton.attr('data-total');
            $('#cantidad').val(quantity);
            $('#packID').val(packID);
            $('#precio').html('Total: $'+total+'.00 USD');

        });
    });
</script>

{{-- <script>
    $(document).ready(function(){ 
        var ntokens= $('#cantidad').val();
        var preciouni=10;
        
        $('#cantidad').val(ntokens);
        $('#btnminus').on('click',function(){
            if(ntokens!=1){
                ntokens=ntokens-1;
                $('#cantidad').val(ntokens);
                var precio=ntokens*preciouni;
                $('#precio').html('Total: $'+precio+'.00 USD');
            }
        });
        $('#btnplus').on('click',function(){
            if(ntokens!=30){
                ntokens=parseInt(ntokens)+parseInt(1);
                $('#cantidad').val(ntokens);
                var precio=ntokens*preciouni;
                $('#precio').html('Total: $'+precio+'.00 USD');
            }
        });
        $('#cantidad').on('change',function(){
            ntokens= $('#cantidad').val();
            var precio=ntokens*preciouni;
            $('#precio').html('Total: $'+precio+'.00 USD');
        });
    }); 
</script> --}}

<script>
    // https://developer.mozilla.org/en-US/docs/Web/API/Performance/navigation
    if(performance.navigation.type == 2){
        location.reload(true);
    }
</script>
@endsection