@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="payment-area">
            <h4 class="my-4 blue-dark p-3 text-white">{{ __('Make your payment') }}</h4>

            <div class="cart-summary my-3">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Order summary') }}</h4>
                    </div>
                    <div class="card-body">
                        <p>{{ __('Total products') }} = {{Cart::content()->count()}}</p>
                        <p>{{ __('Product Cost') }} = &#x20AC;{{Cart::total()}}</p>
                        <p>{{ __('Shipping cost') }} = &#x20AC;0.00</p>
                        <p><strong>{{ __('Total cost') }} = &#x20AC;{{Cart::total()}}</strong></p>
                    </div>
                </div>
            </div>

            <div class="bg-light p-3 my-4">
                <form action="{{route('cart.checkout')}}" method="post">
                    @csrf
                    <input type="hidden" name="cart_total" value="{{Cart::total()}}">
                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="pk_test_7xVvmxzKaoeFzuBZZ18WdwKy00bmfx80CA"
                            data-amount=""
                            data-name="Books4All"
                            data-description="Books4All"
                            data-locale="auto">
                    </script>
                </form>
            </div>
            <div class="bg-light p-3 my-4">
                <button class="btn btn-success btn-sm"><strong>{{ __('Cash on delivery') }}</strong></button>
            </div>
        </div>
    </div>
@endsection
