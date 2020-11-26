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
				<h6 class="card-body-title">New Product Add
					<a href="{{route('product.all')}}" class="btn btn-primary btn-sm pull-right">All Product</a>
				</h6> </br>
				<form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
				@csrf
					<div class="form-layout">
						<div class="row mg-b-25">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="product_name" class="form-control-label">Product name : <span class="tx-danger">*</span></label>
									<input id="product_name" class="form-control" type="text" name="product_name" value="" placeholder="Enter product">
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group">
									<label for="product_code" class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
									<input id="product_code" class="form-control" type="text" name="product_code" value="" placeholder="Product code">
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group">
									<label for="product_quantity" class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
									<input id="product_quantity" class="form-control" type="text" name="product_quantity" value="" placeholder="Quantity">
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Category: <span class="tx-danger">*</span></label>
									<select class="form-control select2" data-placeholder="Choose country" name="category_id">
										<option label="Choose country"></option>
										@foreach($category as $item)
										<option value="{{$item->id}}">{{$item->category_name}}</option>
										@endforeach
									</select>
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label>
									<select class="form-control select2" data-placeholder="Choose country" name="subcategory_id">
										
									</select>
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
									<select class="form-control select2" data-placeholder="Choose country" name="brand_id">
										<option label="Choose country"></option>
										@foreach($brand as $item)
										<option value="{{$item->id}}">{{$item->brand_name}}</option>
										@endforeach
									</select>
								</div>
							</div><!-- col-4 -->

							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
									<input class="form-control" type="text" name="product_size" id="size" data-role="tagsinput" placeholder="Size">
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
									<input class="form-control" type="text" name="product_color" id="color" data-role="tagsinput" placeholder="Enter Color">
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Selling price: <span class="tx-danger">*</span></label>
									<input class="border form-control" type="text" name="selling_price" id="size" placeholder="Selling Price">
								</div>
							</div><!-- col-12 -->	
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-control-label">Product detail: <span class="tx-danger">*</span></label>
									<textarea class="form-control" id="summernote" name="product_details"></textarea>
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-12">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Video Link: <span class="tx-danger">*</span></label>
									<input class="form-control" id="summernote" name="video_link">
								</div>
							</div><!-- col-4 -->
							
							
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">Image One(Main thumbnail): <span class="tx-danger">*</span></label>
									<label class="custom-file">
										<input type="file" id="file" class="custom-file-input" name="image_one" accept="image/*" onchange="previewImg1(this);">
										<span class="custom-file-control"></span>
										<img src="#" id="one">
									</label>
								</div>
							</div><!-- col-4 -->	
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
									<label class="custom-file">
										<input type="file" id="file" class="custom-file-input" name="image_two" accept="image/*" onchange="previewImg2(this);">
										<span class="custom-file-control"></span>
										<img src="#" id="two">
									</label>
								</div>
							</div><!-- col-4 -->	
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
									<label class="custom-file">
										<input type="file" id="file" class="custom-file-input" name="image_three" accept="image/*" onchange="previewImg3(this);">
										<span class="custom-file-control"></span>
										<img src="#" id="three">
									</label>
								</div>
							</div><!-- col-4 -->	
						</div> <!-- row -->

						<hr><br><br><br>
						<div class="row">
							<div class="col-lg-4">
								<label class="ckbox">
									<input type="checkbox" name="main_slider" value="1">
									<span>Main slider </span>
								</label>
							</div>
							<div class="col-lg-4">
								<label class="ckbox">
									<input type="checkbox" name="hot_deal" value="1">
									<span>Hot Deal </span>
								</label>
							</div>
							<div class="col-lg-4">
								<label class="ckbox">
									<input type="checkbox" name="best_rated" value="1">
									<span>Best Rate</span>
								</label>
							</div>
							<div class="col-lg-4">
								<label class="ckbox">
									<input type="checkbox" name="trend" value="1">
									<span>Trend Product </span>
								</label>
							</div>
							<div class="col-lg-4">
								<label class="ckbox">
									<input type="checkbox" name="mid_slider" value="1">
									<span>Mid slider</span>
								</label>
							</div>
							<div class="col-lg-4">
								<label class="ckbox">
									<input type="checkbox" name="hot_new" value="1">
									<span>Hot New </span>
								</label>
							</div>
						 </div> <!-- end row -->
										
					</div><!-- form-layout --><br><br>
					<div class="form-layout-footer">
						<button class="btn btn-info mg-r-5">Add</button>
						<button class="btn btn-secondary">Cancel</button>
					</div><!-- form-layout-footer -->
				</form>
			</div><!-- card -->
		</div>

    </div><!-- sl-mainpanel -->
	<!-- ########## END: MAIN PANEL ########## -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<script type="text/javascript">
      $(document).ready(function(){
     $('select[name="category_id"]').on('change',function(){
          var category_id = $(this).val();
          if (category_id) {
			
            
            $.ajax({
			
              url: "{{ url('/get/subcategory/') }}/"+category_id,
              type:"GET",
              dataType:"json",
              success:function(data) { 
              var d =$('select[name="subcategory_id"]').empty();
              $.each(data, function(key, value){
              
              $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');

              });
              },
            });

          }else{
            alert('danger');
          }

            });
      });

 </script>
 <script>
      $(window).on('resize', function() {
      if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
      })
      $(window).on('resize', function() {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
      })
      function previewImg3(input) {
		if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$('#three')
			.attr('src', e.target.result)
			.width(80)
			.height(80);
		};
      reader.readAsDataURL(input.files[0]);
    }
	  }
        
	</script>
	<script>
      $(window).on('resize', function() {
      if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
      })
      $(window).on('resize', function() {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
      })
      function previewImg1(input) {
		if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$('#one')
			.attr('src', e.target.result)
			.width(80)
			.height(80);
		};
      reader.readAsDataURL(input.files[0]);
    }
	  }
        
	</script>
	<script>
      $(window).on('resize', function() {
      if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
      })
      $(window).on('resize', function() {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
      })
      function previewImg2(input) {
		if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$('#two')
			.attr('src', e.target.result)
			.width(80)
			.height(80);
		};
      reader.readAsDataURL(input.files[0]);
    }
	  }
        
	</script>
@endsection
