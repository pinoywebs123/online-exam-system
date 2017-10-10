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
            <h3 class="panel-title">Enrolled Subject List</h3>
          </div>
          <div class="panel-body">
            @if(Session::has('info'))
              <div class="alert alert-success alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Information!</strong> {{Session::get('info')}}
            </div>
            @endif
           

            @foreach($enroll as $sub)
                <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <img src="..." alt="...">
                    <div class="caption">
                      <h4 class="text-center">{{$sub->subject->subject_name}}</h4>
                      <p>...</p>
                      @if($sub->examCheck($sub->subject_id) > 0)
                       <p class="text-center"><button class="btn btn-danger" disabled="">Progress</button></p> 
                      @elseif($sub->finishCheck($sub->subject_id) > 0)
                        
                      <p class="text-center"><button class="btn btn-warning" disabled="">Finish</button></p>
                      @else
                      <p class="text-center"><a href="{{route('student_start_exam', ['id'=> $sub->subject->id])}}" class="btn btn-success" role="button">Start Exam</a> </p>
                      @endif
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