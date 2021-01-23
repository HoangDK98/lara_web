@extends('admin.admin_layouts')

@section('admin_content')


@php
    $d = date('d-m-y');
    $day = DB::table('orders')->where('date',$d)->whereIn('status',[0,1,2,3])->sum('total'); 
    $m = date('F');
    $month = DB::table('orders')->where('month',$m)->whereIn('status',[0,1,2,3])->sum('total');
    $y = date('Y');
    $year = DB::table('orders')->where('year',$y)->whereIn('status',[0,1,2,3])->sum('total');

	$count_d = DB::table('orders')->where('date',$d)->whereIn('status',[0,1,2,3])->count();
	$count_m = DB::table('orders')->where('month',$m)->whereIn('status',[0,1,2,3])->count();
	$count_y = DB::table('orders')->where('year',$y)->whereIn('status',[0,1,2,3])->count();

	$category = DB::table('categories')->get()->count();
	$sub_category = DB::table('subcategories')->get()->count();
	$brand = DB::table('brands')->get()->count();
	$product = DB::table('products')->get()->count();

@endphp
<link href="{{asset('backend/css/styles.css')}}" rel="stylesheet">

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
	<nav class="breadcrumb sl-breadcrumb">
		<span class="breadcrumb-item active"><h2>Trang chủ</h2></span>
	</nav>
	<div class="sl-pagebody">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<h2 class="col-sm-3 col-lg-4 widget-left">
							{{$category}}
						</h2>
						<div class="col-sm-9 col-lg-7 widget-right">
							<a href="{{route('categories')}}" class="text-center">Category</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<h2 class="col-sm-3 col-lg-4 widget-left">
							{{$sub_category}}
						</h2>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large text-center"></div>
							<a href="{{route('sub.categories')}}" class="text-center">Subcategory</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<h2 class="col-sm-3 col-lg-4 widget-left">
							{{$product}}
						</h2>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large text-center"></div>
							<a href="{{route('product.all')}}" class="text-center">Products</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<h2 class="col-sm-3 col-lg-4 widget-left">
							{{$brand}}
						</h2>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large text-center"></div>
							<a href="{{route('brands')}}" class=" text-center">Brands</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><br><br>
		<div class="row row-sm ">
			<div class="col-xl-4">
				<div class="card pd-20 bg-primary">
					<div class="d-flex justify-content-between align-items-center mg-b-10">
						<h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Ngày</h6>
						<h6 href="" class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><i>Doanh thu</i></h6>
						<h6 href="" class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><i>Đơn hàng</i></h6>
					</div><!-- card-header --><br>
					<div class="d-flex align-items-center justify-content-between">
						<span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
						<h6 class="mg-b-0 tx-white tx-lato tx-bold">{{number_format($day,0,',','.')}} đ</h6>
						<h6 class="mg-b-0 tx-white tx-lato tx-bold">{{$count_d}}</h6>
					</div><!-- card-body -->
				</div><!-- card -->
			</div><!-- col-3 -->
			<div class="col-xl-4 mg-t-20 mg-xl-t-0">
				<div class="card pd-20 bg-purple">
				<div class="d-flex justify-content-between align-items-center mg-b-10">
					<h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Tháng</h6>
					<h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><i>Doanh thu</i></h6>
					<h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><i>Đơn hàng</i></h6>
				</div><!-- card-header --><br>
				<div class="d-flex align-items-center justify-content-between">
					<span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
					<h6 class="mg-b-0 tx-white tx-lato tx-bold">{{number_format($year,0,',','.')}} đ</h6>
					<h6 class="mg-b-0 tx-white tx-lato tx-bold">{{$count_m}}</h6>
				</div><!-- card-body -->
				</div><!-- card -->
			</div><!-- col-3 -->
			<div class="col-xl-4 mg-t-20 mg-xl-t-0">
				<div class="card pd-20 bg-success">
				<div class="d-flex justify-content-between align-items-center mg-b-10">
					<h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Năm</h6>
					<h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><i>Doanh thu</i></h6>
					<h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><i>Đơn hàng</i></h6>
				</div><!-- card-header --> <br>
				<div class="d-flex align-items-center justify-content-between">
					<span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
					<h6 class="mg-b-0 tx-white tx-lato tx-bold">{{number_format($year,0,',','.')}} đ</h6>
					<h6 class="mg-b-0 tx-white tx-lato tx-bold">{{$count_y}}</h6>
				</div><!-- card-body -->
				</div><!-- card -->
			</div><!-- col-3 -->
		</div><!-- row -->

		
		
	</div>

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


@endsection
