@extends('template.default')

@section('styles')
<style type="text/css">
  body{
    background-color: gray;
  }
</style>

@endsection

@section('contents')
<div class="container">
    <div>
      <div class="col-md-3 well">
        <ul class="nav nav-pills nav-stacked">
          <li role="presentation" class="active"><a href="{{route('student_main')}}">Enrolled</a></li>
          <li role="presentation"><a href="{{route('student_subjects')}}">Subjects</a></li>
         
          <li role="presentation"><a href="{{route('student_records')}}">Records</a></li>
        </ul>
      </div>

      <div class="col-md-9 well">
          <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Settings Page</h3>
          </div>
          <div class="panel-body">
           
            
            <div class="col-md-6">
                     @if(Session::has('info'))
                        <div class="alert alert-info">{{Session::get('info')}}</div>
                    @endif
                     <h3 class="text-center">Change Password</h3>
                     <form action="{{route('student_change_password')}}" method="POST">
                      
                       <div class="form-group {{$errors->has('new_password') ? 'has-error': ''}}">
                         <label>New Password</label>
                         <input type="password" name="new_password" class="form-control"  maxlength="12">
                          @if($errors->has('new_password'))
                          <span class="help-block">{{$errors->first('new_password')}}</span>
                         @endif
                       </div>
                       <div class="form-group {{$errors->has('repeat_new_password') ? 'has-error': ''}}">
                         <label>Repeat New Password</label>
                         <input type="password" name="repeat_new_password" class="form-control"  maxlength="12">
                         @if($errors->has('repeat_new_password'))
                          <span class="help-block">{{$errors->first('repeat_new_password')}}</span>
                         @endif
                       </div>
                       <button type="submit" class="btn btn-primary">Submit</button>
                       {{csrf_field()}}
                     </form>
                   </div>

                   <div class="col-md-6">
                     <h3 class="text-center">Edit Information</h3>
                      @if(Session::has('info2'))
                        <div class="alert alert-info">{{Session::get('info2')}}</div>
                    @endif
                     <form action="{{route('student_change_settings')}}" method="POST">
                       <div class="form-group {{$errors->has('email') ? 'has-error': ''}}">
                         <label>Email</label>
                         <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
                       </div>
                       <div class="form-group {{$errors->has('contact') ? 'has-error': ''}}">
                         <label>Contact</label>
                         <input type="number" name="contact" class="form-control" value="{{Auth::user()->contact}}">
                       </div>
                       
                       {{csrf_field()}}
                       <button type="submit" class="btn btn-info">Update</button>
                     </form>
                   </div>

            
          </div>
        </div>

      </div>
    </div>
</div>
@endsection

@section('scripts')


@endsection