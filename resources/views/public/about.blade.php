@extends('layouts.master')
@section('title')
{{ __('Books4All') }} - {{ __('All books') }}
@endsection
@section('content')

    <section class="about-us">
        <!-- banner starts -->
        <div class="banner" style="position: relative;">
            <img alt="header" class="img-fluid header-lg" src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us-header.png.webp?v=1.0">
            <div class="text-overlay">
            <h1 class="m-0">Delivering Happiness</h1>
            <h1 class="m-0">
                <span class="theme-color font-weight-bold m-0">Worldwide</span>
            </h1>
            </div>
        </div>
        <!-- banner ends -->
        <!-- who we are starts -->
        <section class="who-we-are mt-100">
            <div class="container-fluid ">
            <div class="row justify-content-center align-items-center">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-12">
                <div class="content">
                    <h2 class="h1">About Us</h2>
                    <p>books4all has made its mark in the e-commerce world in 2012, as a cross-border shopping platform serving more than 180 countries.</p>
                    <p>Through its website and app, books4all provides over 100 million brand-new, unique products from the best international brands in the US, the UK, and other countries.</p>
                    <p>books4all enables seamless and confined payment methods as well as faster checkouts while amplifying the shopper's experience. As an International Shopping doorway, we bring quality products from luxury brands to customers' doorsteps from around the world with the assistance of the most trusted courier partners in the industry.</p>
                </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-12">
                <div class="img">
                    <img alt="world map" class="world-map" src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/world-group.png.webp" title="world map">
                </div>
                </div>
            </div>
            </div>
        </section>
        <!-- who we are ends -->
        <!-- ubuy-journey starts -->
        <section class="ubuy-rising mt-100 ">
            <div class="container-fluid">
            <h2 class="h1 text-center">books4all’s Journey</h2>
            <div class="points text-center">
                <div class="points-image web-view">
                <div class="row">
                    <div class="col-lg-2 col-md-2 for-col-5">
                    <div class="number number-1">
                        <img alt="01" src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/number-1.svg">
                    </div>
                    <div class="content">
                        <p>Journey Begins in Kuwait.</p>
                    </div>
                    </div>
                    <div class="col-lg-2 col-md-2 for-col-5">
                    <div class="content">
                        <p>As an international shopping platform books4all has commenced its operations in many parts of the MENA Region, including Saudi Arabia, Qatar, the United Arab Emirates, Turkey, Egypt, Kuwait Abroad, and others.</p>
                    </div>
                    <div class="number number-2">
                        <img alt="02" src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/number-2.svg">
                    </div>
                    </div>
                    <div class="col-lg-2 col-md-2 for-col-5">
                    <div class="number number-1">
                        <img alt="03" src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/number-3.svg">
                    </div>
                    <div class="content">
                        <p>books4all has opened online stores in 50+ countries, which include New Zealand, India, Australia, South Africa, and Hong Kong.</p>
                    </div>
                    </div>
                    <div class="col-lg-2 col-md-2 for-col-5">
                    <div class="content">
                        <p>books4all has improved the shopping experience of customers by expanding its reach to 90+ countries along with a vast category of authentic &amp; genuine products.</p>
                    </div>
                    <div class="number number-2">
                        <img alt="04" src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/number-4.svg">
                    </div>
                    </div>
                    <div class="col-lg-2 col-md-2 for-col-5">
                    <div class="number number-1">
                        <img alt="05" src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/number-5.svg">
                    </div>
                    <div class="content">
                        <p>Now available in 180 + countries and counting while looking forward to creating dominance in the International shopping sector.</p>
                    </div>
                    </div>
                    <div class="col-lg-2 col-md-2 for-col-5 d-none">&nbsp;</div>
                </div>
                <!-- <img src="assets/images/points.svg" alt="Points">  -->
                </div>
                <div class="points-image mobile-view d-none">
                <div class="points">
                    <div class="image col-6 number-1">
                    <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/mv-number-1.svg">
                    </div>
                    <div class="content col-6">
                    <p class="ml-4">Journey Begins in Kuwait.</p>
                    </div>
                </div>
                <div class="points">
                    <div class="content col-6">
                    <p class="mr-4">As an international shopping platform books4all has commenced its operations in many parts of the MENA Region, including Saudi Arabia, Qatar, the United Arab Emirates, Turkey, Egypt, Kuwait Abroad, and others.</p>
                    </div>
                    <div class="image col-6 number-2">
                    <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/mv-number-2.svg">
                    </div>
                </div>
                <div class="points">
                    <div class="image col-6 number-1">
                    <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/mv-number-3.svg">
                    </div>
                    <div class="content col-6">
                    <p class="ml-4">books4all has opened online stores in 50+ countries, which include New Zealand, India, Australia, South Africa, and Hong Kong.</p>
                    </div>
                </div>
                <div class="points">
                    <div class="content col-6">
                    <p class="mr-4">books4all has improved the shopping experience of customers by expanding its reach to 90+ countries along with a vast category of authentic &amp; genuine products.</p>
                    </div>
                    <div class="image col-6 number-2">
                    <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/mv-number-4.svg">
                    </div>
                </div>
                <div class="points">
                    <div class="image col-6 number-1">
                    <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/mv-number-5.svg">
                    </div>
                    <div class="content col-6">
                    <p class="ml-4">Now available in 180 + countries and counting while looking forward to creating dominance in the International shopping sector.</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
        <!-- ubuy-journey ends -->
        <!-- why-do-we-stand-out starts -->
        <section class="stand-out mt-100 ">
            <div class="container-fluid">
            <h3 class="h1">Why Do We Stand Out?</h3>
            </div>
            <div class="container">
            <div class="stand-out-img  web-view text-center">
                <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/stand-out-img.png">
                <div class="special-gifts position-absolute">
                <p class="text-center">Special global brands &amp; international products from around the world.</p>
                </div>
                <div class="million-products position-absolute">
                <p class="text-center">More than 300 million products in the store await you, such as fashion, electronics, beauty, and much more.</p>
                </div>
                <div class="curated-products position-absolute">
                <p class="text-center">Specially curated payment methods to comfortably enhance your overall shopping experience.</p>
                </div>
                <div class="cross-products position-absolute">
                <p class="text-center">Cross-border shopping Experience.</p>
                </div>
                <div class="reliable-customer position-absolute">
                <p class="text-center">Highly reliable Customer Support Service.</p>
                </div>
            </div>
            <!-- Mobile View Starts -->
            <div class="stand-out-img  mobile-view text-center d-none">
                <div class="special-gifts d-flex align-items-center justify-content-center mb-5">
                <div class="col-6">
                    <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/special-gifts.png">
                </div>
                <div class="col-6">
                    <p>Special global brands &amp; international products from around the world.</p>
                </div>
                </div>
                <div class="million-products d-flex align-items-center justify-content-center mb-5">
                <div class="col-6">
                    <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/million-products.png">
                </div>
                <div class="col-6">
                    <p>More than 300 million products in the store await you, such as fashion, electronics, beauty, and much more.</p>
                </div>
                </div>
                <div class="curated-products d-flex align-items-center justify-content-center mb-5">
                <div class="col-6">
                    <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/curated-products.png">
                </div>
                <div class="col-6">
                    <p>Specially curated payment methods to comfortably enhance your overall shopping experience.</p>
                </div>
                </div>
                <div class="cross-products d-flex align-items-center justify-content-center mb-5">
                <div class="col-6">
                    <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/cross-products.png">
                </div>
                <div class="col-6">
                    <p>Cross-border shopping Experience.</p>
                </div>
                </div>
                <div class="reliable-customer d-flex align-items-center justify-content-center mb-5">
                <div class="col-6">
                    <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/reliable-customer.png">
                </div>
                <div class="col-6">
                    <p>Highly reliable Customer Support Service.</p>
                </div>
                </div>
            </div>
            <!-- Mobile View ends -->
            </div>
        </section>
        <!-- why-do-we-stand-out ends -->
        <!-- global-presence starts -->
        <section class="global-presence mt-100">
            <div class="container">
            <h3 class="h1 position-relative text-center">Global Presence</h3>
            <p class="text-center">Add an international punch to your abroad shopping spree with books4all. We have already laid our steps in the international market and are growing to be a globally renowned marketplace in different continents such as:</p>
            <div class="global-presence-img text-center">
                <img alt="Map" src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/global-map.svg">
            </div>
            </div>
        </section>
        <!-- global-presence ends -->
        <!-- our-core-value starts -->
        <section class="ubuy-core-values w-100 position-relative  mt-100">
            <div class="core-value-image d-block">
                <img alt="ubuy core values" src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/ubuy-core-values.png">
            </div>
            <div class="core-value-content" style="margin-bottom: 40px;">
            <div class="container">
                <div class="col-xxl-10 col-12  our-core-values ">
                <h2 class="h1 position-relative">Our Growth</h2>
                <p>It's been an amazing journey that we are still planning to go on with. Most asked how we've grown so quickly; It is quite a simple question to answer. We have always put our customers as our first priority. Focus on ensuring that customers get the finest and perhaps most affordable products on the market. We take care of it by utilising our comprehensive logistics networks. Another important factor behind our success is our after-sale support team that takes care of customers' needs and demands are met. Internally, we call this our supercalifragilisticexpialidocious philosophy.</p>
                <p>As a new uprising global shopping platform books4all is always looking forward to gaining a new perspective while keeping its core values intact.</p>
                </div>
            </div>
            </div>
            <div class="core-value-points mt-100">
            <div class="container">
                <h2 class="h1 text-center">Core Values:</h2>
                <div class="above-points">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="core-points text-center">
                        <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/drive-change.svg">
                        <p>Drive Change</p>
                    </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="core-points text-center">
                        <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/passionate.svg">
                        <p>Be Passionate</p>
                    </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="core-points text-center">
                        <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/pursue-growth.svg">
                        <p>Pursue Growth</p>
                    </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="core-points text-center">
                        <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/be-creative.svg">
                        <p>Be Creative</p>
                    </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="core-points text-center">
                        <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/do-more-with-less.svg">
                        <p>Do More With Less</p>
                    </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                    <div class="core-points text-center">
                        <img src="https://d3ulwu8fab47va.cloudfront.net/skin/frontend/default/ubuycom-v1/images/about-us/customer-service.svg">
                        <p>Customer Service Isn't Just <br> A Department! </p>
                    </div>
                    </div>
                </div>
                </div>
                <p class="text-center">These values are what have defined us in past and will reflect us well in the future. Still looking forward to being a global shopping platform. books4all is aiming to offer superior quality, eccentric globally renowned products to customers worldwide. Our success is nothing more than the consistent support offered to us by our loyal customers who have helped us clear all the obstacles coming in our path.</p>
            </div>
            </div>
            <h3 class="h1 text-center last-heading mt-5 mb-5">Customers are the Whole &amp; Soul and we respect them.</h3>
        </section>
    </section>
    <style>
        .about-us .banner .text-overlay {
            position: absolute;
            left: 0px;
            right: 0px;
            margin: 0 auto;
            text-align: center;
            top: 310px;
        }
        .about-us .banner .text-overlay h1 {
            font-family: Poppins;
            font-style: normal;
            font-weight: normal;
            font-size: 55px;
            line-height: 70px;
        }
        .theme-color {
            color: #FFB100;
        }
        .font-weight-bold {
            font-weight: 700!important;
        }
        .m-0 {
            margin: 0!important;
        }
        .mt-100 {
    margin-top: 100px !important;
}
.about-us .container-fluid {
    max-width: 1440px !important;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}
