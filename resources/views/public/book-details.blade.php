@extends('layouts.master')

@section('title')
{{ __('Books4All') }} - {{ __('Book Details') }}
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('/')}}assets/css/book-detail.css">
    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="content-area">
                        <div class="card my-4">
                            <div class="card-header blue-dark">
                                <h4 class="text-white">{{ __('Book Details') }}</h4>
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
                                            {{ __('By') }} <a href="{{route('author', $book->author->slug)}}">{{$book->author->name}}</a>
                                        </div>
                                        @if(($book->quantity) > 1)
                                            <div class="badge badge-success mb-2">{{ __('In Stock') }}</div>
                                        @else
                                            <div class="badge badge-danger mb-2">{{ __('out of Stock') }}</div>
                                        @endif
                                        @if($book->discount_rate)
                                            <h6><span class="badge badge-warning">{{$book->discount_rate}}% {{ __('Discount') }}</span></h6>
                                        @endif
                                        <div class="book-price mb-2">
                                            <span class="mr-1">{{ __('Price') }}</span>
                                            @if($book->discount_rate)
                                                <span></span><strong class="line-through">&#x20AC;{{$book->init_price}}</strong>
                                            @endif
                                                <span>{{ __('now') }} </span><strong>&#x20AC;{{$book->price}}</strong>
                                            @if($book->discount_rate)
                                                <div><strong class="text-danger">{{ __('Save') }} &#x20AC;{{$book->init_price - $book->price}}</strong></div>
                                            @endif
                                        </div>
                                        <div class="book-category mb-2 py-1 d-flex flex-row border-top border-bottom">
                                            <a href="{{route('category', $book->category->slug)}}" class="mr-4"><i class="fas fa-folder"></i> {{$book->category->name}}</a>
                                            <a href="#review-section" class="mr-4"><i class="fas fa-comments"></i> {{ __('Reviews') }}</a>
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

                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-shopping-cart"></i> {{ __('Add to cart') }}</button>
                                            </div>
                                        </form>
                                        @include('layouts.includes.flash-message')
                                        
                                        @if(Auth::check() == false)
                                        <a href="{{url('login')}}" class="btn btn-danger btn-lg" >{{ __('Please login to read book') }}</a>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="book-description p-3">
                                        <p>{!! Markdown::convertToHtml(e($book->description)) !!}</p>
                                    </div>
                                </div>
                                </div>
                                </div>
                                        @else
                                        <input type="hidden" value="{{Auth::user()->id}}" id="user_id">
                                        <input type="hidden" value="{{$book->id}}" id="book_id">
                                        @if(count($book->readstates) == 0)
                                        <button id="purchase_bt" class="btn btn-success btn-sm" onclick="select_purchasing_method()">{{ __('Read this book') }}</button>
                                        <div class="row" id="hidden_purchasing_method">
                                            <button id="buy_directly" class="btn btn-success btn-sm" onclick="buy_directly()">{{ __('Read directly') }}</button>
                                            <button id="buy_by_time" class="btn btn-success btn-sm" onclick="buy_by_time()">{{ __('Read by time') }}</button>
                                        </div>
                                        <div class="row" id="hidden_down_bt">
                                            <a href="{{asset($pdf_file_url->pdf_file)}}" class="btn btn-success btn-sm" download style="max-width: 130px; width: 100%"><i class="fas fa-download"></i></a>
                                        </div>
                                        <div class="row" id="hidden_starting_time_bt">
                                            <input type="number" value="1" id="duration_time"> {{ __('minutes') }}
                                            <button id="duration_apply" class="btn btn-danger btn-sm" onclick="select_duration()">{{ __('Apply') }}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="book-description p-3" id="book_description">
                                        <p>{!! Markdown::convertToHtml(e($book->description)) !!}</p>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-4" id="pdf_file">
                                    <iframe id="pdf_viewer" src="{{asset($pdf_file_url->pdf_file)}}#toolbar=0" width="98%" height="600" allowfullscreen="true">
                                            This browser does not support PDFs. Please download the PDF to view it: <a href="{{asset($pdf_file_url->pdf_file)}}">Download PDF</a>
                                    </iframe>
                                </div>
                            </div>
                            <div id="time_limit">Permission closes in <span id="time">00:00</span> minutes!</div>
                        </div>
                                        @else

                                        @if($book->readstates[0]->state == 1)
                                        
                                        @if($book->readstates[0]->user_id == Auth::user()->id)
                                        <div class="row">
                                            <a href="{{asset($pdf_file_url->pdf_file)}}" class="btn btn-success btn-sm" download style="max-width: 130px; width: 100%"><i class="fas fa-download"></i></a>
                                        </div>
                                        </div>
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <iframe id="pdf_viewer" src="{{asset($pdf_file_url->pdf_file)}}#toolbar=0" width="98%" height="600" allowfullscreen="true">
                                            This browser does not support PDFs. Please download the PDF to view it: <a href="{{asset($pdf_file_url->pdf_file)}}">Download PDF</a>
                                    </iframe>
                                </div>
                            </div>
                            </div>
                                        @else
                                        <button id="purchase_bt" class="btn btn-success btn-sm" onclick="select_purchasing_method()">Read this book</button>
                                        <div class="row" id="hidden_purchasing_method">
                                            <button id="buy_directly" class="btn btn-success btn-sm" onclick="buy_directly()">Read directly</button>
                                            <button id="buy_by_time" class="btn btn-success btn-sm" onclick="buy_by_time()">Read by time</button>
                                        </div>
                                        <div class="row" id="hidden_down_bt">
                                            <a href="{{asset($pdf_file_url->pdf_file)}}" class="btn btn-success btn-sm" download style="max-width: 130px; width: 100%"><i class="fas fa-download"></i></a>
                                        </div>
                                        <div class="row" id="hidden_starting_time_bt">
                                            <input type="number" value="1" id="duration_time"> minutes
                                            <button id="duration_apply" class="btn btn-danger btn-sm" onclick="select_duration()">Apply</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="book-description p-3" id="book_description">
                                        <p>{!! Markdown::convertToHtml(e($book->description)) !!}</p>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-4" id="pdf_file">
                                    <iframe id="pdf_viewer" src="{{asset($pdf_file_url->pdf_file)}}#toolbar=0" width="98%" height="600" allowfullscreen="true">
                                            This browser does not support PDFs. Please download the PDF to view it: <a href="{{asset($pdf_file_url->pdf_file)}}">Download PDF</a>
                                    </iframe>
                                </div>
                            </div>
                            <div id="time_limit">Permission closes in <span id="time">00:00</span> minutes!</div>
                        </div>
                                        @endif

                                        @elseif($book->readstates[0]->state == 3)
                                        <button id="continue_bt" class="btn btn-success btn-sm" onclick="select_continue_method()">Continue</button>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-4" id="pdf_file">
                                    <iframe id="pdf_viewer" src="{{asset($pdf_file_url->pdf_file)}}#toolbar=0" width="98%" height="600" allowfullscreen="true">
                                            This browser does not support PDFs. Please download the PDF to view it: <a href="{{asset($pdf_file_url->pdf_file)}}">Download PDF</a>
                                    </iframe>
                                </div>
                            </div>
                            <div id="time_limit">Permission closes in <span id="time">{{$book->readstates[0]->remain_min}}:{{$book->readstates[0]->remain_sec}}</span> minutes!</div>
                        </div>
                                        @else
                                        <button id="purchase_bt" class="btn btn-success btn-sm" onclick="select_purchasing_method()">Read this book</button>
                                        <div class="row" id="hidden_purchasing_method">
                                            <button id="buy_directly" class="btn btn-success btn-sm" onclick="buy_directly()">Read directly</button>
                                            <button id="buy_by_time" class="btn btn-success btn-sm" onclick="buy_by_time()">Read by time</button>
                                        </div>
                                        <div class="row" id="hidden_down_bt">
                                            <a href="{{asset($pdf_file_url->pdf_file)}}" class="btn btn-success btn-sm" download style="max-width: 130px; width: 100%"><i class="fas fa-download"></i></a>
                                        </div>
                                        <div class="row" id="hidden_starting_time_bt">
                                            <input type="number" value="1" id="duration_time"> minutes
                                            <button id="duration_apply" class="btn btn-danger btn-sm" onclick="select_duration()">Apply</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="book-description p-3" id="book_description">
                                        <p>{!! Markdown::convertToHtml(e($book->description)) !!}</p>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-4" id="pdf_file">
                                    <iframe id="pdf_viewer" src="{{asset($pdf_file_url->pdf_file)}}#toolbar=0" width="98%" height="600" allowfullscreen="true">
                                            This browser does not support PDFs. Please download the PDF to view it: <a href="{{asset($pdf_file_url->pdf_file)}}">Download PDF</a>
                                    </iframe>
                                </div>
                            </div>
                            <div id="time_limit">Permission closes in <span id="time">00:00</span> minutes!</div>
                        </div>
                                        @endif
                            @endif
                        @endif
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
        var other_link_state = false;
        
        function select_continue_method() {
            document.getElementById("continue_bt").style.display = "none";
            document.getElementById("pdf_file").style.display = "block";
            document.getElementById("time_limit").style.display = "block";

            var ob_1 = document.getElementById('pdf_file');
            var ob_2 = document.getElementById('time_limit');
            var ob_3 = document.getElementById('book_description');

            var present_remain_time = document.getElementById("time").innerHTML;
            var present_display = document.getElementById("time");
            var present_min = parseInt(present_remain_time.split(":")[0]);
            var present_sec = parseInt(present_remain_time.split(":")[1]);
            var present_time = 60 * present_min;
            var set_flag = 0;
            
            if(set_flag == 0){

                setInterval(function () {
                    present_min = parseInt(present_time / 60, 10);
                    present_sec = parseInt(present_time % 60, 10);
                    
                    present_display.textContent = present_min + ":" + present_sec;

                    setTimeout(sendTime, 1000);
                    console.log(present_time);
                    
                    if (--present_time < 0) {
                        set_flag == 1;
                        ob_1.style.display = "none";
                        ob_2.style.display = "none";
                        // ob_3.style.display = "block";
                        window.location.reload();
                    }

                }, 1000);
            }
        }

        function select_purchasing_method() {
            window.location.assign("https://whmcs.books4all.it/whmcs/index.php/store/ebooks");
        }

        function buy_by_time() {
            document.getElementById("hidden_starting_time_bt").style.display = "block";
            document.getElementById("hidden_purchasing_method").style.display = "none";
            document.getElementById("hidden_down_bt").style.display = "none";

           
        }

        function buy_directly() {
            
            // document.getElementById("hidden_down_bt").style.paddingLeft = "13px";

            // console.log(user_remain_id);
            $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            $.ajax({
                url: "{{ url('/book/read') }}",
                method: 'post',
                data: {
                    user: jQuery('#user_id').val(),
                    book: jQuery('#book_id').val(),
                    state: 1
                },
                success: function(result){
                    console.log(result);
                    if(result['success'] != 'success')
                        return;
                    document.getElementById("pdf_file").style.display = "block";
                    document.getElementById("hidden_purchasing_method").style.display = "none";
                    document.getElementById("hidden_down_bt").style.display = "block";
                    document.getElementById("book_description").style.display = "none";
                }
            });
        }

        function select_duration() {
            var final_sel_time = document.getElementById("duration_time").value;
            // console.log(final_sel_time);
            var final_minutes = parseInt(final_sel_time); 
            var Minutes = 60 * parseInt(final_sel_time),
                display = document.querySelector('#time'),
                ob1 = document.querySelector('#pdf_file'),
                ob2 = document.querySelector('#time_limit');
                ob3 = document.querySelector('#book_description');
            var duration_time = 0;
            var temp_src = document.getElementById("pdf_viewer").src;
            document.getElementById("pdf_viewer").src = temp_src;
            if(document.getElementById("duration_time").value == '') {
                alert("Input empty field!");
            }
            else {
                

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/book/duration') }}",
                    method: 'post',
                    data: {
                        user: jQuery('#user_id').val(),
                        book: jQuery('#book_id').val(),
                        state: 2,
                        time: final_minutes
                    },
                    success: function(result){
                        if(result['success'] != 'success')
                            return;
                        document.getElementById("hidden_starting_time_bt").style.display = "none";
                        document.getElementById("pdf_file").style.display = "block";          
                        document.getElementById("time_limit").style.display = "block";
                        document.getElementById("book_description").style.display = "none";
                        startTimer(Minutes, display, ob1, ob2, ob3);
                        console.log(result);
                    }

                });
            }
        }
        
        function startTimer(duration, display, ob1, ob2, ob3) {
            var limit_time = parseInt(document.getElementById("duration_time").value);
            // console.log(duration);
            var flag = 0;
            var timer = duration, minutes, seconds;
            var remain_time_int;
            if(other_link_state == false){
                
                setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                
                remain_time_int = minutes;

                // minutes = minutes < 10 ? "0" + minutes : minutes;
                // seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                setTimeout(sendTime, 1000);

                if(flag == 0){
                    if (--timer < 0) {
                        flag == 1;
                        ob1.style.display = "none";
                        ob2.style.display = "none";
                        ob3.style.display = "block";
                        window.location.reload();
                    }
                }
            }, 1000);
            }            
        }

        function sendTime() {
            // var limit_time = parseInt(document.getElementById("duration_time").value);
            var remain_time = document.getElementById("time").innerHTML;
            var remain_min = remain_time.split(":")[0];
            var remain_sec = remain_time.split(":")[1];
            // if (remain_min[0] == '0') {
            //     remain_min = remain_min[1];
            // }
            remain_min = parseInt(remain_min);
            remain_sec = parseInt(remain_sec);
            // console.log(limit_time, remain_min, remain_sec);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/book/remain') }}",
                method: 'post',
                data: {
                    user: jQuery('#user_id').val(),
                    book: jQuery('#book_id').val(),
                    state: 3,
                    // limit_time: limit_time,
                    remain_min: remain_min,
                    remain_sec: remain_sec
                },
                success: function(result){
                    console.log(result);
                }

            });


            
        }

        // window.onload = function () {
        //     var final_sel_time = document.getElementById("duration_time").value;
        //     console.log(final_sel_time);
        //     var Minutes = 60 * parseInt(final_sel_time),
        //         display = document.querySelector('#time'),
        //         ob1 = document.querySelector('#pdf_file'),
        //         ob2 = document.querySelector('#time_limit');
        //         ob3 = document.querySelector('#book_description');
        //     startTimer(Minutes, display, ob1, ob2, ob3);
        // };
        
        // $("a").click(function() {
        //     alert('asdasdasd');
        //     // if (isInDiscount) {
        //             e.preventDefault()
        //             // console.log("that's right!");
        //             // window.location.href = e.href;
        //         // }
        //     });
        

    </script>
@endsection
