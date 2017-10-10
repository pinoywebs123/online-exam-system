@extends('template.default')

@section('styles')
<style type="text/css">
	.well{
		
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
	<h4 class="text-center">Online Examination Signup Form</h4>
	<form action="{{route('signup_check')}}" method="POST">
		<div class="form-group {{$errors->has('fname') ? 'has-error' : ''}}">
			<label>First Name</label>
			<input type="text" name="fname" class="form-control">
			@if($errors->has('fname'))
				<span class="help-block">{{$errors->first('fname')}}</span>
			@endif
		</div>

		<div class="form-group {{$errors->has('mname') ? 'has-error' : ''}}">
			<label>Middle Name</label>
			<input type="text" name="mname" class="form-control">
			@if($errors->has('mname'))
				<span class="help-block">{{$errors->first('mname')}}</span>
			@endif
		</div>

		<div class="form-group {{$errors->has('lname') ? 'has-error' : ''}}">
			<label>Last Name</label>
			<input type="text" name="lname" class="form-control">
			@if($errors->has('lname'))
				<span class="help-block">{{$errors->first('lname')}}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('contact') ? 'has-error' : ''}}">
			<label>Contact</label>
			<input type="number" name="contact" class="form-control">
			@if($errors->has('contact'))
				<span class="help-block">{{$errors->first('contact')}}</span>
			@endif
		</div>

		<div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
			<label>Email</label>
			<input type="email" name="email" class="form-control">
			@if($errors->has('email'))
				<span class="help-block">{{$errors->first('email')}}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
			<label>Username</label>
			<input type="text" name="username" class="form-control">
			@if($errors->has('username'))
				<span class="help-block">{{$errors->first('username')}}</span>
			@endif
		</div>

		<div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
			<label>Password</label>
			<input type="password" name="password" class="form-control">
			@if($errors->has('password'))
				<span class="help-block">{{$errors->first('password')}}</span>
			@endif
		</div>

		<div class="form-group {{$errors->has('repeat_password') ? 'has-error' : ''}}">
			<label>Repeat Password</label>
			<input type="password" name="repeat_password" class="form-control">
			@if($errors->has('repeat_password'))
				<span class="help-block">{{$errors->first('repeat_password')}}</span>
			@endif
		</div>
		<button type="submit" class="btn btn-success btn-block">Submit</button>
		{{csrf_field()}}
	</form>
</div>

@endsection

@section('scripts')


@endsection