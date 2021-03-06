
<link rel="stylesheet" href="{{asset('frontend/styles/email.css')}}">


<div id="wrap-inner">
	<div id="khach-hang">
		<h3>Thông tin khách hàng</h3>
		<p>
			<span class="info">Khách hàng: </span>
			{{$info['name']}}
		</p>
		<p>
			<span class="info">Email: </span>
			{{$info['email']}}
		</p>
		<p>
			<span class="info">Điện thoại: </span>
			{{$info['phone']}}
		</p>
		<p>
			<span class="info">Địa chỉ: </span>
			{{$info['address']}}
		</p>
		<p>
			<span class="info">Thành phố: </span>
			{{$info['city']}}
		</p>
	</div>
	<div id="hoa-don">
		<h3>Hóa đơn mua hàng</h3>
		<table class="table-bordered table-responsive">
			<tr class="bold">
				<td width="30%">Tên sản phẩm</td>
				<td width="25%">Giá</td>
				<td width="20%">Số lượng</td>
				<td width="15%">Thành tiền</td>
			</tr>
			@foreach($carts as $cart)
			<tr>
				<td>{{$cart->name}}</td>
				<td class="price">{{number_format($cart->price,0,',','.')}}</td>
				<td>{{$cart->qty}}</td>
				<td class="price">{{number_format($cart->price*$cart->qty,0,',','.')}} VND</td>
			</tr>
			@endforeach
			<hr>
			<tr>
				<td colspan="3">Phí ship:</td>
				<td class="total-price">{{number_format($service,0,',','.')}} VND</td>
			</tr>
			<tr>
				<td colspan="3">Khuyến mãi:</td>
				<td class="total-price">{{$coupon}} %</td>
			</tr>
			<tr>
				<td colspan="3">Tổng tiền:</td>
				<td class="total-price">{{number_format($total,0,',','.')}} VND</td>
			</tr>
		</table>
	</div>
	<div id="xac-nhan">
		<br>
		<p align="justify">
			<b>Quý khách đã đặt hàng thành công!</b><br />
			• Sản phẩm của Quý khách sẽ được chuyển đến Địa chỉ có trong phần Thông tin Khách hàng của chúng Tôi sau thời gian 2 đến 3 ngày, tính từ thời điểm này.<br />
			• Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số Điện thoại trước khi giao hàng 24 tiếng.<br />
			<b><br />Cám ơn Quý khách đã sử dụng Sản phẩm của Công ty chúng Tôi!</b>
		</p>
	</div>
</div>
<!-- end main -->