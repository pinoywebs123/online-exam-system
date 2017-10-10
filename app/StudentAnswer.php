<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cisco;
use App\General;
use App\Database;
class StudentAnswer extends Model
{
    public function getQuestion($subject, $question){

    	if($subject == 1){
    		return General::where('id', $question)->first();

    	}elseif($subject == 2){
    		return Cisco::where('id', $question)->first();
    	}elseif($subject == 3){
    		return Database::where('id', $question)->first();
    	}
    }

 







}
