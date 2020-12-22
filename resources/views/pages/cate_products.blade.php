@extends('layouts.app')

@section('content')
@include('layouts.menubar')

    	<!-- Home -->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/shop_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/shop_responsive.css')}}">

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title"></h2>
    </div>
</div>

<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">Categories</div>
                        <ul class="sidebar_categories">
                            @php
                            $category = DB::table('categories')->get();
                            @endphp
                            @foreach($category as $item)
                            <li><a href="{{route('view.cate.product',$item->id)}}">{{$item->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar_section filter_by_section">
                        <div class="sidebar_title">Filter By</div>
                        <div class="sidebar_subtitle">Price</div>
                        <div class="filter_price">
                            <div id="slider-range" class="slider_range"></div>
                            <p>Range: </p>
                            <p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
                        </div>
                    </div>
                    <div class="sidebar_section">
                        <div class="sidebar_subtitle color_subtitle">Color</div>
                        <ul class="colors_list">
                            <li class="color"><a href="#" style="background: #b19c83;"></a></li>
                            <li class="color"><a href="#" style="background: #000000;"></a></li>
                            <li class="color"><a href="#" style="background: #999999;"></a></li>
                            <li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
                            <li class="color"><a href="#" style="background: #df3b3b;"></a></li>
                            <li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
                        </ul>
                    </div>
                    <div class="sidebar_section">
                        <div class="sidebar_subtitle brands_subtitle">Brands</div>
                        <ul class="brands_list">
                            @php 
                            $brand = DB::table('brands')->get();
                            @endphp
                            @foreach($brand as $item)
                            <li class="brand"><a href="#">{{$item->brand_name}}</a></li>      
                            @endforeach                  
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-lg-9">
                
                <!-- Shop Content -->

                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <h3 style="color:blue">{{$cate_name}}</h3>
                        <div class="shop_sorting">
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                    <ul>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
                                        <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product_grid row">
                        <div class="product_grid_border"></div>
                        @foreach($product as $item)
                        <!-- Product Item -->
                        <div class="product_item is_new">
                            <div class="product_border"></div>
                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset($item->image_one)}}" alt=""></div>
                            <div class="product_content">
                                @if($item->discount_price == NULL)
                                    <div class="product_price discount">{{number_format($item->selling_price,0,',','.')}} đ</div>
                                @else
                                    <div class="product_price discount">{{number_format($item->discount_price,0,',','.')}} đ
                                    </div>
                                    <div>
                                        <span class="old_price">{{number_format($item->selling_price,0,',','.')}} đ</span>
                                    </div>
                                @endif
                                <div class="product_name"><div><a href="{{asset('product/detail/'.$item->id.'/'.$item->product_name)}}" tabindex="0">{{$item->product_name}}</a></div></div>
                            </div>
                            <div class="product_fav"><i class="fas fa-heart"></i></div>
                            <ul class="product_marks">
                                @if($item->discount_price == NULL)
                                    <li class="product_mark product_new" >New</li>
                                @else
                                    <li class="product_mark product_new product_discount">
                                        @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = $amount/$item->selling_price*100;
                                        @endphp
                                        {{intval($discount)}} %
                                    </li>
                                @endif	
                            </ul>
                        </div>
                        @endforeach
                    </div>

                    <!-- Shop Page Navigation -->
                    @if($product->count() < $all_product->count())
                    <div class="shop_page_nav d-flex flex-row">
                        <ul class="page_nav d-flex flex-row">
                            {{$product->links()}}
                        </ul>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@endsection