<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Subject;
use App\StudentSubject;
use App\StudentEnroll;
use App\General;
use App\Cisco;
use App\Database;
use App\StudentAnswer;

use App\Http\Requests\student\exam;
use App\Http\Requests\student\changepass;
use App\Http\Requests\student\changeset;

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware('usercheck');
    }

    public function student_main(){
    	$enroll = StudentEnroll::where('user_id', Auth::id())->get();
    	return view('student.student', compact('enroll'));
    }

    public function student_logout(){
    	Auth::logout();
    	return redirect()->route('login');
    }

    public function student_subjects(){
        $subjects = Subject::where('status_id',1)->get();
        return view('student.subject', compact('subjects'));
    }

    public function student_remarks(){
        return view('student.remark');
    }

    public function student_records(){
        $records = StudentSubject::where('user_id', Auth::id())->where('status_id', 2)->get();
        return view('student.record', compact('records'));
    }

    public function student_enroll($id){
        $subjects = Subject::where('id',$id)->first();
        return view('student.enroll', compact('subjects'));
    }

    public function student_enroll_check($id, Request $request){
        $check = Subject::where('id', $id)->where('enroll_code', $request['enroll_code'])->first();
        if($check){
            $hasenroll = StudentEnroll::where('subject_id', $id)->where('user_id', Auth::id())->first();
            if($hasenroll){
                return redirect()->route('student_subjects')->with('info', 'You are already enrolled in this subject.');
            }
            $find = User::find(Auth::id());
            $enroll = new StudentEnroll;
            $enroll->subject_id = $id;
            $find->enroll()->save($enroll);

            return redirect()->route('student_main')->with('info', 'You have successfully Enrolled!');
        }else{
            return redirect()->route('student_subjects')->with('info', 'Invalid Enrollment Codes for this subject!!');
        }
        
    }

    public function student_start_exam($id){
        $subj = Subject::findOrFail($id);
        return view('student.start_exam', compact('subj'));
    }

    public function student_starting_examination(Request $request,$subject){
        $test_start_check = Subject::where('id', $subject)->where('teachers_code', $request['teacher_code'])->first();

        if($test_start_check){
            $record = new StudentSubject;
            $record->user_id = Auth::id();
            $record->subject_id = $subject;
            $record->status_id = 1;
            $record->seconds = 60 ;
            $record->minutes = 3600;
            $record->save();
            return redirect()->route('student_exam_is_love', ['subject'=> $subject, 'question'=> 0]);
        }else{
            return redirect()->back()->with('info', 'Invalid Teachers Codes for this subject');
        }
    }

    public function student_exam_is_love($subject, $question){
        $question = $question + 1;
        
        if($subject == 1){
            $time = StudentSubject::where('subject_id', $subject)->where('user_id', Auth::id())->first();
            $subject = Subject::where('id', $subject)->first();
            $gen = General::where('id', $question)->first();
            
            return view('exam.exam', compact('gen', 'subject', 'question', 'time'));
        }elseif($subject == 2){
            $time = StudentSubject::where('subject_id', $subject)->where('user_id', Auth::id())->first();
            $subject = Subject::where('id', $subject)->first();
            $gen = Cisco::where('id', $question)->first();
            
            return view('exam.exam', compact('gen', 'subject', 'question', 'time'));
        }elseif($subject == 3){
            $time = StudentSubject::where('subject_id', $subject)->where('user_id', Auth::id())->first();
            $subject = Subject::where('id', $subject)->first();
            $gen = Database::where('id', $question)->first();
            
            return view('exam.exam', compact('gen', 'subject', 'question', 'time'));
        }
    }

    public function exam_timer($subject){
        $timerem = $_GET['timerem'];

        $stud_subj = StudentSubject::where('subject_id', $subject)->where('user_id', Auth::id())->update(['seconds'=> $timerem]);
    }

    public function record_user_answer(Request $request,$subject, $question){
        $minutes = $_GET['minutes'];
        $stud_ans = new StudentAnswer;
        $stud_ans->user_id = Auth::id();
        $stud_ans->subject_id = $subject;
        $stud_ans->question_id = $question;
        $stud_ans->answer = strtoupper($request['answer']);
        $stud_ans->save();
        StudentSubject::where('subject_id', $subject)->where('user_id', Auth::id())->update(['seconds'=> 60, 'minutes'=> $minutes]);
        return redirect()->route('student_exam_is_love', ['subject'=> $subject, 'question'=> $question]);
    }

    public function exam_time_out($subject, $question, $answer){
        $minutes = $_GET['minutes'];
        $stud_ans = new StudentAnswer;
        $stud_ans->user_id = Auth::id();
        $stud_ans->subject_id = $subject;
        $stud_ans->question_id = $question;
        $stud_ans->answer = strtoupper($answer);
        $stud_ans->save();
        StudentSubject::where('subject_id', $subject)->where('user_id', Auth::id())->update(['seconds'=> 60, 'minutes'=> $minutes]);
         return redirect()->route('student_exam_is_love', ['subject'=> $subject, 'question'=> $question]);
    }



    public function finish_exam_send(Request $request,$subject, $question){
         $stud_ans = new StudentAnswer;
        $stud_ans->user_id = Auth::id();
        $stud_ans->subject_id = $subject;
        $stud_ans->question_id = $question;
        $stud_ans->answer = strtoupper($request['answer']);
        $stud_ans->save();

        return redirect()->route('student_finish_exam', ['subject'=> $subject]);
    }

    public function student_finish_exam($subject){
        $ans = StudentAnswer::where('subject_id', $subject)->where('user_id', Auth::id())->get();

        StudentSubject::where('subject_id', $subject)->where('user_id', Auth::id())->update(['status_id'=> 2]);
        return view('exam.finish', compact('ans'));
    }

    public function student_view_records($subject){
        $views = StudentAnswer::where('subject_id', $subject)->where('user_id', Auth::id())->get();

        return view('student.show_records', compact('views'));
    }

    public function student_settings(){
            return view('student.settings');
    }

    public function student_change_password(Request $request, changepass $check){
             $update = User::where('id', Auth::id())->update(['password' => bcrypt($request['new_password'])]);
            if($update){
                return redirect()->back()->with('info', 'Password change successfully');
            }else{
                return redirect()->back()->with('info', 'Failed to  change password');
            }
    }

    public function student_change_settings(Request $request, changeset $check){
        $data = array('email'=> $request['email'], 'contact'=> $request['contact']);
        $update = User::where('id', Auth::id())->update($data);
        if($update){
            return redirect()->back()->with('info2', 'Information updated successfully');
        }else{
            return redirect()->back()->with('info2', 'Failed to  update ');
        }

    }





   
}
