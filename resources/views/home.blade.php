@extends('layouts.app')
@section('content')

<div class="contact_form">
    <div class="container">
    <br><hr><br>
        <div class="row">
            <div class="col-8 card">
                <table class="table table-response">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Body</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mark 1</td>
                            <td>Mark 1</td>
                            <td>Mark 1</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Mark 1</td>
                            <td>Mark 1</td>
                            <td>Mark 1</td>
                        </tr><tr>
                            <td>1</td>
                            <td>Mark 1</td>
                            <td>Mark 1</td>
                            <td>Mark 1</td>
                        </tr>
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
