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
          
          <li role="presentation" class="active"><a href="{{route('student_records')}}">Records</a></li>
        </ul>
      </div>

      <div class="col-md-9 well">
          <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Record List</h3>
          </div>
          <div class="panel-body">
            @foreach($records as $rec)
              <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <img src="..." alt="...">
                    <div class="caption">
                      <h4 class="text-center">{{$rec->subject->subject_name}}</h4>

                      <p class="text-center"><a href="{{route('student_view_records', ['subject'=> $rec->subject_id])}}" class="btn btn-primary">View Records</a></p>
                      
                    </div>
                  </div>
                </div>

             
            @endforeach
          </div>
        </div>

      </div>
    </div>
</div>
@endsection

@section('scripts')


@endsection