<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\StudentSubject;
class StudentEnroll extends Model
{
    public function subject(){
    	return $this->belongsTo('App\Subject');
    }

    public function examCheck($id){
    	return StudentSubject::where('user_id', Auth::id())->where('subject_id', $id)->where('status_id',1)->count();
    }

    public function finishCheck($id){
    	return StudentSubject::where('user_id', Auth::id())->where('subject_id', $id)->where('status_id',2)->count();
    }
}