.align-items-center {
    -ms-flex-align: center!important;
    align-items: center!important;
}
.justify-content-center {
    -ms-flex-pack: center!important;
    justify-content: center!important;
}
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
img {
    vertical-align: middle;
    border-style: none;
}
.about-us img {
    max-width: 100% !important;
}
.mt-100 {
    margin-top: 100px !important;
}
.ubuy-rising .points {
    margin-top: 60px;
}
.ubuy-rising .points .points-image.web-view {
    position: relative;
}
.for-col-5 {
    -webkit-box-flex: 0 !important;
    -ms-flex: 0 0 20% !important;
    flex: 0 0 50% !important;
    max-width: 20% !important;
}
.ubuy-rising .points .points-image.web-view:before {
    content: "";
    width: 100%;
    display: block;
    background: #fdf1e3;
    height: 18px;
    border-radius: 50px;
    position: absolute;
    bottom: 212px;
    margin: 20px;
}
::before {
    box-sizing: border-box;
}

.container {
    max-width: 1720px;
}
.stand-out-img.web-view {
    display: block;
    position: relative;
}
.stand-out-img {
    padding-top: 130px;
}
.stand-out .special-gifts {
    top: 480px;
    left: 260px;
}
.stand-out p {
    max-width: 270px;
    width: 100%;
    font-size: 17px;
    color: #666;
}
.stand-out .million-products {
    top: 266px;
    left: 270px;
}
.stand-out .curated-products {
    top: 10px;
    left: 710px;
}
.stand-out .cross-products {
    top: 270px;
    right: 290px;
}
.stand-out .reliable-customer {
    top: 480px;
    right: 250px;
}
.position-absolute {
    position: absolute!important;
}

.global-presence p {
    font-size: 18px;
    color: #000000;
    max-width: 1100px;
    margin: 0 auto;
    width: 100%;
}
.global-presence-img {
    margin-top: 100px;
}
.col-xl-10 {
    -ms-flex: 0 0 83.333333%;
    flex: 0 0 83.333333%;
    max-width: 83.333333%;
}
.core-value-image {
    position: absolute;
    left: 0px;
    top: -240px;
}
.ubuy-core-values .h1 {
    padding-bottom: 10px;
}
.h1 {
    font-size: 32px;
    font-weight: 600;
    line-height: 48px;
    font-family: 'Poppins', sans-serif;
}
.ubuy-core-values p {
    font-size: 18px;
    margin-bottom: 30px;
    line-height: 30px;
    color: #666666;
}
.ubuy-core-values .core-value-points p.text-center {
    width: 90%;
    margin: 50px auto;
    text-align: left !important;
}
.ubuy-rising .points .points-image.web-view .content {
    padding: 40px 0px;
}
.ubuy-rising .points .points-image.web-view .number {
    padding: 40px 36px;
}
.ubuy-rising .points .points-image.web-view .number {
    position: relative;
}
    </style>
@endsection
