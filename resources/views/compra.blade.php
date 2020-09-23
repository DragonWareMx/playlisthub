@extends('layouts.menuGestor')

@section('importOwl')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/O.css">
    <link rel="stylesheet" type="text/css" href="/css/A.css">
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('menu')
    Compra
@endsection

@section('contenido')
<div class="div_90_o">
    <div class="row row-p" style="display: block;width:350px">
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