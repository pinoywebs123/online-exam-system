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
          <li role="presentation"><a href="{{route('student_subjects')}}">Subjects</a></li>
          
          <li role="presentation" ><a href="{{route('student_records')}}">Records</a></li>
        </ul>
      </div>

      <div class="col-md-9 well">
          <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Remarks List</h3>
          </div>
          <div class="panel-body">
            Panel content
          </div>
        </div>

      </div>
    </div>
</div>
@endsection

@section('scripts')


@endsection