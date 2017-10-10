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
            <h3 class="panel-title">{{$subject->subject_name}}</h3>
           <h3 class="text-right" id="countdowntimerm">TEST</h3>
          </div>
          <div class="panel-body">
            @if(Session::has('info'))
              <div class="alert alert-danger alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Information!</strong> {{Session::get('info')}}
            </div>
            @endif
           
            <div class="col-md-8 col-md-offset-2">
              <h3 class="text-center">Time Remaining: </h3>
              <h3 class="center"><div id="countdowntimer" class="text-center"></div></h3>
              
              <h4 class="text-center">{{$question}} of 60 Questions</h4>
              <h4>{{$gen->question}}</h4>
              <ul>
                <li>A. {{$gen->A}}</li>
                <li>B. {{$gen->B}}</li>
                <li>C. {{$gen->C}}</li>
                <li>D. {{$gen->D}}</li>
              </ul>

                @if($question == 60)
                   <form id="answerNextPage" action="{{route('finish_exam_send', ['subject'=> $subject->id, 'question'=> $gen->id])}}" method="POST" onclick="window.onbeforeunload=null;" method="POST" onclick="window.onbeforeunload=null;">
                @else
                <form id="answerNextPage" action="{{route('record_user_answer', ['subject'=> $subject->id, 'question'=> $gen->id])}}" method="POST" onclick="window.onbeforeunload=null;">
                @endif

              
                <div class="form-group">
                  <label>Enter the <strong>Letter</strong> of the Corrent Answer: </label>
                  <input type="text" name="answer" class="form-control" maxlength="1">
                </div>
                @if($question == 60)
                  <button type="submit" class="btn btn-danger btn-block">FINISH</button>
                @else
                  <button type="submit" class="btn btn-success btn-block">NEXT</button>
                @endif
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


<script>
  // saves the current countdown time to the database before refreshing/closing the page
  function questionRefresh() {

      var lasttimerem = document.querySelector('#countdowntimer').innerHTML;
      
      // AJAX for timeIsUp.php
      xmlhttp = new XMLHttpRequest();

      xmlhttp.open("GET","{{route('exam_timer', ['subject'=> $subject->id])}}?timerem="+lasttimerem,true);
      xmlhttp.send();
  }

  document.body.onclick = function() {
    questionRefresh();
  };

  window.onbeforeunload = function() {
      questionRefresh();
      return 'confirm';
  }

  var seconds = {{$time->seconds}};
  var minutes = {{$time->minutes}};

  document.querySelector('#countdowntimer').innerHTML = seconds;
  document.querySelector('#countdowntimerm').innerHTML = Math.floor(minutes/60) + "." + minutes%60;

  function timecountdown() {
    if (seconds == 0) {
      @if($question == 60)

      @else
        window.onbeforeunload=null;
      window.location = "{{route('exam_time_out', ['subject'=> $subject->id, 'question'=> $gen->id, 'answer'=> 'E'])}}?minutes=" + minutes;
      @endif
      
    }
    
    document.querySelector('#countdowntimer').innerHTML = seconds;
    document.querySelector("#countdowntimerm").innerHTML = Math.floor(minutes/60) + '.' + minutes%60;

    var oldAttrib = document.querySelector('#answerNextPage').getAttribute('action');
    
    if (oldAttrib.indexOf('?') != -1) {
      var oldAttrib = oldAttrib.substr(0, oldAttrib.indexOf('?'));
    } 

    document.querySelector("#answerNextPage").removeAttribute('action');
    document.querySelector("#answerNextPage").setAttribute('action', oldAttrib + '?minutes=' + minutes);
    

    seconds--;
    minutes--;
  }

  setInterval(timecountdown, 1000);
</script>

@endsection