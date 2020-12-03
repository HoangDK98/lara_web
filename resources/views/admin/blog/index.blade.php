@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          	<h5>Post List</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
		  	<h6 class="card-body-title">Post List
		  		<a href="{{route('add.post')}}" class="btn btn-sm btn-primary" style="float:right" >Add New Post</a>
		  	</h6> <br>
			<div class="table-wrapper">
				<table id="datatable1" class="table-striped w-auto">
					<thead>
						<tr>
							<th class="wd-20p">Post Title</th>
							<th class="wd-30p">Post Category</th>
							<th class="wd-30p">Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($post as $key=>$item)
						<tr scope="row">
							<td>{{$item->post_title_en}}</td>
							<td>{{$item->category_name_en}}</td>
							<td><img src="{{asset($item->post_image)}}" width="60px" height="60px"></td>
							<td>
								<a href="{{route('edit.post',$item->id)}}" class="btn btn-sm btn-info" >Edit</a>
								<a href="{{route('delete.post',$item->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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

@endsection