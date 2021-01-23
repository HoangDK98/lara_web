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
						<div class="cart_title " style="color:red"><i class="fas fa-heart" ></i> Yêu thích </div><br>
						<div class="cart-item">
							<table class="table table-striped">
								<thead>
									<tr class="row text-center">
										<th class="col-sm-3">Image</th>
										<th class="col-sm-3">Name</th>
										<th class="col-sm-3">Color</th>
										<th class="col-sm-3">Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach($wishlist as $key => $item)

									<tr class="row text-center">
										<td class="col-sm-3"><img src="{{asset($item->image_one)}}" alt="" style="width:90px ;height:90px"></td>
										<td class="col-sm-3">{{$item->product_name}}</td>
										<td class="col-sm-3">{{$item->product_color}}</td>
										<td class="col-sm-3">
											<button class="cart_item_text btn btn-sm btn-success" id="{{$item->id}}" data-toggle="modal" data-target="#cartmodel" onclick="proView(this.id)">Add to cart</button>
											<a href= "{{asset('product/detail/'.$item->id.'/'.$item->product_name)}}" class="cart_item_text btn btn-sm btn-primary">Xem</a>
											<a href= "{{route('wishlist.remove',$item->id)}}" class="cart_item_text btn btn-sm btn-danger" id="delete">Xóa</a>
										</td>
									</tr>
									@endforeach

								</tbody>
							</table>
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
<div class="modal fade" id="cartmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Product View</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-3">
							<div class="cart">
								<img src="" id="pimage" width='180px' height="200px">
								<div class="cart-body">
									<h5 class="cart-title text-center" id="pname" >
										Product name
									</h5>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<ul class="list-group">
								<li class="list-group-item">Product Code :<span id="pcode"></span> </li>
								<li class="list-group-item">Category :<span id="pcate"></span> </li>
								<li class="list-group-item">SubCategory :<span id="psub"></span> </li>
								<li class="list-group-item">Brand :<span id="pbrand"></span> </li>
								<li class="list-group-item">Stock :<span id=""></span> <span class="badge" style="background:green;color:white">Available</span></li>
							</ul>
						</div>
						<div class="col-md-3">
							<form action="{{route('insert.into.cart')}}" method="post">
							@csrf
								<input type="hidden" name="product_id" id="product_id">
								<div class="form-group">
									<label for="exampleInputcolor">Color</label>
									<select name="color" class="form-control" id="color">
						
									</select>
									
								</div>
								<div class="form-group">
									<label>Quantity</label>
									<input type="number" class="form-control" name="qty" value="1">
								</div>
								<button type="submit" class="btn btn-primary">Add to Cart</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- product-view -->
	<script type="text/javascript">
		function proView(id){
			$.ajax({
				url: "{{url('/cart/product/view/')}}/" + id, 
				type :"GET",
				dataType:"json",
				success:function(data){
					$('#pname').text(data.product.product_name);
					$('#pimage').attr('src',"http://127.0.0.1:8000/" + data.product.image_one);
					$('#pcode').text(data.product.product_code);
					$('#pcate').text(data.product.category_name);
					$('#psub').text(data.product.subcategory_name);
					$('#pbrand').text(data.product.brand_name);
					$('#product_id').val(data.product.id);

					var d = $('select[name="color"]').empty();
					$.each(data.color,function(key,value){
						$('select[name="color"]').append('<option value="'+value+'">'+value+'</option>'); 
        			});
				}
			})
		}

		//popup delete wishlist

	</script> 
	
	<script>  
		$(document).on("click", "#delete", function(e){
			e.preventDefault();
			var link = $(this).attr("href");
			swal({
				title: "Are you sure delete it?",
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
</script> 
@endsection