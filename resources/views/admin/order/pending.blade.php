@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          	<h5>Order Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
		  	<h6 class="card-body-title">Order List</h6> <br>
			<div class="table-wrapper">
				<table id="datatable1" class="table-striped w-auto">
					<thead>
						<tr>
							<th class="wd-10p">Order ID</th>
							<th class="wd-15">SubTotal</th>
							<th class="wd-20">Total</th>
							<th class="wd-20">Date</th>
							<th class="wd-20">Status</th>
							<th class="wd-25">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($order as $item)
						<tr scope="row">
							<td>{{$item->id}}</td>
							<td>{{number_format($item->subtotal,0,'.',',')}} đ</td>
							<td>{{number_format($item->total,0,'.',',')}} đ</td>
							<td>{{$item->date}}</td>
							<td>
								@if($item->status == 0)					
								<span class="badge badge-warning">Pending</span>
								@elseif($item->status == 1)
								<span class="badge badge-info">Accept Order</span>
								@elseif($item->status == 2)
								<span class="badge badge-warning">Progress</span>
								@elseif($item->status == 3)
								<span class="badge badge-success">Delevered</span>
								@else
								<span class="badge badge-danger">Cancle</span>
								@endif
							</td>
							<td>
								@if($item->status == 0)
								<a href="{{route('admin.payment.accept',$item->id)}}" class="btn btn-sm btn-success">Accept</a>
								<a href="{{route('admin.view.order',$item->id)}}" class="btn btn-sm btn-info" >View</a>
								@elseif($item->status == 1)
								<a href="{{route('admin.process.delivery',$item->id)}}" class="btn btn-sm btn-success">Delevery</a>
								<a href="{{route('admin.view.order',$item->id)}}" class="btn btn-sm btn-info" >View</a>
								@elseif($item->status == 2)
								<a href="{{route('admin.delivery.done',$item->id)}}" class="btn btn-sm btn-success">Delivered</a>
								<a href="{{route('admin.view.order',$item->id)}}" class="btn btn-sm btn-info" >View</a>
								@else
								<a href="{{route('admin.view.order',$item->id)}}" class="btn btn-sm btn-info" >View</a>
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
	

@endsection