<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Subject;
use App\Model\Schedule;
use App\Model\Teacher;
use App\Model\Student;
use App\Model\Section;
use App\User;
use Auth;
use Schema;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subject = new Subject;
        $this->schedule = new Schedule;
        $this->student = new Student;
        $this->teacher = new Teacher;
        $this->user = new User;
        $this->section = new Section;
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.1
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_role == 0){
            $data['student_confirmed'] = $this->student->where('status',1)->count();
            $data['student_unconfirmed'] = $this->student->where('status',0)->count();
            $data['total_students'] = $this->student->count();
            $data['subject'] = $this->subject->count();
            $data['teacher'] = $this->teacher->count();
            $data['section'] = $this->section->count();
            $data['module_name'] = 'dashboard';
            $data['module_header'] = 'Dashboard';
            return view('home',$data);
        }else{
            return redirect()->route('teacherIndex');
        }
    }

    public function teacherindex()
    {
        $user = Auth::user();
        $teacher = $this->teacher->where('user_id',$user->id)->first();
        $data['schedules'] = $this->schedule
            ->where('schedule.teacher_id',$teacher->id)
            ->orderBy('schedule_time_id')
            ->get();
        $data['module_name'] = 'attendance';
        $data['module_header'] = 'Attendance';
    return view('pages.teacher.sectionList',$data);
    }

    public function checkUser(Request $request) {
        // validate qrcode
        if ($request->data) {
            //get student by qrcode
            $student_details = $this->student->where('qr_code',$request->data)->first();
        }

        //validate if student found and schedule id
        if(isset($student_details->id) && isset($request->id)){
            //get schedule detais : section name, subject id, year
            $section = $this->schedule->select('s.section_name','schedule.subject_id','s.year')->where('schedule_id',$request->id)->join('section as s','s.id','=','schedule.section_id')->first();

            //validate if section exist
            if(empty($section->section_name)){
                //no section
                return response()->json(['status'=>0,'message'=>'Student does not belong to this Subject']);
            }

            //set table name year_sectionname
            $table_name = $section->year.'_'.$section->section_name;

            // get table details
            $table_details =  DB::table($table_name)->where('student_id',$student_details->id)->where('subject_id',$section->subject_id)->first();

            //check if table has the student
            if(!empty($table_details)){

                //check if the student attendace already check within the day
                if($table_details->updated_at == date('Y-m-d')){
                    //if the student is already updated within the day
                    return response()->json(['status'=>0,'message'=>'Student already scanned.']);
                }

                //update the student attendance
                DB::table($table_name)->where('student_id',$student_details->id)->where('subject_id',$section->subject_id)
                ->update([
                    'attendance' => $student_details->attendance+1,
                    'absent_dates' => '[]',
                    'total_attendance' => $student_details->total_attendance+1
                ]);
            }else{
                //first time attendance insert to the table
                DB::table($table_name)->insert([
                    'student_id' => $student_details->id,
                    'subject_id' => $section->subject_id,
                    'attendance' => 1,
                    'absent_dates' => '',
                    'total_attendance' => 1,
                    'updated_at' => date('Y-m-d')
                ]);
            }

            return response()->json(['status'=>1,'message'=>'Please proceed to the next student.']);
        }

        return response()->json(['status'=>0,'message'=>'Student does not belong to this Subject']);

    }

    public function attendanceIndex(Request $request)
    {
        $data['module_header'] = 'Attendance > Checking';
        $data['module_name'] = 'attendance';
        $data['schedule_id'] = $request->get('schedule_id');
        $data['schedule'] = $this->schedule->where('schedule_id',$request->get('schedule_id'))->first();
        return view('pages.teacher.attendance',$data);
    }

    public function stopAttendandace(Request $request)
    {
       $date = date('Y-m-d');
       $section = $this->section->where('id',$request->get('section_id'))->first();
       $table = $section->year.'_'.strtolower($section->section_name);
       $absents = DB::table($table)->where('updated_at','<>',$date)->where('subject_id',$request->get('subject_id'))->get();
       if(!empty($absents)){
        $count = 0;
        foreach ($absents as $val) {
            $count++;
            $absent_dates = $val->absent_dates.'|'.$date;
            $absent_dates = (string)$absent_dates;
            DB::table($table)->where('attendance_id',$val->attendance_id)->update(['absent_dates'=>$absent_dates,
                'updated_at'=>$date]);
        }

        return redirect()->route('teacherIndex')->with(['status'=>'Number of absent(s) :'.$count]);
       }
       

    }

}
