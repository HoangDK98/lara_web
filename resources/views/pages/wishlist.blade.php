@extends('layouts.app')

@section('content')
@include('layouts.menubar')

<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_responsive.css')}}">
	<!-- Cart -->
@if($wishlist != NULL)
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart_container">
						<div class="cart_title " ><i class="fas fa-heart" style="color:red"></i> Your Wishlish </div>
						<div class="cart_items">
							<ul class="cart_list">
                            @foreach($wishlist as $key => $item)
								<li class="cart_item clearfix">
									<div class="cart_item_image text-center"><img src="{{asset($item->image_one)}}" alt="" style="width:70px ;height:70px"></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Name</div>
											<div class="cart_item_text">{{$item->product_name}}</div>
                                        </div>
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Color</div>
											<div class="cart_item_text"><span></span>{{$item->product_color}}</div>
										</div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Action</div>
                                            <a href= "" class="cart_item_text btn btn-sm btn-success">Add to cart</a>
										</div>
									</div>
                                </li>
                                <hr>
                            @endforeach
							</ul>
						</div>
						
					</div>
				</div>
			</div>
		</div>
    </div>
@else

    <div class="container">
        <div class="text-center">
            <h2> Danh sách yêu thích của bạn đang trống</h2><br>
            <a href="/" class="btn btn-primary">Tới ngay </a>
        </div>
    </div>

@endif
    
@endsection