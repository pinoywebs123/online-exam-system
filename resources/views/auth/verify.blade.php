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
	@if(Session::has('error'))
		<div class="alert alert-danger alert-dismissable">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Information!</strong>{{Session::get('error')}}
		</div>
	@endif
	@if(Session::has('success'))
		<div class="alert alert-success alert-dismissable">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Information!</strong>{{Session::get('success')}}
		</div>
	@endif
	<form action="{{route('verify_me_check')}}" method="POST">
		<div class="form-group {{$errors->has('email') ? 'has-error': ''}}">
			<label>Email</label>
			<input type="email" name="email" class="form-control" maxlength="30">
			@if($errors->has('email'))
				<span class="help-block">{{$errors->first('email')}}</span>
			@endif
		</div>
		<div class="form-group {{$errors->has('code') ? 'has-error': ''}}">
			<label>Code</label>
			<input type="text" name="code" class="form-control" maxlength="12">
			@if($errors->has('code'))
				<span class="help-block">{{$errors->first('code')}}</span>
			@endif
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success btn-block">SUBMIT</button>
			
			{{csrf_field()}}
		</div>

	</form>
</div>

@endsection

@section('scripts')


@endsection