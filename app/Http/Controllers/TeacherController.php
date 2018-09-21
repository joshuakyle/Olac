<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lib\TeacherRepository;
use Auth;
use App\Model\Teacher;
use App\Model\Schedule;
use App\Model\Section;
use App\Model\Student;

class TeacherController extends Controller
{
    private $teacherRepository;

    function __construct(TeacherRepository $teacherRepository){
            $this->teacherRepository = $teacherRepository;
            $this->teacher = new Teacher;
            $this->schedule = new Schedule;
            $this->section = new Section;
            $this->student = new Student;
    }
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $data['teachers'] = $this->teacherRepository->getTeachers();
        $data['module_name'] = 'teacher-list';
        $data['module_header'] = 'Teacher Management';
        return view('pages.teacherList',$data);
    }

    public function addTeacher(Request $request)
    {
        $rules = [
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required|email',
          'contact_number' => 'required',
          'gender' => 'required',
          'birthdate' => 'required',
          'username' => 'required|unique:users',
          'password' => 'required|string|min:6',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return back()->withErrors($validator)
                        ->withInput();
        }else{
            $fulltime = $request->input('fulltime') == 'on' ? 1 : 0;
            $this->teacherRepository->createTeacher(
                $request->input('first_name'),
                $request->input('last_name'),
                $request->input('email'),
                $request->input('contact_number'),
                $request->input('gender'),
                $request->input('birthdate'),
                $request->input('username'),
                $request->input('password'),
                $fulltime
            );
        return back()->with('status','Teacher has been successfully added.');
        }
    }
    public function getTeacher($id)
    {
        return $this->teacherRepository->getTeacher($id);
    }

    public function updateTeacher(Request $request)
    {
         $rules = [
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required',
          'contact_number' => 'required',
          'gender' => 'required',
          'birthdate' => 'required',
          'username' => 'required',
          'password' => 'string|min:6',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return back()->withErrors($validator)
                        ->withInput();
        }else{
          $fulltime = $request->input('fulltime') == 'on' ? 1 : 0;
            $this->teacherRepository->updateTeacher(
                $request->input('first_name'),
                $request->input('last_name'),
                $request->input('email'),
                $request->input('contact_number'),
                $request->input('gender'),
                $request->input('birthdate'),
                $request->input('username'),
                $request->input('user_id'),
                $request->input('id'),
                $fulltime
            );
        return back()->with('status','Teacher has been successfully updated.');
        }
    }

    public function delete($id)
    {
        if($this->teacherRepository->delete($id)){
            return back()->with('status','Teacher has been successfully deleted.');
        }

        return back()->with('status','Failed to delete.');
    }

    public function gradesIndex()
    {
      $user = Auth::user();
      $teacher = $this->teacher->where('user_id',$user->id)->first();
      $data['schedules'] = $this->schedule
          ->where('schedule.teacher_id',$teacher->id)
          ->orderBy('schedule_time_id')
          ->get();
      $data['module_name'] = 'grades';
      $data['module_header'] = 'Assign Grade > Section List';
      return view('pages.teacher.gradeIndex',$data);
    }

    public function studentList($scheduleId)
    {
      if(!$scheduleId){
        return redirect('/dashboard');
      }

      $section = $this->section->select('section.id','s.subject_id','section.section_name')->where('s.schedule_id',$scheduleId)->join('schedule as s','s.section_id','=','section.id')->first();
      $data['students'] = $this->student->where('section_id',$section->id)->orderBy('last_name')->get();
      $data['section'] = $section;
      $data['subject_id'] = $section->subject_id;
      $data['module_name'] = 'grades';
      $data['module_header'] = 'Assign Grades > Section List > Student List';
      return view('pages.teacher.studentList',$data);
    }
}