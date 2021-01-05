@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Order details</h6> <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>Order</strong> Details</div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>{{$order->name}}</th>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <th>{{$order->phone}}</th>
                                </tr><tr>
                                    <th>Payment Type</th>
                                    <th>{{$order->payment_type}}</th>
                                </tr><tr>
                                    <th>Payment ID</th>
                                    <th>{{$order->payment_id}}</th>
                                </tr><tr>
                                    <th>Total</th>
                                    <th>{{number_format($order->total,0,'.',',')}}</th>
                                </tr><tr>
                                    <th>Moth</th>
                                    <th>{{$order->month}}</th>
                                </tr><tr>
                                    <th>Date</th>
                                    <th>{{$order->date}}</th>


                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="card">
                        <div class="card-header"><strong>Shipping</strong> Details</div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>{{$shipping->ship_name}}</th>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <th>{{$shipping->ship_phone}}</th>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <th>{{$shipping->ship_email}}</th>
                                </tr>
                                <tr>
                                    <th>Addreess</th>
                                    <th>{{$shipping->ship_address}}</th>
                                </tr>
                                    <th>City</th>
                                    <th>{{$shipping->ship_city}}</th>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <th>
                                        @if($order->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                        @elseif($order->status == 1)
                                        <span class="badge badge-info">Payment Accept</span>
                                        @elseif($order->status == 2)
                                        <span class="badge badge-warning">Progress</span>
                                        @elseif($order->status == 3)
                                        <span class="badge badge-success">Delivered</span>
                                        @else
                                        <span class="badge badge-danger">Cancle</span>
                                        @endif
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="row">
                      
                <div class="card pd-20 pd-sm-40 col-lg-12">
                <div class="card-header"><strong>Product</strong> Details</div>
                    <br>
                    <div class="table-wrapper">
                        <table class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-10p">Product ID</th>
                                    <th class="wd-15p">Product Name</th>
                                    <th class="wd-15p">Image</th>
                                    <th class="wd-15p">Color</th>
                                    <th class="wd-10p">Quantity</th>
                                    <th class="wd-10p">Unit Price</th>
                                    <th class="wd-25p">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $item)
                                <tr>
                                    <td>{{$item->product_id}}</td>
                                    <td>{{$item->product_name}}</td>
                                    <td><img src="{{asset($item->image_one)}}" height="50px" width="50px"></td>
                                    <td>{{$item->color}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->single_price}}</td>
                                    <td>{{$item->total_price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
                </div><!-- card -->

            </div>
            @if($order->status == 0)
            <a href="{{route('admin.payment.accept',$order->id)}}" class="btn btn-info">Payment Accept</a><hr>
            <a href="{{route('admin.payment.cancle',$order->id)}}" class="btn btn-danger">Order Cancle</a>
            @elseif($order->status == 1)
            <a href="{{route('admin.process.delivery',$order->id)}}" class="btn btn-info">Progress Delevery</a><hr>
            @elseif($order->status == 2)
            <a href="{{route('admin.delivery.done',$order->id)}}" class="btn btn-success">Delivery Done</a><hr>
            @endif
        </div>
      </div>
    </div>

@endsection