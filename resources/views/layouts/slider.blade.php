	<!-- Banner -->
    @php 
	$slider = DB::table('products')
				->join('brands','brands.id','products.brand_id')
				->select('products.*','brands.brand_name')
				->where('main_slider',1)->orderBy('id','DESC')->first();
@endphp
	<div class="banner">
		<div class="banner_background" style="background-image:url({{asset('frontend/images/banner_background.jpg')}})"></div>
		<div class="container fill_height">
			<div class="row fill_height">
				<div class="banner_product_image"><img src="{{asset($slider->image_one)}}" alt=""style="height:300px"></div>
				<div class="col-lg-5 offset-lg-4 fill_height">
					<div class="banner_content">
						<h2 class="banner_text">{{ $slider->product_name }}</h2>
						<div class="banner_price">
						@if($slider->discount_price == NULL)
							<span>{{$slider->selling_price}} đ
						@else
							<span class="selling_price_slider">{{number_format($slider->discount_price,0,',','.')}} đ </span>
							<span class="discount_price_slider">{{number_format($slider->selling_price,0,',','.')}} đ</span>
						@endif
						</div> <br>
						<div class="button banner_button"><a href="#">Shop Now</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>