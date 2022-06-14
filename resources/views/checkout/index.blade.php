@extends('layouts.master')

@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('extra-script')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
    <div class="col-md-12">
        <h1>Page de paiement</h1>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('checkout.store') }}" method="POST" class="my-4" id="payment-form">
                    @csrf
                    <div id="card-element">
                    <!-- Un element sera créer ici -->
                    </div>
                    <!-- Un message d'erreur sera afficher  ici -->
                    <div id="card-errors" role="alert"></div>
                    <button class="btn btn-success mt-4"id="submit">Procéder au paiement ({{ getPrice($total) }})</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
<script>
    var stripe = Stripe('pk_test_51KwrVAAwbNOpOuKCxhZ2hdUrfcdfhDumIsMD00Bs57lacA9NyDcRoMeaGkwlIvC02NXGrKS2JzO0nCUnlEk5oAVI001P3pULjt');
    var elements = stripe.elements();

    var style = {
        base: {
        color: "#32325d",
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
            color: "#aab7c4"
        }
        },
        invalid: {
        color: "#fa755a",
        iconColor: "#fa755a"
        }
    };
    var card = elements.create("card", {style: style});
    card.mount("#card-element");
    card.addEventListener('change', ({error}) =>{
        const displayError = document.getElementById('card-errors');
        if(error){
            displayError.classList.add('alert', 'alert-danger', 'my-4');
            displayError.textContent = error.message;
        }else{
            displayError.classList.remove('alert', 'alert-danger', 'my-4');
            displayError.textContent = '';
        }
    });

    var submitButton = document.getElementById('submit');

    submitButton.addEventListener('click', function(ev){
        ev.preventDefault();
        submitButton.disabled = true;
        stripe.confirmCardPayment("{{ $clientSecret }}", {
            payment_method:{
                card: card
            }
        }).then(function(result){
            if(result.error){
                submitButton.disabled = false;
                console.log(result.error.message);
            }else{
                //Procède au paiement
                if(result.paymentIntent.status =='succeeded'){
                // Affichera un message de succes!
                // console.log(result.paymentIntent);
                var paymentIntent = result.paymentIntent;
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var form = document.getElementById('payment-form');
                var url = form.action;
                

                fetch(
                    url,
                    {
                        headers:{
                            "Content-Type": "application/json",
                            "accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                        },
                        method: 'post',
                        body: JSON.stringify({
                            paymentIntent: paymentIntent
                        })
                    }
                ).then((data) => {
                    if(data.status == 400){
                        var redirect = '/';
                    }else{
                        var redirect = '/panier/merci';
                    }

                    // console.log(data);
                    // form.reset();
                    window.location.href = redirect;
                }).catch((error) => {
                    console.log(error);
                })
                }
            }
        });
    });
</script>
@endsection