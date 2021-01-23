<!DOCTYPE html>
<html lang="en">
<head>
<title>OneHit</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneHit project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/plugins/slick-1.8.0/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/responsive.css')}}">
<!-- chart -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
<!-- <link rel="stylesheet" href="sweetalert2.min.css"> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://js.stripe.com/v3/"></script>


</head>

<body>
<!-- @if (session()->has('flash_notification.success')) <div class="alert alert-success">{!! session('flash_notification.success') !!}</div>
@endif -->
<div class="super_container">
	
	<!-- Header -->
	
	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('frontend/images/phone.png')}}" alt=""></div>+84 986854598</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('frontend/images/mail.png')}}" alt=""></div><a href="mailto:doanhoang4598@gmail.com">doanhoang4598@gmail.com</a></div>
						<div class="top_bar_content ml-auto">
							<div class="top_bar_menu">
								@guest
								@else
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<a href="{{route('home')}}" data-toggle="modal" data-target="#exampleModal">My Tracking Order</a>
									</li>										
								</ul>
								@endguest	
							</div>
							<div class="top_bar_user">
								@guest
								<div><a href="{{route('register')}}"><div class="user_icon"><img src="{{asset('frontend/images/user.svg')}}" alt=""></div>Đăng kí || Đăng nhập</a></div>
								@else
									<ul class="standard_dropdown top_bar_dropdown">
										<li>
											<a href="{{route('home')}}"><div class="user_icon"><img src="{{asset('frontend/images/user.svg')}}" alt=""></div>{{Auth::user()->name}}<i class="fas fa-chevron-down"></i></a>
											<ul>
												<li><a href="{{route('user.wishlist')}}">Wishlist</a></li>
												<li><a href="{{route('user.checkout')}}">Checkout</a></li>
												<li><a href="#">Others</a></li>
												<li><a href="{{route('user.logout')}}">Logout</a></li>
											</ul>
										</li>										
									</ul>
								@endguest	
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-3 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo"><a href="/"><img src="{{asset('frontend/images/logo.png')}}" style="width:170px;height:160px" alt="logo"></a></div>
						</div>
					</div>
				@php 
					$category = DB::table('categories')->get();
				@endphp
					
					<!-- Search -->
					<div class="col-lg-5 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">

									<form action="{{route('product.search')}}" class="header_search_form clearfix" method="post">
										@csrf
										<input type="search" required="required" class="header_search_input" placeholder="Tìm kiếm sản phẩm..." name="search">
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{asset('frontend/images/search.png')}}" alt=""></button>
									</form>

								</div>
							</div>
						</div>
					</div>

					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">

							@guest

							@else

							@php
								$wishlist = DB::table('wishlists')->where('user_id',Auth::id())->get();
							@endphp
								<div class="wishlist_icon"><img src="{{asset('frontend/images/heart.png')}}" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="{{route('user.wishlist')}}">Yêu thích</a></div>
									<div class="wishlist_count">{{count($wishlist)}}</div>
								</div>
							</div>
							@endguest
							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{asset('frontend/images/cart.png')}}" alt="">
										<div class="cart_count"><span>{{Cart::count()}}</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{route('show.cart')}}">Giỏ hàng</a></div>
										<div class="cart_price">{{number_format(Cart::priceTotal(),0,',','.')}} đ</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Main Navigation -->



	<!-- Characteristics -->
	
@yield('content')

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
		<hr><br>
			<div class="row">

				<div class="col-lg-4 footer_col">
					<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo"><a href="#">OneHit</a></div>
						</div>
						<div class="footer_title">Got Question? Call Us 24/7</div>
						<div class="footer_phone">+84 986854598</div>
						<div class="footer_contact_text">
							<p>Giai Phong Ha Noi , VN</p>
						</div>
						<div class="footer_social" style="">
							<ul>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-youtube"></i></a></li>
								<li><a href="#"><i class="fab fa-google"></i></a></li>
								<li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
@php 
$category = DB::table('categories')->limit(6)->get();
$brand = DB::table('brands')->limit(6)->get();
$subcategory = DB::table('subcategories')->limit(6)->get();

@endphp
				<div class="col-lg-3">
					<div class="footer_column">
						<div class="footer_title">Danh mục</div>	
						<ul class="footer_list">
							@foreach($category as $item)
							<li><a href="#">{{$item->category_name}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>

				<div class="col-lg-3">
					<div class="footer_column">
						<div class="footer_title">Phụ danh mục</div>
						<ul class="footer_list">
							@foreach($subcategory as $item)
							<li><a href="#">{{$item->subcategory_name}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<div class="footer_title">Thương hiệu</div>
						<ul class="footer_list">
							@foreach($brand as $item)
							<li><a href="#">{{$item->brand_name}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

<!-- Modal tracking  -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal Tracking</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{route('order.tracking')}}" method="GET">
						@csrf
						<div class="modal-body">
							<label for=""><h4>Status Code</h4></label>
							<input type="text" required="" name="code" class="form-control" placeholder="Order Status Code" >
						</div>
						<button class="btn btn-danger" type="submit" style="margin-left: 13px;">Track Now</button>
					</form>
				</div>
			</div>
		</div>
	</div>

<script src="{{asset('frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('frontend/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('frontend/plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{asset('frontend/plugins/easing/easing.js')}}"></script>
<script src="{{asset('frontend/js/custom.js')}}"></script>
</body>

<!-- toast -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="{{asset('frontend/js/product_custom.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>


 <script>
	@if(Session::has('message'))
		var type="{{Session::get('alert-type','info')}}"
		switch(type){
			case 'info':
				toastr.info("{{ Session::get('message') }}");
				break;
			case 'success':
				toastr.success("{{ Session::get('message') }}");
				break;
			case 'warning':
				toastr.warning("{{ Session::get('message') }}");
				break;
			case 'error':
				toastr.error("{{ Session::get('message') }}");
				break;
		}
	@endif
</script>  

<!-- return order  -->
<script>  
	$(document).on("click", "#return", function(e){
		e.preventDefault();
		var link = $(this).attr("href");
		swal({
			title: "Are you Want to return?",
			icon:'warning',
			text: "One return , this will return your money !", 
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


</html>