<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', function () {
    if(Auth::check()){
        	return redirect('/dashboard');
    }else{
        return redirect('/index');
    }
});
Route::group(['middleware'=>['auth']],function(){
	
	// Route::group(['middleware'=>['check.role']],function(){
		//for admin
		Route::get('/dashboard', 'HomeController@index')->name('dashboard');
		//teacher
		Route::get('/teacher-list', 'TeacherController@index')->name('teacher-list');
		Route::post('/addteacher', 'TeacherController@addTeacher')->name('addTeacher');
		Route::post('/updateteacher', 'TeacherController@updateTeacher')->name('updateTeacher');
		Route::get('/teacher/info/{id}', 'TeacherController@getTeacher');
		Route::get('/teacher/delete/{id}', 'TeacherController@delete');

		//student
		Route::get('/student-list', 'StudentController@index')->name('student-list');

		//subject
		Route::get('/subject-list', 'SubjectController@index')->name('subject-list');
		Route::post('/subject-add', 'SubjectController@add')->name('add-subject');
		Route::post('/subject-update', 'SubjectController@update')->name('update-subject');
		Route::get('/subject/info/{id}', 'SubjectController@getSubject');
		Route::get('/subject/delete/{id}', 'SubjectController@delete');

		//payment
		Route::get('/payment-list', 'PaymentController@index')->name('payment-list');

		//section
		Route::get('/section-list', 'SectionController@index')->name('section-list');
		Route::post('/section-add', 'SectionController@add')->name('add-section');
		Route::post('/section-update', 'SectionController@update')->name('update-section');
		Route::get('/section/info/{id}', 'SectionController@getSection');
		Route::get('/section/delete/{id}', 'SectionController@delete');

		//schedule
		Route::get('/schedule-list', 'ScheduleController@index')->name('schedule-list');
		Route::post('/schedule-add', 'ScheduleController@add')->name('add-schedule');
		Route::get('/schedule/delete/{id}', 'ScheduleController@delete');

		//student
		Route::get('/student/info/{id}', 'StudentController@getStudent');
		Route::post('/student-update', 'StudentController@update')->name('student-update');


		Route::get('/teacher/availability/{id}', 'ScheduleController@getTeacherSched');
		Route::get('/section/availability/{id}', 'ScheduleController@getSectionSched');
		Route::get('/schedule/availability/{id}', 'ScheduleController@getSched');
		Route::get('/students/unconfirmed', 'StudentController@getUnconfirmed');
		Route::get('/students/unconfirmed/details', 'StudentController@getUnconfirmedDetails');
		Route::post('/student/reject', 'StudentController@rejectStudents')->name('update-studet-reject');

	// });

	//for teachers
	Route::get('/attendance/sections', 'HomeController@teacherindex')->name('teacherIndex');
	Route::get('/grades/sections', 'TeacherController@gradesIndex')->name('gradesIndex');
	Route::post('/start/attendance', 'HomeController@attendanceIndex')->name('attendance');
	Route::any('/end/attendance', 'HomeController@stopAttendandace')->name('end-attendance');
	Route::post('/qrcheck', 'HomeController@checkUser')->name('checkUser');
	Route::post('/qrgenerate', 'StudentController@qrgenerate')->name('qrgenerate');
	Route::get('/section/students/{scheduleId}', 'TeacherController@studentList')->name('studentList');
	Route::any('/updateGrade', 'StudentController@updateGrade')->name('updateGrade');

});

//student
Route::get('/student-login', 'StudentController@studentLogin')->name('studentLogin');
Route::post('/student-login-credentials', 'StudentController@studentGradeLogin')->name('studentGradeLogin');
Route::post('/student/grade', 'StudentController@studentGrade')->name('studentGrade');
Route::get('/student/grade/list', 'StudentController@studentGradeList')->name('studentGradeList');
Route::post('/student/updatepin', 'StudentController@updatePin')->name('update-pin');
Route::post('/student/update-studet-status', 'StudentController@updateStudentStatus')->name('update-studet-status');
Route::any('/onlinepayment/{secretKey}/{id}', 'StudentController@paymentView');
Route::any('/registration', 'StudentController@registrationView');
Route::post('/downloadform', 'StudentController@generateForm')->name('download-pdf');

Route::get('/enroll', 'EnrollmentController@index')->name('enroll');
Route::get('/qrcode', 'EnrollmentController@qrcode');
Route::post('/addstudent', 'EnrollmentController@create');
Route::get('/index', function(){
	  return view('index');
});

