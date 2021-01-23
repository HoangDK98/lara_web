@extends('layouts.app')

@section('content')
@include('layouts.menubar')

@php
    $service = DB::table('services')->get();
    $coupon = DB::table('coupons')->get();
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
                                        <label><h3>Hình thức vận chuyển : <h3></label><br>
                                        <select id="service" class="form-control">
                                            @foreach($service as $item)
                                            <option value="{{$item->id}}">{{ $item->shop_name }} -- {{number_format($item->shipping_charge,0,',','.')}} đ</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 text-lg-right" style="margin-top:20px">
                                        <label><h3>Mã khuyến mãi : <h3></label><br>
                                        <select id="coupon" name="coupon" class="form-control" >
                                            <option value="0">Không -- 0</option>
                                            @foreach($coupon as $item)
                                            <option value="{{$item->id}}">{{ $item->coupon }} -- {{$item->discount}}</option>
                                            @endforeach
                                        </select>
                                    </div>     
                                </div>
                                <br>
                            </div>
                        </div> <br>
                    </div>
				</div>
            </div>
		</div>
    </div>


		<div class="container">
			<div class="row">
                <div class="col-lg-7" >
                    <form method="post" action="{{route('user.order')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control input_field" name="phone" required="required" id="phone" placeholder="Your phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control input_field" name="email" required="required" id="email" placeholder="Your email">
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control input_field" name="address" required="required" id="address" placeholder="Your Address">
                        </div>
                        <div class="form-group">
                            <label for="city">Thành phố</label>
                            <input type="text" class="form-control input_field" name="city" required="required" id="city" placeholder="Your City">
                        </div>
                        <div class="contact_form_button">
                            <button type="submit" class="btn btn-info">Order</button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-5">
</br>
                    <form>
                        <div class="contact_form_container">
                            <ul class="list-group">
                                <li class="list-group-item">Tiền sản phẩm : 
                                    <span id="subtotal" style="float:right">{{number_format(Cart::subtotal(),0,',','.')}} đ</span>
                                </li>
                                <li class="list-group-item">Khuyến mãi (%):
                                    <span id="discount" style="float:right"></span>
                                </li>
                                <li class="list-group-item">Phí ship :
                                    <span id="shipping_fee" name="shipping_fee" style="float:right"></span>
                                </li>
                                <li class="list-group-item">Tổng :
                                    <span id="total"  style="float:right">{{number_format(Cart::subtotal() - Session::get('coupon')['discount']/100*Cart::subtotal(),0,',','.')}} đ</span>
                                </li>
                            </ul> </br>
                            
                        </div>
                    </form>
                </div>
		    </div>
		<div>
    
    
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

    <!-- Add Ship and voucher -->
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script>

    let free_charge = 0;
    let coupon_discount = 0;
    let total = 0;
    
    $("#coupon")
        .change(function() {
            var coupon_id = "";
            var coupon_name = "";
            $("#coupon option:selected").each(function() {
                coupon_id += $( this ).val() + " ";
                coupon_name += $( this ).text() + " ";
                split = coupon_name.split('--')[1];
                coupon_discount = Number(split);
            });
            $( "#discount" ).text( split ) ;
            $( "#coupon_id" ).text( coupon_id );
                var tg = $('#subtotal').text();
                var str_tg = tg.replace(/[^a-zA-Z0-9 ]/g, "");
                total = Number(str_tg);
                total = total - coupon_discount*total/100 + free_charge;
                $("#total").text( total.toLocaleString('vi-VN') +" đ") ;
        })
        .trigger( "change" );

    $("#service")
        .change(function() {
            var service_id = "";
            var service_name = "";
            var split="";
            $("#service option:selected").each(function() {
                service_id += $( this ).val() + "";
                service_name += $( this ).text() + "";
                split = service_name.split('--')[1];
                var str_split = split.replace(/[^a-zA-Z0-9 ]/g, "");
                free_charge = Number(str_split); 
            });
            
            $( "#shipping_fee" ).text( split );
            $( "#service_id" ).text( service_id );
                var tg = $('#subtotal').text();
                var str_tg = tg.replace(/[^a-zA-Z0-9 ]/g, "");
                total = Number(str_tg);
                total = total - coupon_discount*total/100 + free_charge;
                $("#total").text( total.toLocaleString('vi-VN') +" đ" ) ;
            // }
        })
        .trigger( "change" );

</script>
<script src="{{asset('frontend/js/cart_custom.js')}}"></script>
    
@endsection