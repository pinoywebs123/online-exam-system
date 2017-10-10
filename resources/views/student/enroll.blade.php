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
          <li role="presentation" ><a href="{{route('student_main')}}">Enrolled</a></li>
          <li role="presentation" class="active"><a href="{{route('student_subjects')}}">Subjects</a></li>
          
          <li role="presentation" ><a href="{{route('student_records')}}">Records</a></li>
        </ul>
      </div>

      <div class="col-md-9 well">
          <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">{{$subjects->subject_name}}</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-4 col-md-offset-4">
              <form action="" method="POST">
                <div class="form-group">
                  <label>Enter Enrollment Code</label>
                  <input type="text" name="enroll_code" class="form-control" required="">
                </div>
                <button type="submit" class="btn btn-primary btn-block">SEND</button>
                {{csrf_field()}}
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