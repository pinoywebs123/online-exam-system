<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/bootstrap.min.css')}}">
        <title>Laravel</title>

       @yield('styles')
    </head>
    <body>
        @if(Auth::user())
            <nav class="navbar navbar-default">
                  <div class="container-fluid">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                      </button>
                      <a class="navbar-brand" href="{{route('student_main')}}">O-Exam</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                      <ul class="nav navbar-nav">
                        <li class="active"><a href="{{route('student_main')}}">Home</a></li>
                        
                       
                      </ul>
                     
                      <ul class="nav navbar-nav navbar-right">
                         <li><a href="{{route('student_settings')}}">Settings</a></li>
                         <li><a href="{{route('student_logout')}}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                      
                      </ul>
                    </div>
                  </div>
                </nav>
        @endif;
       @yield('contents')
    </body>
    <script src="{{URL::to('js/jquery.js')}}"></script>
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
    @yield('scripts')
</html>
