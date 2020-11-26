@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
		<nav class="breadcrumb sl-breadcrumb">
			<a class="breadcrumb-item" href="index.html">Starlight</a>
			<span class="breadcrumb-item active">Product Section</span>
		</nav>

		<div class="sl-pagebody">
			<div class="card pd-20 pd-sm-40">
				<h6 class="card-body-title">Product Detail Page
					<a href="{{route('product.all')}}" class="btn btn-primary btn-sm pull-right">All Product</a>
				</h6> </br>
					<div class="form-layout">
						<div class="row mg-b-25">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="product_name" class="form-control-label">Product name : <span class="tx-danger"></span></label>
                                    <br><p>{{$product->product_name}}</p>
                                </div>
							</div><!-- col-4 -->
							<div class="col-lg-4 ">
								<div class="form-group ">
									<label for="product_code" class="form-control-label text-center">Product Code: <span class="tx-danger"></span></label>
                                    <br><p>{{$product->product_code}}</p>
                                </div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group">
									<label for="product_quantity" class="form-control-label">Quantity: <span class="tx-danger"></span></label>
                                    <br><p>{{$product->product_quantity}}</p>
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Category: <span class="tx-danger"></span></label>
                                    <br><p>{{$product->category_name}}</p>
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Sub Category: <span class="tx-danger"></span></label>
                                    <br><p>{{$product->subcategory_name}}</p>
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Brand: <span class="tx-danger"></span></label>
                                    <br><p>{{$product->brand_name}}</p>
								</div>
							</div><!-- col-4 -->

							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Product Size: <span class="tx-danger"></span></label>
                                    <br><p>{{$product->product_size}}</p>
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Product Color: <span class="tx-danger"></span></label>
                                    <br><p>{{$product->product_color}}</p>
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Selling price: <span class="tx-danger"></span></label>
                                    <br><p>{{$product->selling_price}}</p>
								</div>
							</div><!-- col-12 -->	
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-control-label">Product details: <span class="tx-danger"></span></label>
                                    <br><p>{{!! $product->product_details !!}}</p>
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-12">
								<div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Video Link: <span class="tx-danger"></span></label>
                                    <br><p>{{$product->video_link}}</p>
								</div>
							</div><!-- col-4 -->
							
							
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">Image One(Main thumbnail): <span class="tx-danger"></span></label>
									<br><label class="custom-file">
										<img src="{{asset($product->image_one)}}" width="80px" height="80px" >
									</label>
								</div>
							</div><!-- col-4 -->	
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">Image Two: <span class="tx-danger"></span></label>
                                    <br><img src="{{asset($product->image_two)}}" width="80px" height="80px" >
								</div>
							</div><!-- col-4 -->	
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">Image Three: <span class="tx-danger"></span></label>
                                    <br><img src="{{asset($product->image_three)}}" width="80px" height="80px" >
								</div>
							</div><!-- col-4 -->	
						</div> <!-- row -->

						<hr><br>
						<div class="row">
							<div class="col-lg-4">
								<label class="">
                                    @if($product->main_slider == 1)
                                    <span class="badge badge-success" title="active">Main slider </span>
                                    @else
                                    <span class="badge badge-danger"title="inactive">Main slider </span>
                                    @endif
								</label>
							</div>
							<div class="col-lg-4">
                                <label class="">
                                    @if($product->hot_deal == 1)
                                    <span class="badge badge-success" title="active">Hot deal </span>
                                    @else
                                    <span class="badge badge-danger"title="inactive">Hot deal </span>
                                    @endif
								</label>
							</div>
							<div class="col-lg-4">
                                <label class="">
                                    @if($product->best_rated == 1)
                                    <span class="badge badge-success" title="active">Best rate </span>
                                    @else
                                    <span class="badge badge-danger"title="inactive">Best rate </span>
                                    @endif
								</label>
							</div>
							<div class="col-lg-4">
                                <label class="">
                                    @if($product->trend == 1)
                                    <span class="badge badge-success" title="active">Trend </span>
                                    @else
                                    <span class="badge badge-danger"title="inactive">Trend </span>
                                    @endif
								</label>
							</div>
							<div class="col-lg-4">
                                <label class="">
                                    @if($product->mid_slider == 1)
                                    <span class="badge badge-success" title="active">Mid slider </span>
                                    @else
                                    <span class="badge badge-danger"title="inactive">Mid slider </span>
                                    @endif
								</label>
							</div>
							<div class="col-lg-4">
                                <label class="">
                                    @if($product->hot_new == 1)
                                    <span class="badge badge-success" title="active">Hot new </span>
                                    @else
                                    <span class="badge badge-danger" title="inactive">Hot new </span>
                                    @endif
								</label>
							</div>
						 </div> <!-- end row -->
										
					</div><!-- form-layout -->
				</form>
			</div><!-- card -->
		</div>

    </div><!-- sl-mainpanel -->

@endsection
