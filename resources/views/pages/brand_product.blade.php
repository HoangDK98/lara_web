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
            <br><br><br><br>

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">Danh mục</div>
                        <ul class="sidebar_categories">
                        @foreach($cate_id as $item)
                            @php
                            $category = DB::table('categories')->where('id',$item->category_id)->first();
                            @endphp
                            <li><a href="{{route('view.cate.product',$category->id)}}">{{$category->category_name}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="sidebar_section">
                        <div class="sidebar_title">Phụ danh mục</div>
                        <ul class="brands_list">
                        @foreach($subcate_id as $item)
                            @php 
                            $subcategory = DB::table('subcategories')->where('id',$item->subcategory_id)->first();
                            @endphp
                            <li class="brand"><a href="{{route('view.sub.product',$subcategory->id)}}">{{$subcategory->subcategory_name}}</a></li>      
                        @endforeach                  
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-lg-9">
                
                <!-- Shop Content -->

                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <h3 style="color:blue">{{$brand_name}}</h3>
                      
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