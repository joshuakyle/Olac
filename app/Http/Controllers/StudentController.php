<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Student;
use App\Model\Section;
use App\Model\First;
use App\Model\Second;
use App\Model\Third;
use App\Model\Fourth;
use App\Model\Subject;
use App\Model\Payment;
use Mail;
use QRCode;
use PDF;
use DB;
class StudentController extends Controller
{
    public function __construct(){
        $this->section = new Section;
        $this->student = new Student;
        $this->first = new First;
        $this->second = new Second;
        $this->third = new Third;
        $this->fourth = new Fourth;
        $this->subject = new Subject;
        $this->payment = new Payment;
        $this->secret_key = '093c79299129781e3f7fe11ad5b9862a';
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index(Request $request)
    {   
        if($request->get('lastname')){
            $like = $request->get('lastname');
        }else{
            $like = '';
        }
        $data['students'] = $this->student->where('last_name','like','%'.$like.'%')->where('old_student',0)->where('status',1)->paginate(30);
        $data['module_name'] = 'student-list';
        $data['module_header'] = 'Student Management';
        return view('pages.studentList',$data);
    }

    public function getUnconfirmed()
    {
        return $this->student->where('status',0)->where('old_student',0)->count();
    }

    public function getUnconfirmedDetails()
    {
        return $this->student->where('status',0)->where('old_student',0)->get();
    }

    public function qrgenerate(Request $req)
    {
        $qr = $req->get('qr');
        $file = QRCode::text($qr)
                ->setSize(8)
                ->setOutfile(getStoragePath().'/'.$req->last_name.'.png')
                ->png();
        return response()->download(getStoragePath().'/'.$req->last_name.'.png')->deleteFileAfterSend(true);
    }

    public function getStudent($id)
    {
        return $this->student->where('id',$id)->first();
    }

     public function update(Request $request)
    {
        $rules = [
            "first_name" => "required",
            "last_name" => "required",
            "middle_name" => "required",
            "address" => "required",
            "religion" => "required",
            "guardian_name" => "required",
            "guardian_relation" => "required",
            "guardian_occupation" => "required",
            "guardian_contact_number" => "required",
            "guardian_email" => "required",
            "previous_school_name" => "required",
            "previous_school_address" => "required",
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return back()->withErrors($validator)
                        ->withInput();
        }else{
            $result = $this->student->where('id',$request->get('student_id'))->update([
                "first_name" => $request->get('first_name'),
                "last_name" => $request->get('last_name'),
                "middle_name" => $request->get('middle_name'),
                "address" => $request->get('address'),
                "religion" => $request->get('religion'),
                "guardian_name" => $request->get('guardian_name'),
                "guardian_relation" => $request->get('guardian_relation'),
                "guardian_occupation" => $request->get('guardian_occupation'),
                "guardian_number" => $request->get('guardian_contact_number'),
                "guardian_email" => $request->get('guardian_email'),
                "old_school_name" => $request->get('previous_school_name'),
                "old_school_address" => $request->get('previous_school_address'),
            ]);
            if($result){
                return back()->with('status','Student has been successfully updated');
            }else{
             return back()->with('status','Failed to update.');
            }
        }
    }

    public function updateGrade(Request $request)
    {
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        if($request->get('subject_id')){
            $subject = $this->subject->where('id',$request->get('subject_id'))->first();
            if($subject->year == 1){
                $table = $this->first;
            }elseif($subject->year == 2){
                $table = $this->second;
            }elseif($subject->year == 3){
                $table = $this->third;
            }elseif($subject->year == 4){
                $table = $this->fourth;
            }
            //for first quarter
            if($request->get('first_quarter')){
                $details = $table->where('student_id',$request->get('student_id'))->where('subject_id',$request->get('subject_id'))->where('quarter',1)->first();
                if(!empty($details)){
                    $table->where('grade_id',$details->grade_id)->update(['score'=>$request->get('first_quarter')]);
                }else{
                    $table->insert(['score'=>$request->get('first_quarter'),'student_id'=>$request->get('student_id'),'subject_id'=>$request->get('subject_id'),'quarter' => 1]);
                }
            }
            //for second quarter
            if($request->get('second_quarter')){
                $details = $table->where('student_id',$request->get('student_id'))->where('subject_id',$request->get('subject_id'))->where('quarter',2)->first();
                if(!empty($details)){
                    $table->where('grade_id',$details->grade_id)->update(['score'=>$request->get('second_quarter')]);
                }else{
                    $table->insert(['score'=>$request->get('second_quarter'),'student_id'=>$request->get('student_id'),'subject_id'=>$request->get('subject_id'),'quarter' => 2]);
                }
            }

            //third quarter
            if($request->get('third_quarter')){
                $details = $table->where('student_id',$request->get('student_id'))->where('subject_id',$request->get('subject_id'))->where('quarter',3)->first();
                if(!empty($details)){
                    $table->where('grade_id',$details->grade_id)->update(['score'=>$request->get('third_quarter')]);
                }else{
                    $table->insert(['score'=>$request->get('third_quarter'),'student_id'=>$request->get('student_id'),'subject_id'=>$request->get('subject_id'),'quarter' => 3]);
                }
            }

            //fourth quarter
            if($request->get('fourth_quarter')){
                $details = $table->where('student_id',$request->get('student_id'))->where('subject_id',$request->get('subject_id'))->where('quarter',4)->first();
                if(!empty($details)){
                    $table->where('grade_id',$details->grade_id)->update(['score'=>$request->get('fourth_quarter')]);
                }else{
                    $table->insert(['score'=>$request->get('fourth_quarter'),'student_id'=>$request->get('student_id'),'subject_id'=>$request->get('subject_id'),'quarter' => 4]);
                }
            }

            return response()->json(['status' => 1,'message' => 'Student grades are now recorded.']);
        }else{
            return response()->json(['status' => 0,'message' => 'Failed to update']);
        }
    }

    public function studentLogin()
    {
        return view('pages.student.studentLogin');
    }

    public function studentGrade(Request $request)
    {
        
        if(!is_null($request->data)){
            $student_details = $this->student->select('id')->where('qr_code',$request->data)->first();
            if(isset($student_details->id)){
                return response()->json(['status' => 1,'redirect' => route('studentGradeList',['id' => $student_details->id])]);
            }else{
                return response()->json(['status' => 0,'message' => 'Sorry, Your QR Code does not exist in our system']);
            }
        }else{
            return response()->json(['status' => 0,'message' => 'Sorry, Your QR Code does not exist in our system']);
        }


    }
    public function studentGradeLogin(Request $request)
    {
        if($request->id && $request->pin){
            $id = strtolower($request->id);
            $id_parts = decodeStudentNumber($id);
            $student_details = $this->student->select('id')->where('id',$id_parts[0])->where('old_year_level',$id_parts[1])->where('pin',$request->pin)->first();
            if(isset($student_details->id)){
                return response()->json(['status' => 1,'redirect' => route('studentGradeList',['id' => $student_details->id])]);
            }else{
                return response()->json(['status' => 0,'message' => 'Credentials does not exist in our system.']);
            }
        }else{
            return response()->json(['status' => 0,'message' => 'Please provide both Student ID and PIN']);
        }
    }

    public function studentGradeList(Request $request)
    {
        if($request->get('id')){
            $student_details = $this->student->where('id',$request->get('id'))->first();
            $data['id'] = $student_details->id;
            $data['name'] = $student_details->last_name.','.$student_details->first_name.' '.getMiddleInitial($student_details->middle_name);
            $data['student'] = $student_details;
            $data['year'] = $student_details->old_year_level+1;
            return view('pages.student.studentGrade',$data);
        }else{
            return response()->json(['status' => 0,'message' => 'Sorry, Your QR Code does not exist in our system']);
        }
    }

    public function updatepin(Request $request)
    {
        $rules = ['pin'=>'required|confirmed|max:4|min:4','old_pin'=>'required'];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return back()->withErrors($validator)
                        ->withInput();
        }else{
            $c = $this->student->where('id',$request->get('id'))->where('pin',$request->get('old_pin'))->update([
                'pin' => $request->get('pin')
            ]);

            if($c){
                return back()->with('status','Your pin has been successfully updated');
            }else{
                return back()->with('status','Old Pin does not match');
            }

        }
    }

