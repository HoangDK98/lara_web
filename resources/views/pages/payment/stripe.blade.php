@extends('layouts.app')
@php
    $ship = DB::table('services')->first();
    $shipping_fee  = $ship->shopping_charse;
    $cart = Cart::content();
@endphp
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/contact_responsive.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/stripe.css')}}">
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
							<form action="{{route('stripe.charge')}}" method="post" id="payment-form">
							@csrf
								<div class="form-row">
									<label for="card-element">
									Credit or debit card
									</label>
									<div id="card-element">
									<!-- A Stripe Element will be inserted here. -->
									</div>
									<!-- Used to display form errors. -->
									<div id="card-errors" role="alert"></div>
								</div><br>
								<input type="hidden" name="shipping_fee" value="{{$shipping_fee}}"> 
								<input type="hidden" name="total" value="{{Cart::subtotal() - Session::get('coupon')['discount']/100*Cart::subtotal()+$shipping_fee}}"> 
								<input type="hidden" name="ship_name" value="{{$data['name']}}"> 
								<input type="hidden" name="ship_phone" value="{{$data['phone']}}"> 
								<input type="hidden" name="ship_email" value="{{$data['email']}}"> 
								<input type="hidden" name="ship_address" value="{{$data['address']}}"> 
								<input type="hidden" name="ship_city" value="{{$data['city']}}"> 
								<input type="hidden" name="payment" value="{{$data['payment']}}"> 
								<button class="btn btn-primary">Submit Payment</button>
							</form>
					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	</div>
	<!-- <script src="https://js.stripe.com/v3/"></script> -->
	<script src="{{asset('frontend/js/stripe.js')}}"></script>

@endsection
