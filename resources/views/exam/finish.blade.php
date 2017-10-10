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
            <h3 class="panel-title">Exam Result</h3>
          </div>
          <div class="panel-body">
            @if(Session::has('info'))
              <div class="alert alert-success alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Information!</strong> {{Session::get('info')}}
            </div>
            @endif
            <table class="table">
              <thead>
                <tr>
                  <td>Answer of the Question</td>
                  <td>You're Answer</td>
                  <td>Remarks</td>
                  <td>Points</td>
                </tr>
              </thead>
              <tbody>
                <?php $score = 0; ?>

                
                @foreach($ans as $out)
                  <tr>
                    <td>{{$out->getQuestion($out->subject_id, $out->question_id)->answer}}</td>
                    <td>{{$out->answer}}</td>
                    <td>
                      @if($out->getQuestion($out->subject_id, $out->question_id)->answer == $out->answer)
                        <p>Correct</p>
                        <?php $score = $score + 1; ?>
                      @else
                        <p>Wrong</p>
                      @endif
                    </td>
                    <td>
                     @if($out->getQuestion($out->subject_id, $out->question_id)->answer == $out->answer)
                        1
                      @else
                       0
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
              <h3>Total Score: <?php echo $score; ?></h3>
            </table>
            
          </div>
        </div>

      </div>
    </div>
</div>
@endsection

@section('scripts')


@endsection