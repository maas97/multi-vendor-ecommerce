{{-- This page is rendered by index() method in Front/IndexController.php --}}
@extends('front.layout.layout')


@section('content')
    <!-- Main-Slider -->
    <div class="ph-item relative" style="height: 82vh; margin: 10px 0px">
        <div class="slider-main owl-carousel relative d-flex align-items-start"  style="height: 82vh">

            {{-- Show the banner dynamically depending on the Admin Panel choice --}}
            @foreach ($sliderBanners as $banner)
                <div class=""  style="background-size: contain; background-repeat: no-repeat;" >
                    <div class="slide-content">
                        <h1>
                            <a class="w-100"  @if (!empty($banner['link'])) href="{{ url($banner['link']) }}" @else href="javascript:;" @endif >
                                <img style="height: 75vh" src="{{ asset('front/images/banner_images/' . $banner['image']) }}" title="{{ $banner['title'] }}" alt="{{ $banner['title'] }}">
                            </a>
                        </h1>
                        <h2>{{ $banner['title'] }}</h2>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Main-Slider /- -->




    @if (isset($fixBanners[1]['image']))
        <!-- Banner-Layer -->
        <div class="banner-layer mb-5">
            <div class="container-fluid">
                <div class="d-flex justify-content-center">
                    <a target="_blank" rel="nofollow" href="{{ url($fixBanners[1]['link']) }}" class="banner-hover effect-dark-opacity">
                        <img class="img-fluid" src="{{ asset('front/images/banner_images/' . $fixBanners[1]['image']) }}" alt="{{ $fixBanners[1]['alt'] }}" title="{{ $fixBanners[1]['title'] }}">
                    </a>
                </div>
            </div>
        </div>
        <!-- Banner-Layer /- -->
    @endif



    <!-- Top Collection -->
    <section class="section-maker">
        <div class="container col-9" >
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">TOP COLLECTION</h3>
                <ul class="nav tab-nav-style-1-a justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#men-latest-products">New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#men-best-selling-products">Best Sellers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#discounted-products">Discounted Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#men-featured-products">Featured Products</a>
                    </li>
                </ul>
            </div>
            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="men-latest-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">

                                    {{-- Show 'New Arrivals'. Show the LATEST 8 products ONLY. Check the index() method in IndexController.php --}}
                                    @foreach ($newProducts as $product)
                                        @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                            // dd($product['product_image']);
                                            // dd($product_image_path);
                                            // if (!empty($product['product_image']) && file_exists($product_image_path)) {
                                            //     dd('Yes');
                                            // } else {
                                            //     dd('No');
                                            // }
                                        @endphp

                                        <div class="product-card">
                                            <div class="badge">Hot</div>
                                            <div class="product-tumb">
                                                <a style="height: 100%; width:100%; border-radius: 20px" class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                                        <img style="height: 100%; width:100%;  border-radius: 20px" class="img-fluid " src="{{ asset($product_image_path) }}" alt="Product">
                                                    @else {{-- show the dummy image --}}
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <a class="product-catagory" href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                <h4 class="d-flex justify-content-between">
                                                    <a class="d-inline-block" href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    <span class="product-links">
                                                        <a class="d-inline-block" href=""><i class="fa fa-heart"></i></a>
                                                        <a class="d-inline-block" href="{{ url('product/' . $product['id']) }}"><i class="fa fa-shopping-cart"></i></a>
                                                    </span>
                                                </h4>
                                                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p> -->


                                                {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                                                @php
                                                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="product-bottom-details d-inline-block">
                                                    @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                                            <div class="product-price">
                                                                <small>${{ $product['product_price'] }}</small> <br>
                                                                ${{ $getDiscountPrice }}
                                                            </div>
                                                    @else {{-- if there's no discount on the price, show the original price --}}
                                                            <div class="product-price">
                                                                ${{ $product['product_price'] }}
                                                            </div>
                                                            @endif
                                                    </div>
                                                    <div class="item-stars d-inline-block">
                                                            <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                                <span style='width:0'></span>
                                                            </div>
                                                            <span>(0)</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane show fade" id="men-best-selling-products">
                            <div class="slider-fouc">

                                <div class="products-slider owl-carousel" data-item="4">
                                {{-- Show the 'Best Seller' products. Check the index() method in IndexController.php --}}
                                    @foreach ($bestSellers as $product)
                                        @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                            // dd($product['product_image']);
                                            // dd($product_image_path);
                                            // if (!empty($product['product_image']) && file_exists($product_image_path)) {
                                            //     dd('Yes');
                                            // } else {
                                            //     dd('No');
                                            // }
                                        @endphp

                                        <div class="product-card">
                                            <div class="badge">Best</div>
                                            <div class="product-tumb">
                                                <a style="height: 100%; width:100%; border-radius: 20px" class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                                        <img style="height: 100%; width:100%;  border-radius: 20px" class="img-fluid " src="{{ asset($product_image_path) }}" alt="Product">
                                                    @else {{-- show the dummy image --}}
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <a class="product-catagory" href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                <h4 class="d-flex justify-content-between">
                                                    <a class="d-inline-block" href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    <span class="product-links">
                                                        <a class="d-inline-block" href=""><i class="fa fa-heart"></i></a>
                                                        <a class="d-inline-block" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    </span>
                                                </h4>

                                                {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                                                @php
                                                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="product-bottom-details d-inline-block">
                                                    @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                                            <div class="product-price">
                                                                <small>${{ $product['product_price'] }}</small> <br>
                                                                ${{ $getDiscountPrice }}
                                                            </div>
                                                    @else {{-- if there's no discount on the price, show the original price --}}
                                                            <div class="product-price">
                                                                ${{ $product['product_price'] }}
                                                            </div>
                                                            @endif
                                                    </div>
                                                    <div class="item-stars d-inline-block">
                                                            <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                                <span style='width:0'></span>
                                                            </div>
                                                            <span>(0)</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="discounted-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                {{-- Show the 'Best Seller' products. Check the index() method in IndexController.php --}}
                                    @foreach ($bestSellers as $product)
                                        @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                            // dd($product['product_image']);
                                            // dd($product_image_path);
                                            // if (!empty($product['product_image']) && file_exists($product_image_path)) {
                                            //     dd('Yes');
                                            // } else {
                                            //     dd('No');
                                            // }
                                        @endphp

                                        <div class="product-card">
                                            <div class="badge">Sale</div>
                                            <div class="product-tumb">
                                                <a style="height: 100%; width:100%; border-radius: 20px" class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                                        <img style="height: 100%; width:100%;  border-radius: 20px" class="img-fluid " src="{{ asset($product_image_path) }}" alt="Product">
                                                    @else {{-- show the dummy image --}}
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <a class="product-catagory" href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                <h4 class="d-flex justify-content-between">
                                                    <a class="d-inline-block" href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    <span class="product-links">
                                                        <a class="d-inline-block" href=""><i class="fa fa-heart"></i></a>
                                                        <a class="d-inline-block" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    </span>
                                                </h4>

                                                {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                                                @php
                                                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="product-bottom-details d-inline-block">
                                                    @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                                            <div class="product-price">
                                                                <small>${{ $product['product_price'] }}</small> <br>
                                                                ${{ $getDiscountPrice }}
                                                            </div>
                                                    @else {{-- if there's no discount on the price, show the original price --}}
                                                            <div class="product-price">
                                                                ${{ $product['product_price'] }}
                                                            </div>
                                                            @endif
                                                    </div>
                                                    <div class="item-stars d-inline-block">
                                                            <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                                <span style='width:0'></span>
                                                            </div>
                                                            <span>(0)</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="men-featured-products">
                            <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                {{-- Show the 'Best Seller' products. Check the index() method in IndexController.php --}}
                                    @foreach ($bestSellers as $product)
                                        @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                            // dd($product['product_image']);
                                            // dd($product_image_path);
                                            // if (!empty($product['product_image']) && file_exists($product_image_path)) {
                                            //     dd('Yes');
                                            // } else {
                                            //     dd('No');
                                            // }
                                        @endphp

                                        <div class="product-card">
                                            <div class="badge">Sale</div>
                                            <div class="product-tumb">
                                                <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                                    @else {{-- show the dummy image --}}
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <a class="product-catagory" href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                <h4 class="d-flex justify-content-between">
                                                    <a class="d-inline-block" href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    <span class="product-links">
                                                        <a class="d-inline-block" href=""><i class="fa fa-heart"></i></a>
                                                        <a class="d-inline-block" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    </span>
                                                </h4>

                                                {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                                                @php
                                                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="product-bottom-details d-inline-block">
                                                    @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                                            <div class="product-price">
                                                                <small>${{ $product['product_price'] }}</small> <br>
                                                                ${{ $getDiscountPrice }}
                                                            </div>
                                                    @else {{-- if there's no discount on the price, show the original price --}}
                                                            <div class="product-price">
                                                                ${{ $product['product_price'] }}
                                                            </div>
                                                            @endif
                                                    </div>
                                                    <div class="item-stars d-inline-block">
                                                            <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                                <span style='width:0'></span>
                                                            </div>
                                                            <span>(0)</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Top Collection /- -->




    @if (isset($fixBanners[0]['image']))
        <!-- Banner-Layer -->
        <div class="banner-layer mb-5">
            <div class="container-fluid">
                <div class="d-flex justify-content-center">
                    <a target="_blank" rel="nofollow" href="{{ url($fixBanners[0]['link']) }}" class="mx-auto banner-hover effect-dark-opacity">
                        <img class="img-fluid" src="{{ asset('front/images/banner_images/' . $fixBanners[0]['image']) }}" alt="{{ $fixBanners[0]['alt'] }}" title="{{ $fixBanners[0]['title'] }}">
                    </a>
                </div>
            </div>
        </div>
        <!-- Banner-Layer /- -->
    @endif



    <!-- Site-Priorities -->
    <section class="app-priority">
        <div class="container col-9">
            <div class="priority-wrapper u-s-p-b-80">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-star"></i>
                            </div>
                            <h2>
                                Great Value
                            </h2>
                            <p>We offer competitive prices on our 100 million plus product range</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-cash"></i>
                            </div>
                            <h2>
                                Shop with Confidence
                            </h2>
                            <p>Our Protection covers your purchase from click to delivery</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-ios-card"></i>
                            </div>
                            <h2>
                                Safe Payment
                            </h2>
                            <p>Pay with the world’s most popular and secure payment methods</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-contacts"></i>
                            </div>
                            <h2>
                                24/7 Help Center
                            </h2>
                            <p>Round-the-clock assistance for a smooth shopping experience</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Site-Priorities /- -->
@endsection
