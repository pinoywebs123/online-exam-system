<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    public function subject(){
    	return $this->belongsTo('App\Subject');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
