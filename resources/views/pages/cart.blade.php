@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_responsive.css')}}">
	<!-- Cart -->
@if(Cart::count() > 0)
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart_container">
						<div class="cart_title "><i class="fas fa-cart-plus"> Giỏ hàng</i></div>
						<div class="cart_items">
							<ul class="cart_list">
                            @foreach($cart as $key => $item)
								<li class="cart_item clearfix">
									<div class="cart_item_image text-center"><img src="{{asset($item->options->image)}}" alt="" style="width:70px ;height:70px"></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Name</div>
											<div class="cart_item_text">{{$item->name}}</div>
                                        </div>
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Color</div>
											<div class="cart_item_text"><span></span>{{$item->options->color}}</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Quantity</div><br>
											<div class="form-group" style="width:70px">
                                                <input onchange="updateCart(this.value,'{{$item->rowId}}')" class="form-control" type="number" value="{{$item->qty}}">
                                            </div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Price</div>
											<div class="cart_item_text">{{number_format($item->price,0,',','.')}} đ</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Total</div>
											<div class="cart_item_text">{{number_format($item->price * $item->qty,0,',','.')}} đ</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Action</div>
                                            <a href= "{{asset('remove/cart/'.$item->rowId)}}" class="cart_item_text btn btn-sm btn-danger">X</a>
										</div>
									</div>
                                </li>
                                <hr>
                            @endforeach
							</ul>
						</div>
						
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total:</div>
								<div class="order_total_amount">{{Cart::total()}} đ</div>
							</div>
						</div>

						<div class="cart_buttons">
							<button type="button" class="button cart_button_clear">Add to Cart</button>
							<button type="button" class="button cart_button_checkout">Checkout</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
@else

    <div class="container">
        <div class="text-center">
            <h2> Giỏ hàng của bạn đang trống</h2><br>
            <a href="/" class="btn btn-primary">Mua ngay </a>
        </div>
    </div>

@endif
<script type='text/javascript'>
    function updateCart(qty, rowId) {
        $.get(
            "{{asset('update/cart')}}", {
                qty: qty,
                rowId: rowId
            },
            function() {
                location.reload();
            }
        );
    }
</script>
<script src="{{asset('frontend/js/cart_custom.js')}}"></script>
    
@endsection