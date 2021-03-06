@extends('layouts.app')

@section('content')
@include('layouts.menubar')

<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/product_responsive.css')}}">
	<!-- Single Product -->

<div class="single_product">
    <div class="container">
        <div class="row">

            <!-- Images -->
            <div class="col-lg-2 order-lg-1 order-2">
                <ul class="image_list">
                    <li data-image="{{asset($product->image_one)}}"><img src="{{asset($product->image_one)}}" alt=""></li>
                    <li data-image="{{asset($product->image_two)}}"><img src="{{asset($product->image_two)}}" alt=""></li>
                    <li data-image="{{asset($product->image_three)}}"><img src="{{asset($product->image_three)}}" alt=""></li>
                </ul>
            </div>

            <!-- Selected Image -->
            <div class="col-lg-5 order-lg-2 order-1">
                <div class="image_selected"><img src="{{asset($product->image_one)}}" alt=""></div>
            </div>

            <!-- Description -->
            <div class="col-lg-5 order-3">
                <div class="product_description">
                    <div class="product_category">{{$product->category_name}} > {{$product->subcategory_name}}</div>
                    <div class="product_name">{{$product->product_name}}</div>
                    <div class="product_text"><p>{!! ($product->product_details) !!}</p></div><br>
                    <div class="order_info d-flex flex-row">
                        <form action="{{asset('product/addcart/'.$product->id)}}" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect2">Quantity</label>
                                        <input type="hidden" id="p_qty" value="{{$product->product_quantity}}"></input>
                                        <input onchange="check(this.value)" class="form-control" type="number" name="qty" value="1" pattern="[0-9]">
                                    </div>
                                </div>   
                                
                            </div>
                            @if($product->discount_price == NULL)
                                <div class="product_price discount">Giá bán : {{number_format($product->selling_price,0,',','.')}} đ</div>
                            @else
                                <div class="product_price discount">Giá bán : {{number_format($product->discount_price,0,',','.')}} đ
                                </div>
                                <div>
                                    <span class="old_price">{{number_format($product->selling_price,0,',','.')}} đ</span>
                                </div>
                            @endif
                            <div class="button_container">
                                <button type="submit" class="button cart_button">Add to Cart</button>
                                <br><br>
                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_inline_share_toolbox"></div> 
            
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

	<!-- Recently Viewed -->

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Thông tin sản phẩm</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Chi tiết sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Nhận xét</a>
                    </li>
                </ul>
                
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <br>{!! $product->product_details !!}
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><br>
                        <div class="fb-comments" data-href="{{Request::url()}}" data-width="" data-numposts="5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ff5303191dd3f1a"></script>

<script type='text/javascript'>
    function check(qty) {
		if(Number(qty) <= 0 ){
			Swal.fire('Số lượng không hợp lệ', '', 'error');
			setTimeout(function(){
				window.location.reload(1);
				}, 1500);
		}
		else if(Number(qty) > Number($('#p_qty').val())){
			Swal.fire('Không đủ số lượng', '', 'error');
			setTimeout(function(){
				window.location.reload(1);
				}, 1500);
		}
        
    }
</script>
@endsection