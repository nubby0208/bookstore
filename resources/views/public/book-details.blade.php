@extends('layouts.master')

@section('title')
Bookshop - Book details
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('/')}}assets/css/book-detail.css">
    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="content-area">
                        <div class="card my-4">
                            <div class="card-header bg-dark">
                                <h4 class="text-white">Book Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-4">
                                        <div class="book-img-details">
                                            <img src="{{$book->image_url}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="book-title">
                                            <h5>{{$book->title}}</h5>
                                        </div>
                                        <div class="author mb-2">
                                            By <a href="{{route('author', $book->author->slug)}}">{{$book->author->name}}</a>
                                        </div>
                                        @if(($book->quantity) > 1)
                                            <div class="badge badge-success mb-2">In Stock</div>
                                        @else
                                            <div class="badge badge-danger mb-2">out of Stock</div>
                                        @endif
                                        @if($book->discount_rate)
                                            <h6><span class="badge badge-warning">{{$book->discount_rate}}% Discount</span></h6>
                                        @endif
                                        <div class="book-price mb-2">
                                            <span class="mr-1">Price</span>
                                            @if($book->discount_rate)
                                                <span></span><strong class="line-through">&#8369;{{$book->init_price}}</strong>
                                            @endif
                                                <span>now</span><strong>&#8369;{{$book->price}}</strong>
                                            @if($book->discount_rate)
                                                <div><strong class="text-danger">Save &#8369;{{$book->init_price - $book->price}}</strong></div>
                                            @endif
                                        </div>
                                        <div class="book-category mb-2 py-1 d-flex flex-row border-top border-bottom">
                                            <a href="{{route('category', $book->category->slug)}}" class="mr-4"><i class="fas fa-folder"></i> {{$book->category->name}}</a>
                                            <a href="#review-section" class="mr-4"><i class="fas fa-comments"></i> Reviews</a>
                                        </div>

                                        <form action="{{route('cart.add')}}" method="post">
                                            @csrf
                                            <div class="cart">
                                            <span class="quantity-input mr-2 mb-2">
                                                <a href="#" class="cart-minus" id="cart-minus">-</a>
                                                <input title="QTY" name="quantity" type="text" value="1" class="qty-text">
                                                <a href="#" class="cart-plus" id="cart-plus">+</a>
                                            </span>
                                                <input type="hidden" name="book_id" value="{{$book->id}}">

                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-shopping-cart"></i> Add to cart</button>
                                            </div>
                                        </form>
                                        @include('layouts.includes.flash-message')

                                        @if(Auth::check() == false)
                                        <button class="btn btn-danger btn-lg" >Please login to read book</button>
                                        @else
                                        <button id="purchase_bt" class="btn btn-danger btn-lg" onclick="select_purchasing_method()">Read this book</button>
                                        @endif
                                        <div class="row" id="hiden_purchasing_method">
                                            <button id="buy_directly" class="btn btn-danger btn-lg" onclick="buy_directly()">Read directly</button>
                                            <button id="buy_by_time" class="btn btn-danger btn-lg" onclick="buy_by_time()">Read by time</button>
                                        </div>
                                        <div class="row" id="hidden_down_bt">
                                            <a href="{{asset($pdf_file_url->pdf_file)}}" class="btn btn-outline-danger btn-lg" download><i class="fas fa-download"></i></a>
                                        </div>
                                        <div class="row" id="hidden_starting_time_bt">
                                            <input type="number" value="1" id="duration_time"> minutes
                                            <button id="duration_apply" class="btn btn-danger btn-sm" onclick="select_duration()">Apply</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="book-description p-3">
                                        <p>{!! Markdown::convertToHtml(e($book->description)) !!}</p>
                                    </div>
                                </div>
                                <div class="row justify-content-center" id="pdf_file">
                                    <iframe id="pdf_viewer" src="{{asset($pdf_file_url->pdf_file)}}#toolbar=0" width="98%" height="600" allowfullscreen="true">
                                            This browser does not support PDFs. Please download the PDF to view it: <a href="{{asset($pdf_file_url->pdf_file)}}">Download PDF</a>
                                    </iframe>
                                </div>
                            </div>
                            <div id="time_limit">Registration closes in <span id="time">00:00</span> minutes!</div>
                        </div>
                        <div class="card card-body my-4">
                            <div class="author-description d-flex flex-row">
                                <div class="author-img mr-4">
                                    <img src="{{$book->author->image? $book->author->image_url : $book->default_img}}" alt="">
                                </div>
                                <div class="des">
                                    <h5><a href="{{route('author', $book->author->slug)}}">{{$book->author->name}}</a></h5>
                                    <small>
                                        <a href="{{route('author', $book->author->slug)}}">
                                            <i class="fas fa-book"></i>
                                            {{$book->author->books()->count()}}
                                            {{str_plural('Book', $book->author->books()->count())}}
                                        </a>
                                    </small>
                                    <p>{!! Markdown::convertToHtml(e($book->author->bio)) !!}</p>
                                </div>
                            </div>
                        </div>
                        <!-- COMMENTS HERE -->
                        @include('layouts.includes.reviews')
                    </div>
                </div>
                <!-- Sidebar -->
                    @include('layouts.includes.side-bar')
                <!-- Sidebar end -->
            </div>
        </div>
    </section>

    <script>
        function select_purchasing_method() {
            document.getElementById("purchase_bt").style.display = "none";
            document.getElementById("hiden_purchasing_method").style.display = "block";
        }

        function buy_by_time() {
            document.getElementById("hidden_starting_time_bt").style.display = "block";
            document.getElementById("hiden_purchasing_method").style.display = "none";
            document.getElementById("hidden_down_bt").style.display = "none";
        }

        function buy_directly() {
            document.getElementById("pdf_file").style.display = "block";
            document.getElementById("hiden_purchasing_method").style.display = "none";
            document.getElementById("hidden_down_bt").style.display = "block";
        }

        function select_duration() {
            var duration_time = 0;
            var temp_src = document.getElementById("pdf_viewer").src;
            document.getElementById("pdf_viewer").src = temp_src;
            if(document.getElementById("duration_time").value == '') {
                alert("Input empty field!");
            }
            else {
                document.getElementById("hidden_starting_time_bt").style.display = "none";
                document.getElementById("pdf_file").style.display = "block";           
                document.getElementById("time_limit").style.display = "block";
                
            }
        }
        function startTimer(duration, display, ob1, ob2) {
            // console.log(duration);
            var flag = 0;
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;
                if(flag == 0){
                    if (--timer < 0) {
                        flag == 1;
                        ob1.style.display = "none";
                        ob2.style.display = "none";
                    }
                }
            }, 1000);
        }
        window.onload = function () {
            var final_sel_time = document.getElementById("duration_time").value;
            console.log(final_sel_time);
            var Minutes = 60 * parseInt(final_sel_time),
                display = document.querySelector('#time'),
                ob1 = document.querySelector('#pdf_file'),
                ob2 = document.querySelector('#time_limit');
            startTimer(Minutes, display, ob1, ob2);
        };
    </script>
@endsection
