@extends('template.default')

@section('styles')
<style type="text/css">
	.well{
		margin-top: 10%;
		opacity: 0.8;
		border-radius: 10px;
	}
	body { 
			 background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('{{URL::to('image/bg.jpg')}}');
			background-position: center center;
			background-repeat:  no-repeat;
			background-attachment: fixed;
			background-size:  cover;
			background-color: #999;
			font-family: 'Raleway', sans-serif;
 			
	}
	#reg{
		color: gray;

	}

</style>

@endsection

@section('contents')

<div class="col-md-4 col-md-offset-4 well">
	<h3 class="text-center">Online Examination</h3>
	@if(Session::has('register'))
		<div class="alert alert-success alert-dismissable">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Success!</strong>{{Session::get('register')}}
		</div>
	@endif
	@if(Session::has('error'))
		<div class="alert alert-danger alert-dismissable">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		 {{Session::get('error')}}
		</div>
	@endif
	<form action="{{route('loginCheck')}}" method="POST">
		<div class="form-group {{$errors->has('username') ? 'has-error': ''}}">
			<label>Username</label>
			<input type="text" name="username" class="form-control" maxlength="12">
			@if($errors->has('username'))
				<span class="help-block">{{$errors->first('username')}}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('password') ? 'has-error': ''}}">
			<label>Password</label>
			<input type="password" name="password" class="form-control" maxlength="12">
			@if($errors->has('password'))
				<span class="help-block">{{$errors->first('password')}}</span>
			@endif
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success btn-block">Log-in</button>
			<p class="text-center"><a href="{{route('signup')}}" id="reg">Sign-up</a></p>
			{{csrf_field()}}
		</div>

	</form>

	<p class="text-right"><a href="{{route('forgot_password')}}">Forgot Password</a></p>
</div>

@endsection

@section('scripts')


@endsection