    public function updateStudentStatus(Request $request)
    {
        $guardian_details = $this->student->whereIn('id',$request->ids)->get();
        $faileds = [];
        $i = 0;
        if(!empty($request->ids)){

            $emails = [];
            foreach ($guardian_details as $value) {
                $section = $this->getAvailabelSection($value->old_year_level+1);
                if(!isset($section->year)){
                    $faileds[] = ['message'=>$value->last_name.' was not accepted, Sections for '.getYearText($value->old_year_level+1).' are already full'];
                    continue;
                }
                $this->createAttendance($section,$value->id);
                $this->checkStudentIfOld($value);
                $this->student->where('id',$value->id)->update(['section_id'=>$section->id]);
                $i++;
                $email = $value->guardian_email;
                Mail::send('email', ['key' => url('/onlinepayment',$parameters = ['secret_key' => $this->secret_key,'student_id'=>$value->id])], function($message) use ($email)
                {
                    $message->to($email)->subject('Olac online payment.');
                });
            }

            if(!is_null($faileds)){
                return response()->json(['status'=> 2 ,'faileds' => $faileds]);
            }
            return response()->json(['status' => 1,'message' => 'Total of number of Confirmed students : '.$i]);
        }else{
            return response()->json(['status' => 0,'message' => 'Confirmation Failed, Please try again.']);
        }
    }

