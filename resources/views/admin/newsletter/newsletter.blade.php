@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          	<h5>Newsletter Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
		  	<h6 class="card-body-title">Newsletter List
		  		<a href="#" class="btn btn-sm btn-primary" style="float:right" data-toggle="modal" data-target="#modal-add">Delete all</a>
		  	</h6> <br>
			<div class="table-wrapper">
				<table id="datatable1" class="table-striped w-auto">
					<thead>
						<tr>
							<th class="wd-20p"><input type="checkbox"> ID</th>
							<th class="wd-30p">Email</th>
							<th class="wd-30p">Subcribiing Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($newsletter as $key=>$item)
						<tr scope="row">
							<td> <input type="checkbox"> {{$item->id}}</td>
							<td>{{$item->email}}</td>
							<td>{{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</td>
							<td>
								<a href="{{route('newsletter.delete',$item->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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
					<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Newsletter</h6>
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
				<form method="post" action="{{route('newsletter.store')}}">
					@csrf
					<div class="modal-body pd-20">
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" id="email" placeholder="email">
                        </div>												
					</div><!-- modal-body -->
					<div class="modal-footer">
						<button type="submit" class="btn btn-info pd-x-20">Save</button>
						<button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
      	</div><!-- modal-dialog -->
	</div>
	
@endsection