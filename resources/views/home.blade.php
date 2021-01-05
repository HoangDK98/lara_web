@extends('layouts.app')
@section('content')
@php
$order = DB::table('orders')->where('user_id',Auth::id())->orderBy('id','DESC')->limit(10)->get();
@endphp
<div class="contact_form">
    <div class="container">
    <br><hr><br>
        <div class="row">
            <div class="col-8 card">
                <table class="table table-response">
                    <thead>
                        <tr>
                            <th scope="col">Payment Type</th>
                            <th scope="col">Payment ID</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status Code</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $item)
                        <tr>
                            <td>{{$item->payment_type}}</td>
                            <td>{{$item->payment_id}}</td>
                            <td>{{number_format($item->total,0,'.',',')}} đ</td>
                            <td>{{$item->date}}</td>
                            <td>{{$item->status_code}}</td>
                            <td>
                                <a href="" class="btn btn-info">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <div class="card">
                    <img src="{{asset('frontend/images/avt.png')}}" class="card-img-top" style="height:90px;width:90px;margin-left:34%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{Auth::user()->name}}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{route('password.change')}}">Change password</a></li>
                        <li class="list-group-item">line one</li>
                        <li class="list-group-item">line one</li>
                    </ul>
                    <div class="card-body">
                        <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block" >Logout</a> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
