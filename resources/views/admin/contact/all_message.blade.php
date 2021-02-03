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

	<div class="modal fade" id="viewmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" >
					<div class="row" >
						<div class="col-lg-6">
							<ul class="list-group">
								<li class="list-group-item">Name :<span id="name"></span> </li>
								<li class="list-group-item">Phone :<span id="phone"></span> </li>
								<li class="list-group-item">Email :<span id="email"></span> </li>
								<li class="list-group-item">Satus :<span id="status" class="badge"></span></li>
							</ul>
						</div>
						<div class="col-lg-6">
							<h6>Message</h6><br>
							<textarea rows="7" cols="30" id="content_message" disabled></textarea><br>
						</div>
					</div>
				</div>
				<div class="modal-footer" id="modal-foot">
								
				</div>
			</div>
		</div>
	</div>
	
	<!-- ########## END: MAIN PANEL ########## -->

	<script type="text/javascript">
		function proView(id){
			$.ajax({
				url: "{{url('/admin/message/view/')}}/" + id, 
				type :"GET",
				dataType:"json",
				success:function(data){
					$('#name').text(data.message.name);
					$('#phone').text(data.message.phone);
					$('#email').text(data.message.email);
					if(data.message.status == 0){
						$('#status').empty();
						$('#modal-foot').empty();
						$('#status').append("<span class='badge' style='background:#ffc107;color:white'>pendding</span>");
            			$('#modal-foot').append("<a href='http://127.0.0.1:8000/admin/process/message/"+data.message.id+"' class='btn btn-primary'>Xử lý</a>");
					}else{
						$('#status').empty();
						$('#modal-foot').empty();
						$('#status').append("<span class='badge' style='background:green;color:white'>processed</span>");
						$('#modal-foot').append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
					}	
					$('#content_message').val(data.message.message);
				}
			})
		}
	</script>

@endsection