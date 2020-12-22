@extends('layouts.app')
@php
    $ship = DB::table('services')->first();
    $shipping_fee = $ship->shopping_charse;
@endphp
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/contact_responsive.css')}}">
@section('content')
@include('layouts.menubar')

    <div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-lg-8" style="border:1px solid grey ;padding:30px; border-radius:20px">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Cart Product</div>
                        <div class="cart_items">
							<ul class="cart_list">
                            @foreach($cart as $key => $item)
								<li class="cart_item clearfix">
									<!-- <div class="cart_item_image text-center"><img src="{{asset($item->options->image)}}" alt="" style="width:70px ;height:70px"></div> -->
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title"><b>Image</b></div>
											<div class="cart_item_text"><img src="{{asset($item->options->image)}}" alt="" style="width:40px ;height:40px"></div>
                                        </div>
                                        <div class="cart_item_name cart_info_col">
											<div class="cart_item_title"><b>Name</b></div>
											<div class="cart_item_text">{{$item->name}}</div>
                                        </div>
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_title"><b>Color</b></div>
											<div class="cart_item_text"><span></span>{{$item->options->color}}</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title"><b>Quantity</b></div>
											<div class="cart_item_text">{{$item->qty}}</div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title"><b>Price</b></div>
											<div class="cart_item_text">{{number_format($item->price,0,',','.')}} đ</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title"><b>Total</b></div>
											<div class="cart_item_text">{{number_format($item->price * $item->qty,0,',','.')}} đ</div>
                                        </div>
                                        
									</div>
                                </li>
                                <hr>
                            @endforeach
							</ul>
                        </div>
                        <ul class="list-group col-lg-8" style="float:right">
                            <li class="list-group-item">Tiền sản phẩm : 
                                <span style="float:right">{{number_format(Cart::subtotal(),0,',','.')}} đ</span>
                            </li>
                            @if(Session::has('coupon'))
                            <li class="list-group-item">Khuyến mãi :
                                <span style="float:right">{{Session::get('coupon')['discount']}} %</span>
                            </li>
                            @endif
                            <li class="list-group-item">Phí ship :
                                <span style="float:right">{{number_format($shipping_fee,0,',','.')}} đ</span>
                            </li>
                            <li class="list-group-item">Thanh toán :
                                <span style="float:right">{{number_format(Cart::subtotal() - Session::get('coupon')['discount']/100*Cart::subtotal()+$shipping_fee,0,',','.')}} đ</span>
                            </li>
                        </ul>
					</div>
                </div>

                <div class="col-lg-4" style="border:1px solid grey ;padding:30px; border-radius:20px">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Shipping Address</div>
						<form action="{{route('process.payment')}}" id="contact_form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Full name</label>
                                <input type="text" class="form-control" name="name" require="" id="name"  placeholder="Your full name">
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" require="" id="phone"  placeholder="Your phone">
                            </div><div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" require="" id="email"  placeholder="Your email">
                            </div><div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" require="" id="address"  placeholder="Your Address">
                            </div>
                            </div><div class="form-group">
                                <label for="city">Thành phố</label>
                                <input type="text" class="form-control" name="city" require="" id="city"  placeholder="Your City">
                            </div>
                            <div class="contact_form_title text-center">Payment By</div>
                            <div class="form-group">
                                <ul class="logos_list">
                                    <li><input type="radio" name="payment" value="stripe"><img style="width:140px;height:80px" src="{{asset('frontend/images/mastercard.png')}}"></li>
                                    <li><input type="radio" name="payment" value="paypal"><img style="width:140px;height:80px" src="{{asset('frontend/images/paypal.png')}}"></li>
                                </ul>
                            </div>
							<div class="contact_form_button">
								<button type="submit" class="btn btn-info">Pay now</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	</div>
@endsection
