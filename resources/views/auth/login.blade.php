@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/contact_responsive.css')}}">
@section('content')
    <div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 offset-lg-1" style="border:1px solid grey ;padding:30px; border-radius:20px">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Sign in</div>
						<form action="{{route('login')}}" id="contact_form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email or Phone</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" require="" id="exampleInputEmail1"  placeholder="Email or Phone">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                            </div>
                            <div class="form-group">
                                <label for="pass1">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" require="" id="pass1"  placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
							<div class="contact_form_button">
								<button type="submit" class="btn btn-info">Login</button>
                            </div>
                        </form>
                        <br>
                        <a href="{{ route('password.request') }}" class="text-blue">I forgot my password</a><br><br>
                        <button class="btn btn-block btn-primary"><i class="fab fa-facebook"></i> Login with Facebook</button>
                        <button class="btn btn-block btn-danger"><i class="fab fa-google"></i> Login with Google</button>
					</div>
                </div>

                <div class="col-lg-5 offset-lg-1" style="border:1px solid grey ;padding:30px; border-radius:20px">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Sign up</div>
						<form action="{{route('register')}}" id="contact_form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Full name</label>
                                <input type="text" class="form-control" name="name" require="" id="email"  placeholder="Your full name">
                            </div><div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone" require="" id="phone"  placeholder="Your phone">
                            </div><div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" require="" id="email"  placeholder="Your email">
                            </div>
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" name="password" require="" id="pass"  placeholder="Your password">
                            </div>
                            <div class="form-group">
                                <label for="re_pass">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" require="" id="re_pass"  placeholder="Re-Type password">
                            </div>
							<div class="contact_form_button">
								<button type="submit" class="btn btn-info">Sign up</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	</div>
@endsection
