@extends('layouts.master')

@section('content')
    <!-- Slider Area -->
    <section class="welcome-area">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="slider-img slider-bg-1"></div>
                    <div class="carousel-caption">
                        <h2>{{ __('Book of Love') }}</h2>
                        <p class="d-none d-md-block">{{ __('Let us bring to the world of love') }}</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slider-img slider-bg-2"></div>
                    <div class="carousel-caption">
                        <h2>{{ __('Books of Sacrifice') }}</h2>
                        <p class="d-none d-md-block">{{ __('Let us bring to the world of Sacrifice') }}</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slider-img slider-bg-3"></div>
                    <div class="carousel-caption">
                        <h2>{{ __('Books of Wisdom') }}</h2>
                        <p class="d-none d-md-block">{{ __('Let us bring to the world of Wisdom') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main-content">
        <div class="container">
            <div class="row">
                <!-- Sidebar Content -->
                @include('layouts.includes.side-bar')
                <!-- //Sidebar End -->
                <div class="col-md-8">
                    <div class="content-area">
                        <div class="card my-4">
                            <div class="card-header blue-dark">
                                <h4><a href="{{route('category', 'engineering')}}" class="text-white">{{ __('Pack1 Books') }}</a></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if(! $pack1_books->count())
                                       <div class="alert alert-warning">No books availble</div>
                                    @else
                                        @foreach($pack1_books as $book)
                                            <div class="col-lg-3 col-6">
                                                <div class="book-wrap">
                                                    <div class="book-image mb-2">
                                                        <a href="{{route('book-details', $book->id)}}"><img src="{{$book->image_url}}" alt=""></a>
                                                        @if($book->discount_rate)
                                                            <h6><span class="badge badge-warning discount-tag">Discount {{$book->discount_rate}}%</span></h6>
                                                        @endif
                                                    </div>
                                                    <div class="book-title mb-2">
                                                        <a href="{{route('book-details', $book->id)}}">{{str_limit($book->title, 30)}}</a>
                                                    </div>
                                                    <div class="book-author mb-2">
                                                        <small>{{ __('By') }} <a href="{{route('author', $book->author->slug)}}">{{$book->author->name}}</a></small>
                                                    </div>
                                                    <div class="pbook-price mb-3">
                                                        @if($book->discount_rate)
                                                            <span class="line-through mr-3">&#x20AC;{{$book->init_price}}</span>
                                                        @endif
                                                        <span class=""><strong>&#x20AC;{{$book->price}}</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="show-more pt-2 text-right">
                                    <a href="{{route('category', 'engineering')}}" class="text-secondary">{{ __('See More') }} <i class="fas fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card my-4">
                            <div class="card-header blue-dark">
                                <h4><a href="{{route('category', 'literature')}}" class="text-white">{{ __('Pack2 Books') }}</a></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if(! $pack2_books->count())
                                        <div class="alert alert-warning">No books availble</div>
                                    @else
                                        @foreach($pack2_books as $book)
                                            <div class="col-lg-3 col-6">
                                                <div class="book-wrap">
                                                    <div class="book-image mb-2">
                                                        <a href="{{route('book-details', $book->id)}}"><img src="{{$book->image_url}}" alt=""></a>
                                                        @if($book->discount_rate)
                                                            <h6><span class="badge badge-warning discount-tag">Discount {{$book->discount_rate}}%</span></h6>
                                                        @endif
                                                    </div>
                                                    <div class="book-title mb-2">
                                                        <a href="{{route('book-details', $book->id)}}">{{str_limit($book->title, 30)}}</a>
                                                    </div>
                                                    <div class="book-author mb-2">
                                                        <small>{{ __('By') }} <a href="{{route('author', $book->author->slug)}}">{{$book->author->name}}</a></small>
                                                    </div>
                                                    <div class="pbook-price mb-3">
                                                        @if($book->discount_rate)
                                                            <span class="line-through mr-3">&#x20AC;{{$book->init_price}}</span>
                                                        @endif
                                                        <span class=""><strong>&#x20AC;{{$book->price}}</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="show-more pt-2 text-right">
                                    <a href="{{route('category', 'literature')}}" class="text-secondary">{{ __('See More') }} <i class="fas fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="discount-book mb-5" id="discount-books">
        <div class="container">
            <div class="card mb-10">
                <div class="card-header blue-dark text-white">
                    <h4><a href="{{route('discount-books')}}" class="text-white">{{ __('Discount Book') }}</a></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(! $discount_books->count())
                            <div class="alert alert-warning">No books available</div>
                        @else
                            @foreach($discount_books as $book)
                                <div class="col-lg-2 col-6">
                                    <div class="book-wrap">
                                        <div class="book-image mb-2">
                                            <a href="{{route('book-details', $book->id)}}"><img src="{{$book->image_url}}" alt=""></a>
                                            @if($book->discount_rate)
                                                <h6><span class="badge badge-warning discount-tag">Discount {{$book->discount_rate}}%</span></h6>
                                            @endif
                                        </div>
                                        <div class="book-title mb-2">
                                            <a href="{{route('book-details', $book->id)}}">{{str_limit($book->title, 30)}}</a>
                                        </div>
                                        <div class="book-author mb-2">
                                            <small>{{ __('By') }} <a href="{{route('author', $book->author->slug)}}">{{$book->author->name}}</a></small>
                                        </div>
                                        <div class="pbook-price mb-3">
                                            @if($book->discount_rate)
                                                <span class="line-through mr-3">&#x20AC;{{$book->init_price}}</span>
                                            @endif
                                            <span class=""><strong>&#x20AC;{{$book->price}}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="show-more pt-2 text-right">
                        <a href="{{route('discount-books')}}" class="text-secondary">{{ __('See More') }} <i class="fas fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
