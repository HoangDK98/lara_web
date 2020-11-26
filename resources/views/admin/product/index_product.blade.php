@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          	<h5>Product Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
		  	<h6 class="card-body-title">Product List
		  		<a href="{{route('product.add')}}" class="btn btn-sm btn-primary" style="float:right" >Add</a>
		  	</h6> <br>
			<div class="table-wrapper">
				<table id="datatable1" class="table display responsive nowrap">
					<thead>
						<tr>
							<th class="wd-10p">Product Code</th>
							<th class="wd-15p">Product Name</th>
							<th class="wd-15p">Image</th>
							<th class="wd-15p">Category</th>
							<th class="wd-15p">Brand</th>
							<th class="wd-10p">Quantity</th>
							<th class="wd-10p">Status</th>
							<th class="wd-25p">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($product as $key=>$item)
						<tr>
							<td>{{$item->product_code}}</td>
							<td>{{$item->product_name}}</td>
							<td><img src="../../{{$item->image_one}}" height="50px" width="50px"></td>
							<td>{{$item->category_name}}</td>
							<td>{{$item->brand_name}}</td>
                            <td>{{$item->product_quantity}}</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            
							<td>
								<a href="{{route('product.edit',$item->id)}}" class="btn btn-sm btn-primary" title="Edit" ><i class="fa fa-edit"></i></a>
								<a href="{{route('product.delete',$item->id)}}" class="btn btn-sm btn-danger" title="Delete" id="delete"><i class="fa fa-trash"></i></a>
								<a href="{{route('product.view',$item->id)}}" class="btn btn-sm btn-warning" title="Show"><i class="fa fa-eye"></i></a>
								@if($item->status == 1)
								<a href="{{route('product.inactive',$item->id)}}" class="btn btn-sm btn-secondary" title="Inactive"><i class="fa fa-thumbs-down"></i></a>
								@else
								<a href="{{route('product.active',$item->id)}}" class="btn btn-sm btn btn-info" title="Active"><i class="fa fa-thumbs-up"></i></a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div><!-- table-wrapper -->
      	</div><!-- card -->
      </div>
    </div><!-- sl-mainpanel -->
	<!-- ########## END: MAIN PANEL ########## -->
	
	<!-- Modal Add -->

    <!-- <div id="modal-add" class="modal fade">
      	<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-header pd-x-20">
					<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Brand</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@if($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<form method="post" action="{{route('brand.store')}}" enctype="multipart/form-data">
					@csrf
					<div class="modal-body pd-20">
						<div class="form-group">
							<label for="addName">Brand name</label>
							<input type="text" name="brand_name" class="form-control" id="addName" placeholder="Brand" ">
                        </div>
                        <div class="form-group">
							<label for="addName">Brand logo</label>
							<input id="img" type="file" accept="image/*" name="brand_logo" class="form-control" placeholder="Brand logo" onchange="previewImg(this)"> </br>
							<img id="avatar" class="thumbnail" alt="brand_logo">
						</div>												
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-info pd-x-20">Save</button>
						<button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
      	</div>
	</div> -->
	
	<!-- end modalAdd -->
	
@endsection