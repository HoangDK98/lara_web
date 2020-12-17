@extends('layouts.app')

@section('content')

@php
$ship = DB::table('services')->first();
$free = $ship->shopping_charse;
@endphp
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_responsive.css')}}">
	<!-- Cart -->
@if(Cart::count() > 0)
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart_container">
						<div class="cart_title ">Checkout</div>
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
                        <br>
                        <div class="container">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-5" style="margin-left:20px;margin-top:15px">
                                        <h3>Áp dụng voucher</h3><br>
                                        <i>Mã khuyến mãi : </i>
                                        @if(Session::has('coupon'))
                                            {{Session::get('coupon')['name']}}
                                            <button onclick="remove()" class="btn-sm btn-danger">x</button>                                       
                                        @else
                                            Không
                                        @endif
                                    </div>
                                    <div class="col-lg-6 text-lg-right" style="margin-top:20px">
                                        <form action="{{route('apply.coupon')}}" method="post" class="row">
                                            @csrf
                                            <div class="form_group col-lg-10">
                                                <input type="text" name="coupon" class="form-control " require placeholder="Nhập mã khuyến mãi">
                                            </div><br>
                                            <button class="btn btn-info col-lg-2" type="submit">
                                                Áp dụng 
                                            </button>
                                        </form>
                                    </div>     
                                </div>
                                <br>
                            </div>
                        </div> <br>
                        
						<!-- Order Total -->
                        
                        <ul class="list-group col-lg-4" style="float:right">
                            <li class="list-group-item">Tiền sản phẩm : 
                                <span style="float:right">{{number_format(Cart::subtotal(),0,',','.')}} đ</span>
                            </li>
                            @if(Session::has('coupon'))
                            <li class="list-group-item">Khuyến mãi :
                                <span style="float:right">{{Session::get('coupon')['discount']}} %</span>
                            </li>
                            @endif
                            <li class="list-group-item">Phí ship :
                                <span style="float:right">{{number_format($free,0,',','.')}} đ</span>
                            </li>
                            <li class="list-group-item">Thanh toán :
                                <span style="float:right">{{number_format(Cart::subtotal() - Session::get('coupon')['discount']/100*Cart::subtotal()+$free,0,',','.')}} đ</span>
                            </li>
                        </ul>
                    </div>
				</div>
            </div>
            <div class="cart_buttons">
                <button type="button" class="button cart_button_clear">Add to Cart</button>
                <a href="{{route('user.checkout')}}" class="button cart_button_checkout">Checkout</a>
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
    function remove() {
        $.get(
            "{{asset('user/cancle/coupon')}}", {

            },
            function() {
                location.reload();
            }
        );
    }
</script>
<script src="{{asset('frontend/js/cart_custom.js')}}"></script>
    
@endsection