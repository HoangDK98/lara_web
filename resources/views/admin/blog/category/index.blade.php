@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          	<h5>Blog Categories Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
		  	<h6 class="card-body-title">Blog Categories List
		  		<a href="#" class="btn btn-sm btn-primary" style="float:right" data-toggle="modal" data-target="#modal-add">Add New Categoies</a>
		  	</h6> <br>
			<div class="table-wrapper">
				<table id="datatable1" class="table-striped w-auto">
					<thead>
						<tr>
							<th class="wd-20p">ID</th>
							<th class="wd-30p">Category Name En</th>
							<th class="wd-30p">Category Name Hint</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($blogcate as $key=>$item)
						<tr scope="row">
							<td>{{$item->id}}</td>
							<td>{{$item->category_name_en}}</td>
							<td>{{$item->category_name_in}}</td>
							<td>
								<a href="{{route('blog.category.edit',$item->id)}}" class="btn btn-sm btn-info" >Edit</a>
								<a href="{{route('blog.category.delete',$item->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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
    <div id="modal-add" class="modal fade">
      	<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-header pd-x-20">
					<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Category</h6>
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
				<form method="post" action="{{route('blog.category.store')}}">
					@csrf
					<div class="modal-body pd-20">
						<div class="form-group">
							<label for="addName">Category Name En</label>
							<input type="text" name="category_name_en" class="form-control" id="addName" placeholder="Category Name Endlish">
                        </div>	
                        <div class="form-group">
							<label for="addName">Category Name Hindi</label>
							<input type="text" name="category_name_in" class="form-control" id="addName" placeholder="Category Name Hindi">
						</div>											
                    </div><!-- modal-body -->
					<div class="modal-footer">
						<button type="submit" class="btn btn-info pd-x-20">Save</button>
						<button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
      	</div><!-- modal-dialog -->
	</div><!-- end modalAdd -->
	

@endsection