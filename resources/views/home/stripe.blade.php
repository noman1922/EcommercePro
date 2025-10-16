<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h1 style="text-align: center; font-size: 25px; padding-top: 20px;">Total Amount is ${{$totalprice}}</h1>
        <h1 style="text-align: center; font-size: 25px; padding-top: 20px;">Pay Using Your Card</h1>
        <form action="https://api.stripe.com/v1/charges" method="POST">
            @csrf
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ env('STRIPE_KEY') }}"
                data-amount="{{$totalprice*100}}"
                data-name="Payment"
                data-description="Test payment"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto"
                data-currency="usd">
            </script>
        </form>
    </body>
</html>