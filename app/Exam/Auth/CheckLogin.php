<?php 
namespace App\Exam\Auth;

use Illuminate\Http\Request;
use Auth;
class CheckLogin{

	protected $request;

	public function __construct(Request $request){
		$this->request = $request;
	}

	public function check(){
		$data = array('username'=> $this->request['username'], 'password'=> $this->request['password']);
		if(Auth::attempt($data)){
			return true;
		}else{
			return false;
		}
	}

}