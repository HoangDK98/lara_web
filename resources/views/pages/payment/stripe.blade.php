@extends('layouts.app')
@php
	$total = DB::table('payments')->where('id',$payment_id)->first()->total;
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
						<div class="contact_form_title text-center">Thông tin</div>
                        <div class="cart_items">
							<ul class="cart_list">
								<li class="cart_item clearfix">
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
											<h4 class=""><b>Thanh toán : {{number_format($total,0,',','.')}} đ</b></h4>
                                        </div>
									</div>
                                </li>
                                <hr>
							</ul>
                        </div>
                        
					</div>
                </div>

                <div class="col-lg-4" style="border:1px solid grey ;padding:30px; border-radius:20px">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Shipping Address</div>
							<form action="{{route('stripe.charge',$payment_id)}}" method="post" id="payment-form">
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
