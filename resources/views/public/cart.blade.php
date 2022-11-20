@extends('layouts.master')
@section('title')
{{ __('Books4All') }} - {{ __('Cart page') }}
@endsection

@section('content')
    <div class="container">
        <div class="card my-4">
            <div class="card-header blue-dark text-white">
                <h4><i class="fas fa-shopping-cart"></i> {{ __('Shopping cart') }}</h4>
            </div>
            <div class="card-body">
                @include('layouts.includes.flash-message')
                @if(Cart::content()->count())
                <table class="table table-borderless">
                <thead class="bg-light">
                <tr>
                  <th></th>
                  <th scope="col">{{ __('Image') }}</th>
                  <th scope="col">{{ __('Title') }}</th>
                  <th scope="col">{{ __('Price') }}</th>
                  <th scope="col" width="100">{{ __('Quantity') }}</th>
                  <th scope="col">{{ __('Sub total') }}</th>
                </tr>
                </thead>
                    @foreach(Cart::content() as $item)
                    <tbody>
                    <tr class="border-bottom">
                      <td><a href="{{route('cart.delete' ,['id' => $item->rowId])}}" class="text-danger" title="Remove cart item"><i class="fas fa-times"></i></a></td>

                      <td><img src="{{asset('assets/img/'.$item->options->image->file)}}" alt="" width="50"></td>

                      <td>{{$item->name}}</td>

                      <td>&#x20AC;{{$item->price}}</td>

                      <td>
                        <span class="quantity-input mr-2 mb-2 d-flex flex-row">
                            <a href="{{route('cart.decrement', ['id' => $item->rowId, 'qty' => $item->qty])}}" class="cart-minus">-</a>
                             <input title="QTY" name="quantity" type="text" value="{{$item->qty}}" class="qty-text">
                            <a href="{{route('cart.increment', ['id' => $item->rowId, 'qty' => $item->qty, 'book_id'=> $item->id])}}" class="cart-plus">+</a>
                        </span>
                      </td>

                      <td>&#x20AC;{{$item->subtotal()}}</td>
                    </tr>
                    </tbody>
                    @endforeach
                <tbody>
                    <tr>
                        <td colspan="4"><a href="{{route('all-books')}}" class="text-primary">{{ __('Continue shopping') }}</a></td>
                        <td><strong>{{ __('Total') }}</strong></td>
                        <td>&#x20AC;{{Cart::total()}}</td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2">
                            <a href="{{route('cart.checkout')}}" class="btn btn-outline-danger btn-sm">{{ __('Checkout') }} <i class="fas fa-long-arrow-alt-right"></i></a>
                        </td>
                    </tr>
                </tbody>
                </table>
                @else
                    <div class="alert alert-warning">{{ __('No item found in cart') }}. <a href="{{route('all-books')}}"> {{ __('Continue shopping') }}</a></div>
                @endif
            </div>
        </div>
    </div>
@endsection
