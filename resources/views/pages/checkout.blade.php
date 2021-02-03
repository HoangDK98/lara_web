@extends('layouts.app')

@section('content')
@include('layouts.menubar')

@php
    $service = DB::table('services')->get();
    $coupon = DB::table('coupons')->where('status',1)->get();
@endphp
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_responsive.css')}}">
	<!-- Cart -->
@if(Cart::count() > 0)
<form method="post" action="{{route('user.order')}}">
@csrf
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart_container">
						<div class="cart_title ">Checkout</div>
						<div class="cart_items">
                        <table class="table table-striped">
								<thead>
									<tr class="row text-center">
										<th class="col-sm-2">Image</th>
										<th class="col-sm-3">Name</th>
										<th class="col-sm-1">Quantity</th>
										<th class="col-sm-2">Price</th>
										<th class="col-sm-2">Total</th>
										<th class="col-sm-2">Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach($cart as $item)
									<tr class="row text-center">
										<td class="col-sm-2"><img src="{{asset($item->options->image)}}" alt="" style="width:80px ;height:80px;"></td>
										<td class="col-sm-3 align-bottom">{{$item->name}}</td>
										<td class="col-sm-1" style="width:70px">
                                        {{$item->qty}}
										</td>
										<td class="col-sm-2">{{number_format($item->price,0,',','.')}} đ</td>
										<td class="col-sm-2">{{number_format($item->price * $item->qty,0,',','.')}} đ</td>
										<td class="col-sm-2">
											<a href= "{{asset('remove/cart/'.$item->rowId)}}" class="btn btn-sm btn-danger">X</a>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
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
                                        <input id="service_id" name="service_id" type="hidden">

                                    </div>
                                    <div class="col-lg-6 text-lg-right" style="margin-top:20px">
                                        <label><h3>Mã khuyến mãi : <h3></label><br>
                                        <select id="coupon" name="coupon" class="form-control" >
                                            <option value="0">Không -- 0</option>
                                            @foreach($coupon as $item)
                                            <option value="{{$item->id}}">{{ $item->coupon }} -- {{$item->discount}}</option>
                                            @endforeach
                                        </select>
                                        <input id="coupon_id" name="coupon_id" type="hidden">
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

                </div>

                <div class="col-lg-5">
                    </br>
                    <div class="contact_form_container">
                        <ul class="list-group">
                            <li class="list-group-item">Tiền sản phẩm : 
                                <span id="subtotal" style="float:right">{{number_format(Cart::subtotal(),0,',','.')}} đ</span>
                            </li>
                            <li class="list-group-item">Khuyến mãi (%):
                                <span id="discount" style="float:right"></span>
                            </li>
                            <li class="list-group-item">Phí ship :
                                <span id="shipping_fee" style="float:right"></span>
                            </li>
                            <input type="hidden" >
                            <li class="list-group-item">Tổng :
                                <span id="total"  style="float:right">{{number_format(Cart::subtotal() - Session::get('coupon')['discount']/100*Cart::subtotal(),0,',','.')}} đ</span>
                            </li>
                            <br>
                            <div class="form-group">
                                <ul class="logos_list">
                                    <li><input type="radio" name="payment" value="0">Thanh toán khi nhận hàng</li>
                                    <li><input type="radio" name="payment" value="1">Thanh toán online</li>
                                </ul>
                            </div>
                            <div class="contact_form_button" style="float:right">
                                <button type="submit" style="float:right" class="btn btn-info">Đặt hàng</button>
                            </div>
                        </ul> </br>
                        
                    </div>
                </div>
		    </div>
		<div>
        </div>
        </div>
</form>
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
            $( "#coupon_id" ).val( coupon_id );
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
                service_id += $( this ).val() + " ";
                service_name += $( this ).text() + "";
                split = service_name.split('--')[1];
                var str_split = split.replace(/[^a-zA-Z0-9 ]/g, "");
                free_charge = Number(str_split); 
            });
            
            $( "#shipping_fee" ).text( split );
            $( "#service_id" ).val( service_id );
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