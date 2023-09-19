@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="container d-flex justify-content-between border rounded shadow flex-wrap">
                    <form class="col-4 d-flex flex-column p-3 pt-4" action="{{route('stripe-payment')}}" method="POST" id="payment-form">
                        @csrf
                        <h2>Personal Information</h2>
                        <label for="name" class="mb-2 mt-3">Name</label>
                        <input name="name" id="card-holder-name"
                            type="text"
                            placeholder="Enter Your Name"
                            class="mb-2 rounded-pill p-2 shadow"
                            style="outline: none !important"
                        />
                        <label for="email" class="mb-2">Email</label>
                        <input
                            name="email"
                            type="email"
                            placeholder="Enter Your Email"
                            class="mb-2 rounded-pill p-2 shadow"
                            style="outline: none !important"
                        />
                        <label for="phoneNumber" class="mb-2">Phone Number</label>
                        <input
                            name="phone_number"
                            type="text"
                            placeholder="Enter Your Phone Number"
                            class="mb-2 rounded-pill p-2 shadow"
                            style="outline: none !important"
                        />
                        <input type="hidden" name="payment_token" id="payment_token">
                        <input type="hidden" name="card_last_4_digits" id="card_last_4_digits">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="mt-3">
                            <h2>Order Information</h2>
                            <div class="d-flex flex-column">
                                <label for="phoneNumber" class="mb-2">Order Qunatity</label>
                                <input name="qty" type="number" value="1" min="1"
                                placeholder="Put quantity you want to order"
                                class="mb-2 rounded-pill p-2 shadow"
                                style="outline: none !important"
                                />
                            </div>
                        </div>
                        <div class="mt-3">
                            <h2>Card Information</h2>
                            <div id="card-element" class="mt-3"></div>
                            <button class="btn w-25 rounded btn-primary mt-5 rounded-pill" id="card-button" type="button">
                            Pay
                            </button>
                        </div>
                    </form>
                    <div class="col-4 d-flex flex-column p-3 pt-4">
                    <h2>Product Information</h2>
                    <img src="{{Vite::asset('resources/images/p_1.png')}}" alt="" class="h-50 rounded mt-3" />
                    <h6 class="mt-3">Name : {{$product->name}}</h6>
                    <h6 class="mt-3">Price : {{$product->price}} {{$product->currency}}</h6>
                    <h6 class="mt-3">Type : {{$product->type}}</h6>
                    </div>
                </div>
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
            alert('Card verification failed.');
        } else {
            // The card has been verified successfully...
                alert('Card has been varified.proceeding to payment');
                document.getElementById('payment_token').value =paymentMethod.id;
                document.getElementById('card_last_4_digits').value =paymentMethod.card.last4;
                document.getElementById("payment-form").submit();
        }
    });
</script>
@endsection