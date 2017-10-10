<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Subject;
use App\User;
use App\General;
use App\Cisco;
use App\Database;
use App\StudentSubject;

use App\Http\Requests\admin\changepass;
use App\Http\Requests\admin\changeset;
use App\Http\Requests\question;
class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('admincheck');
    }
    
    public function admin_main(){
        $student = User::where('role_id',2)->count();
        $subject = Subject::count();
        $record = StudentSubject::count();
    	return view('admin.main', compact('student','subject','record'));
    }

    public function admin_logout(){
    	Auth::logout();
    	return redirect()->route('login');
    }

    public function admin_subject(){
    	$subjects = Subject::all();
    	return view('admin.subjects', compact('subjects'));
    }

    public function admin_students(){
    	$users = User::where('role_id',2)->get();
    	return view('admin.students', compact('users'));
    }

    public function admin_subject_create(){
    	return view('admin.subject_create');
    }

    public function admin_rankings(){
        $subj = Subject::all();
    	return view('admin.ranking', compact('subj'));
    }

    public function admin_subject_create_check(Request $request){
        $find = User::findOrFail(Auth::id());
    	$subj = new Subject;
    	$subj->subject_name = strtoupper($request['subject_name']);
    	$subj->enroll_code = str_random(10);
        $subj->teachers_code = 0;
    	$subj->status_id = 0;
    	$find->subject()->save($subj);
    	return redirect()->route('admin_subject')->with('info', 'New Subject successfully added!!');
    }

    public function admin_subject_status($id){
    	$wak = Subject::where('id', $id)->update(['status_id'=> 1]);
    	if($wak){
    		return redirect()->back()->with('info', 'Subjects has been successfully Open!!');
    	}
    }

    public function admin_subject_view($id){
        $subj = Subject::where('id', $id)->first();
    	if($id == 1){
            $count = General::count();
            return view('admin.subject_view',compact('subj','count'));
        }elseif($id == 2){
            $count = Cisco::count();
            return view('admin.subject_view',compact('subj','count'));
        }elseif($id == 3){
            $count = Database::count();
            return view('admin.subject_view',compact('subj','count'));
        }
    	
    }


    public function admin_subject_new_question(Request $request, $id, question $validate){
        $find = Subject::where('id',$id)->first();
        if($id == 1){
            $gen = new General;
            $gen->question = $request['question'];
            $gen->A = $request['A'];
            $gen->B = $request['B'];
            $gen->C = $request['C'];
            $gen->D = $request['D'];
            $gen->answer = strtoupper($request['answer']);
            $find->general()->save($gen);
        }elseif($id == 2){
           $gen = new Cisco;
            $gen->question = $request['question'];
            $gen->A = $request['A'];
            $gen->B = $request['B'];
            $gen->C = $request['C'];
            $gen->D = $request['D'];
            $gen->answer = strtoupper($request['answer']);
            $find->cisco()->save($gen);
        }elseif($id == 3){
            $gen = new Database;
            $gen->question = $request['question'];
            $gen->A = $request['A'];
            $gen->B = $request['B'];
            $gen->C = $request['C'];
            $gen->D = $request['D'];
            $gen->answer = strtoupper($request['answer']);
            $find->database()->save($gen);
        }

    	

    	return redirect()->back()->with('info', 'Question has been successfully Added!!');
    }


    public function admin_update_teacherscode(Request $request,$id){
        $check = Subject::where('teachers_code', $request['teachers_code'])->first();
        if($check){
            return redirect()->back()->with('info', 'Teachers code already exist');
        }
        $update = Subject::where('id', $id)->update(['teachers_code'=>$request['teachers_code']]);
        if($update){
            return redirect()->back()->with('info', 'Teachers Code successfully Updated!!');
        }
    }



    public function admin_show_ranks($id){
        $show = StudentSubject::where('subject_id', $id)->where('status_id', 2)->get();
        return view('admin.show_rank', compact('show'));
    }

    public function view_questions_subject($subject){
        $subj = Subject::findOrFail($subject);

        if($subject == 1){
            $quest = General::all();
            return view('admin.view_question', compact('quest','subj'));
        }elseif($subject == 2){
             $quest = Cisco::all();
            return view('admin.view_question', compact('quest','subj'));
        }elseif($subject == 3){
            $quest = Database::all();
            return view('admin.view_question', compact('quest','subj'));
        }
    }

    public function admin_setting(){
        return view('admin.setting');
    }

    public function admin_change_password(Request $request, changepass $check){
       
       $update = User::where('id', Auth::id())->update(['password' => bcrypt($request['new_password'])]);
            if($update){
                return redirect()->back()->with('info', 'Password change successfully');
            }else{
                return redirect()->back()->with('info', 'Failed to  change password');
            }
    }


    public function admin_change_settings(Request $request, changeset $check){
        $data = array('email'=> $request['email'], 'contact'=> $request['contact']);
        $update = User::where('id', Auth::id())->update($data);
        if($update){
            return redirect()->back()->with('info2', 'Information updated successfully');
        }else{
            return redirect()->back()->with('info2', 'Failed to  update ');
        }
    }














}
