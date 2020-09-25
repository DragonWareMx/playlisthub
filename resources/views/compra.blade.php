@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/compra.css">
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('menu')
    Compra
@endsection

@section('contenido')

    {{-- <div class="row row-p" style="display: block;width:350px">
        <label for="card-element">
            <a href="https://stripe.com/mx" target="_blank"><img src="" width="50px" height="50px"></a> Tarjeta de crédito o débito 
        </label>
        <div id="card-element">
          <!-- A Stripe Element will be inserted here. -->
        </div>
    
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div> --}}
    <form action="" id="payment-form" method="POST">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="compra-header">
                    <div style="width: 100%">
                        <a href="" class="logo">
                            <img src="{{ asset('img/logos/logo.png') }}">
                        </a>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="row">
                @if(session('status'))
                <div class="alert alert-danger" role="alert" style="width: 100%">
                    <ul>
                        <li>{{session('status')}}</li>
                    </ul>
                </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger" role="alert" style="width: 100%">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="compra-table">
                    <div class="compra-cell cell-80">
                        <div class="formulario-container">
                            <h1 class="row-m">Información de la tarjeta:</h1>
                        </div>
                        <div class="formulario-container">


                            {{-- CORREO --}}
                            <div class="row row-p">
                                <div class="field">
                                    <input type="text" autocomplete="" id="nombreTarjeta" name="nombreTarjeta" value="" onchange="this.setAttribute('value', this.value);" required>
                                    <label for="nombreTarjeta" id="titularname" title="Nombre en tarjeta" data-title="Nombre en tarjeta"></label>
                                </div>
                            </div>

                            
                            {{-- TEL --}}
                            <div class="row row-p" style="display: block">
                                <label for="card-element">
                                    <a href="https://stripe.com/mx" target="_blank"><img src="{{ asset('img/iconos/stripe-payment-logo.png') }}" width="50px" height="50px"></a> Tarjeta de crédito o débito 
                                </label>
                                <div id="card-element">
                                  <!-- A Stripe Element will be inserted here. -->
                                </div>
                            
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                              </div>
                        </div>
                    </div>


                    <div class="compra-cell cell-20">
                        <div class="compra-container">
                            <h1>Detalles de la compra</h1>
                            @php
                                $total = 0;
                            @endphp
                            {{-- HEADER TABLA --}}
                            <div class="productos-compra">
                                <div class="producto-table">
                                    <div class="producto-row">
                                        <div class="producto-cell imagen-producto">
                                            <p><b></b></p>
                                        </div>
                                        <div class="producto-cell contenido-producto">
                                            <p><b>Cantidad</b></p>
                                        </div>
                                        <div class="producto-cell contenido-producto">
                                            <p><b>Producto</b></p>
                                        </div>
                                        <div class="producto-cell contenido-producto-sm">
                                            <p><b>Subtotal</b></p>
                                        </div>
                                    </div>
                                    {{-- PRODUCTOS --}}
                                        <div class="producto-row">
                                            <div class="producto-cell imagen-producto">
                                                <img src="{{ asset('/img/logos/ico-playlist.png') }}" style="border-radius: 50%;border:1px solid #8177f5; ">
                                            </div>
                                            <div class="producto-cell contenido-producto">
                                                <p>{{ $cantidad }}</p>
                                            </div>
                                            <div class="producto-cell contenido-producto">
                                                <p>Tokens</b></p>
                                            </div>
                                            <div class="producto-cell contenido-producto-sm">
                                                <p>${{ number_format($cantidad*10, 2 , ".", "," ) }}</p>
                                                @php
                                                    $total += $cantidad*10;
                                                @endphp
                                            </div>
                                        </div>
                                </div>

                                {{-- TOTALES --}}
                                <div class="producto-table">
                                    <div class="producto-row">
                                        <div class="totales" id="subtotalHTML" style="display: none;">
                                            <p>Subtotal</p><p id="subtotal">${{ number_format($total, 2 , ".", "," ) }}</p>
                                        </div>
                                        
                                        <div class="totales" id="cuponHTML" style="display: none;">
                                            <p>Cupón de descuento</p><p id="cuponDescuento">${{ number_format(0, 2 , ".", "," ) }}</p>
                                        </div>
                                        <div class="totales">
                                            <p>Total</p><p id="total">${{ number_format($total, 2 , ".", "," ) }} USD</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <input type="submit" value="Realizar compra" class="shrink"> --}}
                            <button type="submit" id="complete-order" class="boton_compra shrink" name="action">Pagar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="libro-regresar">
            
        </div>
    </form>



<script>
    (function(){
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51HHHSrDINHvQO7l2gCKyjrAPWXBfg7kTPQOyvjkmQFbghqNpjucfMqES9L0DuSdhDQT7nXYAQ02j0N4Wa0QeKSzS00CPKytdCO');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Karla", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style,
            hidePostalCode: true
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
        event.preventDefault();

        document.getElementById('complete-order').disabled=true;

        var options = {
            name: document.getElementById('nombreTarjeta').value,
            address_line1: document.getElementById('calle').value+' '+document.getElementById('colonia').value ,
            address_city: document.getElementById('ciudad').value,
            address_state: document.getElementById('estado').value,
            address_zip: document.getElementById('cp').value,

        }

        stripe.createToken(card, options).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                document.getElementById('complete-order').disabled=false;
            } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
            }
        });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
        }
    })();
</script>
@endsection