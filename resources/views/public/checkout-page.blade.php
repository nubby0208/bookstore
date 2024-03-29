@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="my-4 p-3 blue-dark text-white card-header"><h4 class="m-0">{{ __('Checkout Page') }}</h4></div>
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-product blue-dark text-white card-header">
                    <h4><a href="{{route('cart')}}" title="Back to cart" class="text-danger"><i class="fas fa-shopping-basket" ></i></a> {{ __('Your orders') }}</h4>
                    <table class="table table-bordered bg-light">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('Book') }}</th>
                            <th scope="col">{{ __('Quantity') }}</th>
                            <th scope="col">{{ __('Price') }}</th>
                            <th scope="col">{{ __('Sub Total') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Cart::content() as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->qty}}</td>
                            <td>&#x20AC;{{$item->price}}</td>
                            <td>&#x20AC;{{$item->subtotal()}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="billing-address my-4">
                    <div class="p-3 bg-light my-4 text-white"><h4 class="m-0">{{ __('Billing address') }}</h4></div>

                    <form action="{{route('cart.proceed')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="shipping_name" class="form-control {{$errors->has('shipping_name')? 'is-invalid' : ''}}" value="{{Auth::user()? Auth::user()->name : ''}}" placeholder="{{ __('Name') }}">

                            @if($errors->has('shipping_name'))
                                <span class="invalid-feedback"><strong>{{$errors->first('shipping_name')}}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" name="mobile_no" class="form-control {{$errors->has('mobile_no') ? 'is-invalid': ''}}" placeholder="{{ __('Mobile number') }}">

                            @if($errors->has('mobile_no'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('mobile_no')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <textarea name="address" class="form-control {{$errors->has('address')? 'is-invalid' : ''}}" placeholder="{{ __('Shipping Address') }}" cols="30" rows="5"></textarea>
                            @if($errors->has('address'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('address')}}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="payment-area my-4 py-5 px-3 bg-light">
                            <input type="submit" value="{{ __('Proceed to payment') }}" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-summary my-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Order summary') }}</h4>
                        </div>
                        <div class="card-body">
                            <p>{{ __('Total products') }} = {{Cart::content()->count()}}</p>
                            <p>{{ __('Product Cost') }} = &#x20AC;{{Cart::total()}}</p>
                            <p>{{ __('Shipping cost') }} = &#x20AC;0.00 </p>
                            <p><strong>{{ __('Total cost') }} = &#x20AC;{{Cart::total()}}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
