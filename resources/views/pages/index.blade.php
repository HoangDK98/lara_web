@extends('layouts.app')

@section('content')

@include('layouts.menubar')
@include('layouts.slider')

@php 
	$new = DB::table('products')->where('status',1)->orderBy('id','DESC')->limit(12)->get();
	$hot = DB::table('products')->join('brands','brands.id','products.brand_id')
		->select('products.*','brands.brand_name')->where('status',1)
		->where('hot_deal',1)->orderBy('id','DESC')->limit(8)->get();
@endphp

<div class="characteristics">
		<div class="container">
			<div class="row">

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{asset('frontend/images/char_1.png')}}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Miễn phí vận chuyển</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{asset('frontend/images/char_2.png')}}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Giao hàng nhanh chóng</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{asset('frontend/images/char_3.png')}}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Nhiều ưu đãi</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{asset('frontend/images/char_4.png')}}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Đặt hàng 24/7</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Deals of the week -->

	<div class="deals_featured">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
					
					<!-- Deals -->

					<div class="deals">
						<div class="deals_title">Giảm giá sốc</div>
						<div class="deals_slider_container">
							
							<!-- Deals Slider -->
							<div class="owl-carousel owl-theme deals_slider">
								@foreach($hot as $item)
								<!-- Deals Item -->
								<div class="owl-item deals_item">
									<div class="deals_image"><img src="{{asset($item->image_one)}}" alt=""></div>
									<div class="deals_content">
										<div class="deals_info_line d-flex flex-row justify-content-start">
											<div class="deals_item_category"><a href="#">{{$item->brand_name}}</a></div>
											@if($item->discount_price == NULL)
											@else
											<div class="deals_item_price_a ml-auto">{{number_format($item->selling_price,0,',','.')}} đ</div>
											@endif
										</div>
										<div class="deals_info_line d-flex flex-row justify-content-start">
											<div class="deals_item_name"><a href="{{asset('product/detail/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></div>
											@if($item->discount_price == NULL)
											<div class="deals_item_price ml-auto">{{number_format($item->selling_price,0,',','.')}} đ</div>
											@else
											<div class="deals_item_price ml-auto">{{number_format($item->discount_price,0,',','.')}} đ</div>
											@endif
										</div>
										<!-- <div class="available">
											<div class="available_line d-flex flex-row justify-content-start">
												<div class="available_title">Đã bán: <span>25</span></div>
												<div class="sold_title ml-auto">Còn lại: <span>{{$item->product_quantity}}</span></div>
											</div>
											<div class="available_bar"><span style="width:17%"></span></div>
										</div> -->
										<div class="deals_timer d-flex flex-row align-items-center justify-content-start">
											<div class="deals_timer_title_container">
												<div class="deals_timer_title">Nhanh tay</div>
												<div class="deals_timer_subtitle">Còn:</div>
											</div>
											<div class="deals_timer_content ml-auto">
												<div class="deals_timer_box clearfix" data-target-time="">
													<div class="deals_timer_unit">
														<div id="deals_timer1_hr" class="deals_timer_hr"></div>
														<span>giờ</span>
													</div>
													<div class="deals_timer_unit">	
														<div id="deals_timer1_min" class="deals_timer_min"></div>
														<span>phút</span>
													</div>
													<div class="deals_timer_unit">
														<div id="deals_timer1_sec" class="deals_timer_sec"></div>
														<span>giây</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>

						</div>

						<div class="deals_slider_nav_container">
							<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
							<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
						</div>
					</div>
					
					<!-- Featured -->
					<div class="featured">
						<div class="tabbed_container">
							<div class="tabs">
								<ul class="clearfix">
									<li class="active">Sản phẩm mới</li>
								</ul>
								<div class="tabs_line"><span></span></div>
							</div>
							<!--Featured Product Panel -->
							<div class="product_panel panel active">
								<div class="featured_slider slider">

									<!-- Slider Item -->
									@foreach($new as $item)
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center">
													<img src="{{asset($item->image_one)}}" alt="" >
											</div>
											<div class="product_content">
												@if($item->discount_price == NULL)
													<div class="product_price discount">{{number_format($item->selling_price,0,',','.')}} đ</div>
												@else
													<div class="product_price discount">{{number_format($item->discount_price,0,',','.')}} đ
													</div>
													<div>
														<span class="old_price">{{number_format($item->selling_price,0,',','.')}} đ</span>
													</div>
												@endif
												<div class="product_name"><div><a href="{{asset('product/detail/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></div></div>
												<div class="product_extras">
													<button class="product_cart_button add-cart" id="{{$item->id}}" data-toggle="modal" data-target="#cartmodel" onclick="proView(this.id)">Add to Cart</button>
												</div>
											</div>
											<button class="add-wishlist" data-id="{{$item->id}}">
												<div class="product_fav"><i class="fas fa-heart"></i></div>
											</button>
											<ul class="product_marks">
												@if($item->discount_price == NULL)
													<li class="product_mark product_new" >New</li>
												@else
													<li class="product_mark product_discount">
														@php
															$amount = $item->selling_price - $item->discount_price;
															$discount = $amount/$item->selling_price*100;
														@endphp
														{{intval($discount)}} %
													</li>
												@endif	
											</ul>
										</div>
									</div>
									@endforeach

								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Popular Categories -->

	<div class="popular_categories">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="popular_categories_content">
						<div class="popular_categories_title">Popular Categories</div>
						<div class="popular_categories_slider_nav">
							<div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
							<div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
						</div>
						<!-- <div class="popular_categories_link"><a href="#">full catalog</a></div> -->
					</div>
				</div>
				
				@php 
					$category = DB::table('categories')->get();
				@endphp
				<!-- Popular Categories Slider -->

				<div class="col-lg-9">
					<div class="popular_categories_slider_container">
						<div class="owl-carousel owl-theme popular_categories_slider">

							<!-- Popular Categories Item -->
							@foreach($category as $item)
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="{{asset('frontend/images/popular_1.png')}}" alt=""></div>
									<div class="popular_category_text">{{$item->category_name}}</div>
								</div>
							</div>
							@endforeach

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Banner -->

	@php 
		$mid = DB::table('products')
			->join('categories','products.category_id','categories.id')
			->join('brands','products.brand_id','brands.id')
			->select('products.*','brands.brand_name','categories.category_name')
			->where('products.mid_slider',1)->orderBy('id','desc')->limit(3)
			->get();	
	@endphp
	
	<div class="banner_2">
		<div class="banner_2_background" style="background-image:url({{asset('frontend/images/banner_2_background.jpg')}})"></div>
		<div class="banner_2_container">
			<div class="banner_2_dots"></div>
			<!-- Banner 2 Slider -->
			<div class="owl-carousel owl-theme banner_2_slider">
				<!-- Banner 2 Slider Item -->
				@foreach($mid as $item)
				<div class="owl-item">
					<div class="banner_2_item">
						<div class="container fill_height">
							<div class="row fill_height">
								<div class="col-lg-4 col-md-6 fill_height">
									<div class="banner_2_content">
										<div class="banner_2_category"><h3>{{$item->category_name}}</h3></div>
										<div class="banner_2_title">{{$item->product_name}}</div>
										<div class="banner_2_text"><h4>{{$item->brand_name}}</h4> <br>
											<h2>{{number_format($item->selling_price,0,',','.')}} đ</h2>
										</div>
										<div class="button banner_2_button"><a href="{{asset('product/detail/'.$item->id.'/'.$item->product_name)}}">Mua ngay</a></div>
									</div>
									
								</div>
								<div class="col-lg-8 col-md-6 fill_height">
									<div class="banner_2_image_container ">
										<div class="banner_2_image "><img src="{{asset($item->image_one)}}" alt="" ></div>
									</div>
								</div>
							</div>
						</div>			
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>

	<!-- Hot New Category One -->
	@php 
		$cat = DB::table('categories')->skip(1)->first();
		$product = DB::table('products')->where('category_id',$cat->id)->where('status',1)
					->limit(10)->orderBy('id','DESC')->get();	
	@endphp
	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div class="new_arrivals_title">{{$cat->category_name}}</div>
							<ul class="clearfix">
								<li class="active"></li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="row">
							<div class="col-lg-12" style="z-index:1;">

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">
										<!-- Slider Item -->
										@foreach($product as $item)
										<div class="featured_slider_item">
											<div class="border_active"></div>
											<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset($item->image_one)}}" alt="" ></div>
												<div class="product_content">
													@if($item->discount_price == NULL)
														<div class="product_price discount">{{number_format($item->selling_price,0,',','.')}} đ</div>
													@else
														<div class="product_price discount">{{number_format($item->discount_price,0,',','.')}} đ
														</div>
														<div>
															<span class="old_price">{{number_format($item->selling_price,0,',','.')}} đ</span>
														</div>
													@endif
													<div class="product_name"><div><a href="{{asset('product/detail/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></div></div>
													<div class="product_extras">
														<button class="product_cart_button add-cart" id="{{$item->id}}" data-toggle="modal" data-target="#cartmodel" onclick="proView(this.id)">Add to Cart</button>
													</div>			
												</div>
												<button class="add-wishlist" data-id="{{$item->id}}">
													<div class="product_fav"><i class="fas fa-heart"></i></div>
												</button>
												<ul class="product_marks">
													@if($item->discount_price == NULL)
														<li class="product_mark product_new" >New</li>
													@else
														<li class="product_mark product_discount">
															@php
																$amount = $item->selling_price - $item->discount_price;
																$discount = $amount/$item->selling_price*100;
															@endphp
															{{intval($discount)}} %
														</li>
													@endif	
												</ul>
											</div>
										</div>
										@endforeach
									<div class="arrivals_slider_dots_cover"></div>
								</div>

							</div>
						</div>
								
					</div>
				</div>
			</div>
		</div>		
	</div>

	<!-- Hot New Category Two -->

	@php 
		$cat = DB::table('categories')->skip(5)->first();
		$product = DB::table('products')->where('category_id',$cat->id)->where('status',1)
					->limit(10)->orderBy('id','DESC')->get();	
	@endphp
	
	<div class="">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div class="new_arrivals_title">{{$cat->category_name}}</div>
							<ul class="clearfix">
								<li class="active"></li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="row">
							<div class="col-lg-12" style="z-index:1;">

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">
										<!-- Slider Item -->
										@foreach($product as $item)
										<div class="featured_slider_item">
											<div class="border_active"></div>
											<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset($item->image_one)}}" alt="" ></div>
												<div class="product_content">
													@if($item->discount_price == NULL)
														<div class="product_price discount">{{number_format($item->selling_price,0,',','.')}} đ</div>
													@else
														<div class="product_price discount">{{number_format($item->discount_price,0,',','.')}} đ
														</div>
														<div>
															<span class="old_price">{{number_format($item->selling_price,0,',','.')}} đ</span>
														</div>
													@endif
													<div class="product_name"><div><a href="{{asset('product/detail/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></div></div>
													<div class="product_extras">
														<button class="product_cart_button add-cart" id="{{$item->id}}" data-toggle="modal" data-target="#cartmodel" onclick="proView(this.id)">Add to Cart</button>
													</div>				
												</div>
												<button class="add-wishlist" data-id="{{$item->id}}">
													<div class="product_fav"><i class="fas fa-heart"></i></div>
												</button>
												<ul class="product_marks">
													@if($item->discount_price == NULL)
														<li class="product_mark product_new">New</li>
													@else
														<li class="product_mark product_discount">
															@php
																$amount = $item->selling_price - $item->discount_price;
																$discount = $amount/$item->selling_price*100;
															@endphp
															{{intval($discount)}} %
														</li>
													@endif	
												</ul>
											</div>
										</div>
										@endforeach
									<div class="arrivals_slider_dots_cover"></div>
								</div>

							</div>
						</div>
								
					</div>
				</div>
			</div>
		</div>		
	</div>
	

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

	<!-- Modal with add cart -->
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
									<label>Quantity</label>
									<input onchange="check(this.value)" type="number" class="form-control" name="qty" value="1">
									<input type="hidde" id="p_qty">
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
					$('#pimage').attr('src',data.product.image_one);
					$('#pcode').text(data.product.product_code);
					$('#pcate').text(data.product.category_name);
					$('#psub').text(data.product.subcategory_name);
					$('#pbrand').text(data.product.brand_name);
					$('#product_id').val(data.product.id);
					$('#p_qty').val(data.product.product_quantity);
				}
			})
		}
		function check(qty) {
			if(Number(qty) <= 0 ){
				Swal.fire('Số lượng không hợp lệ', '', 'error');
				setTimeout(function(){
					window.location.reload(1);
					}, 1500);
			}
			else if(Number(qty) > Number($('#p_qty').val())){
				Swal.fire('Không đủ số lượng', '', 'error');
				setTimeout(function(){
					window.location.reload(1);
					}, 1500);
			}
		}

	</script>
	<!-- add wishlist with ajax -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-wishlist').on('click',function(){
				var id = $(this).data('id');
				if(id){
					$.ajax({ 
						url: "{{url('wishlist/add/')}}/" + id , 
						type:"GET",
						dataType:'json',
						success:function(data){ 
							const Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000,
							timerProgressBar: true,
							didOpen: (toast) => {
								toast.addEventListener('mouseenter', Swal.stopTimer)
								toast.addEventListener('mouseleave', Swal.resumeTimer)
							}
							})
							if($.isEmptyObject(data.error)){
								Toast.fire({
								icon: 'success',
								title: data.success
								})
							}else{
								Toast.fire({
								icon: 'error',
								title: data.error
							})
							}
							
						},
					});
				}else{
					alert('danger');
				}
			});
		});
	</script>
	
	
@endsection