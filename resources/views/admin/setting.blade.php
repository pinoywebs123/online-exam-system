<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Online Examination</title>

    
    <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet">

   
    <link href="{{URL::to('css/sb-admin.css')}}" rel="stylesheet">

   
    <link href="{{URL::to('css/plugins/morris.css')}}" rel="stylesheet">

 

<style type="text/css">
    #txt{
        font-size: 48px;
    }
    .navbar {
     background: #2c3e50 !important;
   }
   #sides ul {
    background: #2c3e50 !important;
   }
   body {
    background: #2c3e50;
   }
  
</style>

</head>

<body>

    <div id="wrapper">

       
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
           
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" data-toggle="modal" data-target="#test">Exam</a>
            </div>
            
            <ul class="nav navbar-right top-nav">
               
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Auth::user()->email}} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       
                        
                       
                         <li>
                            <a href="{{route('admin_setting')}}"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{route('admin_logout')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
           
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="sides">
                <ul class="nav navbar-nav side-nav">
                	<center>
                		<img src="{{URL::to('image/admin.png')}}" width="80px" alt="profile here" class="img-circle">
                	</center>
                    <li>
                       <a href="#">
                       		<p class="text-center" style="color: #fff">{{Auth::user()->fname}}</p>
                       		<p class="text-center" style="color: #fff">Online</p>
                       
                       </a>
                    </li>
                    <li class="active">
                      <a href="{{route('admin_main')}}" ><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                     <li >
                    	<a href="{{route('admin_rankings')}}" ><i class="glyphicon glyphicon-volume-up"></i> Records</a>
                    </li>
                     <li>
                        <a href="{{route('admin_subject')}}"><i class="glyphicon glyphicon-folder-open"></i> SUBJECTS</a>
                    </li>
                    <li>
                    	<a href="{{route('admin_students')}}"><i class="glyphicon glyphicon-user"></i> STUDENTS</a>
                    </li>
                    
                </ul>
            </div>
           
        </nav>

        <div id="page-wrapper">
           
              
         <div class="panel panel-primary">
            <div class="panel-heading">
                  <h2 class="text-center">Admin Settings</h2>              
            </div>

            <div class="panel-body">
                   <div class="col-md-6">
                     @if(Session::has('info'))
                        <div class="alert alert-info">{{Session::get('info')}}</div>
                    @endif
                     <h3 class="text-center">Change Password</h3>
                     <form action="{{route('admin_change_password')}}" method="POST">
                      
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
                     <form action="{{route('admin_change_settings')}}" method="POST">
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
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>

    
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>

    
 

</body>

</html>