    private function createAttendance($section,$student_id)
    {
        $table = $section->year.'_'.strtolower($section->section_name);
        //get all available subject for specific section
        $subjects = $this->subject->select('subjects.id')->join('schedule as s','s.subject_id','subjects.id')->where('s.section_id',$section->id)->get();

        // insert initial data attendance for every subject
        foreach ($subjects as $key => $value) {
            //for transferees and late enrollees
            $at_table = DB::table($table)->select('total_attendance')->where('subject_id',$value->id)->first();

            //insert available subject
            DB::table($table)->insert([
                'student_id' => $student_id,
                'subject_id' => $value->id,
                'attendance' => 0,
                'absent_dates' => '',
                'total_attendance' => isset($at_table->total_attendance) ? $at_table->total_attendance : 0,
                'updated_at' => date('Y-m-d')
            ]);
        }
    }

    private function checkStudentIfOld($value)
    {
    }

    public function paymentView($secretKey,$id)
    {
        if($secretKey == $this->secret_key){
            $data['student'] = $this->student->where('id',$id)->first();
            return view('paymentView',$data);
        }else{
            return response(view('error.404'), 404);
        }
    }

    public function generateForm(Request $request)
    {
        $id = $request->get('id');
        $student = $this->student->where('id',$id)->first();
        $data['student'] = $student;
        $data['payment'] = $this->payment->first();
        $pdf = PDF::loadView('regform', $data);
        return $pdf->download(generateStudentNumber($student->old_year_level+1,$student->id).'.pdf');
    }

    public function getAvailabelSection($year)
    {
        $sections_per_year = $this->section->where('year',$year)->orderBy('created_at')->get();
        foreach ($sections_per_year as $key => $val) {
            $students = $this->student->where('section_id',$val->id)->where('status',1)->count();
            if($students < $val->capacity){
                return $val;
                break;
            }
        }

        return false;
    }

    public function rejectStudents(Request $request)
    {
        $student = $this->student->whereIn('id',$request->ids)->get();
         foreach ($student as $value) {
                $email = $value->guardian_email;
                //send email to guardian
                Mail::send('emailfailedreg',[], function($message) use ($email)
                {
                    $message->to($email)->subject('OLAC Enrollment.');
                });
                //delete student
                $this->student->where('id',$value->id)->delete();

            }

        return response()->json(['status' => 1,'message' => 'Student rejection successfully.']);
    }
}