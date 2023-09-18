<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('stripe-payment')}}" method="post">

        <!-- Stripe Elements Placeholder -->
        <div class="card col-md-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input id="card-holder-name" class="form-control" type="text" name="name">
            </div>
            <div class="form-group">
                <label for="name">email</label>
                <input type="email" name="email">
            </div>
            <div class="form-group">
                <label for="name">Phone number</label>
                <input type="number" name="phone_number">
            </div>
            <input type="hidden" name="payment_token" id="payment_token">
            
            <div id="card-element" class="col-md-2"></div>
            
            <button id="card-button">
                Process Payment
            </button>
        </div>
    </form>
</body>
</html>
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
        }
    });
</script>