@extends('layouts.app')

@section('content')
    <div class="contact-form">
        <div class="container"><hr><br>
            <div class="row">
                <div class="col-5 offset-lg-1">
                    <div class="contact_form_title"><h4>Your Order Status</h4></div><br>
                    <div class="progress">
                        @if($tracking->status == 0)
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        @elseif($tracking->status == 1)
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        @elseif($tracking->status == 2)
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        @elseif($tracking->status == 3)
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        @else
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        @endif                    
                    </div> <br>
                
                    @if($tracking->status == 0)
                    <h4>Note : Chờ xác nhận  </h4>
                    @elseif($tracking->status == 1)
                    <h4>Note : Chờ lấy hàng </h4>
                    @elseif($tracking->status == 2)
                    <h4>Note : Đang giao </h4>
                    @elseif($tracking->status == 3)
                    <h4>Note : Đã giao</h4>
                    @else
                    <h4>Đã hủy</h4>
                    @endif 

                </div>
                <div class="col-5 offset-lg-1">
                    <div class="contact_form_title"><h4>Chi tiết đơn hàng </h4></div>
                    <div class="list-group col-lg-12">
                        <div class="list-group-item"><b>Payment Type :</b> {{$tracking->payment_type}}</div>
                        <div class="list-group-item"><b>Transition ID :</b> {{$tracking->payment_id}}</div>
                        <div class="list-group-item"><b>Balance ID :</b> {{$tracking->balance_transaction}}</div>
                        <div class="list-group-item"><b>Subtotal :</b> {{$tracking->subtotal}}</div>
                        <div class="list-group-item"><b>Shipping :</b> {{$tracking->shipping}}</div>
                        <div class="list-group-item"><b>Total :</b> {{$tracking->total}}</div>
                        <div class="list-group-item"><b>Month :</b> {{$tracking->month}}</div>
                        <div class="list-group-item"><b>Date :</b> {{$tracking->date}}</div>
                        <div class="list-group-item"><b>Year :</b> {{$tracking->year}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection