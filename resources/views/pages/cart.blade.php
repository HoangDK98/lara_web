@extends('layouts.app')

@section('content')
@include('layouts.menubar')

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
							<table class="table table-striped">
								<thead>
									<tr class="row text-center">
										<th class="col-sm-1"><input type="checkbox" id="checkall"> All item</th>
										<th class="col-sm-2">Image</th>
										<th class="col-sm-2">Name</th>
										<th class="col-sm-1">Color</th>
										<th class="col-sm-1">Quantity</th>
										<th class="col-sm-2">Price</th>
										<th class="col-sm-2">Total</th>
										<th class="col-sm-1">Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach($cart as $item)
									<tr class="row text-center form">
										<td class="col-sm-1">
											<input type="checkbox" class="checkitem" value="{{$item->id}}">{{$item->id}}
										</td>
										<td class="col-sm-2"><img src="{{asset($item->options->image)}}" alt="" style="width:80px ;height:80px;padding-top:20px"></td>
										<td class="col-sm-2">{{$item->name}}</td>
										<td class="col-sm-1">{{$item->options->color}}</td>
										<td class="col-sm-1" style="width:70px">
											<input onchange="updateCart(this.value,'{{$item->rowId}}')" class="form-control" type="number" value="{{$item->qty}}">
										</td>
										<td class="col-sm-2">{{number_format($item->price,0,',','.')}} đ</td>
										<td class="col-sm-2">{{number_format($item->price * $item->qty,0,',','.')}} đ</td>
										<td class="col-sm-1">
											<a href= "{{asset('remove/cart/'.$item->rowId)}}" class="cart_item_text btn btn-sm btn-danger">X</a>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total:</div>
								<!-- <div class="order_total_amount">{{number_format(Cart::total(),0,',','.')}} đ</div> -->

							</div>
						</div>

						<div class="cart_buttons">
							<a href="{{route('cart.delete')}}" class="btn btn-danger" id="delete">Xóa giỏ hàng</a>
							<a href="{{route('user.checkout')}}" class=" btn btn-primary">Checkout</a>
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

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script src="{{asset('frontend/js/cart_custom.js')}}"></script>

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

<script>  
	$(document).on("click", "#delete", function(e){
		e.preventDefault();
		var link = $(this).attr("href");
		swal({
			title: "Are you sure delete my cart?",
			icon: "warning", 
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				window.location.href = link;
			} 
		});
	});

	// get item cart
	var arrItem =[];

	
	$("#checkall").click(function(){
		$("input[type=checkbox]").prop('checked', $(this).prop('checked'));
	});

	// $('.checkitem:checked').each(function(){
	// 	arrItem.push($(this).val());
	// })

	$(".checkitem").click(function(){
		// alert($(this).val());
	});
	$(".checkitem").change(function(){
		if($(this).prop("checked") == false){
			$("#checkall").prop("checked","false");
		}
		// if($(".checkitem:checked").length == $(".checkitem").length){
		// 	$("#checkall").prop("checked","true");
		// }
		
	})


</script>
@endsection