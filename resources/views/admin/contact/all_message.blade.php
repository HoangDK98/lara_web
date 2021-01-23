@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          	<h5>Order Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
		  	<h6 class="card-body-title">Order List
		  	</h6> <br>
			<div class="table-wrapper">
				<table id="datatable1" class="table-striped w-auto">
					<thead>
						<tr>
							<th class="wd-25p">Name</th>
							<th class="wd-15p">Phone</th>
							<th class="wd-20">Email</th>
							<th class="wd-20">Message</th>
							<th class="wd-20">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($message as $key=>$item)
						<tr scope="row">
							<td>{{$item->name}}</td>
							<td>{{$item->phone}}</td>
							<td>{{$item->email}}</td>
							<td>{{$item->message}}</td>				
							<td>
								<a href="" class="btn btn-sm btn-info" >View</a>
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