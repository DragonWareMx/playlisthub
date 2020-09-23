@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
@endsection

@section('menu')
    Tokens
@endsection

@section('contenido')
<div class="div_90_o">
    <div class="ico_title60_o">
        <img class="img_ico_title_o" src="img/iconos/tokens.png" alt="">
        <div class="p_title_o">&nbsp;&nbsp;Tus Tokens</div>
    </div>
    <button id="btnModal" class="a_agregar_o">
        <img class="img_a_agregar_o" src="img/iconos/plus.png" alt="">
        <div id="btnModal" class="txt_a_o">Comprar</div>
    </button>
    <hr class="hr_100_o">
    <div class="div_tokens_o"> 15 tokens</div>
    <div class="ico_title_o">
        <img class="img_ico_title_o" src="img/iconos/buy.png" alt="">
        <div class="p_title_o">&nbsp;&nbsp;Paquetes de tokens disponibles para compra</div>
    </div>
    <hr class="hr_100_o">
    <div class="div_100_o">
        <div class="item_comprar_token">
            <div class="item_token_encabezado">10 TOKENS</div>
            <div class="item_txt_black">$2375.00 pesos</div>
            <div class="item_txt_black">Ahorras $124.25 pesos</div>
            <div class="item_txt_gray">Promoción válida hasta la fecha 21-08-2020</div>
            <button type="button" class="btn_comprar_token" >Comprar</button>
        </div>
        <div class="item_comprar_token">

        </div>
        <div class="item_comprar_token">

        </div>
        <div class="item_comprar_token">

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
            <button type="button" class="modal_token_boton_cantidad" id="btnminus">-</button>
            <input class="modal_token_input" type="number" name="cantidad" value="1" min="1" max="30" id="cantidad">
            <button type="button" class="modal_token_boton_cantidad" id="btnplus">+</button>
        </div>  
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
    if(document.getElementById("btnModal")){
			var modal = document.getElementById("tvesModal");
			var btn = document.getElementById("btnModal");
			var span = document.getElementsByClassName("close")[0];
			var body = document.getElementsByTagName("body")[0];

			btn.onclick = function() {
				modal.style.display = "block";

				body.style.position = "static";
				body.style.height = "100%";
				body.style.overflow = "hidden";
			}

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
</script>

<script>
    // https://developer.mozilla.org/en-US/docs/Web/API/Performance/navigation
    if(performance.navigation.type == 2){
        location.reload(true);
    }
</script>
@endsection