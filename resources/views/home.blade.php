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
                            <th scope="col">Order ID</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{number_format($item->total,0,'.',',')}} đ</td>
                            <td>{{$item->date}}</td>
                            <td>
                                @if($item->status == 0)
                                <span class="badge badge-warning">Pending</span>
                                @elseif($item->status == 1)
                                <span class="badge badge-info">Payment Accept</span>
                                @elseif($item->status == 2)
                                <span class="badge badge-warning">Progress</span>
                                @elseif($item->status == 3)
                                <span class="badge badge-success">Delivered</span>
                                @else
                                <span class="badge badge-danger">Cancle</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ Auth::user()->name }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> <a href="{{ route('password.change') }}">Edit Profile</a>  </li>
                        <li class="list-group-item"> <a href="{{ route('password.change') }}">Change Password</a>  </li>
                    </ul>
                    <div class="card-body">
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br>
@endsection
