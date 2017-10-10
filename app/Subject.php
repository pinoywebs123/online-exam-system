<?php

namespace App;

use App\StudentEnroll;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Subject extends Model
{
    public function general(){
    	return $this->hasMany('App\General');
    }

    public function cisco(){
    	return $this->hasMany('App\Cisco');
    }

    public function database(){
    	return $this->hasMany('App\Database');
    }

    public function enroll($id){
    	return StudentEnroll::where('subject_id', $id)->where('user_id', Auth::id())->count();
    }
}
