<?php

use App\User;
use App\Subject;
use App\Roles;




Route::get('/', function () {
    return redirect()->route('login');
});



Route::group(['prefix'=>'auth'], function(){
	Route::get('/login', [
		'as'=> 'login',
		'uses'=> 'AuthController@login'
	]);

	Route::post('/login', [
		'as'=> 'loginCheck',
		'uses'=> 'AuthController@loginCheck'
	]);

	Route::get('/signup', [
		'as'=> 'signup',
		'uses'=> 'AuthController@signup'
	]);

	Route::post('/signup', [
		'as'=> 'signup_check',
		'uses'=> 'AuthController@signup_check'
	]);

	Route::get('/verify-student', [
		'as'=> 'verify_me',
		'uses'=> 'AuthController@verify_me'
	]);

	Route::post('/verify-student', [
		'as'=> 'verify_me_check',
		'uses'=> 'AuthController@verify_me_check'
	]);

	Route::get('/forgot-password', [
		'as'=> 'forgot_password',
		'uses'=> 'AuthController@forgot_password'
	]);

	Route::post('/forgot-password',[
		'as'=> 'forgot_password_check',
		'uses'=> 'AuthController@forgot_password_check'
	]);
});

Route::group(['prefix'=> 'student'], function(){
	Route::get('/main', [
		'as'=> 'student_main',
		'uses'=> 'StudentController@student_main'
	]);

	Route::get('/logout', [
		'as'=> 'student_logout',
		'uses'=> 'StudentController@student_logout'
	]);

	Route::get('/subjects', [
		'as'=> 'student_subjects',
		'uses'=> 'StudentController@student_subjects'
	]);

	Route::get('/remarks', [
		'as'=> 'student_remarks',
		'uses'=> 'StudentController@student_remarks'
	]);

	Route::get('/records', [
		'as'=> 'student_records',
		'uses'=> 'StudentController@student_records'
	]);

	Route::get('/enroll/{id}', [
		'as'=> 'student_enroll',
		'uses'=> 'StudentController@student_enroll'

	]);

			Route::post('/enroll/{id}', [
				'as'=> 'student_enroll_check',
				'uses'=> 'StudentController@student_enroll_check'
			]);

	Route::get('/start-exam/{id}', [
		'as'=> 'student_start_exam',
		'uses'=> 'StudentController@student_start_exam'
	]);		

		Route::post('/starting-examination/{subject}', [
			'as'=> 'student_starting_examination',
			'uses'=> 'StudentController@student_starting_examination'
		]);

	Route::get('/exam-on-the-way/{subject}/{question}/starting', [
		'as'=> 'student_exam_is_love',
		'uses'=> 'StudentController@student_exam_is_love'
	]);	

	Route::post('exam-answer/{subject}/{question}', [
		'as'=> 'record_user_answer',
		'uses'=> 'StudentController@record_user_answer'
	]);

	Route::get('/exam-timeo-out/{subject}/{question}/{answer}', [
		'as'=> 'exam_time_out',
		'uses'=> 'StudentController@exam_time_out'
	]);

	Route::get('/exam-timer/{subject}', [
		'as'=> 'exam_timer',
		'uses'=> 'StudentController@exam_timer'
	]);	

	Route::post('/finish-exam/{subject}/{question}', [
		'as'=> 'finish_exam_send',
		'uses'=> 'StudentController@finish_exam_send'
	]);

	Route::get('/finish-exam/{subject}', [
		'as'=> 'student_finish_exam',
		'uses'=> 'StudentController@student_finish_exam'
	]);

	Route::get('/view-records/{subject}', [
		'as'=> 'student_view_records',
		'uses'=> 'StudentController@student_view_records'
	]);

	Route::get('/settings', [
		'as'=> 'student_settings',
		'uses'=> 'StudentController@student_settings'
	]);
	Route::post('/change-password',[
			'as'=> 'student_change_password',
			'uses'=> 'StudentController@student_change_password'
		]);

		Route::post('/change-settings',[
			'as'=> 'student_change_settings',
			'uses'=> 'StudentController@student_change_settings'
		]);
});


Route::group(['prefix'=> 'admin'], function(){

		Route::get('/main', [
			'as'=> 'admin_main',
			'uses'=> 'AdminController@admin_main'
		]);

		Route::get('/logout',[
			'as'=> 'admin_logout',
			'uses'=> 'AdminController@admin_logout'
		]);

		Route::get('/subjects', [
			'as'=> 'admin_subject',
			'uses'=> 'AdminController@admin_subject'
		]);

			Route::get('/subject-create', [
				'as'=> 'admin_subject_create',
				'uses'=> 'AdminController@admin_subject_create'
			]);
			Route::post('/subject-create',[
				'as'=> 'admin_subject_create_check',
				'uses'=> 'AdminController@admin_subject_create_check'
			]);

			Route::get('/subject-status/{id}', [
				'as'=> 'admin_subject_status',
				'uses'=> 'AdminController@admin_subject_status'
			]);

			Route::get('/subject-view/{id}', [
				'as'=> 'admin_subject_view',
				'uses'=> 'AdminController@admin_subject_view'
			]);

			Route::post('/admin_subject_new_question/{id}', [
				'as'=> 'admin_subject_new_question',
				'uses'=> 'AdminController@admin_subject_new_question'
			]);

			Route::post('/admin-update-teacher-codes/{id}',[
				'as'=> 'admin_update_teacherscode',
				'uses'=> 'AdminController@admin_update_teacherscode'
			]);

		Route::get('/students',[
			'as'=> 'admin_students',
			'uses'=> 'AdminController@admin_students'
		]);

		Route::get('/rankings', [
			'as'=> 'admin_rankings',
			'uses'=> 'AdminController@admin_rankings'
		]);

		Route::get('/rankings/{id}', [
			'as'=> 'admin_show_ranks',
			'uses'=> 'AdminController@admin_show_ranks'
		]);

		Route::get('/view-questions/{subject}', [
			'as'=> 'view_questions_subject',
			'uses'=> 'AdminController@view_questions_subject'
		]);

		Route::get('/settings', [
			'as'=> 'admin_setting',
			'uses'=> 'AdminController@admin_setting'
		]);

		Route::post('/change-password',[
			'as'=> 'admin_change_password',
			'uses'=> 'AdminController@admin_change_password'
		]);

		Route::post('/change-settings',[
			'as'=> 'admin_change_settings',
			'uses'=> 'AdminController@admin_change_settings'
		]);
});




// Route::get('/addUser', function(){

// $user = new User;
// $user->fname = 'Kwek';
// $user->lname = 'Kang';
// $user->username = '123123';
// $user->email = '123123@yahoo.com';
// $user->password = bcrypt('123123');
// $user->role_id = 2;
// $user->status_id = 1;
// $user->save();
// });

// Route::get('/addSubject', function(){
// 	$subj = new Subject;
// 	$subj->subject_name = 'General Sciece'; 
// 	$subj->code = str_random(10);
// 	$subj->save();
// });

// Route::get('/addRoles', function(){

// 	$aw = new Roles;
// 	$aw->role_name = 'Student';
// 	$aw->save();
// });