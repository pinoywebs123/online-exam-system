<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\auth\login;
use App\Http\Requests\auth\signup;
use App\Http\Requests\auth\verify_me;
use App\Http\Requests\auth\forgot;
use App\Exam\Auth\CheckLogin;
use Auth;
use App\User;
use App\Verify;
use Mail;
class AuthController extends Controller
{
    public function login(){
    	return view('auth.login');
    }

    public function loginCheck(login $request, CheckLogin $check){
    	if($check->check()){
            if(Auth::user()->status_id == 0){
               return 'Please check your email to verify your accout';     
            }

    		if(Auth::user()->role_id == 2){
                return redirect()->route('student_main');
            }else if(Auth::user()->role_id == 1){
                return redirect()->route('admin_main');
            }
    	}else {
    		return redirect()->back()->with('error', 'Invalid username and password combination.');;
    	}
    }

    public function signup(){
        return view('auth.signup');
    }

    public function signup_check(Request $request,signup $check){
        $code = str_random(10);

        $data = array('title'=> 'Thank you for Registering Spencer Online Examination.',
              'content'=> 'Dear Students kindly verify your account. You have a code: '.$code.' : '.route('verify_me'),
              'email'=> $request['email']

              );

       Mail::send('auth.email', $data, function($message) use ($data){
        $message->to($data['email'])->subject('Spencer online Examination');
       });


        $user = new User;
        $user->fname = $request['fname'];
        $user->mname = $request['mname'];
        $user->lname = $request['lname'];
        $user->contact = $request['contact'];
        $user->email = $request['email'];
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->role_id = 2;
        $user->status_id = 0;
        $user->save(); 

        
        $ver = new Verify;
        $ver->email = $request['email'];
        $ver->code = $code;
        $ver->save();

        return redirect()->route('login')->with('register', 'You have successfully registerd. Kindly verify your account before logging in.'); 
    }

    public function verify_me(){

        return view('auth.verify');
    }

    public function verify_me_check(Request $request, verify_me $check){
        $verify = Verify::where('email', $request['email'])->where('code', $request['code'])->first();

        if($verify){
            User::where('email', $request['email'])->update(['status_id'=> 1]);
            $verify->delete();
            return redirect()->back()->with('success', 'Verify successfully You can Login in now!!');
        }else{

            return redirect()->back()->with('error', 'Invalid Email/Codes');
        }

    }


    public function forgot_password(){
        return view('auth.forgot');
    }


    public function forgot_password_check(Request $request, forgot $check){
        $code = str_random(11);
        
        $update = User::where('email', $request['email'])->update(['password'=> bcrypt($code)]);
       if($update){
             $data = array('title'=> 'Spencer Online Examination Reset your password',
                      'content'=> 'Hola! looks like you forgot your password. Here is the new one'. ' : '.$code,
                      'email'=> $request['email']

                      );

               Mail::send('auth.email', $data, function($message) use ($data){
                $message->to($data['email'])->subject('Spencer online Examination');
               });

        return redirect()->back()->with('success', 'We have successfully send your new password');
       }else{

        return redirect()->back()->with('error', 'Failed to reset your password , try again later');
       }


       

       
    }






}
