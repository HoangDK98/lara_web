@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          	<h5>Message</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
		  	<h6 class="card-body-title">All message
		  	</h6> <br>
			<div class="table-wrapper">
				<table id="datatable1" class="table-striped w-auto">
					<thead>
						<tr>
							<th class="wd-20">Name</th>
							<th class="wd-15">Phone</th>
							<th class="wd-20">Email</th>
							<th class="wd-20">Message</th>
							<th class="wd-15">Status</th>
							<th class="wd-20">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($message as $key=>$item)
						<tr scope="row">
							<td>{{$item->name}}</td>
							<td>{{$item->phone}}</td>
							<td>{{$item->email}}</td>
							<td>{{substr($item->message,0,50)}} ......</td>		
							<td>
								@if($item->status == 0)
								<span class="badge badge-warning">pending</span>
								@else
								<span class="badge badge-success">processed</span>
								@endif
							</td>		
							<td>							
								<button id="{{$item->id}}" onclick="proView(this.id)" data-toggle="modal" data-target="#viewmessage" class="btn btn-sm btn-info" >View</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div><!-- table-wrapper -->
      	</div><!-- card -->
      </div>
    </div><!-- sl-mainpanel -->


	<!-- Modal read message -->
	
	<!-- ########## END: MAIN PANEL ########## -->

	

@endsection