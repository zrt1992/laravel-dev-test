@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="{{route('stripe-payment')}}" method="POST" id="payment-form">
                @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="card-holder-name" class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label for="name">email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Phone number</label>
                        <input type="number" name="phone_number" class="form-control">
                    </div>
                    <input type="hidden" name="payment_token" id="payment_token">
                    <input type="hidden" name="card_last_4_digits" id="card_last_4_digits">
                    
                    <div id="card-element"></div>
                    
                    <button id="card-button" type="button">
                        Process Payment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
 
<script>
    const stripe = Stripe('pk_test_a9xkxDQl4qDPKHnHfffLCFsh');
 
    const elements = stripe.elements();
    const cardElement = elements.create('card');
 
    cardElement.mount('#card-element');

    // card verification process
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    
    cardButton.addEventListener('click', async (e) => {
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );
    
        if (error) {
            // Display "error.message" to the user...
        } else {
            // The card has been verified successfully...
            console.log(paymentMethod)
            alert(paymentMethod.id)
            document.getElementById('payment_token').value =paymentMethod.id;
            document.getElementById('card_last_4_digits').value =paymentMethod.card.last4;
            document.getElementById("payment-form").submit();
        }
    });
</script>
@endsection