@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
    <link rel="stylesheet" type="text/css" href="/css/perfilMusico.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
@endsection

@section('menu')
    Tokens
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
        @foreach ($usuario as $user)
            <div class="div_tokens_o"> {{$user->tokens}}&nbsp;tokens</div>
        @endforeach 
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
            <button  data-pack="0" data-quantity="10" data-total="100" data-ref="90" type="button" class="btn_comprar_token" >Comprar</button>
        </div>
        <div class="item_comprar_token">
            <div class="item_token_encabezado">20 TOKENS</div>
            <div class="item_txt_black">$190.00 USD</div>
            <div class="item_txt_black">Ahorras $10.00 USD</div>
            <div class="item_txt_gray">Promoción válida hasta la fecha 31-12-2020</div>
            <button data-pack="1" data-quantity="20" data-total="190" data-ref="170"  type="button" class="btn_comprar_token" >Comprar</button>
        </div>
        <div class="item_comprar_token">
            <div class="item_token_encabezado">30 TOKENS</div>
            <div class="item_txt_black">$270.00 USD</div>
            <div class="item_txt_black">Ahorras $30.00 USD</div>
            <div class="item_txt_gray">Promoción válida hasta la fecha 31-12-2020</div>
            <button data-pack="2" data-quantity="30" data-total="270" data-ref="240" type="button" class="btn_comprar_token" >Comprar</button>
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
        <div class="txt_modal_izquierda">Ingresa el código de referencia:</div>
        <div class="div_tokens_botones" style="margin-bottom: 10px">
            <input type="text" name="code" id="code" class="modal_token_input" style="border: 1px solid gray;margin: 5px 0px 5px 0px" autocomplete="off">
            <button class="a_comprarTokens" type="button" onclick="comprobar()">Validar</button>      
        </div>
        <input type="hidden" name="descuento" id="descuento" value="">
        <input type="hidden" name="precioRef" id="precioRef" value="">
        <div class="modal_txt_mensaje">
            Para brindarte un mejor servicio y la mayor seguridad, Playlisthub utiliza Paypal y Stripe 
            como plataformas de procesamiento de pago. Si tienes alguna duda al respecto puedes visitar sus 
            sitios oficiales en 
            <a href="https://www.paypal.com/mx/home" target="_blank" style="color: blueviolet">https://www.paypal.com/mx/home</a> y 
            <a href="https://stripe.com/mx" target="_blank" style="color: blueviolet">https://stripe.com/mx</a> 
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
    var cupones=@json($ref);
    function comprobar(){
        var referencia = document.getElementById('code').value;
        var bool=false;
        cupones.forEach(cupon => {
            if(cupon["code"] == referencia){
                bool=true;
            }            
        });
        if(bool){
            var total= document.getElementById('precioRef').value;
            document.getElementById('descuento').value='true';
            var precio = document.getElementById('precio');
            precio.innerHTML= 'Total: $'+total+'.00 USD';
            var campo=document.getElementById('code');
            campo.readOnly=true;
            bootbox.alert("Referencia válida, se te aplicó un descuento del 10% en tu compra.");
        }
        else{

            bootbox.alert("Referencia inválida, por favor prueba con otra.");
        }
    }

</script>

<script>
    $(document).ready(function(){
        $('.btn_comprar_token').on('click',function(){
            $('#tvesModal').css({
                "display":"block"
            });
            $('html, body').css('overflow', 'hidden');
            $('html, body').css('position', 'static');  
            $('html, body').css('height', '100%'); 
            var boton=$(this);
            var packID=boton.attr('data-pack');
            var quantity=boton.attr('data-quantity');
            var total=boton.attr('data-total');
            var totalRef=boton.attr('data-ref');
            $('#precioRef').val(totalRef);
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